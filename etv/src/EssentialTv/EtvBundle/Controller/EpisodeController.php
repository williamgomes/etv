<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EssentialTv\EtvBundle\Entity\Episodes;
use EssentialTv\EtvBundle\Entity\EpisodeRatings;
use Symfony\Component\HttpFoundation\JsonResponse;
use EssentialTv\EtvBundle\Entity\UserShowSeasonEpisode;

class EpisodeController extends Controller {

    public function indexAction($id) {
        $session = $this->getRequest()->getSession();


        //initializing the variables
        $episodeInfo = array();
        $reactionInfo = array();
        $spoilerInfo = array();
        $quoteInfo = array();
        $showInfo = array();
        $countReaction = 0;
        $countSpoiler = 0;
        $countQuote = 0;

        //initializing entity manager
        $entityManager = $this->getDoctrine()->getManager();

        //checking if $id is greater than 0 or not
        if ($id > 0) {
            //getting episode info from db
            $episodeInfo = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->findBy(array('episodeId' => $id));
            $showId = $episodeInfo[0]->getEpisodeShowId();
            
            //getting show info from db
            $showInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($showId);
            
            //getting shows characters
            $showCharactersResult = $entityManager->getRepository('EssentialTvEtvBundle:CharacterShow')->getCharactersOfShow($showId);
            $showCharacters = array();
            
            foreach($showCharactersResult as $characters)
            {
                $showCharacters[] = array('id'=>$characters->getCharacterId(),'name'=>$characters->getCharacterTitle(),'avatar' => $this->container->get('router')->getContext()->getBaseUrl().$characters->getCharacterBannerImage(),'type'=>'contact');
            }
            
            
            $showCharacters = json_encode($showCharacters);
            //getting reaction info from db
            $reactionInfo = $entityManager->getRepository('EssentialTvEtvBundle:Reactions')->getReactionsAndResponse($id);
            //counting reactions
            $countReaction = count($reactionInfo);

            //getting spoiler info from db
            $spoilerInfo = $entityManager->getRepository('EssentialTvEtvBundle:Spoilers')->findBy(array('spoilerEpisodeId' => $id));
            //counting spoilers
            $countSpoiler = count($spoilerInfo);


            //getting quote info from db
            $quoteInfo = $entityManager->getRepository('EssentialTvEtvBundle:Quotes')->getEpisodeQuotesWthUser($id);
            //counting quotes
            $countQuote = count($quoteInfo);

            //checking if episode already rated by the user or not
            $session = $this->getRequest()->getSession();
            $userId = 0;
            $countRating = 0;
            if ($session->get('isLoggedIn')) {
                $userId = $session->get('user')->getUserId();
            }

            if ($userId > 0) {
                $episodeRatingInfo = $entityManager->getRepository('EssentialTvEtvBundle:EpisodeRatings')->findBy(array("erUserId" => $userId, "erEpisodeId" => $id));
                $countRating = count($episodeRatingInfo);
            }
            
            
            //getting yes and no rating from db
            $yesRating = $entityManager->getRepository('EssentialTvEtvBundle:ConfigSettings')->findBy(array("csOption" => "ESSENTIAL_YES_VALUE"));
            $noRating = $entityManager->getRepository('EssentialTvEtvBundle:ConfigSettings')->findBy(array("csOption" => "ESSENTIAL_NO_VALUE"));
            
            
            $taggedCharInfo = $entityManager->getRepository('EssentialTvEtvBundle:CharacterSeasonEpisode')->getEpisodeWiseChar($id);
        }

        //returning the template with results
        return $this->render('EssentialTvEtvBundle:Episode:index.html.twig', array('episodeInfo' => $episodeInfo,
                    'reactionInfo' => $reactionInfo,
                    'countReaction' => $countReaction,
                    'spoilerInfo' => $spoilerInfo,
                    'countSpoiler' => $countSpoiler,
                    'quoteInfo' => $quoteInfo,
                    'countQuote' => $countQuote,
                    'episodeId' => $id,
                    'showInfo' => $showInfo,
                    'isLoggedIn' => $session->get('isLoggedIn'),
                    'countRating' => $countRating,
                    'yesRating' => $yesRating,
                    'noRating' => $noRating,
                    'showCharacters' => $showCharacters,
                    'taggedCharInfo' => $taggedCharInfo));
    }

    public function reactiondetailsAction($id, $episodeid) {
        $session = $this->getRequest()->getSession();

        //initializing the variables
        $reactionInfo = array();
        $reactionResponseInfo = array();

        //initializing entity manager
        $entityManager = $this->getDoctrine()->getManager();

        //checking if $id is greater than 0 or not
        if ($id > 0) {
            //getting episode info from db
            $episodeInfo = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->find($episodeid);

            $reactionInfo = $entityManager->getRepository('EssentialTvEtvBundle:Reactions')->find($id);
            $reactionResponseInfo = $entityManager->getRepository('EssentialTvEtvBundle:Reactions')->findBy(array('reactionParentId' => $id));
        }

        //returning the template with results
        return $this->render('EssentialTvEtvBundle:Episode:reactiondetails.html.twig', array('reactionInfo' => $reactionInfo,
                    'reactionResponseInfo' => $reactionResponseInfo,
                    'episodeInfo' => $episodeInfo,
                    'reactionId' => $id,
                    'isLoggedIn' => $session->get('isLoggedIn')));
    }

    public function episodeReactionsAction(Request $_request) {
        $session = $this->getRequest()->getSession();
        if ($session->get('isLoggedIn')) {
            if ($_request->isXMLHttpRequest()) {
                //for now keeping user id = 1
                $session = $this->getRequest()->getSession();
                $userID = $session->get('user')->getUserId();
                $dateTimeNow = date_create(date("Y-m-d H:i:s"));
                $episodeId = $_request->get('episodeId');
                $showId = $_request->get('showId');
                $feedback = $_request->get('feedback');

                //initializing entity manager
                $entityManager = $this->getDoctrine()->getManager();

                $reviewExist = $entityManager->getRepository('EssentialTvEtvBundle:EpisodeRatings')->findBy(array("erUserId" => $userID, "erEpisodeId" => $episodeId));
                if ($reviewExist == null) {
                    $userObject = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($userID);
                    $episodeObject = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->find($episodeId);
                    $showObject = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($showId);

                    $episodeRating = new EpisodeRatings;
                    $episodeRating->setErUserId($userID);
                    $episodeRating->setErEpisodeId($episodeId);
                    $episodeRating->setErShowId($showId);
                    $episodeRating->setErRatingValue($feedback);
                    $episodeRating->setErCreatedOn($dateTimeNow);
                    $episodeRating->setErCreatedBy($userID);
                    $episodeRating->setErUpdatedBy($userID);
                    $episodeRating->setErUpdatedOn($dateTimeNow);


                    $entityManager->persist($episodeRating);


                    if ($feedback == 'yes') {
                        $episodeObject->setEpisodeEssentialCountTotal($episodeObject->getEpisodeEssentialCountTotal() + 1);
                    } else {
                        $episodeObject->setEpisodeNotEssentialCountTotal($episodeObject->getEpisodeNotEssentialCountTotal() + 1);
                    }
                    $entityManager->persist($episodeRating);
                    $entityManager->flush();
                    $rating = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->getEpisodeRating($episodeId);
                    //prepare the response, e.g.

                    $response = array("isPosted" => true, "message" => "Success!! your review has been posted.", "rating" => $rating);
                    //you can return result as JSON
                } else {
                    $rating = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->getEpisodeRating($episodeId);
                    $response = array("isPosted" => false, "message" => "You have already posted review for this episode", "rating" => $rating);
                }
//you can return result as JSON
                return new JsonResponse($response);
            } else {
                return new JsonResponse('This is not ajax!', 400);
            }
        } else {
            $response = array("isPosted" => false, "message" => "Please login to post a review.");
            return new JsonResponse($response);
        }
    }

    public function getEpisodeListAjaxAction(Request $_request) {

        $showId = trim($_request->get('showId'), ",");
        if ($showId == "") {
            $response = array("isPosted" => false, "message" => "No show has been selected");
            return new JsonResponse(json_encode($response));
        }
        $entityManager = $this->getDoctrine()->getManager();

        /////Load the requested data
        $episodesInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getEpisodeListInShows($showId);
        $options = "";
        foreach ($episodesInfo as $episode) {
            $imageSrc = "<img src='" . $this->get('request')->getBaseUrl() . $episode['episodeBannerImage'] . "'>";
            $options .= '<option value="' . $episode['episodeId'] . '" class="option_eight" data-left="' . $imageSrc . '">&nbsp;S'.$episode['episodeSeason'].'E'.$episode['episodeNumber']." - " . $episode['episodeTitle'] . '</option>';
        }

        $response = array("isPosted" => true, "message" => $options);
        return new JsonResponse(json_encode($response));
    }

    public function suggestAction($id) {
        $request = $this->container->get('request');
        $text = $request->request->get('keyword');

        if ($text != "") {
            if (isset($text[0])) {
                $keyword = $text[0];
                $keyword = str_replace("@", "", $keyword);
                $keyword = str_replace(" ", "%", $keyword);
            }
        } else {
            $keyword = '';
        }

        //initializing entity manager
        $entityManager = $this->getDoctrine()->getManager();

        $arrCharacter = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->getEpisodeSuggestion($keyword, $id);
        //prepare the response, e.g.
        $response = array("episodes" => $arrCharacter);
        //you can return result as JSON
        return new JsonResponse($response);
    }

    public function viewVideoAction($id) {
        //initializing entity manager
        $entityManager = $this->getDoctrine()->getManager();
        $episodeUserId = 0;
        //checking if session exist and user logged in
        $session = $this->getRequest()->getSession();
        $createdDateTime = date_create(date("Y-m-d H:i:s"));

        if ($session->get('isLoggedIn')) {
            $episodeUserId = $session->get('user')->getUserId();
        }

        $episodeInfo = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->find($id);
        $episodeVideoUrl = $episodeInfo->episodeVideoUrl;
        $episodeShowId = $episodeInfo->episodeShowId;
        $episodeSeasonId = $episodeInfo->episodeSeasonId;

        $userShowSeasonEpisode = new UserShowSeasonEpisode();

        $userShowSeasonEpisode->setUsseUserId($episodeUserId);
        $userShowSeasonEpisode->setUsseEpisodeId($id);
        $userShowSeasonEpisode->setUsseShowId($episodeShowId);
        $userShowSeasonEpisode->setUsseSeasonId($episodeSeasonId);
        $userShowSeasonEpisode->setUsseCreatedBy($episodeUserId);
        $userShowSeasonEpisode->setUsseCreatedOn($createdDateTime);
        $userShowSeasonEpisode->setUsseUpdatedBy($episodeUserId);
        $userShowSeasonEpisode->setUsseUpdatedOn($createdDateTime);

        $entityManager->persist($userShowSeasonEpisode);
        $entityManager->flush();

        //if user logged in then this episode id will be added to his last watched episode id
        if ($episodeUserId > 0) {
            $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($episodeUserId);
            $userInfo->setUserLastViewedEpisodeId($id);
            $userInfo->setUserLastViewedEpisodeDatetime($createdDateTime);
            $entityManager->flush();
        }

        //returning the template with results
        return $this->render('EssentialTvEtvBundle:Episode:viewVideo.html.twig', array('episodeInfo' => $episodeInfo));
    }

}

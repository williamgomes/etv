<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EssentialTv\EtvBundle\Entity\SeasonsRepository;
use EssentialTv\EtvBundle\Entity\PostRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use EssentialTv\EtvBundle\Entity\CharacterSeasonEpisode;

class CharacterController extends Controller {

    public function suggestAction() {
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
        $showId = $request->request->get('showId'); 
        if($showId!="")    
        {
            $showId = $request->request->get('showId');
            $arrCharacter = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->getCharacterSuggestionShow($keyword,$showId);
        }
        else
        $arrCharacter = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->getCharacterSuggestion($keyword);
        //prepare the response, e.g.
        $response = array("characters" => $arrCharacter);
        //you can return result as JSON
        return new JsonResponse(json_encode($response));
    }

    public function detailsAction($id, $showid = "") {
        $entityManager = $this->getDoctrine()->getManager();
        $showId = $showid;

        $characterInfo = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->find($id);
        
        $characterAppearance = $entityManager->getRepository('EssentialTvEtvBundle:CharacterShow')->findBy(array("csCharacterId" => $id));
        $countCharAppearance = count($characterAppearance);

        $episodesInfo = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->getEpisodeByCharactersOrderDesc($id);
        $countEpisode = count($episodesInfo);

        $fandomInfo = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getPostsByCharactersOrderDesc($id);
        $countFandom = count($fandomInfo);


        $quoteInfo = $entityManager->getRepository('EssentialTvEtvBundle:Quotes')->getQuotesByCharacterOrdrDesc($id);
        $countQuote = count($quoteInfo);

        $showInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($showId);
        
        $userRole = '';
        $session = $this->getRequest()->getSession();
        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
        }
        
        $charMostApperedSeason = $entityManager->getRepository('EssentialTvEtvBundle:CharacterSeasonEpisode')->getMostApperanceOfChar($id);

        return $this->render('EssentialTvEtvBundle:Character:details.html.twig', array("characterInfo" => $characterInfo,
                    "episodesInfo" => $episodesInfo,
                    "countEpisode" => $countEpisode,
                    "fandomInfo" => $fandomInfo,
                    "countFandom" => $countFandom,
                    "quoteInfo" => $quoteInfo,
                    "countQuote" => $countQuote,
                    "showInfo" => $showInfo,
                    "showId" => $showId,
                    "userRole" => $userRole,
                    "countCharAppearance" => $countCharAppearance,
                    "charMostApperedSeason" => $charMostApperedSeason));
    }

    public function charDetailsAction($id) {
        $entityManager = $this->getDoctrine()->getManager();

        $characterInfo = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->find($id);
        
        $characterAppearance = $entityManager->getRepository('EssentialTvEtvBundle:CharacterShow')->findBy(array("csCharacterId" => $id));
        $countCharAppearance = count($characterAppearance);

        $episodesInfo = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->getEpisodeByCharactersOrderDesc($id);
        $countEpisode = count($episodesInfo);

        $fandomInfo = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getPostsByCharactersOrderDesc($id);
        $countFandom = count($fandomInfo);


        $quoteInfo = $entityManager->getRepository('EssentialTvEtvBundle:Quotes')->getQuotesByCharacterOrdrDesc($id);
        $countQuote = count($quoteInfo);
        
        $userRole = '';
        $session = $this->getRequest()->getSession();
        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
        }

        $charMostApperedSeason = $entityManager->getRepository('EssentialTvEtvBundle:CharacterSeasonEpisode')->getMostApperanceOfChar($id);
        $prevUrl = $this->get('request')->server->get('HTTP_REFERER');
        return $this->render('EssentialTvEtvBundle:Character:charDetails.html.twig', array("characterInfo" => $characterInfo,
                    "episodesInfo" => $episodesInfo,
                    "countEpisode" => $countEpisode,
                    "fandomInfo" => $fandomInfo,
                    "countFandom" => $countFandom,
                    "quoteInfo" => $quoteInfo,
                    "countQuote" => $countQuote,
                    "userRole" => $userRole,
                    "countCharAppearance" => $countCharAppearance,
                    "charMostApperedSeason" => $charMostApperedSeason,
                    "prevUrl"=>$prevUrl));
    }

    public function editAction($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $characterInfo = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->find($id);
        $episodesInfo = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->getEpisodeByCharactersOrderDesc($id);
        $countEpisode = count($episodesInfo);

        $defaultName = $characterInfo->getCharacterTitle();
        $aliasOne = $characterInfo->getCharacterAliasOne();
        $aliasTwo = $characterInfo->getCharacterAliasTwo();
        $aliasThree = $characterInfo->getCharacterAliasThree();
        $aliasFour = $characterInfo->getCharacterAliasFour();
        $mainActor = $characterInfo->getCharacterActors();
        if ($mainActor != "") {
            $arrMainActor = explode(',', $mainActor);
            if (count($arrMainActor > 0)) {
                $actorOne = $arrMainActor[0];
                if (isset($arrMainActor[1])) {
                    $actorTwo = $arrMainActor[1];
                } else {
                    $actorTwo = "";
                }
            }
        } else {
            $actorOne = '';
            $actorTwo = '';
        }


        $form = $this->createFormBuilder($characterInfo)
                ->add('characterTitle', 'text', array('label' => 'Default Name', 'required' => true, 'data' => $defaultName))
                ->add('characterAliasOne', 'text', array('label' => 'Alias One', 'required' => true, 'data' => $aliasOne))
                ->add('characterAliasTwo', 'text', array('label' => 'Alias Two', 'required' => true, 'data' => $aliasTwo))
                ->add('characterAliasThree', 'text', array('label' => 'Alias Three', 'required' => true, 'data' => $aliasThree))
                ->add('characterAliasFour', 'text', array('label' => 'Alias Four', 'required' => true, 'data' => $aliasFour))
                ->add('characterAliasFour', 'text', array('label' => 'Alias Four', 'required' => true, 'data' => $aliasFour))
                ->add('characterAliasFour', 'text', array('label' => 'Alias Four', 'required' => true, 'data' => $aliasFour))
                ->add('actorOne', 'text', array('label' => 'Actor One', 'required' => true, 'data' => $actorOne))
                ->add('actorTwo', 'text', array('label' => 'Actor Two', 'required' => true, 'data' => $actorTwo))
                ->getForm();

        return $this->render('EssentialTvEtvBundle:Character:edit.html.twig', array("characterInfo" => $characterInfo,
                    "episodesInfo" => $episodesInfo,
                    "countEpisode" => $countEpisode,
                    'form' => $form->createView(),
                    "mainActor" => $mainActor));
    }

    public function updateAction($id) {
        //for now keeping user id = 1
        $userID = 1;
        $request = $this->container->get('request');
        $defaultName = $request->request->get('defaultName');
        $aliasOne = $request->request->get('aliasOne');
        $aliasTwo = $request->request->get('aliasTwo');
        $aliasThree = $request->request->get('aliasThree');
        $aliasFour = $request->request->get('aliasFour');
        $actorOne = $request->request->get('actorOne');
        $actorTwo = $request->request->get('actorTwo');
        $mainActors = $actorOne . ',' . $actorTwo;

        //initializing entity manager
        $entityManager = $this->getDoctrine()->getManager();

        $characterInfo = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->find($id);

        $characterInfo->setCharacterAliasOne($aliasOne);
        $characterInfo->setCharacterAliasTwo($aliasTwo);
        $characterInfo->setCharacterAliasThree($aliasThree);
        $characterInfo->setCharacterAliasFour($aliasFour);
        $characterInfo->setCharacterActors($mainActors);
        $characterInfo->setCharacterTitle($defaultName);

        $entityManager->flush();

        $response = array("id" => $id);
        //you can return result as JSON
        return new JsonResponse(json_encode($response));
    }

    public function uploadImageAction(Request $request) {

        $entityManager = $this->getDoctrine()->getManager();

        $charId = $request->request->get('charId');

        $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/uploads/characters';

        $charInfo = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->find($charId);


        if (count($request->files->get('char_img')) > 0) {
            if ($request->files->get('char_img')->getMimeType() == "image/png" OR $request->files->get('char_img')->getMimeType() == "image/jpg" OR $request->files->get('char_img')->getMimeType() == "image/jpeg" OR $request->files->get('char_img')->getMimeType() == "image/gif") {
                $extension = $request->files->get('char_img')->guessExtension();
                if (!$extension) {
//                            if extension cannot be guessed
                    $extension = 'bin';
                }
                $newNameofFile = date("ymdHis") . "_" . rand(100000000, 999999999) . '.' . $extension;
                $request->files->get('char_img')->move($uploadDir, $newNameofFile);
                $charBannerImage = '/images/uploads/characters/' . $newNameofFile;
                $charInfo->setCharacterBannerImage($charBannerImage);
            }
        }

        try {
            $entityManager->flush();
            $response = array("isPosted" => TRUE);
        } catch (Exception $e) {
            //you can return result as JSON
            $response = array("isPosted" => FALSE);
        }
        return new JsonResponse($response);
    }

    public function getCharacterListAjaxAction(Request $_request) {

        $showId = trim($_request->get('showId'), ",");
        if ($showId == "") {
            $response = array("isPosted" => false, "message" => "No show has been selected");
            return new JsonResponse(json_encode($response));
        }
        $entityManager = $this->getDoctrine()->getManager();

        /////Load the requested data
        $episodesInfo = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->getShowCharecters($showId);
        $options = "";
        foreach ($episodesInfo as $episode) {
            $imageSrc = "<img src='" . $this->get('request')->getBaseUrl() . $episode['characterBannerImage'] . "'>";
            $options .= '<option value="' . $episode['characterId'] . '" class="option_eight" data-left="' . $imageSrc . '">' . $episode['characterTitle'] . '</option>';
        }

        $response = array("isPosted" => true, "message" => $options);
        return new JsonResponse(json_encode($response));
    }

    public function characterPrevalenceAction() {
        $entityManager = $this->getDoctrine()->getManager();

        $allCharacterInfo = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->getAllCharacters();

        $allQuotesInfo = $entityManager->getRepository('EssentialTvEtvBundle:Quotes')->getAllQuotes();

        $allSpoilerInfo = $entityManager->getRepository('EssentialTvEtvBundle:Spoilers')->getAllSpoiler();

        $allEpisodeInfo = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->getAllEpisodes();

        $arrNewEpisodeInfo = array();
        foreach ($allEpisodeInfo AS $Episode) {
            $arrNewEpisodeInfo[$Episode['episodeId']] = $Episode;
        }



        $arrCountAgainstEpisode = array();
        foreach ($allCharacterInfo AS $Character) {
            $charId = $Character['characterId'];

            foreach ($allQuotesInfo AS $Quotes) {
                if ($Quotes['quoteCharacterId'] == $charId) {
                    if (isset($arrCountAgainstEpisode[$Quotes['quoteCharacterId']][$Quotes['quoteEpisodeId']])) {
                        $arrCountAgainstEpisode[$Quotes['quoteCharacterId']][$Quotes['quoteEpisodeId']] = $arrCountAgainstEpisode[$Quotes['quoteCharacterId']][$Quotes['quoteEpisodeId']] + 1;
                    } else {
                        $arrCountAgainstEpisode[$Quotes['quoteCharacterId']][$Quotes['quoteEpisodeId']] = 1;
                    }
                }
            }

            foreach ($allSpoilerInfo AS $Spoiler) {
                if ($Spoiler['spoilerCharacterIds'] != "") {
                    if (in_array($charId, explode(",", $Spoiler['spoilerCharacterIds']))) {
                        if (isset($arrCountAgainstEpisode[$charId][$Spoiler['spoilerEpisodeId']])) {
                            $arrCountAgainstEpisode[$charId][$Spoiler['spoilerEpisodeId']] = $arrCountAgainstEpisode[$charId][$Spoiler['spoilerEpisodeId']] + 1;
                        } else {
                            $arrCountAgainstEpisode[$charId][$Spoiler['spoilerEpisodeId']] = 1;
                        }
                    }
                }
            }
        }


        $seasonId = 0;
        $CharacterId = 0;
        $charCount = 0;
        $charEpisode = 0;
        foreach ($arrCountAgainstEpisode AS $Key => $Val) {
            $CharacterId = $Key;
            foreach ($Val AS $Kkey => $Vval) {
                $charCount = $Vval;
                $charEpisode = $Kkey;

                if (isset($arrNewEpisodeInfo[$charEpisode])) {
                    $seasonId = $arrNewEpisodeInfo[$charEpisode]['episodeSeasonId'];
                }
                $charEpisodeCountInfo = $entityManager->getRepository('EssentialTvEtvBundle:CharacterSeasonEpisode')->findBy(array(
                    "cseCharacterId" => $CharacterId,
                    "cseSeasonId" => $seasonId,
                    "cseEpisodeId" => $charEpisode
                ));

                if (count($charEpisodeCountInfo) > 0) {//record already exist
                    $charEpisodeCountInfo[0]->setCseApperanceCount($charCount);
                    $entityManager->flush();
                } else {//record do not exist, need to create one
                    $createdDateTime = date_create(date("Y-m-d H:i:s"));

                    $newCharEpisodeCount = new CharacterSeasonEpisode();
                    $newCharEpisodeCount->setCseCharacterId($CharacterId);
                    $newCharEpisodeCount->setCseSeasonId($seasonId);
                    $newCharEpisodeCount->setCseEpisodeId($charEpisode);
                    $newCharEpisodeCount->setCseApperanceCount($charCount);
                    $newCharEpisodeCount->setCseCreatedBy(0);
                    $newCharEpisodeCount->setCseCreatedOn($createdDateTime);
                    $newCharEpisodeCount->setCseUpdatedBy(0);
                    $newCharEpisodeCount->setCseUpdatedOn($createdDateTime);


                    try {
                        $entityManager->persist($newCharEpisodeCount);
                        $entityManager->flush();
                        echo "Data saved successfully";
                    } catch (Exception $ex) {
                        echo "Error: " . $ex;
                    }
                }
            }
        }

        return $this->render('EssentialTvEtvBundle:Character:characterPrevalence.html.twig');
    }

}

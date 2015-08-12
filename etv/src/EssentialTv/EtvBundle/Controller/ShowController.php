<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EssentialTv\EtvBundle\Entity\Seasons;
use EssentialTv\EtvBundle\Entity\Shows;
use EssentialTv\EtvBundle\Entity\Episodes;
use EssentialTv\EtvBundle\Entity\Posts;
use EssentialTv\EtvBundle\Entity\ShowRepository;
use EssentialTv\EtvBundle\Entity\SeasonsRepository;
use EssentialTv\EtvBundle\Entity\EpisodesRepository;

class ShowController extends Controller {

    public function indexAction($filter = "Trending") {
        $entityManager = $this->getDoctrine()->getManager();
        $recentEpisodes = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getFourRecentEpisodes();
        $popularPost = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getMostPopularPost();
        $postList = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getPostList($filter, 0, 12);
        $firstResult = 12;

        return $this->render('EssentialTvEtvBundle:Show:index.html.twig', array("popularPost" => $popularPost[0], "postList" => $postList,
                    "recentEpisodes" => $recentEpisodes, "filter" => $filter, 'firstResult' => $firstResult));
    }

    public function seasonAction($id) {
        //initializing the variables
        $seasonsInfo = array();
        $episodeInfo = array();
        $characterInfo = array();
        $countSeason = 0;
        $countEpisode = 0;
        $countCharacter = 0;

        //initializing entity manager
        $entityManager = $this->getDoctrine()->getManager();

        //checking if $id is greater than 0 or not
        if ($id > 0) {
            $showInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($id);
//            $seasonsInfo = $entityManager->getRepository('EssentialTvEtvBundle:Seasons')->getSeasonsFromShowOrderDesc($id);
            $episodeInfo = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->getEpisodesFromShowOrderBySeason($id);
//            echo "<pre>";
//            print_r($episodeInfo);
            $arrEpisodeInfo = array();
            foreach ($episodeInfo AS $Episode) {
                $arrEpisodeInfo[$Episode->episodeSeasonId][] = $Episode;
            }
            ksort($arrEpisodeInfo);
            
            $characterInfo = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->getCharacterFromShowOrderDesc($id);

            $countEpisode = count($arrEpisodeInfo);
            $countCharacter = count($characterInfo);
            $arrLastViewedEpisodeInfo = array();
            $session = $this->getRequest()->getSession();
            if ($session->get('isLoggedIn')) {
                $userId = $session->get('user')->getUserId();
                $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($userId);
                
                $userLastViewedEpisode = $userInfo->getUserLastViewedEpisodeId();
                if($userLastViewedEpisode > 0){
                    foreach($episodeInfo AS $Episode) {
                        if($userLastViewedEpisode == $Episode->episodeId){
                            $arrLastViewedEpisodeInfo = $Episode;
                        }
                    }
                }
            }
        }

        //returning the template with results
        return $this->render('EssentialTvEtvBundle:Show:season.html.twig', array("seasonInfo" => $seasonsInfo,
                    "episodeInfo" => $arrEpisodeInfo,
                    "oldEpisodeInfo" => $episodeInfo,
                    "countSeason" => $countSeason,
                    "countEpisode" => $countEpisode,
                    "characterInfo" => $characterInfo,
                    "countCharacter" => $countCharacter,
                    "arrLastViewedEpisodeInfo" => $arrLastViewedEpisodeInfo,
                    "showInfo" => $showInfo,
                    "showId" => $id));
    }

    public function chooseShowAction($filter = "") {

        $alphabets = array();
        foreach (range('A', 'Z') as $char) {
            $alphabets[] = $char;
        }

        $entityManager = $this->getDoctrine()->getManager();
        $shows = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getShowList($filter, 0, 12);

        return $this->render('EssentialTvEtvBundle:Show:chooseShow.html.twig', array("alphabets" => $alphabets, 'shows' => $shows, 'filter' => 'Trending'));
    }

    public function showListAjaxAction($filter = "", $offset) {
        $entityManager = $this->getDoctrine()->getManager();
        $shows = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getShowList($filter, $offset, 12);

        return $this->render('EssentialTvEtvBundle:Show:chooseShowAjaxElements.html.twig', array('shows' => $shows, 'filter' => $filter, 'offset' => $offset + 12));
    }

    public function showDetailsAction($showTitle) {
        $entityManager = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        $showDetails = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getShowBySlug($showTitle);
        if ($session->get('isLoggedIn')) {
            $userId = $session->get('user')->getUserId();
            $entityManager->getRepository('EssentialTvEtvBundle:Users')->logActivity($userId, 'show', $showDetails->getShowId());
        }
        if ($showDetails == false) {
            throw $this->createNotFoundException('Show does not exist');
        }
        $id = $showDetails->getShowId();
        $episodes = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getEpisodeList($id, 0, 12);
        return $this->render('EssentialTvEtvBundle:Show:showSelected.html.twig', array('episodes' => $episodes, 'show' => $showDetails, 'showId' => $id, 'isLoggedIn' => $session->get('isLoggedIn')));
    }

    public function showSelectedAction($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $showDetails = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($id);
        $episodes = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getEpisodeList($id, 0, 12);
        return $this->render('EssentialTvEtvBundle:Show:showSelected.html.twig', array('episodes' => $episodes, 'show' => $showDetails, 'showId' => $id, 'isLoggedIn' => $session->get('isLoggedIn')));
    }

    public function loadMoreEpisodesAction($id = 0, $offset = 0) {
        $entityManager = $this->getDoctrine()->getManager();
        $episodes = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getEpisodeList($id, $offset, 12);
        $offset = $offset + 12;
        return $this->render('EssentialTvEtvBundle:Show:episodeListAjax.html.twig', array('episodes' => $episodes, 'showId' => $id, 'filter' => $offset));
    }

}

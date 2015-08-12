<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EssentialTv\EtvBundle\Entity\Episodes;
use EssentialTv\EtvBundle\Entity\EpisodeRatings;
use EssentialTv\EtvBundle\Entity\PostReactions;
use Symfony\Component\HttpFoundation\JsonResponse;
use EssentialTv\EtvBundle\Entity\Reactions;

class ReactionController extends Controller {

    public function addReactionAction(Request $request) {
        if ($request->getMethod() == 'POST') {
            $newReaction = new Reactions();

            $createdDateTime = date_create(date("Y-m-d H:i:s"));
            $session = $this->getRequest()->getSession();
            $userID = $session->get('user')->getUserID();
            $status = 'active';

            $newReaction->setReactionUserId($userID);
            $newReaction->setReactionEpisodeId($request->request->get('episodeId'));
            $newReaction->setReactionParentId(0);
            $newReaction->setReactionText($request->request->get('reaction'));
            $newReaction->setReactionCreatedOn($createdDateTime);
            $newReaction->setReactionUpdatedOn($createdDateTime);
            $newReaction->setReactionCreatedBy($userID);
            $newReaction->setReactionUpdatedBy($userID);

            $eM = $this->getDoctrine()->getManager();
            $eM->persist($newReaction);
            $eM->flush();
            
            //getting reaction info from db
            $episodeId = $request->request->get('episodeId');
            $reactionInfo = $eM->getRepository('EssentialTvEtvBundle:Reactions')->getReactionsAndResponse($episodeId);
            //counting reactions
            $countReaction = count($reactionInfo);

            $response = array("isPosted" => true, "reactionInfo" => $reactionInfo);
            return new JsonResponse(json_encode($response));
        }
    }
    
    public function addPostsReactionAction(Request $request) {
        if ($request->getMethod() == 'POST') {
            $newReaction = new PostReactions();

            $createdDateTime = date_create(date("Y-m-d H:i:s"));
            $session = $this->getRequest()->getSession();
            $userID = $session->get('user')->getUserID();
            $status = 'active';

            $newReaction->setReactionUserId($userID);
            $newReaction->setReactionPostId($request->request->get('postId'));
            $newReaction->setReactionParentId(0);
            $newReaction->setReactionText($request->request->get('reaction'));
            $newReaction->setReactionCreatedOn($createdDateTime);
            $newReaction->setReactionUpdatedOn($createdDateTime);
            $newReaction->setReactionCreatedBy($userID);
            $newReaction->setReactionUpdatedBy($userID);

            $eM = $this->getDoctrine()->getManager();
            $eM->persist($newReaction);
            $eM->flush();
            
            //getting reaction info from db
            $episodeId = $request->request->get('postId');
            $reactionInfo = $eM->getRepository('EssentialTvEtvBundle:PostReactions')->getPostsReactionsAndResponse($episodeId);
            //counting reactions
            $countReaction = count($reactionInfo);

            $response = array("isPosted" => true, "reactionInfo" => $reactionInfo);
            return new JsonResponse(json_encode($response));
        }
    }

    public function addResponseAction(Request $request) {
        
        if ($request->getMethod() == 'POST') {
            $newResponse = new Reactions();

            $createdDateTime = date_create(date("Y-m-d H:i:s"));
            $session = $this->getRequest()->getSession();
            $userID = $session->get('user')->getUserID();
            $status = 'active';

            $newResponse->setReactionUserId($userID);
            $newResponse->setReactionEpisodeId($request->request->get('episodeId'));
            $newResponse->setReactionParentId($request->request->get('reactionId'));
            $newResponse->setReactionText($request->request->get('response'));
            $newResponse->setReactionCreatedOn($createdDateTime);
            $newResponse->setReactionUpdatedOn($createdDateTime);
            $newResponse->setReactionCreatedBy($userID);
            $newResponse->setReactionUpdatedBy($userID);

            $eM = $this->getDoctrine()->getManager();
            $eM->persist($newResponse);
            $eM->flush();

            $response = array("isPosted" => true);
            return new JsonResponse(json_encode($response));
        }
    }
    
    
    public function postReactiondetailsAction($id, $episodeid) {
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

            $reactionInfo = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->find($id);
            $reactionResponseInfo = $entityManager->getRepository('EssentialTvEtvBundle:Reactions')->findBy(array('reactionParentId' => $id));
        }

        //returning the template with results
        return $this->render('EssentialTvEtvBundle:Episode:reactiondetails.html.twig', array('reactionInfo' => $reactionInfo,
                    'reactionResponseInfo' => $reactionResponseInfo,
                    'episodeInfo' => $episodeInfo,
                    'reactionId' => $id,
                    'isLoggedIn' => $session->get('isLoggedIn')));
    }

}

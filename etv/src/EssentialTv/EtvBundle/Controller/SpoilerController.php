<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EssentialTv\EtvBundle\Entity\SpoilerFeedbacksRepository;
use EssentialTv\EtvBundle\Entity\SpoilerFeedbacks;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use EssentialTv\EtvBundle\Entity\Spoilers;

class SpoilerController extends Controller {

    public function approveAction(Request $_request) {
        if ($_request->isXMLHttpRequest()) {
            //for now keeping user id = 1
            $session = $this->getRequest()->getSession();
            $userID = $session->get('user')->getUserID();
            $dateTimeNow = date_create(date("Y-m-d H:i:s"));
            $feedback = 'approve';
            $spoilerID = $_request->get('spoilerID');

            //initializing entity manager
            $entityManager = $this->getDoctrine()->getManager();

            $intCount = $entityManager->getRepository('EssentialTvEtvBundle:SpoilerFeedbacks')->countIfFeedbackGiven($userID, $spoilerID);

            if ($intCount == 0) {
                $spoilerFeedback = new SpoilerFeedbacks;
                $spoilerFeedback->setSpoilerFeedbackUserId($userID);
                $spoilerFeedback->setSpoilerFeedbackFeedback($feedback);
                $spoilerFeedback->setSpoilerFeedbackSpoilerId($spoilerID);
                $spoilerFeedback->setSpoilerFeedbackCreatedOn($dateTimeNow);
                $spoilerFeedback->setSpoilerFeedbackCreatedBy($userID);
                $spoilerFeedback->setSpoilerFeedbackUpdatedBy($userID);
                $spoilerFeedback->setSpoilerFeedbackUpdatedOn($dateTimeNow);


                $entityManager->persist($spoilerFeedback);
                $entityManager->flush();

                //prepare the response, e.g.
                $response = array("id" => $dateTimeNow);
                //you can return result as JSON
                return new JsonResponse(json_encode($response));
            } else {
                $spoilerFeedbackObj = $entityManager->getRepository('EssentialTvEtvBundle:SpoilerFeedbacks')->findBy(array('spoilerFeedbackUserId' => $userID, 'spoilerFeedbackSpoilerId' => $spoilerID));

                $spoilerFeedbackObj[0]->setSpoilerFeedbackFeedback($feedback);

                $entityManager->flush();

                //prepare the response, e.g.
                $response = array("id" => $dateTimeNow);
                //you can return result as JSON
                return new JsonResponse(json_encode($response));
            }
        } else {
            return new JsonResponse('This is not ajax!', 400);
        }
    }

    public function disputeAction(Request $_request) {
        if ($_request->isXMLHttpRequest()) {
            //for now keeping user id = 1
            $session = $this->getRequest()->getSession();
            $userID = $session->get('user')->getUserID();
            $dateTimeNow = date_create(date("Y-m-d H:i:s"));
            $feedback = 'dispute';
            $spoilerID = $_request->get('spoilerID');

            //initializing entity manager
            $entityManager = $this->getDoctrine()->getManager();

            $intCount = $entityManager->getRepository('EssentialTvEtvBundle:SpoilerFeedbacks')->countIfFeedbackGiven($userID, $spoilerID);

            $objDisputeFeedback = $entityManager->getRepository('EssentialTvEtvBundle:SpoilerFeedbacks')->findBy(array("spoilerFeedbackSpoilerId" => $spoilerID));

            $countDisputeFeedback = count($objDisputeFeedback);

            if ($countDisputeFeedback >= 10) {
                $quoteInfo = $entityManager->getRepository('EssentialTvEtvBundle:Spoilers')->find($spoilerID);

                $quoteInfo->setSpoilerStatus('inactive');

                $entityManager->flush();
            }

            if ($intCount == 0) {
                $spoilerFeedback = new SpoilerFeedbacks;
                $spoilerFeedback->setSpoilerFeedbackUserId($userID);
                $spoilerFeedback->setSpoilerFeedbackFeedback($feedback);
                $spoilerFeedback->setSpoilerFeedbackSpoilerId($spoilerID);
                $spoilerFeedback->setSpoilerFeedbackCreatedOn($dateTimeNow);
                $spoilerFeedback->setSpoilerFeedbackCreatedBy($userID);
                $spoilerFeedback->setSpoilerFeedbackUpdatedBy($userID);
                $spoilerFeedback->setSpoilerFeedbackUpdatedOn($dateTimeNow);


                $entityManager->persist($spoilerFeedback);
                $entityManager->flush();

                //prepare the response, e.g.
                $response = array("id" => $dateTimeNow);
                //you can return result as JSON
                return new JsonResponse(json_encode($response));
            } else {
                $spoilerFeedbackObj = $entityManager->getRepository('EssentialTvEtvBundle:SpoilerFeedbacks')->findBy(array('spoilerFeedbackUserId' => $userID, 'spoilerFeedbackSpoilerId' => $spoilerID));

                $spoilerFeedbackObj[0]->setSpoilerFeedbackFeedback($feedback);

                $entityManager->flush();

                //prepare the response, e.g.
                $response = array("id" => $dateTimeNow);
                //you can return result as JSON
                return new JsonResponse(json_encode($response));
            }
        } else {
            return new JsonResponse('This is not ajax!', 400);
        }
    }

    public function addAction(Request $request) {
        if ($request->getMethod() == 'POST') {

            $newSpoiler = new Spoilers();

            $createdDateTime = date_create(date("Y-m-d H:i:s"));
            $session = $this->getRequest()->getSession();
            $userID = $session->get('user')->getUserID();
            $status = 'active';

            $newSpoiler->setSpoilerEpisodeId($request->request->get('episodeId'));
            $newSpoiler->setSpoilerUserId($userID);
            $newSpoiler->setSpoilerCharacterIds($request->request->get('taggedChactr'));
            $newSpoiler->setSpoilerText($request->request->get('spoiler'));
            $newSpoiler->setSpoilerStatus($status);
            $newSpoiler->setSpoilerCreatedOn($createdDateTime);
            $newSpoiler->setSpoilerCreatedBy($userID);
            $newSpoiler->setSpoilerUpdatedOn($createdDateTime);
            $newSpoiler->setSpoilerUpdatedBy($userID);

            $eM = $this->getDoctrine()->getManager();
            $eM->persist($newSpoiler);
            $eM->flush();

            //getting spoiler info from db
            $episodeId = $request->request->get('episodeId');
            $objSpoilerInfo = $eM->getRepository('EssentialTvEtvBundle:Spoilers')->getAllSpoilerEpisode($episodeId);

            $response = array("isPosted" => true, "objSpoilerInfo" => $objSpoilerInfo);
            return new JsonResponse(json_encode($response));
        }
    }

}

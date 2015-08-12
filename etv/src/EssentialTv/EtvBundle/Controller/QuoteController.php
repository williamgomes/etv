<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EssentialTv\EtvBundle\Entity\QuoteFeedbacksRepository;
use EssentialTv\EtvBundle\Entity\QuoteFeedbacks;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use EssentialTv\EtvBundle\Entity\Quotes;

class QuoteController extends Controller {

    public function approveAction(Request $_request) {
        if ($_request->isXMLHttpRequest()) {
            //for now keeping user id = 1
            $session = $this->getRequest()->getSession();
            $userID = $session->get('user')->getUserID();
            $dateTimeNow = date_create(date("Y-m-d H:i:s"));
            $feedback = 'approve';
            $quoteID = $_request->get('quoteID');

            //initializing entity manager
            $entityManager = $this->getDoctrine()->getManager();

            $intCount = $entityManager->getRepository('EssentialTvEtvBundle:QuoteFeedbacks')->countIfFeedbackGiven($userID, $quoteID);

            if ($intCount == 0) {
                $quoteFeedback = new QuoteFeedbacks;
                $quoteFeedback->setQuoteFeedbackUserId($userID);
                $quoteFeedback->setQuoteFeedbackFeedback($feedback);
                $quoteFeedback->setQuoteFeedbackSpoilerId($quoteID);
                $quoteFeedback->setQuoteFeedbackCreatedOn($dateTimeNow);
                $quoteFeedback->setQuoteFeedbackCreatedBy($userID);
                $quoteFeedback->setQuoteFeedbackUpdatedBy($userID);
                $quoteFeedback->setQuoteFeedbackUpdatedOn($dateTimeNow);


                $entityManager->persist($quoteFeedback);
                $entityManager->flush();

                //prepare the response, e.g.
                $response = array("id" => $dateTimeNow);
                //you can return result as JSON
                return new JsonResponse(json_encode($response));
            } else {
                $quoteFeedbackObj = $entityManager->getRepository('EssentialTvEtvBundle:QuoteFeedbacks')->findBy(array('quoteFeedbackUserId' => $userID, 'quoteFeedbackSpoilerId' => $quoteID));

                $quoteFeedbackObj[0]->setQuoteFeedbackFeedback($feedback);

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
            $quoteID = $_request->get('quoteID');

            //initializing entity manager
            $entityManager = $this->getDoctrine()->getManager();

            $intCount = $entityManager->getRepository('EssentialTvEtvBundle:QuoteFeedbacks')->countIfFeedbackGiven($userID, $quoteID);

            $objDisputeFeedback = $entityManager->getRepository('EssentialTvEtvBundle:QuoteFeedbacks')->findBy(array("quoteFeedbackSpoilerId" => $quoteID));

            $countDisputeFeedback = count($objDisputeFeedback);

            if ($countDisputeFeedback >= 10) {
                $quoteInfo = $entityManager->getRepository('EssentialTvEtvBundle:Quotes')->find($quoteID);

                $quoteInfo->setQuoteStatus('inactive');

                $entityManager->flush();
            }

            if ($intCount == 0) {
                $quoteFeedback = new QuoteFeedbacks;
                $quoteFeedback->setQuoteFeedbackUserId($userID);
                $quoteFeedback->setQuoteFeedbackFeedback($feedback);
                $quoteFeedback->setQuoteFeedbackSpoilerId($quoteID);
                $quoteFeedback->setQuoteFeedbackCreatedOn($dateTimeNow);
                $quoteFeedback->setQuoteFeedbackCreatedBy($userID);
                $quoteFeedback->setQuoteFeedbackUpdatedBy($userID);
                $quoteFeedback->setQuoteFeedbackUpdatedOn($dateTimeNow);


                $entityManager->persist($quoteFeedback);
                $entityManager->flush();

                //prepare the response, e.g.
                $response = array("id" => $dateTimeNow);
                //you can return result as JSON
                return new JsonResponse(json_encode($response));
            } else {
                $quoteFeedbackObj = $entityManager->getRepository('EssentialTvEtvBundle:QuoteFeedbacks')->findBy(array('quoteFeedbackUserId' => $userID, 'quoteFeedbackSpoilerId' => $quoteID));

                $quoteFeedbackObj[0]->setQuoteFeedbackFeedback($feedback);

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

            $newQuote = new Quotes();

            $createdDateTime = date_create(date("Y-m-d H:i:s"));
            $session = $this->getRequest()->getSession();
            $userID = $session->get('user')->getUserID();
            $status = 'active';
            $pageType = $request->request->get('type');

            $newQuote->setQuoteEpisodeId($request->request->get('episodeId'));
            $newQuote->setQuoteUserId($userID);
            $newQuote->setQuoteText($request->request->get('txtQuote'));
            $newQuote->setQuoteCharacterId($request->request->get('charId'));
            $newQuote->setQuoteStatus($status);
            $newQuote->setQuoteCreatedOn($createdDateTime);
            $newQuote->setQuoteCreatedBy($userID);
            $newQuote->setQuoteUpdatedOn($createdDateTime);
            $newQuote->setQuoteUpdateBy($userID);

            $eM = $this->getDoctrine()->getManager();
            $eM->persist($newQuote);
            $eM->flush();

            //getting quote info from db
            $episodeId = $request->request->get('episodeId');
            $characterId = $request->request->get('charId');

            $quoteInfo = array();
            if ($pageType == "Epi") {
                $quoteInfo = $eM->getRepository('EssentialTvEtvBundle:Quotes')->getEpisodeQuotesWthUser($episodeId);
                //counting quotes
                $countQuote = count($quoteInfo);
            } elseif($pageType == "Char") {
                $quoteInfo = $eM->getRepository('EssentialTvEtvBundle:Quotes')->getQuotesChar($characterId);
                //counting quotes
                $countQuote = count($quoteInfo);
            }

            $response = array("isPosted" => true, "quoteInfo" => $quoteInfo);
            return new JsonResponse($response);
        }
    }

}

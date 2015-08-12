<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EssentialTv\EtvBundle\Entity\Shows;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller {

public function searchAction(Request $request){
    $qParam =  $request->query->get('query');
    $entityManager = $this->getDoctrine()->getManager();
    $searchInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getSearchResult($qParam);
     shuffle($searchInfo);
    return $this->render('EssentialTvEtvBundle:Default:search.html.twig',array('result'=>$searchInfo));
}

}

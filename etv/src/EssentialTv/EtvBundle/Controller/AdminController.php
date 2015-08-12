<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EssentialTv\EtvBundle\Entity\Seasons;
use EssentialTv\EtvBundle\Entity\Shows;
use EssentialTv\EtvBundle\Entity\Episodes;
use EssentialTv\EtvBundle\Entity\Characters;
use EssentialTv\EtvBundle\Entity\CharacterShow;
use EssentialTv\EtvBundle\Entity\ConfigSettings;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use EssentialTv\EtvBundle\Entity\CharacterShowRepository;
use EssentialTv\EtvBundle\Entity\UserShowSeasonEpisode;
use EssentialTv\EtvBundle\Entity\UserShowSeasonEpisodeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class AdminController extends Controller {

    public function indexAction() {
        $session = $this->getRequest()->getSession();

        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            if ($userRole == "ROLE_ADMIN") {
                $entityManager = $this->getDoctrine()->getManager();

                $allConfigSettings = $entityManager->getRepository('EssentialTvEtvBundle:ConfigSettings')->getAllRows();

                $arrConfigSettings = array();
                foreach ($allConfigSettings AS $Config) {
                    $arrConfigSettings[$Config["csOption"]] = $Config["csValue"];
                }

                return $this->render('EssentialTvEtvBundle:Admin:index.html.twig', array(
                            "allConfigSettings" => $arrConfigSettings));
            } elseif ($userRole == "ROLE_MOD") {

                return $this->redirectToRoute("admin_show_select");
            } elseif ($userRole == "ROLE_USER") {

                return $this->redirectToRoute("home_page");
            }
        } else {
            return $this->redirectToRoute("home_page");
        }
    }

    public function updateSettingsAction(Request $request) {

        if ($request->getMethod() == 'POST') {

            $entityManager = $this->getDoctrine()->getManager();
            $chkStatus = 0;

//updating essential yes field
            $essentialYesValue = $request->request->get('essential_yes');
            $configEssentialYes = $entityManager->getRepository('EssentialTvEtvBundle:ConfigSettings')->updateOptionValue("ESSENTIAL_YES_VALUE", $essentialYesValue);
            if (!$configEssentialYes) {
                $chkStatus++;
            }


//updating essential yes field
            $essentialNoValue = $request->request->get('essential_no');
            $configEssentialNo = $entityManager->getRepository('EssentialTvEtvBundle:ConfigSettings')->updateOptionValue("ESSENTIAL_NO_VALUE", $essentialNoValue);
            if (!$configEssentialNo) {
                $chkStatus++;
            }


//updating essential yes field
            $disputeLimit = $request->request->get('dispute_limit');
            $configDisputLimit = $entityManager->getRepository('EssentialTvEtvBundle:ConfigSettings')->updateOptionValue("DISPUTE_LIMIT", $disputeLimit);
            if (!$configDisputLimit) {
                $chkStatus++;
            }

            if ($chkStatus == 0) {
                $response = array("isPosted" => true, "message" => "Settings updated successfully");
            } else {
                $response = array("isPosted" => false, "message" => "Failed!!");
            }

//you can return result as JSON
            return new JsonResponse($response);
        }
    }

    public function selectShowAction() {
        $session = $this->getRequest()->getSession();
        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            if ($userRole != "ROLE_ADMIN" && $userRole != "ROLE_MOD") {
                return $this->redirectToRoute("home_page");
            }
        } else {
            return $this->redirectToRoute("home_page");
        }
        $post = Request::createFromGlobals();
        if ($post->request->has('query')) {
            $query = $post->request->get('query');
            $results = $this->get_series_list($query);
            $showList = array();
            foreach ($results->hits as $shows) {
                $show = $shows->program;
                $id = $show->tmsId;
                $title = $show->title;
                $image = "http://wway.tmsimg.com/" . $show->preferredImage->uri;
                $showList[] = array('showId' => $id, 'showTitle' => $title, 'showBannerImage' => $image);
            }
            return $this->render('EssentialTvEtvBundle:Admin:showSelect.html.twig', array("showList" => $showList, 'role' => $userRole, 'query' => $query));
        } else {
            $query = '';
        }
        $entityManager = $this->getDoctrine()->getManager();
        $searchQuery = $entityManager->getRepository('EssentialTvEtvBundle:Shows')
                ->createQueryBuilder("s")
                ->where('s.showTitle LIKE :title')
                ->setParameter('title', $query . '%')
                ->getQuery();
        $showList = $searchQuery->getResult();

        return $this->render('EssentialTvEtvBundle:Admin:showSelect.html.twig', array("showList" => $showList, 'query' => null, 'role' => $userRole));
    }

    public function showControlAction($id, Request $request) {
        $session = $this->getRequest()->getSession();
        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            if ($userRole != "ROLE_ADMIN" && $userRole != "ROLE_MOD") {
                return $this->redirectToRoute("home_page");
            }
        } else {
            return $this->redirectToRoute("home_page");
        }
        $entityManager = $this->getDoctrine()->getManager();

/////Load the requested data
        $episodesInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($id);
///Building the form/////
        $originalDataSupersede = $episodesInfo->getShowOriginalDataSupersede() == "active" ? true : false;
        $showStatus = $episodesInfo->getShowStatus() == "active" ? true : false;
        $showAutoDataRefresh = $episodesInfo->getShowAutoDataRefresh() == "active" ? true : false;

        $form = $this->createFormBuilder($episodesInfo)
                ->add('showStatus', 'checkbox', array('label' => 'Show Currently Visible', 'data' => $showStatus, 'required' => false,))
                ->add('showOriginalDataSupersede', 'checkbox', array('label' => 'Original Data Supersedes Api', 'data' => $originalDataSupersede, 'required' => false,))
                ->add('showAutoDataRefresh', 'checkbox', array('label' => 'Show Auto Data Refresh Weekly', 'data' => $showAutoDataRefresh, 'required' => false,))
                ->add('showApiSummary', 'textarea', array('label' => 'API Summary'))
                ->add('showOriginalSummary', 'textarea', array('label' => 'Original Summary', 'required' => false))
                ->add('file', 'file', array('label' => 'Original Summary',
                    "required" => FALSE,
                    "attr" => array(
                        "accept" => "image/*",
                        "multiple" => "multiple",)))
//->add('file','file',array('label'=>'Original Image'))
                ->add('showAliasOne', 'text', array('label' => 'Alias One', 'required' => false))
                ->add('showAliasTwo', 'text', array('label' => 'Alias Two', 'required' => false))
                ->add('save', 'submit', array('label' => 'Update'))
                ->getForm();
        $images = json_decode($episodesInfo->getShowOriginalImages());
        $apiImages = json_decode($episodesInfo->getShowApiImages());
///////Submission Handling////
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (isset($request->request->get('form')['showOriginalDataSupersede'])) {
                $originalDataSupersede = $request->request->get('form')['showOriginalDataSupersede'] == "1" ? "active" : "inactive";
                isset($request->request->get('form')['showStatus']) ? $showStatus = $request->request->get('form')['showStatus'] == "1" ? "active" : "inactive" : $showStatus = "inactive";
                isset($request->request->get('form')['showAutoDataRefresh']) ? $showAutoDataRefresh = $request->request->get('form')['showAutoDataRefresh'] == "1" ? "active" : "inactive" : $showAutoDataRefresh = "inactive";
                $request->request->set('showOriginalDataSupersede', $originalDataSupersede);
                $request->request->set('showStatus', $showStatus);
                $request->request->set('showAutoDataRefresh', $showAutoDataRefresh);
            }
            $episodesInfo->upload();

            $entityManager->persist($episodesInfo);
            $entityManager->flush();
            $baseUrl = $this->get('request')->getBaseUrl();
            $session->set('updateMessage', 'Show Updated Sucessfully');
            return $this->redirect($baseUrl . '/admin/show/control/' . $id);
//return $this->render('EssentialTvEtvBundle:Admin:showControl.html.twig', array("episodesInfo" => $episodesInfo, 'images' => $images, 'form' => $form->createView()));
        }

        $message = $session->get('updateMessage');
        $session->set('updateMessage', '');
        return $this->render('EssentialTvEtvBundle:Admin:showControl.html.twig', array("episodesInfo" => $episodesInfo, 'showId' => $id, 'images' => $images, 'apiImages' => $apiImages, 'form' => $form->createView(), 'role' => $userRole, 'updateMessage' => $message));
    }

    public function showCharactersAction($id, Request $request) {
        $session = $this->getRequest()->getSession();

        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            if ($userRole != "ROLE_USER") {
                $objCharacter = new Characters();
                $characterShowInfo = array();
                $entityManager = $this->getDoctrine()->getManager();

/////Load the requested data
//        
                $showInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($id);

                $form = $this->createFormBuilder($objCharacter)
                        ->add('csv', 'file', array('label' => 'Upload CSV',
                            'mapped' => false,
                            "required" => TRUE,
                            "attr" => array(
                                "accept" => ".csv,.xls,.xlsx")))
                        ->add('upload', 'submit', array('attr' => array('class' => 'btn btn-block btn-blue'), 'label' => 'UPLOAD'))
                        ->getForm();
                $form->handleRequest($request);
                if ($request->getMethod() == 'POST') {
                    $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/uploads/csv/characters';
                    $extension = $form['csv']->getData()->guessExtension();

                    if (!$extension) {
// extension cannot be guessed
                        $extension = 'bin';
                    }

//getting a new name of uploaded file
                    $newNameofFile = rand(1, 99999) . '.' . $extension;

//uploading the file with the name selected and setting permission
                    $form['csv']->getData()->move($uploadDir, $newNameofFile);
                    chmod($uploadDir . '/' . $newNameofFile, 0755);

//loading file using phpexcel
                    $objPHPExcel = \PHPExcel_IOFactory::load($uploadDir . '/' . $newNameofFile);

//counting total sheet and setting sheet 1 as default working sheet
                    $sheetCount = $objPHPExcel->getSheetCount();
                    $PHPExcelActiveSheet = $objPHPExcel->setActiveSheetIndex(0);
                    $countHighestRow = $PHPExcelActiveSheet->getHighestRow(); //returns integer

                    $eM = $this->getDoctrine()->getManager();
                    for ($row = 2; $row <= $countHighestRow; ++$row) {
                        $characterID = $PHPExcelActiveSheet->getCellByColumnAndRow(0, $row);

                        if ($characterID == "") {
                            $Character = new Characters();
                            $CharacterShow = new CharacterShow();

                            $characterName = $PHPExcelActiveSheet->getCellByColumnAndRow(1, $row);
                            $characterSummary = $PHPExcelActiveSheet->getCellByColumnAndRow(2, $row);
                            $characterMainImage = $PHPExcelActiveSheet->getCellByColumnAndRow(3, $row);
                            $characterOtherImage = $PHPExcelActiveSheet->getCellByColumnAndRow(4, $row);
                            $characterAlias1 = $PHPExcelActiveSheet->getCellByColumnAndRow(5, $row);
                            $characterAlias2 = $PHPExcelActiveSheet->getCellByColumnAndRow(6, $row);
                            $characterAlias3 = $PHPExcelActiveSheet->getCellByColumnAndRow(7, $row);
                            $characterAlias4 = $PHPExcelActiveSheet->getCellByColumnAndRow(8, $row);
                            $characterBio = $PHPExcelActiveSheet->getCellByColumnAndRow(9, $row);


                            $originalDataSupersede = 'active';
                            $createdDateTime = date_create(date("Y-m-d H:i:s"));
                            $Character->setCharacterTitle($characterName);
                            $Character->setCharacterOriginalSummary($characterSummary);
                            $Character->setCharacterBannerImage($characterMainImage);
                            $Character->setCharacterOriginalImages($characterOtherImage);
                            $Character->setCharacterAliasOne($characterAlias1);
                            $Character->setCharacterAliasTwo($characterAlias2);
                            $Character->setCharacterAliasThree($characterAlias3);
                            $Character->setCharacterAliasFour($characterAlias4);
                            $Character->setCharacterBio($characterBio);
                            $Character->setCharacterOriginalDataSupersede($originalDataSupersede);
                            $Character->setCharacterCreatedOn($createdDateTime);
                            $Character->setCharacterUpdatedOn($createdDateTime);

                            $eM->persist($Character);
                            $eM->flush();

                            $characterID = $Character->getCharacterId();

                            $CharacterShow->setCsShowId($id);
                            $CharacterShow->setCsCharacterId($characterID);
                            $CharacterShow->setCsCreatedOn($createdDateTime);
                            $CharacterShow->setCsCreatedBy(1);
                            $CharacterShow->setCsUpdatedOn($createdDateTime);
                            $CharacterShow->setCsUpdatedBy(1);

//Saving data into database
                            $eM->persist($CharacterShow);
                            $eM->flush();
                        } else {
                            $CharacterInfo = $eM->getRepository('EssentialTvEtvBundle:Characters')->find($characterID);

                            $characterName = $PHPExcelActiveSheet->getCellByColumnAndRow(1, $row);
                            $characterSummary = $PHPExcelActiveSheet->getCellByColumnAndRow(2, $row);
                            $characterMainImage = $PHPExcelActiveSheet->getCellByColumnAndRow(3, $row);
                            $characterOtherImage = $PHPExcelActiveSheet->getCellByColumnAndRow(4, $row);
                            $characterAlias1 = $PHPExcelActiveSheet->getCellByColumnAndRow(5, $row);
                            $characterAlias2 = $PHPExcelActiveSheet->getCellByColumnAndRow(6, $row);
                            $characterAlias3 = $PHPExcelActiveSheet->getCellByColumnAndRow(7, $row);
                            $characterAlias4 = $PHPExcelActiveSheet->getCellByColumnAndRow(8, $row);
                            $characterBio = $PHPExcelActiveSheet->getCellByColumnAndRow(9, $row);

                            $createdDateTime = date_create(date("Y-m-d H:i:s"));
                            $CharacterInfo->setCharacterTitle($characterName);
                            $CharacterInfo->setCharacterOriginalSummary($characterSummary);
                            $CharacterInfo->setCharacterBannerImage($characterMainImage);
                            $CharacterInfo->setCharacterOriginalImages($characterOtherImage);
                            $CharacterInfo->setCharacterAliasOne($characterAlias1);
                            $CharacterInfo->setCharacterAliasTwo($characterAlias2);
                            $CharacterInfo->setCharacterAliasThree($characterAlias3);
                            $CharacterInfo->setCharacterAliasFour($characterAlias4);
                            $CharacterInfo->setCharacterBio($characterBio);
                            $CharacterInfo->setCharacterUpdatedOn($createdDateTime);

//Updating record into database
                            $eM->flush();
                        }
                    }

                    unlink($uploadDir . '/' . $newNameofFile);
                }

                $characterShowInfo = $entityManager->getRepository('EssentialTvEtvBundle:CharacterShow')->getCharactersOfShow($id);
                $countShowCharacters = count($characterShowInfo);

                return $this->render('EssentialTvEtvBundle:Admin:showCharacters.html.twig', array('form' => $form->createView(),
                            'showInfo' => $showInfo,
                            'characterShowInfo' => $characterShowInfo,
                            'countShowCharacters' => $countShowCharacters));
            } else {

                return $this->redirectToRoute("home_page");
            }
        } else {

            return $this->redirectToRoute("home_page");
        }
    }

    public function charactersDetailsAction($id, Request $request) {
        $session = $this->getRequest()->getSession();

        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            if ($userRole != "ROLE_USER") {
                $entityManager = $this->getDoctrine()->getManager();

/////Load the requested data
//        
                $characterInfo = $entityManager->getRepository('EssentialTvEtvBundle:Characters')->find($id);

                return $this->render('EssentialTvEtvBundle:Admin:charactersDetails.html.twig', array(
                            'characterInfo' => $characterInfo));
            } else {

                return $this->redirectToRoute("home_page");
            }
        } else {

            return $this->redirectToRoute("home_page");
        }
    }

    public function showRemovePictureAction(Request $request) {
        $showId = $request->request->get('showId');
        $image = $request->request->get('image');
        $entityManager = $this->getDoctrine()->getManager();
        $episodesInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($showId);
        $originalImages = json_decode($episodesInfo->getShowOriginalImages());
        unset($originalImages[$image]);


        $episodesInfo->setShowOriginalImages(json_encode($originalImages));
//print_r($episodesInfo->getShowOriginalImages());
        try {
//$entityManager->persist($episodesInfo);
            $entityManager->flush();
            $response = array("isPosted" => true, "message" => "Success!! Deleted image.");
        } catch (Exception $e) {
            $response = array("isPosted" => false, "message" => "Failed!!");
        }
//you can return result as JSON
//you can return result as JSON
        return new JsonResponse(json_encode($response));
    }

    public function showSetBannerAction(Request $request) {
        $showId = $request->request->get('showId');
        $image = $request->request->get('image');
        $entityManager = $this->getDoctrine()->getManager();
        $baseUrl = $this->get('request')->getBaseUrl();
        $episodesInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($showId);
        $image = str_replace($baseUrl, "", $image);
        $episodesInfo->setShowBannerImage(stripslashes($image));
        try {
//$entityManager->persist($episodesInfo);
            $entityManager->flush();
            $response = array("isPosted" => true, "message" => "Success!! Your banner has been changed.");
        } catch (Exception $e) {
            $response = array("isPosted" => false, "message" => "Failed!!");
        }
        return new JsonResponse(json_encode($response));
    }

    public function showSeasonAction($id) {
        $session = $this->getRequest()->getSession();

        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            if ($userRole != "ROLE_USER") {
//initializing the variables
                $seasonsInfo = array();
                $arrSeasonOriginalImage = array();
                $countSeason = 0;

//initializing entity manager
                $entityManager = $this->getDoctrine()->getManager();

//checking if $id is greater than 0 or not
                if ($id > 0) {
                    $showInfo = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($id);
                    $seasonsInfo = $entityManager->getRepository('EssentialTvEtvBundle:Seasons')->getSeasonsFromShowOrderDesc($id);

                    foreach ($seasonsInfo AS $Season) {
                        $seasonOriginalImages = $Season->seasonOriginalImages;
                        $seasonOriginalImages = json_decode($seasonOriginalImages);
                        $arrSeasonOriginalImage[$Season->seasonId][] = $seasonOriginalImages;
                    }
//            echo "<pre>";
//            print_r($arrSeasonOriginalImage);

                    $countSeason = count($seasonsInfo);
                }

                return $this->render('EssentialTvEtvBundle:Admin:showSeason.html.twig', array("showInfo" => $showInfo,
                            "seasonInfo" => $seasonsInfo,
                            "countSeason" => $countSeason,
                            "arrSeasonOriginalImage" => $arrSeasonOriginalImage));
            } else {

                return $this->redirectToRoute("home_page");
            }
        } else {

            return $this->redirectToRoute("home_page");
        }
    }

    public function seasonUpdateAction(Request $request, $id) {

        $entityManager = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST') {

            $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/uploads/seasons';

            $seasonInfo = $entityManager->getRepository('EssentialTvEtvBundle:Seasons')->find($id);

            $seasonOriginalImages = $seasonInfo->getSeasonOriginalImages();


            if ($seasonOriginalImages == "") {
                $seasonOriginalImages = array();
            } else {
                $seasonOriginalImages = json_decode($seasonOriginalImages);
            }



            if (count($request->files->get('files')) > 0) {
                foreach ($request->files->get('files') AS $Files) {
                    if ($Files->getMimeType() == "image/png" OR $Files->getMimeType() == "image/jpg" OR $Files->getMimeType() == "image/jpeg" OR $Files->getMimeType() == "image/gif") {
                        $extension = $Files->guessExtension();
                        if (!$extension) {
//                            if extension cannot be guessed
                            $extension = 'bin';
                        }
                        $newNameofFile = date("ymdHis") . "_" . rand(100000000, 999999999) . '.' . $extension;
                        $Files->move($uploadDir, $newNameofFile);
                        $seasonOriginalImages[] = '/images/uploads/seasons/' . $newNameofFile;
                    }
                }
            }
            $seasonOriginalImages = json_encode($seasonOriginalImages);


            if (count($request->files->get('banner_file')) > 0) {
                if ($request->files->get('banner_file')->getMimeType() == "image/png" OR $request->files->get('banner_file')->getMimeType() == "image/jpg" OR $request->files->get('banner_file')->getMimeType() == "image/jpeg" OR $request->files->get('banner_file')->getMimeType() == "image/gif") {
                    $extension = $request->files->get('banner_file')->guessExtension();
                    if (!$extension) {
//                            if extension cannot be guessed
                        $extension = 'bin';
                    }
                    $newNameofFile = date("ymdHis") . "_" . rand(100000000, 999999999) . '.' . $extension;
                    $request->files->get('banner_file')->move($uploadDir, $newNameofFile);
                    $seasonBannerImage = '/images/uploads/seasons/' . $newNameofFile;
                    $seasonInfo->setSeasonBannerImage($seasonBannerImage);
                }
            }

            $seasonInfo->setSeasonOriginalSummary($request->request->get('season_original_summary'));
            $seasonInfo->setSeasonApiSummary($request->request->get('season_api_summary'));
            $seasonInfo->setSeasonOriginalImages($seasonOriginalImages);

            try {
//$entityManager->persist($episodesInfo);
                $entityManager->flush();
                $response = array("isPosted" => true, "message" => "Season data updated successfully");
            } catch (Exception $e) {
                $response = array("isPosted" => false, "message" => "Failed!!");
            }
        }
//you can return result as JSON
        return new JsonResponse(json_encode($response));
    }

    public function deleteSeasonBannerAction($id) {

        $entityManager = $this->getDoctrine()->getManager();

        $seasonInfo = $entityManager->getRepository('EssentialTvEtvBundle:Seasons')->find($id);
        $seasonBannerImage = $seasonInfo->getSeasonBannerImage();

        unlink(dirname($this->container->getParameter('kernel.root_dir')) . '/web' . $seasonBannerImage);

        $seasonBannerImage = '';

        $seasonInfo->setSeasonBannerImage($seasonBannerImage);

        $entityManager->flush();

        try {
//$entityManager->persist($episodesInfo);
            $entityManager->flush();
            $response = array("isPosted" => true, "message" => "Deleted successfully");
        } catch (Exception $e) {
            $response = array("isPosted" => false, "message" => "Failed!!");
        }

//you can return result as JSON
        return new JsonResponse(json_encode($response));
    }

    public function deleteOtherImageAction(Request $request, $id) {

        $entityManager = $this->getDoctrine()->getManager();
        $imageKey = $request->request->get('imageID');

        $seasonInfo = $entityManager->getRepository('EssentialTvEtvBundle:Seasons')->find($id);
        $seasonOriginalImage = $seasonInfo->getSeasonOriginalImages();
        $seasonOriginalImage = json_decode($seasonOriginalImage);
//        print_r($seasonOriginalImage);


        unlink(dirname($this->container->getParameter('kernel.root_dir')) . '/web' . $seasonOriginalImage[$imageKey]);
        unset($seasonOriginalImage[$imageKey]);
//        $seasonOriginalImage = json_encode($seasonOriginalImage);

        $arrOtherImages = array();

        foreach ($seasonOriginalImage AS $key => $val) {
            $arrOtherImages[] = $val;
        }

        $seasonOriginalImage = json_encode($arrOtherImages);
        $seasonInfo->setSeasonOriginalImages($seasonOriginalImage);

        $entityManager->flush();

        try {
//$entityManager->persist($episodesInfo);
            $entityManager->flush();
            $response = array("isPosted" => true, "message" => "Deleted successfully");
        } catch (Exception $e) {
            $response = array("isPosted" => false, "message" => "Failed!!");
        }

//you can return result as JSON
        return new JsonResponse(json_encode($response));
    }

    public function userControlAction(Request $request) {
        $session = $this->getRequest()->getSession();

        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            if ($userRole != "ROLE_USER") {
                $entityManager = $this->getDoctrine()->getManager();

//getting all user info from db


                $userInfo = array();
                if ($request->getMethod() == 'POST') {
                    $keyword = $request->request->get('keyword');

                    if ($keyword == "") {
                        $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->getAllRows();
                    } else {
                        $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->userSearchResult($keyword);
                    }
                } else {
                    $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->getAllRows();
                }

//getting user rating info
                $episodeRatingInfo = $entityManager->getRepository('EssentialTvEtvBundle:EpisodeRatings')->getRatingCountPerUser();
                $arrEpisodeRatingUsr = array();
                foreach ($episodeRatingInfo AS $EpisodeRating) {
                    $arrEpisodeRatingUsr[$EpisodeRating['erUserId']] = $EpisodeRating['RatingCount'];
                }

                //getting latest show information for user
                $userShowInfo = $entityManager->getRepository('EssentialTvEtvBundle:UserShowSeasonEpisode')->getRecentShowInfo();
//                echo "<pre>";
//                print_r($userShowInfo);

                $arrUserWiseShowInfo = array();
                foreach ($userShowInfo AS $UserShow) {
                    $arrUserWiseShowInfo[$UserShow['usseUserId']][] = $UserShow;
                }
//                echo "<pre>";
//                print_r($arrUserWiseShowInfo);

                $userMaxViewesShowInfo = $entityManager->getRepository('EssentialTvEtvBundle:UserShowSeasonEpisode')->getMaxViewedShowUser();

                $arrUserWiseMaxViewedShowInfo = array();
                foreach ($userMaxViewesShowInfo AS $MaxViewedShow) {
                    $arrUserWiseMaxViewedShowInfo[$MaxViewedShow['usseUserId']][] = $MaxViewedShow;
                }


                $newArrSortedMaxView = array();
                foreach ($arrUserWiseMaxViewedShowInfo AS $UsrMaxView) {
                    $maxVal = 0;
                    foreach ($UsrMaxView AS $MaxViewed) {
                        if ($MaxViewed['USSECount'] > $maxVal) {
                            $maxVal = $MaxViewed['USSECount'];
                            $newArrSortedMaxView[$MaxViewed['usseUserId']] = $MaxViewed;
                        }
                    }
                }


                $userMaxReviewInfo = $entityManager->getRepository('EssentialTvEtvBundle:EpisodeRatings')->getHighestRatingUser();

                $arrUserMaxReviewInfo = array();
                foreach ($userMaxReviewInfo AS $MaxReviewShow) {
                    $arrUserMaxReviewInfo[$MaxReviewShow['erUserId']][] = $MaxReviewShow;
                }

                $newArrSortedMaxReview = array();
                foreach ($arrUserMaxReviewInfo AS $UsrMaxReview) {
                    $maxVal = 0;
                    foreach ($UsrMaxReview AS $MaxReviewed) {
                        if ($MaxReviewed['ERCount'] > $maxVal) {
                            $maxVal = $MaxReviewed['ERCount'];
                            $newArrSortedMaxReview[$MaxReviewed['erUserId']] = $MaxReviewed;
                        }
                    }
                }

                return $this->render('EssentialTvEtvBundle:Admin:userControl.html.twig', array(
                            "userInfo" => $userInfo,
                            "episodeRatingInfo" => $arrEpisodeRatingUsr,
                            "arrUserWiseShowInfo" => $arrUserWiseShowInfo,
                            "newArrSortedMaxView" => $newArrSortedMaxView,
                            "newArrSortedMaxReview" => $newArrSortedMaxReview
                ));
            } else {

                return $this->redirectToRoute("home_page");
            }
        } else {

            return $this->redirectToRoute("home_page");
        }
    }

    public function userDetailsAction($id) {
        $session = $this->getRequest()->getSession();

        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            if ($userRole != "ROLE_USER") {
                $entityManager = $this->getDoctrine()->getManager();

//getting all user info from db
                $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($id);

                $userRecentViewedShowInfo = $entityManager->getRepository('EssentialTvEtvBundle:UserShowSeasonEpisode')->getRecentShowInfoPerUser($id);

                $userMostViewedShowInfo = $entityManager->getRepository('EssentialTvEtvBundle:UserShowSeasonEpisode')->getMaxViewedShowPerUser($id);

                $arrUserMaxViewedShowInfo = array();
                foreach ($userMostViewedShowInfo AS $UserMaxViewedShow) {
                    $arrUserMaxViewedShowInfo[$UserMaxViewedShow['usseUserId']][] = $UserMaxViewedShow;
                }


                $newArrSortedMaxView = array();
                foreach ($arrUserMaxViewedShowInfo AS $UsrMaxView) {
                    $maxVal = 0;
                    foreach ($UsrMaxView AS $MaxViewed) {
                        if ($MaxViewed['USSECount'] > $maxVal) {
                            $maxVal = $MaxViewed['USSECount'];
                            $newArrSortedMaxView[$MaxViewed['usseUserId']] = $MaxViewed;
                        }
                    }
                }

                $episodeRatingInfo = $entityManager->getRepository('EssentialTvEtvBundle:EpisodeRatings')->getRatingCountUser($id);


                return $this->render('EssentialTvEtvBundle:Admin:userDetails.html.twig', array(
                            "userInfo" => $userInfo,
                            "userRecentViewedShowInfo" => $userRecentViewedShowInfo,
                            "userMostViewedShowInfo" => $userMostViewedShowInfo,
                            "newArrSortedMaxView" => $newArrSortedMaxView,
                            "episodeRatingInfo" => $episodeRatingInfo
                ));
            } else {

                return $this->redirectToRoute("home_page");
            }
        } else {

            return $this->redirectToRoute("home_page");
        }
    }

    public function addToSystemAction($showId) {
        ini_set('max_execution_time', 3000);
        $session = $this->getRequest()->getSession();
        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            $userId = $session->get('user')->getUserId();
            if ($userRole == "ROLE_ADMIN") {
                $show = $this->getSeriesDetails($showId);

                $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/downloads/shows';
                $relativePath = '/images/downloads/shows';
                $fs = new Filesystem();
                $imageName = explode("/", $show->preferredImage->uri);
                $image = $relativePath . "/" . end($imageName);
                $images = json_encode(array($image));
                $fs->copy("http://wway.tmsimg.com/" . $show->preferredImage->uri, $uploadDir . "/" . end($imageName));
                $showObj = new Shows();
                $showObj->setShowTmsId($show->tmsId);
                $showObj->setShowApiId($show->seriesId);
                $showObj->setShowSeasonTotal(isset($show->totalSeasons) ? $show->totalSeasons : 1);
                $showObj->setShowEpisodeTotal(isset($show->totalEpisodes) ? $show->totalEpisodes : 1);
                $showObj->setShowGenres(implode(",", $show->genres));
                $showObj->setShowTheme(isset($show->shortDescription) ? $show->shortDescription : "");
                $showObj->setShowTitle($show->title);
                $showObj->setShowOriginalSummary("");
                $showObj->setShowApiSummary($show->longDescription);
                $showObj->setShowOriginalImages($images);
                $showObj->setShowApiImages($images);
                $showObj->setShowBannerImage($image);
                $showObj->setShowAliasOne("");
                $showObj->setShowAliasTwo("");
                $showObj->setShowStatus("active");
                $showObj->setShowOriginalDataSupersede("inactive");
                $showObj->setShowAutoDataRefresh("inactive");
                $showObj->setShowsCreatedBy($userId);
                $showObj->setShowsUpdatedBy($userId);
                $showObj->setShowPopularity(0);
                $showObj->setShowsCreatedOn(date_create(date("Y-m-d H:i:s")));
                $showObj->setShowsUpdatedOn(date_create(date("Y-m-d H:i:s")));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($showObj);
                $entityManager->flush();

                $this->addSeasons($showObj, $show);
                $this->addEpisodes($showObj->getShowId(), $show->seriesId);
                $this->addCharecters($show->cast, $showId, $showObj->getShowId());

                $session->set('updateMessage', 'Show Sucessfully Added To System!');
                $baseUrl = $this->get('request')->getBaseUrl();
                return $this->redirect($baseUrl . '/admin/show/control/' . $showObj->getShowId());
            } else {

                return $this->redirectToRoute("home_page");
            }
        } else {

            return $this->redirectToRoute("home_page");
        }
    }

    function addSeasons($showObj, $show) {
        $entityManager = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            $userId = $session->get('user')->getUserId();
        }
        for ($i = 0; $i < $show->totalSeasons; $i++) {
            $seasonObj = new Seasons();
            $seasonObj->setSeasonTmsId($show->tmsId);
            $seasonObj->setSeasonApiId($show->seriesId);
            $seasonObj->setSeasonShowId($showObj->getShowId());
            $seasonObj->setSeasonEpisodeTotal(isset($show->totalEpisodes) ? $show->totalEpisodes : 1);
            $seasonObj->setSeasonTitle($show->title . " Season: " . $i);
            $seasonObj->setSeasonOriginalSummary("");
            $seasonObj->setSeasonApiSummary($show->longDescription);
            $seasonObj->setSeasonOriginalImages($showObj->getShowOriginalImages());
            $seasonObj->setSeasonApiImages($showObj->getShowApiImages());
            $seasonObj->setSeasonBannerImage($showObj->getShowBannerImage());
            $seasonObj->setSeasonStatus("active");
            $seasonObj->setSeasonOriginalDataSupersede("inactive");
            $seasonObj->setSeasonCreatedBy($userId);
            $seasonObj->setSeasonUpdatedBy($userId);
            $seasonObj->setSeasonCreatedOn(date_create(date("Y-m-d H:i:s")));
            $seasonObj->setSeasonUpdatedOn(date_create(date("Y-m-d H:i:s")));
            $entityManager->persist($seasonObj);
            $entityManager->flush();
        }
    }

    function addCharecters($cast, $showApiId, $showId) {
        $session = $this->getRequest()->getSession();
        $userId = $session->get('user')->getUserId();
        $eM = $this->getDoctrine()->getManager();
        foreach ($cast as $person) {
            $personDetails = $this->getPersonDetails($person->personId);

            $Character = new Characters();
            $CharacterShow = new CharacterShow();
            $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/downloads/characters';
            $relativePath = '/images/downloads/characters';
            $fs = new Filesystem();
            $images = array();
            $image = "";

            foreach ($personDetails as $personImages) {
                //print_r($personImages->uri);die;
                if (is_object($personImages)) {
                    $imageName = explode("/", $personImages->uri);
                    if (!property_exists($personImages, 'seriesId'))
                        $image = $relativePath . "/" . end($imageName);
                    else {
                        if ($personImages->seriesId == $showApiId)
                            $image = $relativePath . "/" . end($imageName);
                    }
                    $images[] = $image;
                    $fs->copy("http://wway.tmsimg.com/" . $personImages->uri, $uploadDir . "/" . end($imageName));
                }
            }
            $images = json_encode($images);
            $characterName = $person->characterName;
            $characterSummary = "";
            $characterMainImage = $image;
            $characterOtherImage = $images;
            $characterAlias1 = "";
            $characterAlias2 = "";
            $characterAlias3 = "";
            $characterAlias4 = "";
            $characterBio = "";


            $originalDataSupersede = 'active';
            $createdDateTime = date_create(date("Y-m-d H:i:s"));
            $Character->setCharacterTitle($characterName);
            $Character->setCharacterOriginalSummary($characterSummary);
            $Character->setCharacterBannerImage($characterMainImage);
            $Character->setCharacterOriginalImages($characterOtherImage);
            $Character->setCharacterAliasOne($characterAlias1);
            $Character->setCharacterAliasTwo($characterAlias2);
            $Character->setCharacterAliasThree($characterAlias3);
            $Character->setCharacterAliasFour($characterAlias4);
            $Character->setCharacterBio($characterBio);
            $Character->setCharacterOriginalDataSupersede($originalDataSupersede);
            $Character->setCharacterCreatedOn($createdDateTime);
            $Character->setCharacterUpdatedOn($createdDateTime);
            $Character->setCharacterActors($person->name);

            $eM->persist($Character);
            $eM->flush();

            $characterID = $Character->getCharacterId();

            $CharacterShow->setCsShowId($showId);
            $CharacterShow->setCsCharacterId($characterID);
            $CharacterShow->setCsCreatedOn($createdDateTime);
            $CharacterShow->setCsCreatedBy($userId);
            $CharacterShow->setCsUpdatedOn($createdDateTime);
            $CharacterShow->setCsUpdatedBy($userId);

//Saving data into database
            $eM->persist($CharacterShow);
            $eM->flush();
        }
    }

    function addEpisodes($showId, $show_api_id) {
        $session = $this->getRequest()->getSession();
        $userId = $session->get('user')->getUserId();
        $curl = curl_init();
        $curlUrl = 'http://data.tmsapi.com/v1.1/series/' . $show_api_id . '/episodes?imageAspectTV=16x9&imageText=false&offset=0&&api_key=gbqyzyeg6476m2hevgyryv93';
        echo $curlUrl;
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            //CURLOPT_URL => 'http://data.tmsapi.com/v1.1/series/185044/episodes?imageSize=Md&offset=0&api_key=gbqyzyeg6476m2hevgyryv93',
            CURLOPT_URL => $curlUrl,
            CURLOPT_USERAGENT => 'Gracenote Api'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $episode_list = json_decode($resp);
        $eM = $this->getDoctrine()->getManager();
        $fs = new Filesystem();
        $images = array();
        $image = "";
        $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/downloads/episodes';
        $relativePath = '/images/downloads/episodes';
        foreach ($episode_list->hits as $episodes) {
            //$episode_id = NULL;
            $episodeImage = $this->get_episode_specific_image($episodes->tmsId);
            if($episodeImage=="")
            {
                $episodeImage = $episodes->preferredImage->uri;
            }
            $imageName = explode("/", $episodeImage);
            $image = $relativePath . "/" . end($imageName);
            $images = json_encode(array($image));
            $createdDateTime = date_create(date("Y-m-d H:i:s"));
            $airingDate = isset($episodes->origAirDate) ? date_create($episodes->origAirDate) : $createdDateTime;
            $fs->copy("http://wway.tmsimg.com/" . $episodeImage, $uploadDir . "/" . end($imageName));
            $episode = new Episodes();
            $episode->setEpisodeTmsId($episodes->tmsId);
            $episode->setEpisodeApiId($episodes->rootId);
            $episode->setEpisodeShowId($showId);
            $episode->setEpisodeSeasonId(isset($episodes->seasonNum) ? $episodes->seasonNum : 0);
            $episode->setEpisodeNumber(isset($episodes->episodeNum) ? $episodes->episodeNum : 0);
            $episode->setEpisodeTitle(isset($episodes->episodeTitle) ? $episodes->episodeTitle : "Not Titled Yet");
            $episode->setEpisodeOriginalSummary("");
            $episode->setEpisodeApiSummary($episodes->longDescription);
            $episode->setEpisodeOriginalImages($images);
            $episode->setEpisodeApiImages($images);
            $episode->setEpisodeBannerImage($image);
            $episode->setEpisodeScreeningDate($airingDate);
            $episode->setOriginalDataSupersede("inactive");
            $episode->setEpisodeEssentialCountTotal(0);
            $episode->setEpisodeNotEssentialCountTotal(0);
            $episode->setEpisodeStatus("active");
            $episode->setEpisodeCreateBy($userId);
            $episode->setEpisodeCreatedOn($createdDateTime);
            $episode->setEpisodeUpdatedBy($userId);
            $episode->setEpisodeUpdatedOn($createdDateTime);
            $eM->persist($episode);
            $eM->flush();
            //mysqli_query($conn,$stmt);
        }
    }

    public function refreshDataNowAction($showId) {
        ini_set('max_execution_time', 3000);
        $session = $this->getRequest()->getSession();
        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            $userId = $session->get('user')->getUserId();
            if ($userRole == "ROLE_ADMIN") {
                $entityManager = $this->getDoctrine()->getManager();
                $showObj = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($showId);
                $show = $this->getSeriesDetails($showObj->getShowTmsId());

                $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/downloads/shows';
                $relativePath = '/images/downloads/shows';
                $fs = new Filesystem();
                $imageName = explode("/", $show->preferredImage->uri);
                $image = $relativePath . "/" . end($imageName);
                $images = json_encode(array($image));
                $fs->copy("http://wway.tmsimg.com/" . $show->preferredImage->uri, $uploadDir . "/" . end($imageName));
                //$showObj = new Shows();
                //$showObj->setShowTmsId($show->tmsId);
                $showObj->setShowApiId($show->seriesId);
                $showObj->setShowSeasonTotal(isset($show->totalSeasons) ? $show->totalSeasons : 1);
                $showObj->setShowEpisodeTotal(isset($show->totalEpisodes) ? $show->totalEpisodes : 1);
                $showObj->setShowGenres(implode(",", $show->genres));
                $showObj->setShowTheme(isset($show->shortDescription) ? $show->shortDescription : "");
                $showObj->setShowTitle($show->title);
                $showObj->setShowApiSummary($show->longDescription);
                $showObj->setShowApiImages($images);
                $showObj->setShowsUpdatedBy($userId);
                $showObj->setShowsUpdatedOn(date_create(date("Y-m-d H:i:s")));
                //$entityManager->persist($showObj);
                $entityManager->flush();

                $this->updateSeasons($showObj, $show);
                //$this->updateEpisodes($showObj->getShowId(),$show->seriesId);
                //$this->updateCharecters($show->cast,$showId,$showObj->getShowId());


                $baseUrl = $this->get('request')->getBaseUrl();
                return $this->redirect($baseUrl . '/admin/show/control/' . $showObj->getShowId());
            } else {

                return $this->redirectToRoute("home_page");
            }
        } else {

            return $this->redirectToRoute("home_page");
        }
    }

    function updateSeasons($showObj, $show) {
        $entityManager = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if ($session->get('isLoggedIn')) {
            $userRole = $session->get('user')->getUserRole();
            $userId = $session->get('user')->getUserId();
        }
        $seasons = $entityManager->getRepository('EssentialTvEtvBundle:Seasons')->findBy(array('seasonShowId' => $showObj->getShowId()));
        foreach ($seasons as $seasonObj) {
            //$seasonObj = new Seasons();
            $seasonObj->setSeasonTmsId($show->tmsId);
            $seasonObj->setSeasonApiId($show->seriesId);
            $seasonObj->setSeasonShowId($showObj->getShowId());
            $seasonObj->setSeasonEpisodeTotal(isset($show->totalEpisodes) ? $show->totalEpisodes : 1);
            //$seasonObj->setSeasonTitle($show->title." Season: ".$i);
            $seasonObj->setSeasonOriginalSummary("");
            $seasonObj->setSeasonApiSummary($show->longDescription);
            $seasonObj->setSeasonOriginalImages($showObj->getShowOriginalImages());
            $seasonObj->setSeasonApiImages($showObj->getShowApiImages());
            $seasonObj->setSeasonBannerImage($showObj->getShowBannerImage());
            $seasonObj->setSeasonStatus("active");
            $seasonObj->setSeasonOriginalDataSupersede("inactive");
            $seasonObj->setSeasonCreatedBy($userId);
            $seasonObj->setSeasonUpdatedBy($userId);
            $seasonObj->setSeasonCreatedOn(date_create(date("Y-m-d H:i:s")));
            $seasonObj->setSeasonUpdatedOn(date_create(date("Y-m-d H:i:s")));
            $entityManager->persist($seasonObj);
            $entityManager->flush();
        }
    }
    
function updateEpisodes($showId, $show_api_id) {
        $session = $this->getRequest()->getSession();
        $userId = $session->get('user')->getUserId();
        $curl = curl_init();
        $curlUrl = 'http://data.tmsapi.com/v1.1/series/' . $show_api_id . '/episodes?imageAspectTV=16x9&imageText=false&offset=0&&api_key=gbqyzyeg6476m2hevgyryv93';
        echo $curlUrl;
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            //CURLOPT_URL => 'http://data.tmsapi.com/v1.1/series/185044/episodes?imageSize=Md&offset=0&api_key=gbqyzyeg6476m2hevgyryv93',
            CURLOPT_URL => $curlUrl,
            CURLOPT_USERAGENT => 'Gracenote Api'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $episode_list = json_decode($resp);
        $eM = $this->getDoctrine()->getManager();
        $fs = new Filesystem();
        $images = array();
        $image = "";
        $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/downloads/episodes';
        $relativePath = '/images/downloads/episodes';
        foreach ($episode_list->hits as $episodes) {
            //$episode_id = NULL;
            $episodeImage = $this->get_episode_specific_image($episodes->tmsId);
            if($episodeImage=="")
            {
                $episodeImage = $episodes->preferredImage->uri;
            }
            $imageName = explode("/", $episodeImage);
            $image = $relativePath . "/" . end($imageName);
            $images = json_encode(array($image));
            $createdDateTime = date_create(date("Y-m-d H:i:s"));
            $airingDate = isset($episodes->origAirDate) ? date_create($episodes->origAirDate) : $createdDateTime;
            $fs->copy("http://wway.tmsimg.com/" . $episodeImage, $uploadDir . "/" . end($imageName));
            $episode = new Episodes();
            $episode->setEpisodeTmsId($episodes->tmsId);
            $episode->setEpisodeApiId($episodes->rootId);
            $episode->setEpisodeShowId($showId);
            $episode->setEpisodeSeasonId(isset($episodes->seasonNum) ? $episodes->seasonNum : 0);
            $episode->setEpisodeNumber(isset($episodes->episodeNum) ? $episodes->episodeNum : 0);
            $episode->setEpisodeTitle(isset($episodes->episodeTitle) ? $episodes->episodeTitle : "Not Titled Yet");
            $episode->setEpisodeOriginalSummary("");
            $episode->setEpisodeApiSummary($episodes->longDescription);
            $episode->setEpisodeOriginalImages($images);
            $episode->setEpisodeApiImages($images);
            $episode->setEpisodeBannerImage($image);
            $episode->setEpisodeScreeningDate($airingDate);
            $episode->setOriginalDataSupersede("inactive");
            $episode->setEpisodeEssentialCountTotal(0);
            $episode->setEpisodeNotEssentialCountTotal(0);
            $episode->setEpisodeStatus("active");
            $episode->setEpisodeCreateBy($userId);
            $episode->setEpisodeCreatedOn($createdDateTime);
            $episode->setEpisodeUpdatedBy($userId);
            $episode->setEpisodeUpdatedOn($createdDateTime);
            $eM->persist($episode);
            $eM->flush();
            //mysqli_query($conn,$stmt);
        }
    }

    function getPersonDetails($personId) {
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://data.tmsapi.com/v1.1/celebs/' . $personId . '/images?api_key=gbqyzyeg6476m2hevgyryv93',
            //CURLOPT_URL => 'http://data.tmsapi.com/v1.1/programs/search?q=2011&entityType=show&api_key='.$this->api_key,
            CURLOPT_USERAGENT => 'Gracenote Api'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $personDetails = json_decode($resp);
        return $personDetails;
    }

    function getSeriesDetails($showId) {
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://data.tmsapi.com/v1.1/programs/' . urlencode($showId) . '?imageAspectTV=16x9&imageText=false&api_key=gbqyzyeg6476m2hevgyryv93',
            //CURLOPT_URL => 'http://data.tmsapi.com/v1.1/programs/search?q=2011&entityType=show&api_key='.$this->api_key,
            CURLOPT_USERAGENT => 'Gracenote Api'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $series_list = json_decode($resp);
        return $series_list;
    }

    function get_series_list($param) {
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://data.tmsapi.com/v1.1/programs/search?q=' . urlencode($param) . '&entityType=Series&api_key=gbqyzyeg6476m2hevgyryv93',
            //CURLOPT_URL => 'http://data.tmsapi.com/v1.1/programs/search?q=2011&entityType=show&api_key='.$this->api_key,
            CURLOPT_USERAGENT => 'Gracenote Api'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $series_list = json_decode($resp);
        return $series_list;
    }
    
    function get_episode_specific_image($episodeId)
    {
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://data.tmsapi.com/v1.1/programs/'.$episodeId.'/images?imageAspectTV=16x9&api_key=gbqyzyeg6476m2hevgyryv93',
			//CURLOPT_URL => 'http://data.tmsapi.com/v1.1/programs/search?q=2011&entityType=show&api_key='.$this->api_key,
			CURLOPT_USERAGENT => 'Gracenote Api'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);
		$image_list = json_decode($resp);
                $epImage = "";
                $width = 0;
                if(is_array($image_list)){
		foreach ($image_list as $image)
		{
			if($image->tier =="Episode" && $image->width =="1280")
			{
				return $image->uri;
			}
                        if($image->tier =="Episode" && $width<$image->width)
                        {
                            $epImage = $image->uri;
                        }
		}
		
               return $epImage;
               }
                else
                    return "";
	
    }

}

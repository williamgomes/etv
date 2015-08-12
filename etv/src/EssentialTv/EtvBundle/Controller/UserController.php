<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EssentialTv\EtvBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller {

    public function loginAction() {
        return $this->render('EssentialTvEtvBundle:Default:search.html.twig');
    }

    public function signUpAction(Request $request) {

        $entityManager = $this->getDoctrine()->getManager();
        $user = new Users();
        $country = $entityManager->getRepository('EssentialTvEtvBundle:Country')->findAll();
        $countries = array();
        foreach ($country as $cnt) {
            $countries[$cnt->getCode()] = $cnt->getName();
        }
        $form = $this->createFormBuilder($user)
                ->add('userFirstName', 'text')
                ->add('userLastName', 'text')
                ->add('userEmail', 'email')
                ->add('userPassword', 'password')
                ->add('userGender', 'choice', array(
                    'choices' => array(
                        'Male' => 'Male',
                        'Female' => 'Female'),
                    'expanded' => true,
                    'multiple' => false
                ))
                ->add('userDob', 'date', array('years' => range(1900,2015)))
                ->add('userStreetAddress', 'text')
                ->add('userStreetAddress2', 'text')
                ->add('userCity', 'text')
                ->add('userCountry', 'choice', array(
                    'choices' => $countries))
                ->add('userZip', 'text')
                ->add('userState', 'text')
                ->add('save', 'submit', array('label' => 'Submit'))
                ->getForm();
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {

            $userData = $entityManager->getRepository('EssentialTvEtvBundle:Users')->findOneBy(array('userEmail' => $user->getUserEmail()));
            if ($userData) {
                return $this->render('EssentialTvEtvBundle:Users:signUp.html.twig', array('form' => $form->createView(), 'message' => 'User already exist. Choose a different Email'));
            }
            $hash = rand();
            $user->setUserPassword(crypt($user->getUserPassword(), $hash));
            $user->setUserHash($hash);
            $user->setUserStatus('active');
            $user->setUserVerification('no');
            $user->setUserRole('ROLE_USER');
            $entityManager->persist($user);
            $entityManager->flush();
            $session = $this->getRequest()->getSession();
            $session->set('regMessage', '<div class="alert alert-success">Registration Successfull!! Please login with your credentials.</div>');
            return $this->redirect($this->get('request')->getBaseUrl() . '/user/signin', 301);
        }

        //return $this->render('EssentialTvEtvBundle:Admin:showControl.html.twig', array("episodesInfo" => $episodesInfo, 'images' => $images, 'form' => $form->createView()));


        return $this->render('EssentialTvEtvBundle:Users:signUp.html.twig', array('form' => $form->createView()));
    }

    public function signInAction(Request $request) {

        $session = $this->getRequest()->getSession();
        $form = $this->createFormBuilder()
                ->add('email', 'email')
                ->add('password', 'password')
                ->getForm();
        $form->handleRequest($request);
        if ($request->getMethod() == 'POST') {
            if ($this->authenticate($request->request->get('form')['email'], $request->request->get('form')['password'])) {
                $userEmail = $request->request->get('form')['email'];
                $entityManager = $this->getDoctrine()->getManager();
                $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->findBy(array("userEmail" => $userEmail));
//                echo "<pre>";
//                print_r($userInfo);
                $userRole = $userInfo[0]->userRole;

                if ($userRole == "ROLE_USER") {
                    return $this->redirectToRoute("home_page");
                } elseif ($userRole == "ROLE_MOD") {
                    return $this->redirectToRoute("admin_show_select");
                } elseif ($userRole == "ROLE_ADMIN") {
                    return $this->redirectToRoute("admin_home");
                }
            } else {
                $message = '<div class="alert alert-danger">Username/Password Incorrect</div>';
                return $this->render('EssentialTvEtvBundle:Users:signIn.html.twig', array('message' => $message, 'form' => $form->createView()));
            }
        } else {
            $message = $session->get('regMessage');
            return $this->render('EssentialTvEtvBundle:Users:signIn.html.twig', array('form' => $form->createView(), 'message' => $message));
        }
    }

    public function showUserInfoHeaderAction() {
        $session = $this->getRequest()->getSession();
        $user = $session->get('user');
        return $this->render('EssentialTvEtvBundle:Users:userInfoHeader.html.twig', array('user' => $user));
        //return var_dump($user);
    }
    public function showUserInfoImageAction() {
        $session = $this->getRequest()->getSession();
        $user = $session->get('user');
        return $this->render('EssentialTvEtvBundle:Users:userInfoImage.html.twig', array('user' => $user));
        //return var_dump($user);
    }
    
    public function showUserMenuAction() {
        $session = $this->getRequest()->getSession();
        $user = $session->get('user');
        return $this->render('EssentialTvEtvBundle:Users:userMenu.html.twig', array('user' => $user));
        //return var_dump($user);
    }

    public function signOutAction() {
        $session = $this->getRequest()->getSession();
        $session->clear();
        return $this->redirectToRoute("home_page");
    }

    function authenticate($username, $password) {
        $entityManager = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $session->clear();
        $userData = $entityManager->getRepository('EssentialTvEtvBundle:Users')->findOneBy(array('userEmail' => $username));
        if (!$userData) {
            return false;
        }

        $prevPass = $userData->getUserPassword();
        $hash = $userData->getUserHash();
        if (crypt($password, $hash) === $prevPass) {
            //$role = new Role('ROLE_ADMIN');
            $session->set('user', $userData);
            $session->set('isLoggedIn', true);
            $session->set('userRole', $userData->getUserRole());
            return true;
        } else
            return false;
    }

    public function setTypeAction($id, Request $request) {
        if ($request->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();

            //getting user information
            $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($id);
            //setting user type
            $userInfo->setUserRole($request->request->get('userType'));
            //updating user info
            try {
                //$entityManager->persist($episodesInfo);
                $entityManager->flush();
                $response = array("isPosted" => true, "message" => "User role updated successfully.");
            } catch (Exception $e) {
                $response = array("isPosted" => false, "message" => "Failed!!");
            }
            //you can return result as JSON
            return new JsonResponse($response);
        }
    }

    public function suspendAction($id, Request $request) {
        if ($request->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();

            //getting user information
            $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($id);
            //setting user type
            $userInfo->setUserStatus($request->request->get('status'));
            //updating user info
            try {
                //$entityManager->persist($episodesInfo);
                $entityManager->flush();
                $response = array("isPosted" => true, "message" => "User status updated successfully.");
            } catch (Exception $e) {
                $response = array("isPosted" => false, "message" => "Failed!!");
            }
            //you can return result as JSON
            return new JsonResponse($response);
        }
    }

    public function deleteAction($id, Request $request) {
        if ($request->getMethod() == 'POST') {
            $entityManager = $this->getDoctrine()->getManager();

            //getting user information
            $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($id);
            //deleting user info
            try {
                //$entityManager->persist($episodesInfo);
                $entityManager->remove($userInfo);
                $entityManager->flush();
                $response = array("isPosted" => true, "message" => "User deleted successfully.");
            } catch (Exception $e) {
                $response = array("isPosted" => false, "message" => "Failed!!");
            }
            //you can return result as JSON
            return new JsonResponse($response);
        }
    }

    public function userProfileAction(Request $request) {
        $session = $this->getRequest()->getSession();

        if (!$session->get('isLoggedIn')) {
            return $this->redirect($this->get('request')->getBaseUrl() . '/user/signin');
        }
        $userID = $session->get('user')->getUserId();
        $entityManager = $this->getDoctrine()->getManager();
        $country = $entityManager->getRepository('EssentialTvEtvBundle:Country')->findAll();
        $countries = array();
        foreach ($country as $cnt) {
            $countries[$cnt->getCode()] = $cnt->getName();
        }
        $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($userID);
        $form = $this->createFormBuilder($userInfo)
                ->add('userFirstName', 'text')
                ->add('userLastName', 'text')
                ->add('userAboutme', 'textarea')
                ->add('userGender', 'choice', array(
                    'choices' => array(
                        'Male' => 'Male',
                        'Female' => 'Female'),
                    'expanded' => true,
                    'multiple' => false
                ))
                ->add('userDob', 'date', array('years' => range(1900, 2015)))
                ->add('userStreetAddress', 'text')
                ->add('userState', 'text')
                ->add('userStreetAddress2', 'text')
                ->add('userCity', 'text')
                ->add('userCountry', 'choice', array(
                    'choices' => $countries))
                ->add('userZip', 'text')
                ->add('userFacebookLink', 'text')
                ->add('userTwitterLink', 'text')
                ->add('userGoogleLink', 'text')
                ->add('save', 'submit', array('label' => 'Submit'))
                ->getForm();
        $form->handleRequest($request);
        if ($request->getMethod() == 'POST') {
            if ($request->files->get('files') != null) {
                $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/uploads/users';
                $relativePath = '/images/uploads/users';
                $extension = $request->files->get('files')->getClientOriginalName();

                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'bin';
                }

                $newNameofFile = rand(1, 99999) . '.' . $extension;

                //uploading the file with the name selected and setting permission
                $request->files->get('files')->move($uploadDir, $newNameofFile);
                $userInfo->setUserProfilePicture($relativePath . "/" . $newNameofFile);
                $entityManager->flush();
                $response = array("isPosted" => true, "message" => "Profile Image Changed Successfully!");
                return new JsonResponse($response);
            }
            if ($form->isValid()) {
                try {
                    //$entityManager->persist($episodesInfo);
                    //$userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($userId);
                    $entityManager->flush();

                    $template = $this->render('EssentialTvEtvBundle:Users:settingViewAjax.html.twig', array('userinfo' => $userInfo))->getContent();
                    $response = array("isPosted" => true, "message" => "Your Information Updated successfully.", 'html' => $template);
                } catch (Exception $e) {
                    $response = array("isPosted" => false, "message" => "Failed!!");
                }
                //you can return result as JSON
                return new JsonResponse($response);
            }
        }

        $posts = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->findBy(array('postCreatedBy' => $userID), array('postCreatedOn' => 'desc'));
        $recentlyViewed = $entityManager->getRepository('EssentialTvEtvBundle:UserRecentViews')->findBy(array('urvUserId' => $userID), array('urvViewedOn' => 'desc'));
        $recentViews = array();
        foreach ($recentlyViewed as $view) {
            if ($view->getUrvElementType() == "post") {
                $post = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->find($view->getUrvElementId());
                if ($post)
                {
                    if(!array_key_exists("post".$post->getPostId(), $recentViews))
                    $recentViews["post".$post->getPostId()] = array('title' => $post->getPostTitle(), 'image' => $post->getPostCoverImage(), 'desc' => $post->getPostAbout(), 'url' => '/post/view/' . $post->getPostId());
                }
            }
            else if ($view->getUrvElementType() == "show") {
                $show = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->find($view->getUrvElementId());
                if ($show)
                {
                    if(!array_key_exists("show".$show->getShowId(), $recentViews))
                    $recentViews["show".$show->getShowId()] = array('title' => $show->getShowTitle(), 'image' => $show->getShowBannerImage(), 'desc' => $show->getShowOriginalDataSupersede() == "active" ? $show->getShowOriginalSummary() : $show->getShowApiSummary(), 'url' => '/' . str_replace(" ", "", $show->getShowTitle()));
                }
            }
            else if ($view->getUrvElementType() == "episode") {
                if ($show)
                    $show = $entityManager->getRepository('EssentialTvEtvBundle:Episodes')->find($view->getUrvElementId());
            }
        }

        return $this->render('EssentialTvEtvBundle:Users:userProfile.html.twig', array('userinfo' => $userInfo, 'form' => $form->createView(), 'posts' => $posts, 'recentViews' => $recentViews));
    }
    
    public function forgotPassowrdAction(Request $request)
    {
        $form = $this->createFormBuilder()
                ->add('email', 'email')
                ->getForm();
        $form->handleRequest($request);
        $message = "";
        if ($request->getMethod() == 'POST')
        {
            $entityManager = $this->getDoctrine()->getManager();
            $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->findBy(array(
                "userEmail" => $request->request->get('form')['email']
            ));
            
            if(empty($userInfo))
            {
                $message = "Account not found. ";
            }
            else
            $message = "An email with new password has been sent to your e-mail address. ";
        }
        return $this->render('EssentialTvEtvBundle:Users:forgotPassword.html.twig', array('form'=>$form->createView(),'message'=>$message));
    }

    public function notificationAction() {
        $session = $this->getRequest()->getSession();
        $entityManager = $this->getDoctrine()->getManager();
        if (!$session->get('isLoggedIn')) {
            return $this->redirect($this->get('request')->getBaseUrl() . '/user/signin');
        } else {
            $userId = $session->get('user')->getUserId();
            $getReactionsComments = $entityManager->getRepository('EssentialTvEtvBundle:Reactions')->getRepliesOnReactions($userId);

            return $this->render('EssentialTvEtvBundle:Users:userNotification.html.twig', array('notifications' => $getReactionsComments));
        }
    }

    public function facebookLoginAction(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $session->clear();

        if ($request->getMethod() == 'POST') {
            $userEmail = $request->request->get('user_email');
            $userFbId = $request->request->get('user_social_id');
            $userSocialType = $request->request->get('user_social_type');
            $userFirstName = $request->request->get('user_first_name');
            $userMiddleName = $request->request->get('user_middle_name');
            $userLastName = $request->request->get('user_last_name');
            $userGender = $request->request->get('user_gender');
            $userVerification = $request->request->get('user_verification');
            $userDOB = $request->request->get('birthday');
            $newUserDOB = date_create(date("Y-m-d H:i:s", strtotime($userDOB)));
            $userFbLink = $request->request->get('fb_link');
            $userRoleType = "ROLE_USER";
            $userStatus = "active";
            $userPassword = "";
            $userHash = "";
            $createdDateTime = date_create(date("Y-m-d H:i:s"));

            $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->findBy(array(
                "userEmail" => $userEmail,
                "userSocialId" => $userFbId,
                "userSocialType" => $userSocialType
            ));

            if (count($userInfo) > 0) {
                $userRoleType = $userInfo[0]->getUserRole();
                $session->set('user', $userInfo[0]);
                $session->set('isLoggedIn', true);
                $session->set('userRole', $userRoleType);

                $response = array("isPosted" => true, "message" => "Signup with Facebook was successfull. Redirecting...", "userRole" => $userRoleType);
                return new JsonResponse($response);
            } else {
                $newUser = new Users();

                $newUser->setUserFirstName($userFirstName);
                $newUser->setUserMiddleName($userMiddleName);
                $newUser->setUserLastName($userLastName);
                $newUser->setUserEmail($userEmail);
                $newUser->setUserSocialId($userFbId);
                $newUser->setUserSocialType($userSocialType);
                $newUser->setUserGender($userGender);
                $newUser->setUserVerification($userVerification);
                $newUser->setUserRole($userRoleType);
                $newUser->setUserPassword($userPassword);
                $newUser->setUserHash($userHash);
                $newUser->setUserStatus($userStatus);
                $newUser->setUserDob($newUserDOB);
                $newUser->setUserFacebookLink($userFbLink);
                $newUser->setUserLastLogin($createdDateTime);

                try {
                    $session->set('user', $newUser);
                    $session->set('isLoggedIn', true);
                    $session->set('userRole', $userRoleType);

                    $entityManager->persist($newUser);
                    $entityManager->flush();

                    $response = array("isPosted" => true, "message" => "Signup with Facebook was successfull. Redirecting...", "userRole" => $userRoleType);
                    return new JsonResponse($response);
                } catch (Exception $ex) {
                    $response = array("isPosted" => false, "message" => "Signup with Facebook failed. Try again later.");
                    return new JsonResponse($response);
                }
            }
        }
    }
    
    
    
    public function googleLoginAction(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $session->clear();

        if ($request->getMethod() == 'POST') {
            $userEmail = $request->request->get('user_email');
            $userGoogleId = $request->request->get('user_social_id');
            $userSocialType = $request->request->get('user_social_type');
            $userFirstName = $request->request->get('user_first_name');
            $userMiddleName = "";
            $userLastName = $request->request->get('user_last_name');
            $userGender = $request->request->get('user_gender');
            $userVerification = $request->request->get('user_verification');
            $newUserDOB = date_create("0000-00-00");
            $userGoogleLink = $request->request->get('google_url');
            $userRoleType = "ROLE_USER";
            $userStatus = "active";
            $userPassword = "";
            $userHash = "";
            $createdDateTime = date_create(date("Y-m-d H:i:s"));

            $userInfo = $entityManager->getRepository('EssentialTvEtvBundle:Users')->findBy(array(
                "userEmail" => $userEmail,
                "userSocialId" => $userGoogleId,
                "userSocialType" => $userSocialType
            ));

            if (count($userInfo) > 0) {
                $userRoleType = $userInfo[0]->getUserRole();
                $session->set('user', $userInfo[0]);
                $session->set('isLoggedIn', true);
                $session->set('userRole', $userRoleType);

                $response = array("isPosted" => true, "message" => "Signup with Google+ was successfull. Redirecting...", "userRole" => $userRoleType);
                return new JsonResponse($response);
            } else {
                $newUser = new Users();

                $newUser->setUserFirstName($userFirstName);
                $newUser->setUserMiddleName($userMiddleName);
                $newUser->setUserLastName($userLastName);
                $newUser->setUserEmail($userEmail);
                $newUser->setUserSocialId($userGoogleId);
                $newUser->setUserSocialType($userSocialType);
                $newUser->setUserGender($userGender);
                $newUser->setUserVerification($userVerification);
                $newUser->setUserRole($userRoleType);
                $newUser->setUserPassword($userPassword);
                $newUser->setUserHash($userHash);
                $newUser->setUserStatus($userStatus);
                $newUser->setUserDob($newUserDOB);
                $newUser->setUserGoogleLink($userGoogleLink);
                $newUser->setUserLastLogin($createdDateTime);

                try {
                    $session->set('user', $newUser);
                    $session->set('isLoggedIn', true);
                    $session->set('userRole', $userRoleType);

                    $entityManager->persist($newUser);
                    $entityManager->flush();

                    $response = array("isPosted" => true, "message" => "Signup with Google+ was successfull. Redirecting...", "userRole" => $userRoleType);
                    return new JsonResponse($response);
                } catch (Exception $ex) {
                    $response = array("isPosted" => false, "message" => "Signup with Google+ failed. Try again later.");
                    return new JsonResponse($response);
                }
            }
        }
    }

}

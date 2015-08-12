<?php

namespace EssentialTv\EtvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EssentialTv\EtvBundle\Entity\Seasons;
use EssentialTv\EtvBundle\Entity\Shows;
use EssentialTv\EtvBundle\Entity\Episodes;
use EssentialTv\EtvBundle\Entity\Posts;
use EssentialTv\EtvBundle\Entity\PostReports;
use EssentialTv\EtvBundle\Entity\PostReactions;
use EssentialTv\EtvBundle\Entity\ShowRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostController extends Controller {

    public function indexAction($filter="Trending") {
        $entityManager = $this->getDoctrine()->getManager();
	$recentEpisodes = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getFourRecentEpisodes();
        $popularPost = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getMostPopularPost();
        $postList =  $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getPostList($filter,0,12);
        $firstResult = 12;
        
        return $this->render('EssentialTvEtvBundle:Post:index.html.twig',
                array("popularPost" => $popularPost[0], "postList" => $postList,
                "recentEpisodes"=>$recentEpisodes,"filter"=>$filter,'firstResult'=>$firstResult));
    }
    
     public function loadMoreAction($firstResult=0,$filter="")
    {
         $entityManager = $this->getDoctrine()->getManager();
         $postList = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getPostList($filter,$firstResult,12);
         $firstResult += 12;       
         return $this->render('EssentialTvEtvBundle:Post:scrollElemets.html.twig',
         array( "elements" => $postList,"filter"=>$filter,'firstResult'=>$firstResult));
    }
    
    public function chooseTemplateAction()
    {
        $session = $this->getRequest()->getSession();
        $message = "";
        if($session->get('post_message')!="")
        {
           $message = $session->get('post_message');
           $session->set('post_message','');
        }
         return $this->render('EssentialTvEtvBundle:Post:chooseTemplate.html.twig', array( "message" => $message));
    }
    
    public function createPostAction($type="",Request $request)
    {
        $session = $this->getRequest()->getSession();
        
        if(!$session->get('isLoggedIn'))
        {
           return $this->redirect($this->get('request')->getBaseUrl().'/user/signin');
        }
        
        $entityManager = $this->getDoctrine()->getManager();
        $showList = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getAllShows();
        $postTypes = $this->getPostTypeList($type);
        $post = new Posts();
        $formBuilder = $this->createFormBuilder($post);
        $formBuilder->add('postTitle', 'text', array('attr'=> array('class' => 'form-control','placeholder'=>'Title')))
                ->add('postAbout', 'textarea',array('attr'=> array('class' => 'form-control'), 'required' => false))
                ->add('postShowIds', 'hidden')
                ->add('postEpisodeIds', 'hidden')
                ->add('postStatus', 'hidden')
                ->add('postCharacterIds', 'hidden')
                ->add('postTags', 'text',array('required' => false,'attr'=> array('class' => 'form-control','placeholder'=>'Add tags, separated by commas')))
                ->add('postPrimaryType', 'choice',array('choices'=>$postTypes,'required' => false,'attr'=> array('class' => 'form-control')))
                ->add('postSecondaryType', 'choice',array('choices'=>$postTypes,'required' => false,'attr'=> array('class' => 'form-control')))
                ->add('postOriginallyCreatedBy', 'text', array('required' => false,'attr'=> array('class' => 'form-control','placeholder'=>'ie. @Essential_TV via Twitter')));
                
             
       if($type=="Image")
       {
            $formBuilder->add('postImages', 'file', array('multiple'=>true,'required' => false,'attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));   
            $formBuilder->add('postCoverImage', 'file',array('attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));
            //$formBuilder->add('postContent', 'hidden');
            
       }
       else if($type=="Text")
       {
           $formBuilder->add('postImages', 'file', array('required' => false,'attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));   
           $formBuilder->add('postContent', 'hidden');
           $formBuilder->add('postCoverImage', 'hidden');
       }
       else
       {
           $formBuilder->add('postImages', 'file', array('required' => false,'attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));   
           $formBuilder->add('postCoverImage', 'hidden');
           $formBuilder->add('postContent', 'text',array('attr'=> array('class' => 'form-control'), 'required' => true));       
       }
             $formBuilder->add('Save', 'submit', array('attr' => array('class' => 'btn btn-default'), 'label' => 'Post'));
             $formBuilder->add('Draft', 'button', array('attr' => array('class' => 'btn btn-default'), 'label' => 'Save Drafts'));
             $formBuilder->add('Cancel', 'button', array('attr' => array('class' => 'btn btn-default'), 'label' => 'Cancel'));
             $form = $formBuilder->getForm();
             $form->handleRequest($request);
             
            ////////************* Handle the submitted Form************////////// 
             
            if ($request->getMethod() == 'POST') {
                $userID = $session->get('user')->getUserId();
                $dateTimeNow = date_create(date("Y-m-d H:i:s"));
                
                
                $post->setPostType($type);
                $post->setPostPopularity(0);
                $post->setPostStatus("Active");
                $post->setPostCreatedOn($dateTimeNow);
                $post->setPostCreatedBy($userID);
                $post->setPostUpdatedBy($userID);
                $post->setPostUpdatedOn($dateTimeNow);
                
                $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/uploads/posts';
                $relativePath  = '/images/uploads/posts';
                if($type=="Image")
                {
                $extension = $form['postCoverImage']->getData()->getClientOriginalName();
                
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'bin';
                }
               
                $newNameofFile = rand(1, 99999) . '.' . $extension;

                //uploading the file with the name selected and setting permission
                $form['postCoverImage']->getData()->move($uploadDir, $newNameofFile);
                
                $post->setPostCoverImage($relativePath."/".$newNameofFile);
                $contentArray = array();
                foreach($form['postImages']->getData() as $myFile)
                {
                    if(is_object($myFile))
                    {
                    $newNameofFile = rand(1, 99999) . '.' . $myFile->getClientOriginalName();
                    $myFile->move($uploadDir, $newNameofFile);
                    $contentArray[] = $relativePath."/".$newNameofFile;
                    }
                }
                
                $post->setPostContent(json_encode($contentArray));
                }
                if($type=="Text")
                {
                    $post->setPostContent($form['postAbout']->getData());
                }
                if($type!="Image")
                {
                     $baseUrl = $this->get('request')->getBaseUrl();
                     $image = $post->getPostCoverImage();
                     $image = str_replace($baseUrl, "", $image);
                     $post->setPostCoverImage($image);
                     $fileData = $form['postImages']->getData();
                    if(isset($fileData))
                    {
                    foreach($form['postImages']->getData() as $myFile)
                    {
                    if(is_object($myFile))
                    {
                    $newNameofFile = rand(1, 99999) . '.' . $myFile->getClientOriginalName();
                    $myFile->move($uploadDir, $newNameofFile);
                    $coverImage = $relativePath."/".$newNameofFile;
                    $post->setPostCoverImage($coverImage);
                    }
                    }
                    }
                     
                }
                if($form['postStatus']->getData()!='draft')
                {
                    $post->setPostStatus('active');
                    $entityManager->persist($post);
                    $entityManager->flush();
                }
                else
                {
                    $post->setPostStatus('draft');
                    $entityManager->persist($post);
                    $entityManager->flush();
                    $session->set('post_message','Your draft has been saved.');
                    return $this->redirect($this->get('request')->getBaseUrl().'/post/chooseTemplate', 301);
                }
            //getting a new name of uploaded file
                return $this->redirect($this->get('request')->getBaseUrl().'/post/view/'.$post->getPostId(), 301);
                
            
             }
            
             
         return $this->render('EssentialTvEtvBundle:Post:createPost.html.twig',array(
                'form' => $form->createView(),'type'=>$type,'showList'=>$showList));
    }
    
    
    public function draftPostsAction(Request $request)
    {
        
        $session = $this->getRequest()->getSession();
        
        if(!$session->get('isLoggedIn'))
        {
           return $this->redirect($this->get('request')->getBaseUrl().'/user/signin');
        }
        $userID = $session->get('user')->getUserId();
        $entityManager = $this->getDoctrine()->getManager();
        $showList = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getAllShows();
        $post = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->findOneBy(array('postCreatedBy'=>$userID,'postStatus'=>'draft'));
        
        if(!$post)
        {
            $session->set('post_message','You do not have any saved draft');
           return $this->redirect($this->get('request')->getBaseUrl().'/post/chooseTemplate'); 
        }
        $post->setPostStatus('active');
        $type = ucfirst($post->getPostType());
        $postTypes = $this->getPostTypeList($type);
        //print_r($type);die;
        $formBuilder = $this->createFormBuilder($post);
        $formBuilder->add('postTitle', 'text', array('attr'=> array('class' => 'form-control','placeholder'=>'Title')))
                ->add('postAbout', 'textarea',array('attr'=> array('class' => 'form-control'), 'required' => false))
                ->add('postShowIds', 'hidden')
                ->add('postEpisodeIds', 'hidden')
                ->add('postCharacterIds', 'hidden')
                ->add('postStatus', 'hidden')
                ->add('postTags', 'text',array('required' => false,'attr'=> array('class' => 'form-control','placeholder'=>'Add tags, separated by commas')))
                ->add('postPrimaryType', 'choice',array('choices'=>$postTypes,'required' => false,'attr'=> array('class' => 'form-control')))
                ->add('postSecondaryType', 'choice',array('choices'=>$postTypes,'required' => false,'attr'=> array('class' => 'form-control')))
                ->add('postOriginallyCreatedBy', 'text', array('required' => false,'attr'=> array('class' => 'form-control','placeholder'=>'ie. @Essential_TV via Twitter')));
                
        $formBuilder->add('postImages', 'file', array('required' => false,'attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));          
       if($type=="Image")
       {
            //$formBuilder->add('postImages', 'file', array('attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));
            $formBuilder->add('postCoverImage', 'file',array('attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));
            //$formBuilder->add('postContent', 'hidden');
            
       }
       else if($type=="Text")
       {
           $formBuilder->add('postContent', 'hidden');
           $formBuilder->add('postCoverImage', 'hidden');
       }
       else
       {
           $formBuilder->add('postCoverImage', 'hidden');
           $formBuilder->add('postContent', 'text',array('attr'=> array('class' => 'form-control'), 'required' => false));       
       }
             $formBuilder->add('Save', 'submit', array('attr' => array('class' => 'btn btn-default'), 'label' => 'Post'));
             $formBuilder->add('Draft', 'button', array('attr' => array('class' => 'btn btn-default'), 'label' => 'Save Drafts'));
             $formBuilder->add('Cancel', 'button', array('attr' => array('class' => 'btn btn-default'), 'label' => 'Cancel'));
             $form = $formBuilder->getForm();
             $form->handleRequest($request);
             
            ////////************* Handle the submitted Form************////////// 
             
            if ($request->getMethod() == 'POST') {
                
                $dateTimeNow = date_create(date("Y-m-d H:i:s"));
                
                
                $post->setPostType($type);
                $post->setPostPopularity(0);
                $post->setPostStatus("Active");
                $post->setPostCreatedOn($dateTimeNow);
                $post->setPostCreatedBy($userID);
                $post->setPostUpdatedBy($userID);
                $post->setPostUpdatedOn($dateTimeNow);
                
                $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/uploads/posts';
                $relativePath  = '/images/uploads/posts';
                if($type=="Image")
                {
                $extension = $form['postCoverImage']->getData()->getClientOriginalName();
                
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'bin';
                }
               
                $newNameofFile = rand(1, 99999) . '.' . $extension;

                //uploading the file with the name selected and setting permission
                $form['postCoverImage']->getData()->move($uploadDir, $newNameofFile);
                
                $post->setPostCoverImage($relativePath."/".$newNameofFile);
                $contentArray = array();
                foreach($form['postImages']->getData() as $myFile)
                {
                    if($myFile!=null)
                    {
                    $newNameofFile = rand(1, 99999) . '.' . $myFile->getClientOriginalName();
                    $myFile->move($uploadDir, $newNameofFile);
                    $contentArray[] = $relativePath."/".$newNameofFile;
                    }
                }
                
                $post->setPostContent(json_encode($contentArray));
                }
                if($type=="Text")
                {
                    $post->setPostContent($form['postAbout']->getData());
                }
                if($type!="Image")
                {
                     $baseUrl = $this->get('request')->getBaseUrl();
                     $image = $post->getPostCoverImage();
                     $image = str_replace($baseUrl, "", $image);
                     $post->setPostCoverImage($image);
                    if(isset($form['postImages']))
                    {
                    foreach($form['postImages']->getData() as $myFile)
                    {
                    if(is_object($myFile))
                    {
                    $newNameofFile = rand(1, 99999) . '.' . $myFile->getClientOriginalName();
                    $myFile->move($uploadDir, $newNameofFile);
                    $coverImage = $relativePath."/".$newNameofFile;
                    $post->setPostCoverImage($coverImage);
                    }
                    }
                    }
                }
                if($form['postStatus']->getData()!='draft')
                {
                    $post->setPostStatus('active');
                    $oldDraft = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->findOneBy(array('postCreatedBy'=>$userID,'postStatus'=>'draft'));
                    $entityManager->remove($oldDraft);
                    $entityManager->persist($post);
                    $entityManager->flush();
                }
                else
                {
                    $post->setPostStatus('draft');
                    $entityManager->flush();
                    $session->set('post_message','Your draft has been saved.');
                    return $this->redirect($this->get('request')->getBaseUrl().'/post/chooseTemplate', 301);
                }
               
                
                
            //getting a new name of uploaded file
                return $this->redirect($this->get('request')->getBaseUrl().'/post/view/'.$post->getPostId(), 301);
                
            
             }
        $shows = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getShowsInPost($post->getPostShowIds());
        $episodes = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getEpisodesInPost($post->getPostEpisodeIds());
        $characters = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getCharactersInPost($post->getPostCharacterIds());   
        $coverImage = $post->getPostCoverImage();     
        
         return $this->render('EssentialTvEtvBundle:Post:draftedPost.html.twig',array(
                'form' => $form->createView(),'type'=>$type,'showList'=>$showList,'shows'=>$shows,'episodes'=>$episodes,'characters'=>$characters,'coverImage'=>$coverImage));
        
    }
    
    public function editPostsAction($postId,Request $request)
    {
        
        $session = $this->getRequest()->getSession();
        
        if(!$session->get('isLoggedIn'))
        {
           return $this->redirect($this->get('request')->getBaseUrl().'/user/signin');
        }
        $userID = $session->get('user')->getUserId();
        $entityManager = $this->getDoctrine()->getManager();
        $showList = $entityManager->getRepository('EssentialTvEtvBundle:Shows')->getAllShows();
        $post = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->find($postId);
        
        if($post->getPostCreatedBy()!=$userID)
        {
            $session->set('post_message','You are not authorized to perform this action');
           return $this->redirect($this->get('request')->getBaseUrl().'/post/chooseTemplate'); 
        }
        
        if(!$post)
        {
            $session->set('post_message','You do not have any saved draft');
           return $this->redirect($this->get('request')->getBaseUrl().'/post/chooseTemplate'); 
        }
        $post->setPostStatus('active');
        $type = ucfirst($post->getPostType());
        $postTypes = $this->getPostTypeList($type);
        //print_r($type);die;
        $formBuilder = $this->createFormBuilder($post);
        $formBuilder->add('postTitle', 'text', array('attr'=> array('class' => 'form-control','placeholder'=>'Title')))
                ->add('postAbout', 'textarea',array('attr'=> array('class' => 'form-control'), 'required' => false))
                ->add('postShowIds', 'hidden')
                ->add('postEpisodeIds', 'hidden')
                ->add('postCharacterIds', 'hidden')
                ->add('postStatus', 'hidden')
                ->add('postTags', 'text',array('required' => false,'attr'=> array('class' => 'form-control','placeholder'=>'Add tags, separated by commas')))
                ->add('postPrimaryType', 'choice',array('choices'=>$postTypes,'required' => false,'attr'=> array('class' => 'form-control')))
                ->add('postSecondaryType', 'choice',array('choices'=>$postTypes,'required' => false,'attr'=> array('class' => 'form-control')))
                ->add('postOriginallyCreatedBy', 'text', array('required' => false,'attr'=> array('class' => 'form-control','placeholder'=>'ie. @Essential_TV via Twitter')));
                
        $formBuilder->add('postImages', 'file', array('required' => false,'attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));          
       if($type=="Image")
       {
            //$formBuilder->add('postImages', 'file', array('attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));
            $formBuilder->add('postCoverImage', 'file',array('attr'=> array('class' => 'form-control','onchange'=>"PreviewImage(this)")));
            //$formBuilder->add('postContent', 'hidden');
            
       }
       else if($type=="Text")
       {
           $formBuilder->add('postContent', 'hidden');
           $formBuilder->add('postCoverImage', 'hidden');
       }
       else
       {
           $formBuilder->add('postCoverImage', 'hidden');
           $formBuilder->add('postContent', 'text',array('attr'=> array('class' => 'form-control'), 'required' => false));       
       }
             $formBuilder->add('Save', 'submit', array('attr' => array('class' => 'btn btn-default'), 'label' => 'Post'));
             $formBuilder->add('Cancel', 'button', array('attr' => array('class' => 'btn btn-default'), 'label' => 'Cancel'));
             $form = $formBuilder->getForm();
             $form->handleRequest($request);
             
            ////////************* Handle the submitted Form************////////// 
             
            if ($request->getMethod() == 'POST') {
                
                $dateTimeNow = date_create(date("Y-m-d H:i:s"));
                
                
                $post->setPostType($type);
                $post->setPostPopularity(0);
                $post->setPostStatus("Active");
                $post->setPostCreatedOn($dateTimeNow);
                $post->setPostCreatedBy($userID);
                $post->setPostUpdatedBy($userID);
                $post->setPostUpdatedOn($dateTimeNow);
                
                $uploadDir = dirname($this->container->getParameter('kernel.root_dir')) . '/web/images/uploads/posts';
                $relativePath  = '/images/uploads/posts';
                if($type=="Image")
                {
                $extension = $form['postCoverImage']->getData()->getClientOriginalName();
                
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'bin';
                }
               
                $newNameofFile = rand(1, 99999) . '.' . $extension;

                //uploading the file with the name selected and setting permission
                $form['postCoverImage']->getData()->move($uploadDir, $newNameofFile);
                
                $post->setPostCoverImage($relativePath."/".$newNameofFile);
                $contentArray = array();
                foreach($form['postImages']->getData() as $myFile)
                {
                    if($myFile!=null)
                    {
                    $newNameofFile = rand(1, 99999) . '.' . $myFile->getClientOriginalName();
                    $myFile->move($uploadDir, $newNameofFile);
                    $contentArray[] = $relativePath."/".$newNameofFile;
                    }
                }
                
                $post->setPostContent(json_encode($contentArray));
                }
                if($type=="Text")
                {
                    $post->setPostContent($form['postAbout']->getData());
                }
                if($type!="Image")
                {
                     $baseUrl = $this->get('request')->getBaseUrl();
                     $image = $post->getPostCoverImage();
                     $image = str_replace($baseUrl, "", $image);
                     $post->setPostCoverImage($image);
                    if(isset($form['postImages']))
                    {
                    $myFile =     $form['postImages']->getData();
                    
                        if(is_object($myFile))
                        {
                        $newNameofFile = rand(1, 99999) . '.' . $myFile->getClientOriginalName();
                        $myFile->move($uploadDir, $newNameofFile);
                        $coverImage = $relativePath."/".$newNameofFile;
                        $post->setPostCoverImage($coverImage);
                        }
                    }
                    
                }
               
                    $post->setPostStatus('active');
                    $entityManager->flush();
                
              
               
                
                
            //getting a new name of uploaded file
                return $this->redirect($this->get('request')->getBaseUrl().'/post/view/'.$post->getPostId(), 301);
                
            
             }
        $shows = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getShowsInPost($post->getPostShowIds());
        $episodes = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getEpisodesInPost($post->getPostEpisodeIds());
        $characters = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getCharactersInPost($post->getPostCharacterIds());   
        $coverImage = $post->getPostCoverImage();     
        
         return $this->render('EssentialTvEtvBundle:Post:editPost.html.twig',array(
                'form' => $form->createView(),'type'=>$type,'showList'=>$showList,'shows'=>$shows,'episodes'=>$episodes,'characters'=>$characters,'coverImage'=>$coverImage,'postId'=>$post->getPostId()));
        
    }
    
    
    public function viewPostAction($postId){
        
        $session = $this->getRequest()->getSession();
        $entityManager = $this->getDoctrine()->getManager();
        if($session->get('isLoggedIn'))
        {
            $userId = $session->get('user')->getUserId();
            $entityManager->getRepository('EssentialTvEtvBundle:Users')->logActivity($userId,'post',$postId);
        }
        $postDetails = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->find($postId);
        $postDetails->setPostPopularity($postDetails->getPostPopularity()+1);
        
        $postReactions = $entityManager->getRepository('EssentialTvEtvBundle:PostReactions')->getPostsReactionsAndResponse($postId);
     
        $entityManager->flush();
        if($postDetails->getPostType()=="image")
        {
            $postDetails->setPostContent(json_decode($postDetails->getPostContent()));
            
        }
        if($postDetails->getPostType()=="video")
        {
            $postDetails->setPostContent(str_replace("watch?v=","embed/",$postDetails->getPostContent()));
            
        }
        $editable = false;
        if($session->get('isLoggedIn'))
        {
            if($postDetails->getPostCreatedBy()==$userId)
            {
                $editable = true;
            }
        }
        
        $shows = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getShowsInPost($postDetails->getPostShowIds());
        $user = $entityManager->getRepository('EssentialTvEtvBundle:Users')->find($postDetails->getPostCreatedBy());
        $postList =  $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getPostList("Trending",0,12);
        $episodes = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getEpisodesInPost(explode(',',$postDetails->getPostEpisodeIds()));
        $characters = $entityManager->getRepository('EssentialTvEtvBundle:Posts')->getCharactersInPost(explode(',',$postDetails->getPostCharacterIds()));
        
        return $this->render('EssentialTvEtvBundle:Post:viewPost.html.twig',array('post'=>$postDetails,'showList'=>$shows,'episodes'=>$episodes,'characters'=>$characters,'user'=>$user,'recomendedPost'=>$postList,'editable'=>$editable,'postReactions'=>$postReactions,'isLoggedIn' => $session->get('isLoggedIn')));
    }
    
    function getPostTypeList($type)
    {
        if($type=="Text" || $type=="Link")
        
            return array(
                        "Review" => "Review",
                        "Preview" => "Preview",
                        "News" => "News",
                        "Listicle" => "Listicle",
                        "Trivia" => "Trivia",
                        "Quiz/Poll/Game" => "Quiz/Poll/Game",
                        "Merchandise" => "Merchandise",
                        "Fan Fiction" => "Fan Fiction",
                        "Fan Film" => "Fan Film",
                        "Fan Art" => "Fan Art",
                        "Meme" => "Meme",
                        "Screencap" => "Screencap",
                        "Show Clip" => "Show Clip",
                        "GIF" => "GIF",
                        "Parody" => "Parody",
                        "Music" => "Music",
                        "Cosplay" => "Cosplay",
                        "Ad/Poster" => "Ad/Poster",
                        "Other" => "Other");
        
        else if ($type=="Video")
       
            return array(  
                        "Review" => "Review",
                        "Preview" => "Preview",
                        "News" => "News",
                        "Trivia" => "Trivia",
                        "Merchandise" => "Merchandise",
                        "Fan Film" => "Fan Film",
                        "Show Clip" => "Show Clip",
                        "Parody" => "Parody",
                         "Music" => "Music",
                        "Ad/Poster" => "Ad/Poster",
                         "Other" => "Other");
        
        else if($type=="Image")
              return array(
                        "Screencap" => "Screencap",
                        "Fan Art" => "Fan Art",
                        "Meme" => "Meme",
                        "GIF" => "GIF",
                        "Cosplay" => "Cosplay",
                        "Ad/Poster" => "Ad/Poster",
                        "Parody" => "Parody",
                        "Merchandise" => "Merchandise",
                        "Preview" => "Preview",
                        "Other" => "Other");
    }
    
    public function postReportAction(Request $request)
    {
        
        $session = $this->getRequest()->getSession();
        if($session->get('isLoggedIn'))
        {
           
        if ($request->getMethod() == 'POST') {
            $dateTimeNow = date_create(date("Y-m-d H:i:s"));
            $report = new PostReports();
            $userID = $session->get('user')->getUserID();
            $report->setPrReportedBy($userID);
            
            $report->setPrReportedOn($dateTimeNow);
            $report->setPrType($request->request->get('prType'));
            $report->setPrDetails($request->request->get('prDetails'));
            $report->setPrPostId($request->request->get('prPostId'));
            $eM = $this->getDoctrine()->getManager();
            $eM->persist($report);
            $eM->flush();
            

            $response = array("isPosted" => true, "message" => "Your report was successfull!");
            return new JsonResponse(json_encode($response));
        }
        }
        else
        {
            $response = array("isPosted" => false, "message" => "Plese Login To Report!");
            return new JsonResponse(json_encode($response));
        }
    }
    

   

}

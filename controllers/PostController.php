<?php

    include_once "models/Post.php";

    class PostController {
        
        public function acao($routes) {
            switch($routes) {
                case "posts":
                    $this->listPosts();
                break;

                case "new-post":
                    $this->viewNewPost();
                break;

                case "send-post":
                    $this->sendPost();
                break;

                case "like":
                    $this->likePost();
                break;
            }
        }

        private function viewNewPost() {
            session_start();
            if(isset($_SESSION['username'])) {
                include "views/newPost.php";
            } else {
                $_SESSION['notLogged'] = "Faça login para poder criar novas publicações";
                include "views/login.php";
            }
            
        }


        private function viewPosts() {
            include "views/posts.php";
        }


        private function sendPost() {
            session_start();        
            
            $postText = $_POST['postText'];
            $username = $_SESSION['username'];

            $fileName = $_FILES["img"]["name"];
            $tempLink = $_FILES["img"]["tmp_name"];
            $filePath = "views/img/$fileName";
            move_uploaded_file($tempLink,$filePath);

            $post = new Post();
            $result = $post->createPost($filePath,$postText,$username);
            //var_dump($result);
            if($result) {
                header('Location:/DH_fakeInstagram/posts');
            } else {
                // header('Location:/DH_instagramMVC/posts');
               echo "Seu post não foi cadastrado. Tente novamente";
            }
        }

        private function listPosts() {
            $post = new Post;
            $listPosts = $post->listPosts();
            $_REQUEST['posts'] = $listPosts;
            $this->viewPosts();
        }
        
        private function likePost() {
            $post = new Post;
            $likes = $_POST['likes'];
            $postId = $_POST['postId'];
            $result = $post->likePost($likes,$postId);
            if($result) {
                header("Location:posts#$postId");
            }
        }

    }

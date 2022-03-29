<?php

class PublicSiteController
{
    
        public function view($params)
    {
        //Checking whether the parameters are empty or 'all'. In both cases should return all posts. Else checks for record;
        if (empty($params) || $params[0] === 'all') {
            require_once(MODEL_PATH . 'Post.php');
            $allPosts = new Post;
            $allPosts = $allPosts->readAll();
            require_once(VIEW_PATH . 'posts_list.php'); return;
        }


        // Checking whether id parameter is number, if its not returns error
        if (!is_numeric($params[0]) || strpos($params[0], 'e') !== false) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'This post does not exist']); return;
        };

        require_once(MODEL_PATH . 'Post.php');
        $post = new Post;
        $post = $post->readRowById($params[0]);

        //Check whether passed number parameter for ID is real database record
        if ($post->num_rows === 0) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Post with this id is not existing']); return;
        }

        //generate view
        $post = $post->fetch_assoc();
        require_once(VIEW_PATH . 'posts_view.php');
    }
}
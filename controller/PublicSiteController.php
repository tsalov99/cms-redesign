<?php

class PublicSiteController
{
    private  $model = 'PostSite';
    private  $method;

    function __construct($method, $params)
    {

        // If its passed a method which doesnt exist in controller, it should return a error
        if (!method_exists($this, $method)) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Page not found']); return;
        }
        $this->$method($params);
        
    }
    
        public function view($params)
    {
        if (isset($params[0]) && $params[0] === 'public') {
            array_shift($params);
        }
        //Checking whether the parameters are empty or 'all'. In both cases should return all posts. Else checks for record;
        if (empty($params) || $params[0] === 'all') {
            require_once(MODEL_PATH . 'PublicSite.php');
            $allPosts = new PublicSite;
            $allPosts = $allPosts->readAll();
            require_once(VIEW_PATH . 'public/posts_list.php'); return;
        }


        // Checking whether id parameter is number, if its not returns error
        if (!is_numeric($params[0]) || strpos($params[0], 'e') !== false) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'This post does not exist']); return;
        };

        require_once(MODEL_PATH . 'PublicSite.php');
        $post = new PublicSite;
        $post = $post->readRowById($params[0]);

        //Check whether passed number parameter for ID is real database record
        if ($post->num_rows === 0) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Post with this id is not existing']); return;
        }

        //generate view
        $post = $post->fetch_assoc();
        $postImages = new PublicSite;
        $postImages = $postImages->getImages($post['id']);
        require_once(VIEW_PATH . 'public/posts_view.php');
    }

    public function addComment($id, $comment)
    {
        # code...
    }

    public function bootstrap() {
        require_once('../lib/main.php');
        require_once('../lib/config.php');
        require_once('../lib/db_init.php');
    }

    public function getView($request) {
        if ($request['callback'] !== NULL) {
            call_user_func($request['callback'], $request);
        } else {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Page not found']); return;
        }
    }
}
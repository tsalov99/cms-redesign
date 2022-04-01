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
        //Checking whether the parameters are empty or 'all'. In both cases should return all posts. Else checks for record;
        if (empty($params) || $params[0] === 'all') {
            require_once(MODEL_PATH . 'PublicSite.php');
            $allPosts = new PublicSite;
            $allPosts = $allPosts->readAll();
            require_once(VIEW_PATH . 'public/posts_list.php'); return;
        } else if ($params)

        // Checking whether id parameter is number, if its not returns error
        //if (!is_numeric($params[0]) || strpos($params[0], 'e') !== false) {
        //    echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'This post does not exist']); return;
        //};
            
        require_once(MODEL_PATH . 'PublicSite.php');
        $post = new PublicSite;
        $post = $post->readRowBySlug($params[0]);
        
        //Check whether passed number parameter for ID is real database record
        if ($post->num_rows === 0) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Post with this id is not existing']); return;
        }

        $post = $post->fetch_assoc();
        $post['content'] = htmlspecialchars_decode($post['content']);
        
        $postImages = new PublicSite;

        //Checks whether client browser accept webp images
        $webpRead = self::checkFormat();
        if($webpRead === true) {
            $postImages = $postImages->getWebpImages($post['id']);
        } else {
            $postImages = $postImages->getImages($post['id']);
        }
        
        // Get comments for the post
        $comments = new PublicSite;
        $comments = $comments->getComments($post['id']);

        require_once(VIEW_PATH . 'public/posts_view.php');
    }

    public function addComment($id)
    {
        require_once(CONTROLLER_PATH . 'Validator_public.php');
        $errors = Validator::check($_POST);


        // If error are empty the comment is added
        if(empty($errors)) {
            require_once(MODEL_PATH . 'PublicSite.php');
            $comment = new PublicSite;
            $data = ['reviewer_name' => $_POST['name'], 'content' => $_POST['content'], 'related_post_id' => (int) $id[0]];
            $result = $comment->addComment($data);
            if($result === true) {
                require_once(VIEW_PATH . 'public/review_added.php');
            }
        } else {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Too tricky']); return;
        }

        
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

    public function checkFormat()
    {
       $clientRequestHeaders = apache_request_headers()['Accept'];
       return strpos($clientRequestHeaders, 'image/webp') ? true : false;
    }
}
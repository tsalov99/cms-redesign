<?php

// to make general logic for main Controller and other controllers to inherit it

class PostController
{
    private  $model = 'Post';
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
        $post['content'] = htmlspecialchars_decode($post['content']);
        require_once(VIEW_PATH . 'posts_view.php');
    }


    public function edit($params) 
    {
        require_once(MODEL_PATH . 'Post.php');
        $post = new Post;
        
        if (!isset($params[0])) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Post with this id is not existing']); return;
        }

        $post = $post->readRowById($params[0]);

        if ($post->num_rows === 0) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Post with this id is not existing']); return;
        }
        $post = $post->fetch_assoc();
        require_once(CONTROLLER_PATH . 'Validator.php');
        $post['created'] = Validator::convertDateCreated($post['created']); //Returning 'T' in the string for the html attribute to display the date
        require_once(VIEW_PATH . 'posts_edit.php');
        
    }


    public function add($params)
    {
        require_once(CONTROLLER_PATH . 'Validator.php');
        require_once(VIEW_PATH . 'posts_add.php');
    }


    public function save($params)
    {
        require_once(CONTROLLER_PATH . 'Validator.php');
        $errors = Validator::check($params);

        if(empty($errors)) {
            require_once(MODEL_PATH . 'Post.php');
            $post = new Post;
            $result = $post->insertRow($_POST);
            if($result === true) {

                
                // Checks whether any images are uploaded
                if (!empty($_FILES['image']['name'][0])) {

                    // The post id is used for each post images folder name
                    $newPostId = $post->getLastId();
                    require_once (CONTROLLER_PATH . 'ImageController.php');
                    
                    // After calling the upload function on the ImageController, it automatically converts and saves the image info to the database
                    $convert = ImageController::upload($_FILES, $newPostId);
                }
                
                require_once(VIEW_PATH . 'posts_saved.php'); return;
            }
        }
        
        // Checks if is set flag - "update". The "update" value is added in Validator check
        if (isset($errors['slug']) && $errors['slug'] === 'update') {
            $post = new Post;
            $id = (int )$params[0];
            $result = $post->updateRowById($id, $_POST);
            if($result === true) {

                if (!empty($_FILES['image']['name'][0])) {

                    // The post id is used for each post images folder name

                    require_once (CONTROLLER_PATH . 'ImageController.php');
                    
                    // After calling the upload function on the ImageController, it automatically converts and saves the image info to the database
                    $convert = ImageController::upload($_FILES, $id);
                }
                require_once(VIEW_PATH . 'posts_saved.php'); return;
            }
        }
        require_once(VIEW_PATH . 'posts_add.php');
    }


    public function delete($params) {
        require_once(MODEL_PATH . 'Post.php');
        $post = new Post;
        $id = (int)$params[0];
        $result = $post->deleteRowById($id);
        if($result === true) {
            require_once(VIEW_PATH . 'posts_delete.php'); return;
        }
    }
}
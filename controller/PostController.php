<?php


// to make general logic for main Controller and other controllers to inherit it

class PostController
{
    private  $model = 'Post';
    private  $method;

    function __construct($method, $params) {
        if (!method_exists($this, $method)) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Page not found']); return;
            //$method = 'view';
            //$params['0'] = 'all';
            //$this->$method($params);
        }
        $this->$method($params);
        
    }
    
    //public function getMethod($params) {
    //    
    //}

    public function viewAll() {
        require_once(VIEW_PATH . 'posts_list.php');
    }

    public function view($params) {

        //Checking whether the parameters are empty or 'all'. In both cases
        if (empty($params) || $params[0] === 'all') {

            require_once(MODEL_PATH . 'Post.php');
            
            $allPosts = new Post(new mysqli('localhost', 'root', 'S1L0V', 'blog-cms-project'));
            $allPosts = $allPosts->readAll();
            require_once(VIEW_PATH . 'posts_list.php'); return;
            
        }

        // Checking whether id parameter is number
        if (!is_numeric($params[0]) || strpos($params[0], 'e') !== false) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'This post does not exist']); return;
        };
        require_once(MODEL_PATH . 'Post.php');

        $post = new Post(new mysqli('localhost', 'root', 'S1L0V', 'blog-cms-project'));  // To change this connection, its only for testing
        $post = $post->readRowById($params[0]);
        if ($post->num_rows === 0) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Post with this id is not existing']); return;
        }
        $post = $post->fetch_assoc();
        require_once(VIEW_PATH . 'posts_view.php');


    }

    public function edit($params) {
        require_once(MODEL_PATH . 'Post.php');
        $post = new Post(new mysqli('localhost', 'root', 'S1L0V', 'blog-cms-project'));  // To change this connection, its only for testing
        $post = $post->readRowById($params[0]);
        if ($post->num_rows === 0) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Post with this id is not existing']); return;
        }
        $post = $post->fetch_assoc();
        require_once(VIEW_PATH . 'posts_edit.php');
        require_once(CONTROLLER_PATH . 'Validator.php');
        //$errors = Validator::check();
        
    }

    public  function add($params) {
        require_once(CONTROLLER_PATH . 'Validator.php');
        //$errors = Validator::check();
        require_once(VIEW_PATH . 'posts_add.php');
    }

    public function save($params) {
        require_once(CONTROLLER_PATH . 'Validator.php');
        $errors = Validator::check();

        if(empty($errors)) {
            require_once(MODEL_PATH . 'Post.php');
            $post = new Post(new mysqli('localhost', 'root', 'S1L0V', 'blog-cms-project'));
            $result = $post->insertRow($_POST);
            require_once(VIEW_PATH . 'posts_saved.php'); return;
        }
        require_once(VIEW_PATH . 'posts_add.php');

    }
}
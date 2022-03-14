<?php


// to make general logic for main Controller and other controllers to inherit it 

class PostController
{
    private  $model = 'Post';
    private  $method;

    function __construct($method, $params) {
        if (!method_exists($this, $method)) {
            $method = 'view';
            $params['0'] = 'all';
            $this->$method($params);
        }
        $this->$method($params);
        
    }
    
    public function getMethod($params) {
        
    }

    public function viewAll() {
        require_once(VIEW_PATH . 'posts_list.php');
    }

    public function view($params) {

        //check whether parameters are empty
        if (empty($params) || $params[0] === 'all') {
            require_once(VIEW_PATH . 'posts_list.php'); return;
        }

        if (!is_numeric($params[0]) || strpos($params[0], 'e') !== false) {
            echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'This post does not exist']); return;
        };

        require_once(VIEW_PATH . 'posts_view.php');


    }

    public function edit($params) {

    }

    public  function save($params) {
        
    }
}
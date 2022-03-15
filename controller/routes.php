<?php
/*
Router::add('/', function () {
    require(VIEW_PATH . 'posts_list.php');
});
Router::add('posts-list', function () {
    require(VIEW_PATH . 'posts_list.php');
});
Router::add('/post-add', function () {
    require(VIEW_PATH . 'post_add.php');
});
Router::add('/post-edit/{id}', function () {
    require(VIEW_PATH . 'post_edit.php');
});
Router::add('/post-delete/{id}', function () {
    require(VIEW_PATH . 'post_edit.php');
});
Router::add('/post/{method}/{id}', function ($info) {
    require(CONTROLLER_PATH . 'PostController.php');
});
*/
//Router::add('/{controller}/{method}/', function () {
    
//});
///posts ->POstController ->index()
///posts/index --- /// 
///posts/view/ ->POstsController->view()
//
//BlogControlller 
//index

Router::add('default', function () {
    echo 'vikash default';
  });

Router::add('home', function ($params) {
    require(CONTROLLER_PATH . 'PostController.php');
    $testController = new PostController($params['method'], $params['parameters']);
  });

Router::add('posts', function ($params) {
    require(CONTROLLER_PATH . 'PostController.php');
    $testController = new PostController($params['method'], $params['parameters']);

    
  //require('PostController.php');
  //$post = new PostController;
  //$post->getMethod($params['method'], $params);
});
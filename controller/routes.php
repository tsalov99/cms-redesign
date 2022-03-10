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

Router::add('home', function () {
    echo 'vikash default';
  });

Router::add('post', function ($params) {
  //echo 'vikash posta';
  require(CONTROLLER_PATH . 'PostController.php');
});
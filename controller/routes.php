<?php

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
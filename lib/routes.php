<?php

Router::add('/', function () {
    require(ROOT_PATH . 'posts_list.php');
});
Router::add('/posts-add', function () {
    require(ROOT_PATH . 'posts_add.php');
});
Router::add('/posts-edit/{slug}', function () {
    require(ROOT_PATH . 'posts_edit.php');
});
Router::add('/posts-delete/{slug}', function () {
    require(ROOT_PATH . 'posts_edit.php');
});
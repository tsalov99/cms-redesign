<?php

Router::add('home', function ($params) {
    require(CONTROLLER_PATH . 'PostController.php');
    new PostController($params['method'], $params['parameters']);
  });

Router::add('posts', function ($params) {
    require(CONTROLLER_PATH . 'PostController.php');
    new PostController($params['method'], $params['parameters']);
});
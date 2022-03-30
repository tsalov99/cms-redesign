<?php

PublicRouter::add('home', function ($params) {
    require(CONTROLLER_PATH . 'PublicSiteController.php');
    $testController = new PublicSiteController($params['method'], $params['parameters']);
  });

PublicRouter::add('posts', function ($params) {
    require(CONTROLLER_PATH . 'PublicSiteController.php');
    $testController = new PublicSiteController($params['method'], $params['parameters']);
  });
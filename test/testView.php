<?php
require('../lib/main.php');
require('TestRouter.php');
require('testRoutes.php');
require('TestDispatch.php');
echo '<br> 1-DS---|   ';
echo DS;
echo '<br> 2-ROOT_PATH---|   ';
echo ROOT_PATH;
echo '<br> 3-LIB_PATH---|   ';
echo LIB_PATH;
echo '<br> 4-MODEL_PATH---|   ';
echo MODEL_PATH;
echo '<br> 5-VENDOR_PATH---|   ';
echo VENDOR_PATH;
echo '<br> 6-LAYOUT_PATH---|   ';
echo LAYOUT_PATH;
echo '<br> 7-URL_BASE----|   ';
echo URL_BASE;
echo '<br> 8-ROUTE_BASE---|   ';
echo ROUTE_BASE;
echo '<br>';
echo ROUTE_BASE;
echo '<br>';
echo URL_BASE;
echo '<br>';

$test = new TestRouter;

$test::matchURL(ROUTE_BASE);


<?php
require('../lib/main.php');
require('TestRouter.php');
require('testRoutes.php');
require('TestDispatch.php');

echo ROUTE_BASE;
echo '<br>';
echo URL_BASE;
echo '<br>';

$test = new TestRouter;

$test::matchURL(ROUTE_BASE);


<?php

require_once('main.php');

require_once('config.php'); // local config file

require_once('db_init.php');

//require_once(MODEL_PATH . 'Database.php');

require_once(CONTROLLER_PATH . 'Router.php');

require_once(CONTROLLER_PATH . 'routes.php');

//echo '<br> 1-DS---|   ';
//echo DS;
//echo '<br> 2-ROOT_PATH---|   ';
//echo ROOT_PATH;
//echo '<br> 3-LIB_PATH---|   ';
//echo LIB_PATH;
//echo '<br> 4-MODEL_PATH---|   ';
//echo MODEL_PATH;
//echo '<br> 5-VENDOR_PATH---|   ';
//echo VENDOR_PATH;
//echo '<br> 6-LAYOUT_PATH---|   ';
//echo LAYOUT_PATH;
//echo '<br> 7-URL_BASE----|   ';
//echo URL_BASE;
//echo '<br> 8-ROUTE_BASE---|   ';
//echo ROUTE_BASE;
//echo '<br>-end';

$host = $settings['database']['host'];
$name = $settings['database']['user'];
$pass = $settings['database']['pass'];
$dbName = $settings['database']['name'];

$test = new Database($host, $name, $pass, $dbName);
//$test->connect($host, $name, $pass, $dbName);
//print_r($test);


// Dispatch route
$request = Router::prepareUrl(ROUTE_BASE);

//$controllerName = ucfirst($request['controller']) . 'Controller';
//$controllerPath = CONTROLLER_PATH . ucfirst($request['controller']) . 'Controller.php';
//if (file_exists($controllerPath)) {
//    require_once($controllerPath);
//    $controller = new $controllerName;
//}

//print_r($request);

if ($request['callback'] !== NULL) {
    call_user_func($request['callback'], $request);
} else {
    echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Page not found']); return;
}
 <?php

// Main constants used trough the app

define('DS', '/');
define('ROOT_PATH', str_replace('\\', DS, dirname(dirname(__FILE__))) . DS);
define('LIB_PATH', ROOT_PATH . 'lib' . DS);
define('MODEL_PATH', ROOT_PATH . 'model' . DS);
define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);
define('LAYOUT_PATH', ROOT_PATH . 'layout' . DS);
define('VIEW_PATH', ROOT_PATH . 'view' . DS);
define('CONTROLLER_PATH', ROOT_PATH . 'controller' . DS);
define('URL_BASE', str_replace($_SERVER['DOCUMENT_ROOT'], '', ROOT_PATH));
define('ROUTE_BASE', rtrim(str_replace(URL_BASE, '/', $_SERVER['REQUEST_URI']), '/') . DS);
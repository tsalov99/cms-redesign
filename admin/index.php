<?php

require_once('../lib/main.php');

require_once(LIB_PATH . 'config.php');

require_once(LIB_PATH . 'Database.php');

require_once(LIB_PATH . 'Router.php');

require_once(LIB_PATH . 'routes.php');

$route = Router::matchRoute(ROUTE_BASE);
if ($route) {
    $route['callback']();
    
} else {
    echo renderTemplate(ROOT_PATH . 'error.php', ['error' => 'Page not found']);
	return;
}

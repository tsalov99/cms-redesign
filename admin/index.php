<?php

require_once('../lib/main.php');

require_once(LIB_PATH . 'config.php');

require_once(LIB_PATH . 'Database.php');

require_once(LIB_PATH . 'Router.php');

require_once(LIB_PATH . 'routes.php');


print_r(ROOT_PATH);
echo "<br>";
print_r(URL_BASE);
echo "<br>";
print_r(ROUTE_BASE);

$route = Router::matchRoute(ROUTE_BASE);
if ($route) {
    $route['callback']();
    
} else {
    echo renderTemplate(ROOT_PATH . 'error.php', ['error' => 'Page not found']);
	return;
}

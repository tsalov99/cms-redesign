<?php
require_once('../layout/public/header.php');

require_once('../controller/PublicRouter.php');

require_once('../controller/public_routes.php');

// The bootstrap method loads enviorment variables, then it is proccessing the request and returns it 
//$request = PublicRouter::bootstrap();
if ($request['callback'] !== NULL) {
    call_user_func($request['callback'], $request);
} else {
    echo renderTemplate(VIEW_PATH . 'error.php', ['error' => 'Page not found']); return;
}
require_once('../view/public/posts_list.php');

require_once('../layout/public/footer.php');
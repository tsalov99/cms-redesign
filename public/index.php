<?php

require_once('../layout/public/header.php');

require_once('../controller/PublicRouter.php');

require_once('../controller/PublicRoutes.php');
PublicRouter::bootstrap();

require_once('../view/public/posts_list.php');

require_once('../layout/public/footer.php');
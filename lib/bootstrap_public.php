<?php

            require_once('main.php');

            require_once('config.php'); // local config file

            require_once('db_init.php');

            require_once(CONTROLLER_PATH . 'PublicRouter.php');

            require_once(CONTROLLER_PATH . 'public_routes.php');

            require_once(MODEL_PATH . 'Model.php');

            Model::$dbConnection = new mysqli($settings['database']['host'], $settings['database']['user'], $settings['database']['pass'], $settings['database']['name']);
            // Dispatch route
            $request = PublicRouter::prepareUrl(ROUTE_BASE);

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
    
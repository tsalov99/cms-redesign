<?php

class TestRouter
{
    public static $routes = [];
    public static $matchingRoute;

    public static function add($route, $callback) {
        static::$routes[$route] = $callback;
    }

    public static function matchURL($url) {
        $url = explode('/', trim($url, '/'))[1];

        foreach (static::$routes as $route => $callback) {
            if ($route === $url) {
                $matchingRoute = $url;
            } else {
                $matchingRoute = "404";
            }
        }
    }
}
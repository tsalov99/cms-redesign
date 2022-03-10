<?php

class TestRouter
{
    public static $routes = [];
    public static $matchingRoute;
    public static $controller;
    public static $method;
    public static $params = [];

    public static function add($route, $callback) {
        static::$routes[$route] = $callback;
    }

    public static function getController($url) {
       $url = explode('/', trim($url, '/'))[1];
       if(array_key_exists($url, static::$routes)) {
        static::$controller = $url;
       }
    }
}
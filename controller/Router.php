<?php

class Router
{
    public static $routes = [];
    public static $request = ['controller' => '','callback' => null, 'method' => '','parameters' => []];

    public static function add($url, $callback)
    {
        static::$routes[$url] = $callback;
    }

    public static function prepareUrl($url)
    {

        $trimmedUrl = trim($url, '/');
        $trimmedUrlArray = explode('/', $trimmedUrl);

        // If controller is not set in the URL get the default controller and stop Router 
        if (empty($trimmedUrlArray[0])) {
            static::$request['controller'] = 'home';
            static::$request['method'] = 'view';
        } else {
            static::$request['controller'] = array_shift($trimmedUrlArray);
        }
        
        // After controller is taken check for matching controller to pass the data. If there is not matching controller return and show error
        if (array_key_exists(static::$request['controller'], static::$routes)) { 
            static::$request['callback'] = static::$routes[static::$request['controller']]; }
        else { 
            return static::$request; 
        }

        // If method is not set in the URL get the default method and stop Router
        if (empty($trimmedUrlArray[0])) { static::$request['method'] = 'index'; }
        else {static::$request['method'] = array_shift($trimmedUrlArray);}

        // If any paramater is passed goes into request parameters array.
        if (empty($trimmedUrlArray[0])) { static::$request['parameters'] = []; }
        else {static::$request['parameters'] = $trimmedUrlArray;}
        
        return static::$request;

    }
}
<?php

class Router
{
    public static $routes = [];
    public static $matchingRoute;

    public static function add($url, $callback)
    {
        static::$routes[$url] = $callback;
    }

    public static function matchRoute($url)
    {
        // Parse the URL in way that will be easy to compare with the routes
        $trimmedUrl      = trim($url, '/');
        $trimmedUrlArray = explode('/', $trimmedUrl);

        // Iterate trough all route and try to match them with the given URL
        foreach (static::$routes as $route => $callback) {

            // Parse the route in a way that will be easy to compare with the URLs
            $trimmedRoute      = trim($route, '/');
            $trimmedRouteArray = explode('/', $trimmedRoute);
            // Check if the simple route and URL match
            if ($trimmedRoute === $trimmedUrl) {
                static::$matchingRoute = ['route' => $route, 'callback' => $callback, 'params' => []];
                return static::$matchingRoute;
            }

            // Prepare data for the comparison
            $routeParams  = [];
            $routeMatches = false;

            // Check all route parts agains all URL parts
            foreach ($trimmedUrlArray as $index => $urlPart) {
                // If the URL has the same route part or a route parameter then
                // we mark it as matching and conitnue with the next parts
                if (isset($trimmedRouteArray[$index]) && (preg_match('@^\{[a-z]+\}$@', $trimmedRouteArray[$index]) || $trimmedRouteArray[$index] === $urlPart)) {
                    $routeMatches = true;
                    // Add the named parameter to the params array
                    if (preg_match('@^\{[a-z]+\}$@', $trimmedRouteArray[$index])) {
                        $routeParams[trim($trimmedRouteArray[$index], '{}')] = $urlPart;
                    }
                } else {
                    $routeParams  = [];
                    $routeMatches = false;
                    break;
                }
            }

            // The tested route fully matches so we can return it as a match
            if ($routeMatches) {
                static::$matchingRoute = ['route' => $route, 'callback' => $callback, 'params' => $routeParams];
                return static::$matchingRoute;
            }
        }

        return false;
    }

}

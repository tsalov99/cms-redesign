<?php 

 /* class Router
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




    public function test(){

    }
} 
*/

class Router      // Changing Router logic always to return controller/method/params. If they are empty, then they'll be passed by default
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
        if (empty($trimmedUrlArray[0])) { static::$request['controller'] = 'home'; }
        else {static::$request['controller'] = array_shift($trimmedUrlArray);}
        
        // After controller is taken check for matching controller to pass the data. If there is not matching controller return and show error
        if (array_key_exists(static::$request['controller'], static::$routes)) { static::$request['callback'] = static::$routes[static::$request['controller']];}
        else { return static::$request; }

        // If method is not set in the URL get the default method and stop Router
        if (empty($trimmedUrlArray[0])) { static::$request['method'] = 'index'; }
        else {static::$request['method'] = array_shift($trimmedUrlArray);}

        // If any paramater is passed goes into request parameters array.
        if (empty($trimmedUrlArray[0])) {static::$request['parameters'] = ''; }
        else {static::$request['parameters'] = $trimmedUrlArray;}

        
        return static::$request;

    }
}
<?php

namespace App\Core;

use App\Core\Functions;

class Router
{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
        return;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
        return;
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $request_method = $_SERVER['REQUEST_METHOD'];

        // Check if the method exists in our routes
        if (isset($this->routes[$request_method])) {

            foreach ($this->routes[$request_method] as $route => $action) {
                // 1. Convert route like '/student/brief/{id}' into Regex Pattern
                // We replace '{id}' (or any {param}) with '([^/]+)' which means "capture anything that isn't a slash"
                $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $route);

                // 2. Check if current URI matches this pattern
                // We add start (^) and end ($) anchors to ensure exact match
                if (preg_match("#^$pattern$#", $uri, $matches)) {

                    // Remove the first match (which is the full string) to keep only params
                    array_shift($matches);

                    // 3. Logic to determine controller class
                    [$controller_name, $controller_method] = explode('@', $action);

                    // Determine Namespace based on prefix
                    $namespace = "App\\Controllers\\";
                    if (str_starts_with($action, 'Admin')) {
                        $namespace .= "Admin\\";
                    } elseif (str_starts_with($action, 'Teacher')) {
                        $namespace .= "Teacher\\";
                    } elseif (str_starts_with($action, 'Student')) {
                        $namespace .= "Student\\";
                    }

                    $controller_class = $namespace . $controller_name;

                    if (class_exists($controller_class)) {
                        $controller = new $controller_class();

                        // 4. Call the method and pass the parameters (the ID)
                        // ...$matches unpacks the array into arguments: index($id)
                        $controller->$controller_method(...$matches);
                        return;
                    }
                }
            }
        }

        // If loop finishes without return, it's a 404
        $controller_class = "App\\Controllers\\NotFoundController";
        $controller = new $controller_class();
        $controller->index();
    }
}

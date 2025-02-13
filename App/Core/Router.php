<?php

namespace App\Core;

class Router
{
    private $routes = [];
    private $acl;

    public function __construct()
    {
        $this->acl = include '../config/acl.php';
    }

    public function addRoute($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch($requestMethod, $requestUri)
    {
        // Debug information
        error_log("Request Method: " . $requestMethod);
        error_log("Request URI: " . $requestUri);
        
        $userRole = Session::get('user_logged_in_role') ?? 'guest';
        error_log("User Role: " . $userRole);
        
        if (!$this->checkAccess($userRole, $requestUri)) {
            error_log("Access Denied for URI: " . $requestUri);
            $this->showForbiddenPage();
        }

        foreach ($this->routes as $route) {
            error_log("Checking route - Method: {$route['method']}, Path: {$route['path']}");
            
            if ($route['method'] === $requestMethod) {
                $matches = $this->matchPath($route['path'], $requestUri);
                error_log("Route matches: " . print_r($matches, true));
                
                if ($matches !== false) {
                    $handler = $route['handler'];
                    
                    // Extract named parameters
                    $params = array_filter($matches, function($key) {
                        return !is_numeric($key);
                    }, ARRAY_FILTER_USE_KEY);
                    
                    error_log("Extracted parameters: " . print_r($params, true));

                    if (is_array($handler)) {
                        try {
                            $controller = new $handler[0]();
                            return call_user_func_array([$controller, $handler[1]], array_values($params));
                        } catch (\Exception $e) {
                            error_log("Handler execution error: " . $e->getMessage());
                            throw $e;
                        }
                    }
                    return call_user_func_array($handler, array_values($params));
                }
            }
        }

        error_log("No matching route found - showing 404");
        $this->showNotFoundPage();
    }

    private function matchPath($routePath, $requestUri)
    {
        $requestUri = strtok($requestUri, '?');
        
        $routeRegex = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $routePath);
        $routeRegex = "#^" . $routeRegex . "$#";
        error_log("Route regex: " . $routeRegex);
        
        $matches = [];
        if (preg_match($routeRegex, $requestUri, $matches)) {
            return $matches;
        }
        return false;
    }

    private function checkAccess($role, $uri)
    {
        // Remove query string from URI if present
        $uri = strtok($uri, '?');
        
        error_log("Checking access for role: $role, URI: $uri");
        
        if ($this->matchAnyRoute($uri, $this->acl['guest']) && $role !== 'guest') {
            error_log("Guest route accessed by non-guest");
            $redirectUri = "/$role/home";
            header("Location: $redirectUri");
            exit;
        }

        $allowedRoutes = array_merge(
            $this->acl['common'] ?? [],
            $this->acl[$role] ?? []
        );

        // echo '<pre>';
        // echo $role;
        // echo '<br>';
        // var_dump($allowedRoutes);
        // die;
        
        error_log("Allowed routes: " . print_r($allowedRoutes, true));
        return $this->matchAnyRoute($uri, $allowedRoutes);
    }

    private function matchAnyRoute($uri, $routes)
    {
        foreach ($routes as $route) {
            $routeRegex = preg_replace('/\{(\w+)\}/', '([^/]+)', $route);
            $routeRegex = "#^" . $routeRegex . "$#";
            error_log("Checking route pattern: $routeRegex against URI: $uri");
            
            if (preg_match($routeRegex, $uri)) {
                error_log("Route matched!");
                return true;
            }
        }
        error_log("No matching route found");
        return false;
    }

    private function showNotFoundPage()
    {
        http_response_code(404);
        include '../App/Views/errors/404.php';
        exit;
    }

    private function showForbiddenPage()
    {
        http_response_code(403);
        include '../App/Views/errors/403.php';
        exit;
    }
}
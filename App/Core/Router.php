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
        $userRole = Session::get('user_logged_in_role') ?? 'guest';

        if (!$this->checkAccess($userRole, $requestUri)) {
            $this->showForbiddenPage();
        }

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $this->matchPath($route['path'], $requestUri)) {
                $handler = $route['handler'];

                if (is_array($handler)) {
                    $controller = new $handler[0]();
                    return call_user_func([$controller, $handler[1]]);
                }
                return call_user_func($handler);
            }
        }

        $this->showNotFoundPage();
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
        include '../App/Views/errors/403.php'; // Custom 403 Page
        exit;
    }


    private function matchPath($routePath, $requestUri)
    {
        $routeRegex = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $routePath);
        $routeRegex = "#^" . $routeRegex . "$#";
        return preg_match($routeRegex, $requestUri, $matches);
    }

    private function checkAccess($role, $uri)
    {
        if (in_array($uri, $this->acl['guest']) && $role !== 'guest') {
            $redirectUri = "$role/home";
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

        return in_array($uri, $allowedRoutes);
    }
}

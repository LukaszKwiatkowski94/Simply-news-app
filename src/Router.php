<?php

declare(strict_types=1);

namespace APP;

enum HttpMethod: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}

final class Router
{

    private array $routes = [];
    private Request $request;

    public function __construct()
    {
        $this->request = new Request($_GET, $_POST);
    }

    public function add(HttpMethod $method, string $path, string $controllerClass, string $methodName): void
    {
        $this->routes[] = [
            'httpMethod' => $method->value,
            'path' => $path,
            'controller' => $controllerClass,
            'controllerMethod' => $methodName,
        ];
    }

    public function dispatch(): void
    {
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $currentMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['httpMethod'] !== $currentMethod) {
                continue;
            }

            $params = $this->match($route['path'], $currentPath);

            if ($params !== null) {
                $controller = new $route['controller']($this->request);
                call_user_func([$controller, $route['controllerMethod']], ...$params);
                return;
            }
        }

        http_response_code(404);
        echo "Not found";
    }

    private function match(string $pattern, string $path): ?array
    {
        preg_match_all('/\{([a-zA-Z0-9_]+)\}/', $pattern, $paramNames);

        $regex = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $pattern);
        $regex = '#^' . $regex . '$#';

        if (preg_match($regex, $path, $matches)) {
            array_shift($matches);

            return array_combine($paramNames[1], $matches);
        }

        return null;
    }
}

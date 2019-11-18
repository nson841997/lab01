<?php
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
use Philo\Blade\Blade;

$dotenv = new Dotenv\Dotenv(__DIR__ . DIRECTORY_SEPARATOR . '..');
$dotenv->load();

class App
{

    public $routes = [];
    public function __construct()
    {
        $this->blade = new Blade($this->view_path(), $this->cache_path());
    }

    public function start()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            foreach ($this->routes as $key => $route) {
                $r->addRoute('GET', $route['path'], function () use ($route) {
                    return $route;
                });
            }
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri        = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        if (getenv('BASE_PATH') !== false && getenv('BASE_PATH') !== '') {
            $uri = str_replace(getenv('BASE_PATH'), '', $uri);
            if ($uri === '') {
                $uri = '/';
            }
        }

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $route   = $handler();

                $this->render($route['view'], $route['data']);
                break;
        }
    }

    public function base_path()
    {
        return dirname(__DIR__);
    }

    public function view_path()
    {
        return $this->base_path() . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views';
    }
    public function cache_path()
    {
        return $this->base_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'cache';
    }

    public function view($view, $data = [])
    {
        return $this->blade->view()->make($view, $data)->render();
    }

    public function render($view, $data = [])
    {
        echo $this->view($view, $data);
    }

    public function get($path, $view, $data = [])
    {
        $this->routes[] = ['path' => $path, 'view' => $view, 'data' => $data];
    }

}

return new App();

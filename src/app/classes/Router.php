<?php

namespace app\classes;

use ReflectionMethod;

/**
 * Summary of Router
 */
class Router
{

    /**
     * Summary of routes
     * @var 
     */
    private array $routes;

    /**
     * Summary of route
     * @param mixed $request_method
     * @param mixed $route
     * @param | $action
     * @return \app\classes\Router
     */
    public function route(string $request_method, string $route, callable|array $action): self
    {

        $this->routes[$request_method][$route] = $action;

        return $this;
    }

    /**
     * Summary of resolve
     * @param mixed $request
     * @param mixed $request_method
     * @throws \InvalidArgumentException
     * @return void
     */
    public function resolve(string $request, string $request_method = 'get')
    {


        $route = explode('?', $request)[0] ?? $request;
        $action = $this->routes[$request_method][$route];

        if (!$action) {
            throw new \InvalidArgumentException('404 error');
        }

        if (is_callable($action)) {
            call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;
            if (class_exists($class)) {
                $instance = new $class();
                if (method_exists($instance, $method)) {
                    $reflection_return = new ReflectionMethod($instance, $method);
                    if ($reflection_return->getReturnType()->getName() === 'void') {
                        $instance->$method();
                    } else {
                        echo $instance->$method();
                    }
                }
            }
        }
    }

    /**
     * Returns a new instance of the class with a GET route.
     *
     * @param string $route The route to handle
     * @param callable|array $action The action to take when the route is requested
     * @return self A new instance of the class with the added GET route
     */
    public function get(string $route, callable|array $action): self
    {
        return $this->route('get', $route, $action);
    }

    /**
     * Adds a POST route to the application.
     *
     * @param string $route The route URL.
     * @param callable|array $action The action to be taken when the route is accessed.
     * @return self
     */
    public function post(string $route, callable|array $action): self
    {
        return $this->route('post', $route, $action);
    }

    /**
     * Summary of routes
     * @return array
     */
    public function routes(): array
    {
        return $this->routes;
    }
}

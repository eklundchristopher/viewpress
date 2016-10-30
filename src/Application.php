<?php

namespace EklundChristopher\ViewPress;

use Exception;
use EklundChristopher\ViewPress\Events\Action;
use EklundChristopher\ViewPress\Events\Filter;

class Application
{
    /**
     * Holds the singleton instance.
     *
     * @var \EklundChristopher\ViewPress\Application
     */
    protected static $instance;

    /**
     * Holds all of the registered components.
     *
     * @var array
     */
    protected $components;

    /**
     * Holds the storage path.
     *
     * @var string
     */
    protected $storagePath;

    /**
     * Holds the views path.
     *
     * @var string
     */
    protected $viewsPath;

    /**
     * Instantiate a new ViewPress instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->components = [];

        static::$instance = $this;
    }

    /**
     * Return the value of a specific identifier.
     *
     * @param  string  $identifier
     * @return mixed
     */
    public function __get($identifier)
    {
        if (isset($this->components[$identifier])) {
            return $this->components[$identifier];
        }
    }

    /**
     * Retrieve a previously instantiated object, or instantiate a new one.
     *
     * @return $this
     */
    public static function getInstance()
    {
        if (! (static::$instance instanceof static)) {
            return new static;
        }

        return static::$instance;
    }

    /**
     * Set the storage path.
     *
     * @param  string  $storagePath
     * @return void
     */
    public function setStoragePath($storagePath)
    {
        $this->storagePath = $storagePath;
    }

    /**
     * Get the storage path.
     *
     * @return string
     */
    public function getStoragePath()
    {
        return $this->storagePath;
    }

    /**
     * Set the views path.
     *
     * @param  string  $viewsPath
     * @return void
     */
    public function setViewsPath($viewsPath)
    {
        $this->viewsPath = $viewsPath;
    }

    /**
     * Get the views path.
     *
     * @return string
     */
    public function getViewsPath()
    {
        return $this->viewsPath;
    }

    /**
     * Register a component.
     *
     * @param  string  $identifier
     * @param  object  $component
     * @return void
     */
    public function register($identifier, $component)
    {
        $this->components[$identifier] = $component;
    }

    /**
     * Create a new action event.
     *
     * @param  string  $name
     * @param  integer  $priority  10
     * @param  integer  $arguments  1
     * @return \EklundChristopher\ViewPress\Events\Action
     */
    public function action($name, $priority = 10, $arguments = 1)
    {
        return new Action($this, $name, $priority, $arguments);
    }

    /**
     * Create a new filter event.
     *
     * @param  string  $name
     * @param  integer  $priority  10
     * @param  integer  $arguments  1
     * @return \EklundChristopher\ViewPress\Events\filter
     */
    public function filter($name, $priority = 10, $arguments = 1)
    {
        return new Filter($this, $name, $priority, $arguments);
    }

    /**
     * Declare a variable through the @declare directive.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return array
     */
    public function declareVariable($name, $value)
    {
        return [$name => $value];
    }
    
    /**
     * Run a controller method from a specific view.
     *
     * @param  string  $action
     * @return void
     */
    public function routeThrough($action)
    {
        list ($controller, $method) = explode('@', $action);

        if (! class_exists($controller)) {
            throw new Exception(sprintf("Class '%s' not found", $controller));
        }

        if (! method_exists($controller, $method)) {
            throw new Exception(sprintf("Call to undefined method %s::%s", $controller, $method));
        }

        $object = new $controller;

        if (method_exists($controller, 'authorize') and call_user_func_array([$object, 'authorize'], []) !== true) {
            return [];
        }

        $response = call_user_func_array([$object, $method], []);

        unset($response['__viewpress']);
        unset($response['__env']);

        return is_array($response) ? $response : [];
    }
}

<?php

namespace EklundChristopher\ViewPress\Events;

use EklundChristopher\ViewPress\Application;

class Action
{
    /**
     * Holds the Application implementation.
     *
     * @var \EklundChristopher\ViewPress\Application
     */
    protected $app;

    /**
     * Holds the action name.
     *
     * @var string
     */
    protected $name;

    /**
     * Holds the priority value.
     *
     * @var integer
     */
    protected $priority;

    /**
     * Holds the number of arguments.
     *
     * @var integer
     */
    protected $arguments;

    /**
     * Instantiate a new Action event object.
     *
     * @param  \EklundChristopher\ViewPress\Application  $application
     * @param  string  $name
     * @param  integer  $priority  10
     * @param  integer  $arguments  1
     * @return void
     */
    public function __construct(Application $application, $name, $priority = 10, $arguments = 1)
    {
        $this->app = $application;
        $this->name = $name;
        $this->priority = $priority;
        $this->arguments = $arguments;
    }

    /**
     * Bind the action object.
     * 
     * @param  object  $action
     * @return void
     */
    public function bind($action)
    {
        if (is_string($action)) {
            $action = new $action($this->app);
        }

        add_action($this->name, [$action, 'handle'], $this->priority, $this->arguments);
    }
}

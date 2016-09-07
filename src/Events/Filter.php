<?php

namespace EklundChristopher\ViewPress\Events;

use EklundChristopher\ViewPress\Application;

class Filter
{
    /**
     * Holds the Application implementation.
     *
     * @var \EklundChristopher\ViewPress\Application
     */
    protected $app;

    /**
     * Holds the filter name.
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
     * Instantiate a new Filter event object.
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
     * Bind the filter object.
     * 
     * @param  mixed  $filter
     * @return void
     */
    public function bind($filter)
    {
        if (is_string($filter)) {
            $filter = new $filter($this->app);
        }

        add_filter($this->name, [$filter, 'handle'], $this->priority, $this->arguments);
    }
}

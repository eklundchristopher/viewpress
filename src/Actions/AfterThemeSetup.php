<?php

namespace EklundChristopher\ViewPress\Actions;

use EklundChristopher\ViewPress\Filters;
use EklundChristopher\ViewPress\Application;

class AfterThemeSetup
{
    /**
     * Holds the Application implementation.
     *
     * @var \EklundChristopher\ViewPress\Application
     */
    protected $app;

    /**
     * Instantiate a new action object.
     *
     * @param  \EklundChristopher\ViewPress\Application  $application
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    /**
     * Trigger the event.
     *
     * @return void
     */
    public function handle()
    {
        $this->app->filter('template_include', 15)->bind(
            $this->app->usesRoutes() ? Filters\RouteHandler::class : Filters\ViewHandler::class
        );
    }
}
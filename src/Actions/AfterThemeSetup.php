<?php

namespace EklundChristopher\ViewPress\Actions;

use Illuminate\View\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\View\FileViewFinder;
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
        if ($viewPath = apply_filters('viewpress_views_path', $this->app->getViewsPath())) {
            $this->app->view->getFinder()->addLocation($viewPath);
        }

        $this->app->filter('template_include', 15)->bind(Filters\ViewHandler::class);
    }
}
<?php

namespace EklundChristopher\ViewPress\Filters;

use EklundChristopher\ViewPress\Application;

class SearchFormHandler
{
    /**
     * Holds the Application implementation.
     *
     * @var \EklundChristopher\ViewPress\Application
     */
    protected $app;

    /**
     * Instantiate a new filter object.
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
     * @param  string  $form
     * @return void
     */
    public function handle($form)
    {
        if ($this->app->view->exists('searchform')) {
            return $this->app->view('searchform')->render();
        }

        return $form;
    }
}

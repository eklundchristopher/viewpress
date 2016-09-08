<?php

namespace EklundChristopher\ViewPress\Filters;

use EklundChristopher\ViewPress\Application;

class ViewHandler
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
     * @param  string  $template
     * @return void
     */
    public function handle($template)
    {
        $path = $this->getRelativePath($template);
        
        return $this->app->view($path)->render(function ($view, $content) {
            if ($engine = $view->getEngine() and ! method_exists($engine, 'getCompiler')) {
                return $view->getPath();
            }

            if ($compiler = $engine->getCompiler() and ! method_exists($compiler, 'getCompiledPath')) {
                return $view->getPath();
            }

            return $compiler->getCompiledPath($view->getPath());
        });
    }

    /**
     * Extract the relative template path.
     *
     * @param  string  $template
     * @return string
     */
    protected function getRelativePath($template)
    {
        $patterns = [
            $this->app->getViewsPath(),
            get_stylesheet_directory(),
            get_template_directory(),
            '.blade.php',
            '.php',
        ];

        return trim(str_ireplace($patterns, null, $template), '/');
    }
}

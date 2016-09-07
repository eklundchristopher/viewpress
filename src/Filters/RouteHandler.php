<?php

namespace EklundChristopher\ViewPress\Filters;

use EklundChristopher\ViewPress\Application;

class RouteHandler
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
        $path = sprintf('%s.php', $this->stripExtension($template));

        $content = include $path;

        if ($content !== 1 and $content !== true) {
            echo $content;
        }

        return null;
    }

    /**
     * Get the relative path starting from the active theme directory.
     *
     * @param  string  $template
     * @return string
     */
    protected function stripExtension($template)
    {
        return str_ireplace(['.blade.php', '.php'], null, $template);
    }
}

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

        try {
            $this->app->view->share('__viewpress', $this->app);

            echo $this->app->view->make($path)->render();
        } catch (InvalidArgumentException $e) {
            if ($e->getMessage() === 'Cannot end a section without first starting one.') {
                exit;
            }
        } catch (Exception $e) {
            // ...
        } finally {
            exit;
        }
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

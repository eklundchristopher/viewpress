<?php

namespace EklundChristopher\ViewPress\Filters;

use EklundChristopher\ViewPress\Application;

abstract class TemplateHandler
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
     * Return an array of templates in order of precedence.
     *
     * @param  array  $templates
     * @return array
     */
    abstract public function templates(array $templates);

    /**
     * Trigger the event.
     *
     * @param  string  $template
     * @return void
     */
    public function handle($template)
    {
        $templates = $this->templates([]);

        return $this->iterate(
            is_array($templates) ? $templates : [$templates]
        );
    }
    
    /**
     * Iterate over the templates.
     *
     * @param  array  $templates
     * @return string|null
     */
    protected function iterate(array $templates)
    {
        $response = null;

        foreach ($templates as $template) {
            if (! $template or ! is_null($response)) {
                continue;
            }

            $response = $this->load($template);
        }

        return $response;
    }

    /**
     * Attempt to find a matching filepath.
     *
     * @param  string  $template
     * @return string
     */
    protected function load($template)
    {
        if ($this->isTemplate($template)) {
            return $this->loadTemplate($template);
        }

        if (file_exists($path = $this->app->getRoutesPath().'/'.$template)) {
            return $path;
        }

        if (locate_template($template)) {
            return $template;
        }
    }

    /**
     * Determine whether the template is an actual template file or just a regular file.
     *
     * @param  string  $template
     * @return boolean
     */
    protected function isTemplate($template)
    {
        return (boolean) preg_match('/^template\:/i', $template);
    }

    /**
     * Load a template file.
     *
     * @param  string  $template
     * @return string|null
     */
    protected function loadTemplate($template)
    {
        $template = preg_replace('/^template\:/i', null, $template);

        if (file_exists(get_stylesheet_directory().'/'.$template)) {
            return get_stylesheet_directory().'/'.$template;
        }

        if (file_exists(get_template_directory().'/'.$template)) {
            return get_template_directory().'/'.$template;
        }

        return null;
    }
}

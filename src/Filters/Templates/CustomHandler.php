<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use Symfony\Component\Finder\SplFileInfo;
use EklundChristopher\ViewPress\Application;

class CustomHandler
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
     * @param  array  $templates
     * @return void
     */
    public function handle(array $templates)
    {
        $manual = apply_filters('viewpress_templates', []);

        if ($manual === false) {
            return $templates;
        }

        if (is_array($manual) and ! empty($manual)) {
            return array_merge($templates, $manual);
        }

        foreach ($this->getFiles() as $file) {
            if (! preg_match('/\.php$/i', $file->getRelativePathname())) {
                continue;
            }

            if (! preg_match('/Template Name:(.*)$/mi', $file->getContents(), $matches)) {
                continue;
            }

            $templates[$this->getFileKey($file)] = _cleanup_header_comment($matches[1]);
        }

        return $templates;
    }

    /**
     * Get all the files within the routes directory.
     *
     * @return array
     */
    protected function getFiles()
    {
        $filesystem = $this->app->view->getFinder()->getFilesystem();

        return $filesystem->allFiles(
            $this->app->getRoutesPath()
        );
    }

    /**
     * Generate the template file key.
     *
     * @param  \Symfony\Component\Finder\SplFileInfo  $file
     * @return string
     */
    protected function getFileKey(SplFileInfo $file)
    {
        $key = $this->app->getRoutesPath().'/'.$file->getRelativePathname();

        $key = trim(str_ireplace([get_template_directory(), get_stylesheet_directory()], null, $key), '/');

        return $key;
    }
}

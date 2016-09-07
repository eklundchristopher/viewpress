<?php

use EklundChristopher\ViewPress\Application;

if (! function_exists('view'))
{
    /**
     * Render a view file.
     *
     * @param  string  $template
     * @param  array  $data  []
     * @return string
     */
    function view($template, array $data = [])
    {
        return Application::getInstance()->view($template, $data);
    }
}

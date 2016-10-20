<?php

use Carbon\Carbon;
use EklundChristopher\ViewPress\Application;

if (! function_exists('viewpress_view'))
{
    /**
     * Render a view file.
     *
     * @param  string  $template
     * @param  array  $data  []
     * @return string
     */
    function viewpress_view($template, array $data = [])
    {
        if (is_admin() and defined('DOING_AJAX') and ! DOING_AJAX) {
            return;
        }
        
        return Application::getInstance()->view->make($template, $data)->render();
    }
}

if (! function_exists('viewpress_directive'))
{
    /**
     * Register a Blade directive.
     *
     * @param  string  $name
     * @param  callable  $closure
     * @return void
     */
    function viewpress_directive($name, callable $closure)
    {
        if (is_admin() and defined('DOING_AJAX') and ! DOING_AJAX) {
            return;
        }
        
        $compiler = Application::getInstance()->view->getEngineResolver()->resolve('blade')->getCompiler();

        $compiler->directive($name, $closure);
    }
}

if (! function_exists('viewpress_timeago'))
{
    /**
     * Display a more humanly readable date & time.
     *
     * @param  string  $date
     * @return string
     */
    function viewpress_timeago($date)
    {
        $timestamp = strtotime($date);

        return Carbon::createFromTimestamp($timestamp)->diffForHumans();
    }    
}

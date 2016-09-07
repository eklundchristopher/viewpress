<?php

namespace EklundChristopher\ViewPress;

class Route
{
    /**
     * Run a controller method from a specific view.
     *
     * @param  string  $action
     * @return object
     */
    public static function through($action)
    {
        list ($controller, $method) = explode('@', $action);

        return call_user_func_array([$controller, $method], []);
    }
}

<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class HomeHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./home.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $templates[] = 'home.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

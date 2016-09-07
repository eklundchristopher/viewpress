<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class NotFoundHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./404.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $templates[] = '404.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

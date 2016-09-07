<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class DateHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./date.php
     * ./posts/archive.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $templates[] = 'date.php';
        $templates[] = 'posts/archive.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

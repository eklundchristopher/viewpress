<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class DateHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./types/date.php
     * ./types/archive.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $templates[] = 'types/date.php';
        $templates[] = 'types/archive.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

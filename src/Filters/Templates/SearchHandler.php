<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class SearchHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./search.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $templates[] = 'search.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

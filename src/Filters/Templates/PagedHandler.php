<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class PagedHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./types/paged.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $templates[] = 'types/paged.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

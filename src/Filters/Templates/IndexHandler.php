<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class IndexHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $templates[] = 'index.php';

        return $templates;
    }
}

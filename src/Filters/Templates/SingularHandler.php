<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class SingularHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./singular.php
     * ./index.php
     * 
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $templates[] = 'singular.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class FrontPageHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./frontpage.php
     * ./home.php
     * ./articles/single.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $templates[] = 'frontpage.php';
        $templates[] = 'home.php';
        $templates[] = 'articles/single.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

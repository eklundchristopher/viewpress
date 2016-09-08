<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use WP_User;
use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class AuthorHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./authors/{nicename}.php
     * ./authors/{id}.php
     * ./authors/author.php
     * ./types/archive.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $author = get_queried_object();

        if ($author instanceof WP_User) {
            $templates[] = sprintf('authors/%s.php', $author->user_nicename);
            $templates[] = sprintf('authors/%d.php', $author->ID);
        }

        $templates[] = 'authors/author.php';
        $templates[] = 'types/archive.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

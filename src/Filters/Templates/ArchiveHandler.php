<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class ArchiveHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./articles/{type}/archive.php
     * ./articles/archive.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        if (! empty($posttypes = array_filter((array) get_query_var('post_type')))) {
            $posttype = reset($posttypes);
            $object = get_post_type_object($posttype);

            if ($object->has_archive) {
                $templates[] = sprintf('articles/%s/archive.php', $posttype);
            }
        }

        $templates[] = 'articles/archive.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

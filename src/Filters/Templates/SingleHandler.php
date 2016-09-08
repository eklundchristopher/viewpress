<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class SingleHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./articles/{type}/{slug}.php
     * ./articles/{type}/{id}.php
     * ./articles/{type}/single.php
     * ./articles/single.php
     * ./singular.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        if ($object = get_queried_object()) {
            if (! empty($object->post_type)) {
                $templates[] = sprintf('articles/%s/%s.php', $object->post_type, $object->post_name);
                $templates[] = sprintf('articles/%s/%d.php', $object->post_type, $object->ID);
                $templates[] = sprintf('articles/%s/single.php', $object->post_type);
            }
        }

        $templates[] = 'articles/single.php';
        $templates[] = 'singular.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

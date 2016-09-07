<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class SingleHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./posts/{type}/{slug}.php
     * ./posts/{type}/{id}.php
     * ./posts/{type}/single.php
     * ./posts/single.php
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
                $templates[] = sprintf('posts/%s/%s.php', $object->post_type, $object->post_name);
                $templates[] = sprintf('posts/%s/%d.php', $object->post_type, $object->ID);
                $templates[] = sprintf('posts/%s/single.php', $object->post_type);
            }
        }

        $templates[] = 'posts/single.php';
        $templates[] = 'singular.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

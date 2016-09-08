<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class SingleHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./types/{type}/{slug}.php
     * ./types/{type}/{id}.php
     * ./types/{type}/single.php
     * ./types/single.php
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
                $templates[] = sprintf('types/%s/%s.php', $object->post_type, $object->post_name);
                $templates[] = sprintf('types/%s/%d.php', $object->post_type, $object->ID);
                $templates[] = sprintf('types/%s/single.php', $object->post_type);
            }
        }

        $templates[] = 'types/single.php';
        $templates[] = 'singular.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

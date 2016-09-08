<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class EmbedHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./types/{type}/embed/{format}.php
     * ./types/{type}/embed/standard.php
     * ./types/embed.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $object = get_queried_object();

        if (! empty($object->post_type)) {
            if ($format = get_post_format($object)) {
                $templates[] = sprintf('types/%s/embed/%s.php', $object->post_type, $format);
            }

            $templates[] = sprintf('types/%s/embed/standard.php', $object->post_type);
        }

        $templates[] = 'types/embed.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

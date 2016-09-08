<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class EmbedHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./articles/{type}/embed/{format}.php
     * ./articles/{type}/embed/standard.php
     * ./articles/embed.php
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
                $templates[] = sprintf('articles/%s/embed/%s.php', $object->post_type, $format);
            }

            $templates[] = sprintf('articles/%s/embed/standard.php', $object->post_type);
        }

        $templates[] = 'articles/embed.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

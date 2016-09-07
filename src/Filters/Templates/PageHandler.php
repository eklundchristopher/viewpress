<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class PageHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * {template}
     * ./posts/page/{slug}.php
     * ./posts/page/{id}.php
     * ./posts/page/single.php
     * ./posts/single.php
     * ./singular.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        list ($id, $template, $name) = [
            get_queried_object_id(), get_page_template_slug(), get_query_var('pagename'),
        ];

        if ($template and 0 === validate_file($template)) {
            $templates[] = sprintf('template:%s', $template);
        }

        if ($name = (! $name and $id and $post = get_queried_object()) ? $post->post_name : $name) {
            $templates[] = sprintf('posts/page/%s.php', $name);
        }

        if ($id) {
            $templates[] = sprintf('posts/page/%d.php', (int) $id);
        }

        $templates[] = 'posts/page/single.php';
        $templates[] = 'posts/single.php';
        $templates[] = 'singular.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

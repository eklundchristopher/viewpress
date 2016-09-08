<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class PageHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * {template}
     * ./articles/page/{slug}.php
     * ./articles/page/{id}.php
     * ./articles/page/single.php
     * ./articles/single.php
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
            $templates[] = sprintf('articles/page/%s.php', $name);
        }

        if ($id) {
            $templates[] = sprintf('articles/page/%d.php', (int) $id);
        }

        $templates[] = 'articles/page/single.php';
        $templates[] = 'articles/single.php';
        $templates[] = 'singular.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

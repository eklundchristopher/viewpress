<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class TagHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./taxonomies/tag/{slug}.php
     * ./taxonomies/tag/{id}.php
     * ./taxonomies/tag/tag.php
     * ./taxonomies/taxonomy.php
     * ./types/archive.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $tag = get_queried_object();

        if (! empty($tag->slug)) {
            $templates[] = sprintf('taxonomies/tag/%s.php', $tag->slug);
            $templates[] = sprintf('taxonomies/tag/%d.php', $tag->term_id);
            $templates[] = 'taxonomies/tag/tag.php';
        }

        $templates[] = 'taxonomies/taxonomy.php';
        $templates[] = 'types/archive.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class TaxonomyHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./taxonomies/{type}/{slug}.php
     * ./taxonomies/{type}/{id}.php
     * ./taxonomies/{type}/taxonomy.php
     * ./taxonomies/taxonomy.php
     * ./articles/archive.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $term = get_queried_object();

        if (! empty($term->slug)) {
            $templates[] = sprintf('taxonomies/%s/%s.php', $term->taxonomy, $term->slug);
            $templates[] = sprintf('taxonomies/%s/%d.php', $term->taxonomy, $term->term_id);
            $templates[] = sprintf('taxonomies/%s/taxonomy.php', $term->taxonomy);
        }

        $templates[] = 'taxonomies/taxonomy.php';
        $templates[] = 'articles/archive.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

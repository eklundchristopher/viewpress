<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class CategoryHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./taxonomies/category/{slug}.php
     * ./taxonomies/category/{id}.php
     * ./taxonomies/category/category.php
     * ./taxonomies/taxonomy.php
     * ./types/archive.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        $category = get_queried_object();

        if (! empty($category->slug)) {
            $templates[] = sprintf('taxonomies/category/%s.php', $category->slug);
            $templates[] = sprintf('taxonomies/category/%d.php', $category->term_id);
            $templates[] = 'taxonomies/category/category.php';
        }

        $templates[] = 'taxonomies/taxonomy.php';
        $templates[] = 'types/archive.php';
        $templates[] = 'index.php';

        return $templates;
    }
}

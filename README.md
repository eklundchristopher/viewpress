![ViewPress](/resources/docs/heading.jpg)

More documentation to come...


# Template Hierarchy
**ViewPress** will search for your WordPress templates within the `views/` folder of your theme. The priority of each template is signified by its respective list number below.

> It is entirely up to you whether you want to utilise the power of Laravel's Blade engine or not. You may activate it by using the `.blade.php` extension for your template files. If you prefer vanilla PHP, however, you may instead use `.php`.

## Home Page display
1. `home.blade.php`
2. `index.blade.php`

## Front Page display
1. `front-page.blade.php`
2. `frontpage.blade.php`
3. `home.blade.php`
4. `types/single.blade.php`
5. `index.blade.php`

## Single Post
1. `types/post/{slug}.blade.php`
2. `types/post/{id}.blade.php`
3. `types/post/single.blade.php`
4. `types/single.blade.php`
5. `singular.blade.php`
6. `index.blade.php`

## Single Page
1. `{custom-template}`
2. `types/page/{slug}.blade.php`
3. `types/page/{id}.blade.php`
4. `types/page/single.php`
5. `types/single.blade.php`
6. `singular.blade.php`
7. `index.blade.php`

## Category
1. `taxonomies/category/{slug}.blade.php`
2. `taxonomies/category/{id}.blade.php`
3. `taxonomies/category/category.blade.php`
4. `taxonomies/taxonomy.blade.php`
5. `types/archive.blade.php`
6. `index.blade.php`

## Tag
1. `taxonomies/tag/{slug}.blade.php`
2. `taxonomies/tag/{id}.blade.php`
3. `taxonomies/tag/tag.blade.php`
4. `taxonomies/taxonomy.blade.php`
5. `types/archive.blade.php`
6. `index.blade.php`

## Custom Taxonomies
1. `taxonomies/{type}/{slug}.blade.php`
2. `taxonomies/{type}/{id}.blade.php`
3. `taxonomies/{type}/taxonomy.blade.php`
4. `taxonomies/taxonomy.blade.php`
5. `types/archive.blade.php`
6. `index.blade.php`

## Custom Post Types
1. `types/{type}/{slug}.blade.php`
2. `types/{type}/{id}.blade.php`
3. `types/{type}/single.blade.php`
4. `types/single.blade.php`
5. `singular.blade.php`
6. `index.blade.php`

## Custom Post Type Archives
1. `types/{type}/archive.blade.php`
2. `types/archive.blade.php`
3. `index.blade.php`

## Author display
1. `authors/{nicename}.blade.php`
2. `authors/{id}.blade.php`
3. `authors/author.blade.php`
4. `types/archive.blade.php`
5. `index.blade.php`

## Date
1. `types/date.blade.php`
2. `types/archive.blade.php`
3. `index.blade.php`

## Search Result
1. `search.blade.php`
2. `index.blade.php`

## 404 (Not Found)
1. `404.blade.php`
2. `index.blade.php`

## Attachment
1. `attachments/{type}/{subtype}.blade.php`
2. `attachments/{subtype}.blade.php`
3. `attachments/{type}.blade.php`
4. `attachments/attachment.blade.php`
5. `types/single.blade.php`
6. `index.blade.php`

## Embeds
1. `types/{type}/embed/{format}.blade.php`
2. `types/{type}/embed/standard.blade.php`
3. `types/embed.blade.php`
4. `index.blade.php`

## Paged
1. `types/paged.blade.php`
2. `index.blade.php`

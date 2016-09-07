<?php

/*
Plugin Name:    ViewPress
Plugin URI:     https://github.com/eklundchristopher/viewpress
Description:    Restructures the way you develop WordPress themes by integrating parts or concepts of the Laravel framework.
Version:        1.0.0
Author:         Christopher Eklund
Author URI:     https://eklundchristopher.com
License:        MIT
License URI:    https://opensource.org/licenses/MIT
Domain Path:    /resources/langs
Text Domain:    viewpress
*/

use Illuminate\View\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\View\FileViewFinder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\PhpEngine;
use EklundChristopher\ViewPress\Actions;
use EklundChristopher\ViewPress\Filters;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Compilers\BladeCompiler;
use EklundChristopher\ViewPress\Application;

define('VIEWPRESS', __FILE__);

try {

    $app = new Application;

    $app->setStoragePath(__DIR__.'/storage/views');
    $app->setViewsPath(get_stylesheet_directory().'/resources/views');
    $app->setRoutesPath(get_stylesheet_directory().'/routes');

    list ($filesystem, $resolver) = [new Filesystem, new EngineResolver];

    $resolver->register('blade', function () use ($filesystem, $app) {
        return new CompilerEngine(new BladeCompiler($filesystem, $app->getStoragePath()), $filesystem);
    });

    $resolver->register('php', function () {
        return new PhpEngine;
    });

    $app->register('view', new Factory(
        $resolver,
        new FileViewFinder($filesystem, [$app->getViewsPath()]),
        new Dispatcher(new Container)
    ));

    extract($app->view->getShared());

    $app->action('after_setup_theme', 15)->bind(Actions\AfterThemeSetup::class);

    $app->filter('index_template', 15)->bind(Filters\Templates\IndexHandler::class);
    $app->filter('404_template', 15)->bind(Filters\Templates\NotFoundHandler::class);
    $app->filter('archive_template', 15)->bind(Filters\Templates\ArchiveHandler::class);
    $app->filter('author_template', 15)->bind(Filters\Templates\AuthorHandler::class);
    $app->filter('category_template', 15)->bind(Filters\Templates\CategoryHandler::class);
    $app->filter('tag_template', 15)->bind(Filters\Templates\TagHandler::class);
    $app->filter('taxonomy_template', 15)->bind(Filters\Templates\TaxonomyHandler::class);
    $app->filter('date_template', 15)->bind(Filters\Templates\DateHandler::class);
    $app->filter('home_template', 15)->bind(Filters\Templates\HomeHandler::class);
    $app->filter('frontpage_template', 15)->bind(Filters\Templates\FrontPageHandler::class);
    $app->filter('page_template', 15)->bind(Filters\Templates\PageHandler::class);
    $app->filter('paged_template', 15)->bind(Filters\Templates\PagedHandler::class);
    $app->filter('search_template', 15)->bind(Filters\Templates\SearchHandler::class);
    $app->filter('single_template', 15)->bind(Filters\Templates\SingleHandler::class);
    $app->filter('singular_template', 15)->bind(Filters\Templates\SingularHandler::class);
    $app->filter('attachment_template', 15)->bind(Filters\Templates\AttachmentHandler::class);
    $app->filter('embed_template', 15)->bind(Filters\Templates\EmbedHandler::class);
    
    $app->filter('theme_page_templates', 15)->bind(Filters\Templates\CustomHandler::class);

} catch (Exception $e) {
    // ...
}

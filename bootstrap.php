<?php
require "config/database.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Html\HtmlServiceProvider;
use Illuminate\Routing\Router;


/*$app['config'] = $app->share(function () {
    return Yaml::parse(file_get_contents(__DIR__.'/app/config.yml'));
});*/

$db = vaah_db_config();
/*
$app = new \Slim\Slim();

$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);*/

$events = new Dispatcher(new Container);

$pathsToTemplates = [__DIR__ . '/templates'];

$filesystem = new Filesystem;

$viewResolver = new EngineResolver;

$viewResolver->register('php', function () {
    return new PhpEngine;
});

$viewFinder = new FileViewFinder($filesystem, $pathsToTemplates);

$viewFactory = new Factory($viewResolver, $viewFinder, $events);


//Set Pagination Variable
// Set the view factory resolver
Paginator::viewFactoryResolver(function () use ($viewFactory) {
    return $viewFactory;
});


$pageName = 'page_number';



// Set up a current path resolver so the paginator can generate proper links
Paginator::currentPathResolver(function () {
    return isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : '/';
});



// Set up a current page resolver
Paginator::currentPageResolver(function ($pageName) {
    $page = isset($_REQUEST[$pageName]) ? $_REQUEST[$pageName] : 1;
    return $page;
});


$capsule = new Capsule;
$capsule->addConnection($db);

$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
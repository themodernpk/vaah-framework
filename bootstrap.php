<?php
require "config/database.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Html\HtmlServiceProvider;

/*$app['config'] = $app->share(function () {
    return Yaml::parse(file_get_contents(__DIR__.'/app/config.yml'));
});*/

$db = [
    'driver' => 'mysql',
    'host' => DB_HOST,
    //'port' => DB_PORT,
    'database' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASSWORD,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
];

$capsule = new Capsule;
$capsule->addConnection($db);

$capsule->setEventDispatcher(new Dispatcher(new Container));

//Set Pagination Variable
$inputs = Request::capture()->all();

if(isset($inputs['page']))
{
    Paginator::currentPageResolver(function () use ($inputs) {
        return $inputs['page'];
    });
}


// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
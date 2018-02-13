<?php
/*
  Plugin Name: Vaah WordPress Plugin Framework
  Description: Vaah Plugins are developed by WebReinvent
  Version: 1.0
  Author: WebReinvent
  Author URI: https://www.webreinvent.com
 */
require "vendor/autoload.php";

include_once(ABSPATH . '/wp-config.php');
include_once(ABSPATH . '/wp-load.php');
include_once(ABSPATH . "wp-includes/pluggable.php");
include_once(ABSPATH . "wp-admin/includes/user.php");
require "config/database.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;


$capsule = new Capsule;

$db = [
    'driver' => 'mysql',
    'host' => DB_HOST,
    'port' => DB_PORT,
    'database' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASSWORD,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
];

$capsule->addConnection($db);

$capsule->setEventDispatcher(new Dispatcher(new Container));

//Set Pagination Variable
$inputs = Request::capture()->all();
Paginator::currentPageResolver(function () use ($inputs) {
    return $inputs['page'];
});

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();


// Load admin scripts
include_once ('config/admin-scripts.php');

// View Admin Menu
include_once ('config/admin-menu.php');

/*// View Front Menu
include_once ('config/admin-menu.php');*/

// View Front Short Code
include_once ('config/short-codes.php');

// Register Wordpress Routes
include_once ('config/register-routes.php');
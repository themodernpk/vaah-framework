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

/*
function vaah_register_query_vars( $vars ) {
    $vars[] = 'page';
    return $vars;
}
add_filter( 'query_vars', 'vaah_register_query_vars' );

$key = get_query_var( 'paged' );

echo "<pre>";
print_r($key);
echo "</pre>";
die("<hr/>line number=123");*/

// Load admin scripts
include_once ('bootstrap.php');

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


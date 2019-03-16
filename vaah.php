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
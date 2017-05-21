<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dir = "";
require_once( $dir . 'lib/config.php' );
require_once( $dir . 'classes/Core.php' );
$core = new Core;
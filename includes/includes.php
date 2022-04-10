<?php

if ( ! defined('ABSPATH') ) {
    die('Direct access not permitted.');
}

require_once (__DIR__) . '/classes/loader.php';

foreach ( glob( (__DIR__) . '/hooks/*.php' ) as $filename ) {
    require_once $filename;
}

foreach ( glob( (__DIR__) . '/functions/*.php' ) as $filename ) {
    require_once $filename;
}

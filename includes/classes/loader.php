<?php if ( ! defined('ABSPATH') ) { die('Direct access not permitted.'); }

foreach ( glob( (__DIR__) . '/interfaces/*.php' ) as $filename ) {
    require_once $filename;
}

foreach ( glob( (__DIR__) . '/handlers/*.php' ) as $filename ) {
    require_once $filename;
}
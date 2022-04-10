<?php

if ( ! defined('ABSPATH') ) {
    die('Direct access not permitted.');
}

/**
 * Init Action
 */
if(!function_exists('customInit')){
    function customInit(){
        //Main Settings
        _registerMetaboxes();
        // Add Plugin actions
        add_action( 'elementor/widgets/widgets_registered', ['_Widget','register'] );
    }
    add_action('init','customInit');
}

if(!function_exists('_registerMetaboxes')){

    function _registerMetaboxes(){
        return [
            'my-citations' =>(new _Metabox(
                ['post'],
                'my-citations',
                ['title' => __('My Citations',MY_CUSTOM_TXDM)],
                'editor'
            ))
        ];
    }
}
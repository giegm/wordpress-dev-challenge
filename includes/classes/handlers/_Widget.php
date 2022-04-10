<?php if ( ! defined('ABSPATH') ) { die('Direct access not permitted.'); }


if ( ! class_exists( '_handlerWidget' ) ) {

    class _Widget{

        static function register($widgets_manager){
            foreach ( glob( MY_CUSTOM_PATH . '/includes/widgets/*.php' ) as $filename ) {
                require_once $filename;
                $class = '\\'.basename($filename,".php");
                $obj = new $class() ;
                
                add_shortcode( $obj->get_name(), [$obj,'registerAsSC']);
                $widgets_manager->register_widget_type( $obj );
            }
        }
    }

}
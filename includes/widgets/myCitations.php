<?php if ( ! defined('ABSPATH') ) { die('Direct access not permitted.'); }

if ( ! class_exists( 'myCitations' ) ) {
    class myCitations extends \Elementor\Widget_Base{
        private $mainData;
        public static $slug = 'my-citations';

        public function setMainData($data=[]){ $this->mainData = $data; }
        public function getMainData(){ return $this->mainData; }

        public function registerAsSC($atts,$content=null){
            global $post;
            $atts = shortcode_atts([
                'post_id'=>$post->ID
            ],$atts);

            $this->setMainData( ['atts'=>$atts,'content'=>$content] );
            return $this->render();
        }
        
        public function get_name() { return self::$slug; }
        
        public function get_title() { return esc_html__( 'My citations Widget', MY_CUSTOM_TXDM ); }
        
        public function get_icon() { return 'eicon-code'; }
        
        public function get_categories() { return [ 'basic' ]; }
        
        protected function _register_controls() {
            global $post;

            $this->start_controls_section(
                'content_section',
                [
                    'label' => __( 'Options', self::$slug ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
        
            $this->add_control(
                'post_id',
                [
                    'label' => __( 'Post ID', MY_CUSTOM_TXDM ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => $post->ID,
                ]
            );

            $this->end_controls_section();
        }
        
        protected function render() {
            $mainData = (!empty($this->getMainData()))?
                $this->getMainData()['atts']:
                $this->get_settings_for_display();

            echo do_shortcode( get_post_meta($mainData['post_id'],$this->get_name(),true) );
        }

    }

}
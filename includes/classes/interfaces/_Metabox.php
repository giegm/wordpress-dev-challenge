<?php if ( ! defined('ABSPATH') ) { die('Direct access not permitted.'); }

if ( ! class_exists( '_Metabox' ) ) {
    class _Metabox{

        private $postList;
        private $prefix;
        private $settings;
        private $build;

        function __construct($postlist=[], $prefix, $settings, $build){
            
            $this->setPostList($postlist);
            $this->setPrefix($prefix);
            $this->setSettings($settings);
            $this->setBuild($build);

            $this->registerHandlers();
        }

        public function setPostList($postList){
            if(is_array($postList)){
                $this->postList=$postList;
            }
        }
        public function getPostList(){ return $this->postList;}

        public function setSettings($settings){
            if(is_array($settings)){
                $this->settings=$settings;
            }
        }
        public function getSettings(){ return $this->settings;}

        public function setPrefix($prefix){ $this->prefix=$prefix; }
        public function getPrefix(){ return $this->prefix;}

        public function setBuild($build){ $this->build=$build; }
        public function getBuild(){ return $this->build;}

        /*
        * Main Handler
        */
        public function registerHandlers(){
            add_action('add_meta_boxes', array($this,'metaRecoder'));
            add_action('save_post', array($this,'metaSave'));
        }

        public function metaRecoder(){

            foreach ($this->getPostList() as $type) {
                add_meta_box(
                    $this->getPrefix(),
                    $this->getSettings()['title'],
                    $this->metaBuild(),
                    $type
                );
            }
        }
        public function metaSave($id){

            if (array_key_exists($this->getPrefix(), $_REQUEST)) {
                update_post_meta(
                    $id,
                    $this->getPrefix(),
                    $_REQUEST[$this->getPrefix()]
                );
            }
        }

        public function getMetaval($id){
            return get_post_meta($id,$this->getPrefix(),true);
        }

        public function metaBuild(){
            switch ($this->getBuild()) {
                case 'editor':
                    return [$this,'buildEditor'];
                default:
                    return [$this,'buildText'];
            }
        }

        public function buildEditor($post){
        
            $meta_box_id = $this->getPrefix();
            $editor_id = $this->getPrefix();

            //Create The Editor
            wp_editor($this->getMetaval($post->ID), $editor_id,[
                'tinymce' => false,
                'quicktags' => true,
            ]);
        }
    }
}
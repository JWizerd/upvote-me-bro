<?php
/**
 * Installation Routine
 */

if( ! class_exists('UMB_Install') ) :

    class UMB_Install 
    {
        /**
         * on creation gather an list of ids for all post with the base post type
         * 
         */
        public function __construct() 
        {

        }



        /**
         * initialize the proper hook for functionality upon activation of the plugin
         * 
         * @since  1.0
         */
        public function run() 
        {
            register_activation_hook( __FILE__, [$this, 'install_upvote_metadata'] );
        } // end fn



        /**
         * install upvote on only the base post type 
         * if users want to add the system to a custom post type
         * they have to do that manually
         * 
         * @since 1.0
         */
        public function install_upvote_metadata()
        {
            try {
                (new UMB_Api)->init();
            } catch (\Exception $e) {
                (new UMB_Logger)->log($e->getMessage());
            }
            
        } // end fn

    } // end class

endif;
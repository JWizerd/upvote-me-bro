<?php
/**
 * Installation Routine
 */

if( ! class_exists('UMB_Install') ) :

    class UMB_Install 
    {
        /**
         * initialize the proper hook for functionality upon activation of the plugin
         * 
         * @since  1.0
         */
        public function run() 
        {
            $this->install_upvote_metadata();
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
                (new UMB_Logger)->report($e->getMessage());
            }
            
        } // end fn

    } // end class

endif;
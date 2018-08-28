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
        public function init() 
        {
            register_activation_hook( __FILE__, [$this, 'install_upvote_metadata']] );
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
            $metadata = new UMB_Upvote_Meta;

            try {
                $metadata->update();
            } catch (\Throwable $e) {

            } // end catch
        } // end fn

    } // end class

endif
<?php 
/**
 * Un-installation subroutine 
 *
 * @since  1.0
 * @author  Jeremiah Wodke
 */

if( ! class_exists('UMB_Uninstall') ) :

    class UMB_Uninstall
    {
        /**
         * install proper action for future deactivation
         * @since  1.0
         */
        public function init() 
        {
            add_action('deactivated_plugin', [$this, 'remove_records'], 10, 2);
        } // end fn



        private function remove_records() {
            $metadata = new UMB_Upvote_Meta;

            try {
                $metadata->remove_all();
            } catch (\Exception $e) {
                (new UMB_Logger)->report($e->getMessage());
            } // end catch
        } // end fn

    } // end class

endif;

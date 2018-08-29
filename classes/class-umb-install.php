<?php
/**
 * Installation Routine
 */

if( ! class_exists('UMB_Install') ) :

    class UMB_Install 
    {

        private $post_ids;

        /**
         * on creation gather an list of ids for all post with the base post type
         * 
         */
        public function __construct() 
        {
            $query = new WP_Query(
                [
                    'post_type' => 'post'
                    'per_page' => -1
                ]
            );


            $post_ids = array_map(function($post){
                return $post->ID;
            }, $query);

            $this->post_ids = $post_ids;
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
            $metadata = new UMB_Upvote_Meta;

            try {
                foreach ($this->post_ids as $post_id) {
                    $metadata->update($post_id);
                }
            } catch (\Throwable $e) {
                (new UMB_Logger)->report($e->getMessage());
            } // end catch
        } // end fn

    } // end class

endif;
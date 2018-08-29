<?php
/**
 * Wordpress Metdata API operations for the following scenarios:
 * -- installation @since 1.0
 * -- delegating to new custom post types @since 1.0
 * -- uninstallation @since 1.0
 */

if( ! class_exists('UMB_Upvote_Meta') ) :

    class UMB_Upvote_Meta 
    {

        const BASE_META_TYPE = 'post';
        const META_KEY = 'upvotes';
        private $post_types;
        


        /**
         * set post type property. primarily
         * used in update custom post type action
         *
         * @since  1.0
         * @param array of newly updated post types
         * probably generated using the wp fn get_post_types()
         */
        public function set_post_types(array $post_types) 
        {
            $this->post_types = $post_types;
        } // end fn



        /**
         * update the metadata for a post with the upvote property
         * 
         * Since the built in update_post_meta function 
         * has the update-or-create functionality built in 
         * there really isn't a need to use add_post_meta
         *
         * @since  1.0
         * @param  int post_id / object_id of the post type
         * @param  string custom post type name 
         */
        public function update($post_id, $custom_post_type_name = null) 
        {
            if (!empty($custom_post_type_name)) {
                $upvotes = (int) $this->get($custom_post_type_name);
                update_metadata( $custom_post_type_name, $object_id, $this::META_KEY, $upvotes++ );
            } else {
                update_post_meta( $this::BASE_META_TYPE, $object_id, $this::META_KEY, $upvotes++ );
            } // endif
        } // end fn



        /**
         * get the current metadata value for upvotes on the post type
         *
         * @since  1.0
         * @param  int post_id / object_id of the post type
         * @param  string custom post type name 
         * @return int metadata upvote value
         */
        protected function get($post_id, $custom_post_type_name = null) {
            if (!empty($custom_post_type_name)) {
                try {
                    $upvotes = get_metadata( $custom_post_type_name, $object_id, $this::META_KEY, $unique );
                    return !empty($upvotes) ? $upvotes : 0;
                } catch (\Throwable $e) {
                    (new UMB_Logger)->report($e->getMessage());
                }
            } else {
                try {
                    $upvotes = get_post_meta( $this::META_TYPE, $object_id, $this::META_KEY);
                    return !empty($upvotes) ? $upvotes : 0;
                } catch(\Throwable $e) {
                    (new UMB_Logger)->report($e->getMessage());   
                }
            } // endif
        } // end fn



        /**
         * remove the upvotes meta data from a post type. 
         * The last param of delete_metadata when set to true
         * will remove the meta key from all objects associated 
         * with a post type.
         *
         * @since  1.0
         * @param  int post_id / object_id of the post type
         * @param  string the post type
         */
        protected function remove($post_id, $post_type) 
        {
            if (!empty($custom_post_type_name)) {
                try {
                    delete_metadata ( $this::META_TYPE, $object_id, $this::META_KEY, null, true);
                } catch (\Throwable $e) {
                    (new UMB_Logger)->report($e->getMessage());
                }
            }
        } // end fn



        /**
         * remove upvote system from all post types
         * @since  1.0
         */
        protected function remove_all() 
        {
            try {
                foreach ($this->post_types as $post_type) {
                    $this->remove($post_id, $post_type);
                }
            } catch(\Throwable $e) {
                (new UMB_Logger)->report($e->getMessage());
            } // end catch
        } // end fn


    } // end class

endif;

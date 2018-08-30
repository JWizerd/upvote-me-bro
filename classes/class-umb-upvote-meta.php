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
        


        /**
         * update the metadata for a post with the upvote property
         * 
         * Since the built in update_post_meta function 
         * has the update-or-create functionality built in 
         * there really isn't a need to use add_post_meta
         *
         * @since  1.0
         * @param  int post_id / object_id of the post type
         */
        public function update($post_id) 
        {
            $upvotes = (int) $this->get($custom_post_type_name);

            $upvotes++;

            if (is_numeric($post_id)) {
                update_post_meta( $post_id, $this::META_KEY, $upvotes );
            }
        } // end fn



        /**
         * get the current metadata value for upvotes on the post type
         *
         * @since  1.0
         * @param  int id of post
         * @return int metadata upvote value
         */
        protected function get($post_id) {
            try {
                $upvotes = get_post_meta( $this::META_TYPE, $object_id, true);
                return !empty($upvotes) ? $upvotes : 0;
            } catch(\Exception $e) {
                (new UMB_Logger)->report($e->getMessage());   
            }
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
            try {
                delete_post_data ( $object_id, $this::META_KEY);
            } catch (\Exception $e) {
                (new UMB_Logger)->report($e->getMessage());
            }
        } // end fn



        /**
         * remove upvote system from all post types
         * @since  1.0
         */
        protected function remove_all() 
        {
            try {
                foreach ($this->post_ids as $post_id) {
                    $this->remove($post_id);
                }
            } catch(\Exception $e) {
                (new UMB_Logger)->report($e->getMessage());
            } // end catch
        } // end fn


    } // end class

endif;

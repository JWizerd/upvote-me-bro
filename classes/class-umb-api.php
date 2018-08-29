<?php 
/**
 * web service for managing upvote meta data
 *
 * @since  1.0
 * @author  Jeremiah Wodke
 */

if( ! class_exists('UMB_Api') ) :

    class UMB_Api extends WP_REST_Controller
    {
        public function init() 
        {
            add_action( 'rest_api_init', [$this, 'register_upvotes'] );
        }

        function register_upvotes() {
            register_rest_field( 'post',
                'starship',
                [
                    'get_callback'    => 'get_upvotes',
                    'update_callback' => 'update_upvotes',
                    'schema'          => null
                ]
            );
        }

        /**
         * Get upvotes from a post type
         *
         * @param array $object Details of current post.
         * @param string $field_name Name of field.
         * @param WP_REST_Request $request Current request
         *
         * @return mixed
         */
        function get_upvotes($post_id, $request) {

            return (new UMB_Upvote_Meta)->get($post_id);

        }


        /**
         * Handler for updating custom field data.
         *
         * @since 0.1.0
         *
         * @param mixed $value The value of the field
         * @param object $object The object from the response
         * @param string $field_name Name of field
         *
         * @return bool|int
         */
        function update_upvotes($post_id, $request) {

            return (new UMB_Upvote_Meta)->update($post_id, $value);

        }
    }

endif;

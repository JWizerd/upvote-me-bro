<?php 
/**
 * web service for managing upvote meta data
 *
 * @since  1.0
 * @author  Jeremiah Wodke
 * @link( http://v2.wp-api.org/extending/modifying/#what-register_rest_field-does, register_rest_field )
 */

if( ! class_exists('UMB_Api') ) :

    require_once('class-logger.php');

    class UMB_Api
    {
        /**
         * install the custom endpoints into the post rest api endpoint
         *
         * @since  1.0
         * 
         */
        public function init() 
        {
            add_action( 'rest_api_init', [$this, 'register_upvotes'] );

            // Compatibility with the REST API v2 beta 9+
            if ( function_exists( 'register_rest_field' ) ) {
                register_rest_field( 'post',
                    'upvotes',
                    [
                        'get_callback' => [$this, 'get_upvotes'],
                        'schema'       => null,
                    ]
                );
            } elseif ( function_exists( 'register_api_field' ) ) {
                register_api_field( 'post',
                    'upvotes',
                    [
                        'get_callback' => [$this, 'update_upvotes'],
                        'schema'       => null,
                    ]
                );
            }
            // try {
            //     add_action( 'rest_api_init', [$this, 'register_upvotes'] );
            // } catch (\Exception $e) {
            //     (new UMB_Logger)->report($e->getMessage());
            // }
        }

        /**
         * register the upvotes operations to the post endpoint
         *
         * @since  1.0
         *
         */
        public function register_upvotes() {

            register_rest_field( 
                'post',
                'upvotes',
                [
                    'get_callback'    => [$this, 'get_upvotes'],
                    'update_callback' => [$this, 'update_upvotes'],
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
         * @return int upvotes post meta
         */
        public function get_upvotes($post_id) {

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
        public function update_upvotes($post_id) {

            return (new UMB_Upvote_Meta)->update($post_id, $value);

        }
    }

endif;

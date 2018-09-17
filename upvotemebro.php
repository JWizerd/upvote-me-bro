<?php
/*
Plugin Name: Upvote Me Bro
Description: A simple upvoting system for all of your post types bro.
Version: 1.0.0
Author: Jeremiah Wodke
Author URI: http://jeremiahwodke.com
Copyright: Jeremiah Wodke
Text Domain: upvote-me-bro
Domain Path: /lang
*/

/**
 * @todo  install autoloader for this plugin directory
 * @todo  build post meta class, 
 *        extend functions into api class, 
 *        and create db operations for custom post type table generation
 * @todo  build install class
 * @todo  build uninstall class
 * @todo  build helper functions (if necessary)
 * @todo  create admin gui for adding or removing classes
 */

require_once(__DIR__ . '/classes/class-umb-uninstall.php');
require_once(__DIR__ . '/classes/class-logger.php');
require_once(__DIR__ . '/classes/class-umb-api.php');
require_once(__DIR__ . '/classes/class-umb-upvote-meta.php');

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Init_UMB') ) : 

    class Init_UMB
    {
        /**
         * install upvote on only the base post type 
         * if users want to add the system to a custom post type
         * they have to do that manually
         * 
         * @since 1.0
         */
        public function init()
        {   
            try {
                (new UMB_Api)->init();
            } catch (\Exception $e) {
                (new UMB_Logger)->report($e->getMessage());
            }
            
        } // end fn

    } // end class

    add_action( 'plugins_loaded', ['Init_UMB', 'init']);

endif;

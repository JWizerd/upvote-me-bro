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
         * run the installation process for the plugin
         */
        public function initialize() 
        {
            try {
                register_activation_hook( __FILE__, [$this, 'install_upvote_metadata'] );
            } catch (\Exception $e) {
                (new UMB_Logger)->report($e->getMessage());
            } // end catch

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

    //when you're ready to test the plugin
    $start = new Init_UMB;
    $start->initialize();

endif;

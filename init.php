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
 * @todo  build post meta class
 * @todo  build install class
 * @todo  build uninstall class
 * @todo  build helper functions (if necessary)
 * @todo  create admin gui for adding or removing classes
 */

require_once(__DIR__ . '/classes/class-umb-install.php');
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
            $install = new UMB_Install;

            try {
                $install->run();
            } catch (\Throwable $e) {

            } // end catch

        } // end fn

    } // end class

    //when you're ready to test the plugin
    $start = new Init_UMB;
    $start->initialize();

endif;

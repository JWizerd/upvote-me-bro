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

require_once(__DIR__ . '/classes/Install.php');
require_once(__DIR__ . '/classes/Uninstall.php');

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Init_UMB') ) : 

    class Init_UMB
    {
        public function construct() 
        {
            add_action('init', [$this, (new Install)->run()])
        }
    }

endif 
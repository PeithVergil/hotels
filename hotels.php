<?php

/*
 * Plugin Name: Hotels Utility Belt
 *
 * Description: Provide custom functionalities for the Hotels site.
 *
 * Version: 0.1
 *
 * Author: Peith Vergil
 * Author URI: http://www.facebook.com/peith.vergil
 */

if ( !defined('HOTELS_DIR') )
    define('HOTELS_DIR', plugin_dir_path(__FILE__));

if ( !defined('HOTELS_URL') )
    define('HOTELS_URL', plugin_dir_url(__FILE__));


require_once( HOTELS_DIR . '/lib/posttypes.php' );
require_once( HOTELS_DIR . '/lib/fields.php' );
require_once( HOTELS_DIR . '/lib/revisions.php' );
require_once( HOTELS_DIR . '/lib/scripts.php' );
require_once( HOTELS_DIR . '/lib/shortcodes.php' );

require_once( HOTELS_DIR . '/lib/forms/hotel-edit.php' );
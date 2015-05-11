<?php
/*
 * Plugin Name: bbPress Advanced Statistics
 * Version: 1.0.1
 * Plugin URI: http://www.thegeek.info
 * Description: Advanced Statistics Available for bbPress users, introducing a familiar looking online and statistics section
 * Author: Jake Hall
 * Author URI: http://www.thegeek.info
 * Requires at least: 3.9
 * Tested up to: 4.2.1
 *
 * @package WordPress
 * @author Jake Hall
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-bbpress-advanced-statistics.php' );
require_once( 'includes/class-bbpress-advanced-statistics-settings.php' );
require_once( 'includes/class-bbpress-advanced-statistics-online.php' );

// Load plugin libraries
require_once( 'includes/lib/class-bbpress-advanced-statistics-admin-api.php' );

/**
 * Returns the main instance of bbPress_Advanced_Statistics to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object bbPress_Advanced_Statistics
 */
function bbPress_Advanced_Statistics () {
    $instance = bbPress_Advanced_Statistics::instance( __FILE__, '1.0.1' );

    if ( is_null( $instance->settings ) ) {
        $instance->settings = bbPress_Advanced_Statistics_Settings::instance( $instance );
    }
    
    if ( is_null( $instance->online ) ) {
        $instance->online = bbPress_Advanced_Statistics_Online::instance( $instance );
    }

    return $instance;
}

bbPress_Advanced_Statistics();
<?php 
/**
 * @package RobotiqueConcept
 */

/*
Plugin Name: Robotique Concept
Plugin URI: http://www.robotiqueconcept.fr
Description: Robotique Concept custom plugin
Version: 1.0.0
Author: Robotique Concept
Author URI: http://www.robotiqueconcept.fr
Licence: GPLv2 or later
Text Domain: robotique-concept
*/

// If this file is called directly, abort.
defined( 'ABSPATH' ) || die();

// Require the composer psr4 autoloader.
if ( file_exists( dirname( __FILE__) . './vendor/autoload.php' ) ) {
    require_once dirname( __FILE__) . './vendor/autoload.php';
}

/**
 * The code that runs on activation
 */
function activate_robotique_concept_plugin() {
    Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_robotique_concept_plugin');

/**
 * The code that runs on deactivation
 */
function deactivate_robotique_concept_plugin() {
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_robotique_concept_plugin');


/**
 * Returns the result of the get_max global function
 */
function _nf( $number, $digits = 2 ) {

	return number_format( $number, $digits, '.', ' ' );

}

function _ha( $price ) {
	return ceil( ( ( $price ) * 1.01 ) / 10 ) * 10;
}


/**
 * Run the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services();
}
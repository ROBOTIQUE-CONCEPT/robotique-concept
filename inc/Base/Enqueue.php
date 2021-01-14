<?php 
/**
 * @package RobotiqueConcept
 */
namespace Inc\Base;

class Enqueue extends \Inc\Base\BaseController {

    public function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    function enqueue( ) {
        // enqueue all aour scripts
        wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/mystyle.css' );
        wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'assets/myscript.js' );
    }
}
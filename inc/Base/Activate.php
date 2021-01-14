<?php 
/**
 * @package RobotiqueConcept
 */
namespace Inc\Base;

use Inc\Base\AdvertsCPTController;

class Activate {

    public static function activate() {

        // $adverts_ctrl = new AdvertsCPTController();
        // $adverts_ctrl->activate();

        flush_rewrite_rules();

        if ( get_option( 'robotique_concept_plugin') ) {
            return;
        }

        $default = array();
        update_option( 'robotique_concept_plugin', $default );
    }
}
<?php 
/**
 * @package RobotiqueConcept
 */
namespace Inc\Base;

class SettingsLinks extends \Inc\Base\BaseController {

    public function register() {
        add_filter( "plugin_action_links_$this->plugin_name", array( $this, 'settings_link' ) );
    }

    public function settings_link( $links ) {
        $settings_link = '<a href="admin.php?page=robotique-concept-plugin">' . __( "Réglages", 'txt' ) . '</a>';
        array_push( $links, $settings_link );
        return $links;
    }
}
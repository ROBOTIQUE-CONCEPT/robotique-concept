<?php 
/**
 * @package RobotiqueConcept
 */
namespace Inc\Base;

class BaseController {

    public $plugin_path ;

    public $plugin_url;

    public $plugin_name;

    public $managers = array();
    
    public function __construct() {
        $this->plugin_path = plugin_dir_path( dirname( __FILE__ , 2 ) );
        $this->plugin_url = plugin_dir_url( dirname( __FILE__ , 2 ) );
        $this->plugin_name = plugin_basename( dirname( __FILE__ , 3 ) . '/robotique-concept.php' );

        $this->managers = array(
            'rc_adverts_manager' => 'Activer les annonces de robots',
            'rc_spares_manager' => 'Activer les pièces détachées',
            'rc_pendants_manager' => 'Activer les pupitres de programmation',
            'rc_robots_manager' => 'Activer la base de données de robots industriels',
        );
    }
}
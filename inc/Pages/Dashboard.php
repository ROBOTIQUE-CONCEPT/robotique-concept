<?php 
/**
 * @package RobotiqueConcept
 */
namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController {

    public $settings;
    public $sections;
    public $fields;

    public $callbacks;
    public $callbacks_mngr;

    public $pages = array();

    // public $subpages = array();

    // public function __construct() {

    // }

    public function register() 
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();

        $this->setPages();

        // $this->setSubPages();

        $this->setSettings();

        $this->setSections();

        $this->setFields();

        $this->settings->addPages( $this->pages )->withSubPage( 'Accueil' )->register();

    }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title'    => 'Robotique Concept',
                'menu_title'    => 'ROBCONCEPT', 
                'capability'    => 'read',
                'menu_slug'     => 'robotique_concept_plugin', 
                'callback'      =>  array( $this->callbacks, 'adminDashboard' ), 
                'icon_url'      =>  'dashicons-store', 
                'position'      =>  2,
            ]
        ];
    }

    public function setSettings()
    {

        $args = array();

        $args[] = [
            'option_group'  =>  'robotique_concept_plugin_settings',
            'option_name'   =>  'robotique_concept_plugin',
            'callback'      =>  array( $this->callbacks_mngr, 'checkboxSanitize' ),
        ];
        
        $this->settings->setSettings( $args );
    }

    public function setSections()
    {
        $args = [
            [
                'id'        =>  'robotique_concept_admin_index',
                'title'     =>  'Settings Manager',
                'callback'  =>  array( $this->callbacks_mngr, 'adminSectionManager' ),
                'page'      =>  'robotique_concept_plugin',
            ]
        ];
        
        $this->settings->setSections( $args );
    }

    public function setFields()
    {

        $args = array();

        foreach ( $this->managers as $key => $value ) {
            $args[] = [
                'id'        =>  $key,
                'title'     =>  $value,
                'callback'  =>  array( $this->callbacks_mngr, 'checkboxField' ),
                'page'      =>  'robotique_concept_plugin',
                'section'  =>  'robotique_concept_admin_index',
                'args'      =>  [
                    'option_name' => 'robotique_concept_plugin',
                    'label_for' => $key,
                    'class'     => 'ui-toggle', 
                ],
            ];
        }

        $this->settings->setFields( $args );
    }
    
}
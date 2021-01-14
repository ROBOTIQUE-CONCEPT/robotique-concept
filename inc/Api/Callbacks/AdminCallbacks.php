<?php 
/**
 * @package RobotiqueConcept
 */
namespace Inc\Api\Callbacks;

class AdminCallbacks extends \Inc\Base\BaseController  {

    public function adminDashboard() 
    {
        return require_once "$this->plugin_path/templates/admin.php"; 
    }

    public function cptAdminPage() 
    {
        return require_once "$this->plugin_path/templates/cpt.php"; 
    }

    public function taxAdminpage() 
    {
        return require_once "$this->plugin_path/templates/taxonomy.php"; 
    }

    public function widgetsAdminPage() 
    {
        return require_once "$this->plugin_path/templates/widget.php"; 
    }

    public function robotiqueConceptOptionsGroup( $input )
    {
        return $input;
    }

    public function robotiqueConceptAdminSection() 
    {
        echo 'check this beautiful section';
    }

}
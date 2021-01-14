<?php 
/**
 * @package RobotiqueConcept
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

use Inc\api\Widgets\FilterWidget;
use Inc\Api\Widgets\SearchWidget;

class WidgetsController extends BaseController 
{
    public function register()
    {

        $filter_widget = new FilterWidget();
        $filter_widget->register();

        $search_widget = new SearchWidget();
        $search_widget->register();

    }
}
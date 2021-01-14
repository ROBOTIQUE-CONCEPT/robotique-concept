<?php
/**
 * @package RobotiqueConcept
 */
namespace Inc;

final class Init {

    /**
     * Store all the classes inside an array
     * @return array full list of classes
     */
    public static function get_services() {
        return [
            Pages\Dashboard::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Base\AdvertsCPTController::class,
            Base\RobotsCPTController::class,
            Base\WidgetsController::class,
        ];
    }

    /**
     * Loop through the classes, initialize them
     * and call the register() method if exists
     * @return void
     */
    public static function register_services() {
        foreach ( self::get_services() as $class ) {
            $service = self::instanciate( $class );
            if ( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     * @param class $class class form services array
     * @return class instance new instance of the class
     */
    private static function instanciate( $class ) {
        $service = new $class();
        return $service;
    }
}
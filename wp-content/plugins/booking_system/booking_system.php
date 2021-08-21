<?php
/*
Plugin Name: Booking System
Description: Booking System for restaurant theme
Version: 1.0.0
Author: Sean Smith
*/

use Inc\Base\Activate;
use Inc\Base\Deactivate;

?>
<?php
defined('ABSPATH') or die('wowwwwww!!!');

//Composer Autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

function activate_booking_system_plugin()
{
    Activate::activate();
}

function deactivate_booking_system_plugin()
{
    Deactivate::deactivate();
}

//register activation and deactivation hooks
register_activation_hook(__FILE__, 'activate_booking_system_plugin');
register_deactivation_hook(__FILE__, 'deactivate_booking_system_plugin');

//Initialize all core classes
if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}

<?php

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController

{

    public $settings;

    public $pages = array();
    public $subpages = array();

    public function __construct()
    {
        $this->settings = new SettingsApi();
    }
    public function register()
    {
        // add_action('admin_menu', array($this, 'add_admin_pages'));

        $pages = [
            [
                'page_title' => 'Booking System',
                'menu_title' => 'Booking System',
                'capibility' => 'manage_options',
                'menu_slug' => 'booking_system_plugin',
                'callback' => function () {
                    echo "<h1>PLUGIN</h1>";
                },
                'icon_url' => 'dashicons-store',
                'position' => '110'
            ],

            [
                'page_title' => 'Test Plugin',
                'menu_title' => 'Test',
                'capibility' => 'manage_options',
                'menu_slug' => 'test_system_plugin',
                'callback' => function () {
                    echo "<h1>EXTernal</h1>";
                },
                'icon_url' =>
                'dashicons-external',
                'position' => '9'
            ]
        ];

        $this->subpages = [

            [
                'parent_slug' => 'booking_system_plugin',
                'page_title' => 'New Booking',
                'menu_title' => 'New Booking',
                'capibility' => 'manage_options',
                'menu_slug' => 'booking_new',
                'callback' => function () {
                    echo "<h1>New Booking</h1>";
                }
            ],

            [
                'parent_slug' => 'booking_system_plugin',
                'page_title' => 'View Bookings',
                'menu_title' => 'View Bookings',
                'capibility' => 'manage_options',
                'menu_slug' => 'view-bookings',
                'callback' => function () {
                    echo "<h1>View Booking</h1>";
                }
            ],
        ];

        $this->settings->addPages($pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }

    // public function add_admin_pages()
    // {
    //     add_menu_page('Booking System', 'Booking System', 'manage_options', 'booking_system_plugin', array($this, 'admin_index'), 'dashicons-store', '110');
    // }
    // public function admin_index()
    // {
    //     // require template
    //     require_once $this->plugin_path . 'templates/admin.php';
    // }
}

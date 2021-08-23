<?php

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController

{

    public $settings;

    public $pages = array();
    public $subpages = array();
    public $callbacks;

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        // add_action('admin_menu', array($this, 'add_admin_pages'));

        $pages = [
            [
                'page_title' => 'Booking System',
                'menu_title' => 'Booking System',
                'capibility' => 'manage_options',
                'menu_slug' => 'booking_system_plugin',
                'callback' => array($this->callbacks, 'adminDashboard'),
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
                'callback' => array($this->callbacks, 'newBookingScreen')
            ],

            [
                'parent_slug' => 'booking_system_plugin',
                'page_title' => 'View Bookings',
                'menu_title' => 'View Bookings',
                'capibility' => 'manage_options',
                'menu_slug' => 'view-bookings',
                'callback' => array($this->callbacks, 'viewBookingScreen')
            ],
        ];

        $this->settings->addPages($pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }

    public function setSettings()
    {
        $args = array(
            array(
                "option_group" => "booking_system_options_group",
                "option_name" => "text_example",
                "callback" => array($this->callbacks, 'bookingSystemGroup')
            )
        );
        $this->settings->setSettings($args);
    }

    public function setSections()
    {
        $args = array(
            array(
                "id" => "admin_index",
                "title" => "Settings",
                "callback" => array($this->callbacks, 'bookingSystemSection'),
                "page" => "booking_system_plugin"
            )
        );
        $this->settings->setSections($args);
    }

    public function setFields()
    {
        $args = array(
            array(
                "id" => "text_example",
                "title" => "Text Example",
                "callback" => array($this->callbacks, 'bookingSystemTextExample'),
                "page" => "booking_system_plugin",
                "section" => "admin_index",
                "args" => array(
                    'label_for' => 'text example',
                    'classes' => 'form-control'
                )
            )
        );
        $this->settings->setFields($args);
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

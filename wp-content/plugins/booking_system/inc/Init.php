<?php


namespace Inc;

final class Init

{
    public static function get_services()
    {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
        ];
    }
    public static function  register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    private static function instantiate($class)
    {
        $service = new $class();

        return $service;
    }

    // use Inc\Activate;
    // use Inc\Deactivate;
    // use Inc\Admin\AdminPages;

    // class bookingSystemSS
    // {
    //     public $plugin;

    //     public function __construct()
    //     {
    //         add_action('init', array($this, 'custom_post_type'));

    //         $this->plugin = plugin_basename(__FILE__);
    //     }

    //     function register()
    //     {
    //         add_action('admin_enqueue_scripts', array($this, 'enqueue'));

    //         add_action('admin_menu', array($this, 'add_admin_pages'));

    //         add_filter('plugin_action_links_' . $this->plugin . '', array($this, 'settings_link'));
    //     }

    //     public function settings_link($links)
    //     {
    //         // add custom settings link
    //         $settings_link = '<a href="admin.php?page=booking_system_plugin">Settings</a>';
    //         array_push($links, $settings_link);

    //         return $links;
    //     }

    //     public function add_admin_pages()
    //     {
    //         add_menu_page('Booking System', 'Booking System', 'manage_options', 'booking_system_plugin', array($this, 'admin_index'), 'dashicons-store', '110');
    //     }

    //     public function admin_index()
    //     {
    //         // require template
    //         require_once plugin_dir_path(__FILE__) . '/templates/admin.php';
    //     }


    //     function uninstall()
    //     {
    //     }

    //     function custom_post_type()
    //     {
    //         register_post_type('order', ['public' => true, 'label' => 'Orders']);
    //     }

    //     function enqueue()
    //     {
    //         // enque style
    //         wp_enqueue_style('bookingsystemstyle', plugins_url('/assets/main.css', __FILE__));
    //         wp_enqueue_script('bookingsystemscript', plugins_url('/assets/main.js', __FILE__));
    //     }

    //     public function activate()
    //     {
    //         Activate::activate();
    //     }

    //     public function deactivate()
    //     {
    //         Deactivate::deactivate();
    //     }
    // }

    // if (class_exists('bookingSystemSS')) {
    //     $bookingSystemSS = new bookingSystemSS();
    //     $bookingSystemSS->register();
    // }

    // register_activation_hook(plugin_dir_path(__FILE__), array($bookingSystemSS, 'activate'));

    // register_deactivation_hook(plugin_dir_path(__FILE__), array('Deactivate', 'deactivate'));
}

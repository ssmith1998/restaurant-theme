<?php

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController

{
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function enqueue()
    {
        // enque style
        wp_enqueue_style('bookingsystemstyle',  $this->plugin_url . '/assets/main.css');
        wp_enqueue_script('bookingsystemscript', $this->plugin_url  . '/assets/main.js');
    }
}

<?php

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function adminDashboard()
    {
        return require_once("$this->plugin_path/templates/admin.php");
    }

    public function newBookingScreen()
    {
        return require_once("$this->plugin_path/templates/SubPages/newBooking.php");
    }
    public function viewBookingScreen()
    {
        return require_once("$this->plugin_path/templates/SubPages/viewBookings.php");
    }


    public function bookingSystemGroup($input)
    {
        return $input;
    }

    public function bookingSystemSection()
    {
        echo 'check this section';
    }

    public function bookingSystemTextExample()
    {

        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" name="text_example" value="' . $value . '" placeholder="text Example"/>';
    }
}

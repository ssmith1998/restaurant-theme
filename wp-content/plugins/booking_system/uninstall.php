<?php

/**
 * trigger this file on uninstall
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die();
}

//clear database stored data
$orders = get_posts(array('post_type' => 'order', 'numberposts' => -1));

foreach ($orders as $order) {
    wp_delete_post($order->ID, true);
}

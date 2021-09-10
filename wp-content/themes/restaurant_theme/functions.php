<?php

function add_theme_scripts()
{



    wp_enqueue_style('BSCSS', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '1.1', 'all');
    wp_enqueue_style('AOSCSS', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), '1.1', 'all');
    wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css', '1.1', 'all');
    wp_enqueue_style('font-mont', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap', array(), '1.1', 'all');
    wp_enqueue_script('BSJS', "https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js", array('jquery'), 1.1);
    wp_enqueue_script('FONTAWESOME', "https://kit.fontawesome.com/f2e27c939b.js", array('jquery'), 1.1);
    wp_enqueue_script('AOSJS', "https://unpkg.com/aos@2.3.1/dist/aos.js", array(), 1.1, true);
    wp_enqueue_script('AXIOS', "https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js", array(), 1.1, true);
    wp_enqueue_script('MAINJS', get_template_directory_uri() . '/js/main.js', array(), 1.1, true);
    wp_enqueue_script('VUEJS', 'https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js', array(), 1.1, true);
    wp_enqueue_script('VUEMAIN', get_template_directory_uri() . '/js/vue.js', array('VUEJS'), 1.1, true);
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

function addAdminScripts()
{
    global $post;

    $post_type = get_post_type($post->ID);

    if ($post_type === 'bookings') {
        wp_enqueue_style('adminCSS', get_template_directory_uri() . '/css/admin.css', '1.1', 'all');
    }
}

add_action('admin_enqueue_scripts', 'addAdminScripts');


function custom_theme_setup()
{
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'nepalbuzz'),
        'footer'  => esc_html__('Footer Menu', 'nepalbuzz'),
    ));
}
add_action('after_setup_theme', 'custom_theme_setup');

function create_posttype()
{
    register_post_type(
        'Reviews',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Review'),
                'singular_name' => __('Review')
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'reviews'),
        )
    );

    register_post_type(
        'Menu',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Menu'),
                'singular_name' => __('Menu')
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'menu'),

        )

    );

    // Our custom post type function
    register_post_type(
        'Bookings',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Bookings'),
                'singular_name' => __('Booking')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'bookings'),
            'show_in_rest' => true,
            'supports' => array('title')


        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype');

function tn_disable_visual_editor($can)
{
    global $post;

    $post_type = get_post_type($post->ID);

    if ($post_type === 'bookings') {
        return false;
        return $can;
    }
}
add_filter('user_can_richedit', 'tn_disable_visual_editor');



//adding table headers to bookings table
add_filter('manage_bookings_posts_columns', 'bs_bookings_table_head');
function bs_bookings_table_head($defaults)
{
    $defaults['booking_date']  = 'Booking Date';
    $defaults['booking_time']    = 'Booking Time';
    $defaults['party_number']   = 'Party Size';
    $defaults['booking_name'] = 'Booking Name';
    $defaults['contact_number'] = 'Contact Number';
    $defaults['contact_email'] = 'Contact Email';
    return $defaults;
}
//add sortable booking columns
add_filter('manage_edit-bookings_sortable_columns', 'sortableBookingColumns');
function sortableBookingColumns($columns)
{
    $columns['booking_date'] = 'Booking Date';

    return $columns;
}
//customising content for each custom column in bookings table
add_action('manage_bookings_posts_custom_column', function ($column_key, $post_id) {
    $booking = get_post_meta($post_id);

    // var_dump($booking);
    // die();
    if ($column_key == 'booking_date') {
        echo date('d M Y', strtotime($booking['booking_date'][0]));
    } else if ($column_key == 'booking_time') {
        echo $booking['booking_time'][0];
    } else if ($column_key == 'party_number') {
        echo $booking['party'][0];
    } else if ($column_key == 'booking_name') {
        echo $booking['first_name'][0] . ' ' . $booking['surname'][0];
    } else if ($column_key == 'contact_number') {
        echo $booking['phone'][0];
    } else if ($column_key == 'contact_email') {
        echo "<a href='mailto: " . $booking['email'][0] . "'>
            " . $booking['email'][0] . "
        </a>";
    }
}, 10, 2);

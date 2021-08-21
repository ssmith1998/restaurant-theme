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
    wp_enqueue_script('MAINJS', get_template_directory_uri() . '/js/main.js', array(), 1.1, true);
    wp_enqueue_script('VUEJS', 'https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js', array(), 1.1, true);
    wp_enqueue_script('VUEMAIN', get_template_directory_uri() . '/js/vue.js', array('VUEJS'), 1.1, true);
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

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
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype');

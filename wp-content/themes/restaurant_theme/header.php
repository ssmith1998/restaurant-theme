<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo is_front_page() ? 'Home' : wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>

<body style="<?php if (is_page(13)) : ?>background-image:url('<?php echo get_template_directory_uri() . '/assets/images/booking-background.png' ?>')<?php endif; ?>">

    <?php
    if (is_front_page()) :
    ?>
        <nav class="navbar" id="mainNav">
            <a id="logo-main" class="navbar-brand" href="#">godere</a>
            <i id="mobileMenuIcon" class="fas fa-bars" style="font-size: 25px; color:white;"></i>
            <?php
            if (has_nav_menu('primary')) {
                $args = array(
                    'theme_location'    => 'primary',
                    'menu_class'        => 'main-nav',
                    'container'         => false
                );
                wp_nav_menu($args);
            }
            ?>

        </nav>
    <?php else : ?>
        <nav class="navbar pl-5 pt-5">
            <a style=" <?php if (is_page(13)) : ?> color: #ffffff;> <?php else : ?> color: black;  <?php endif; ?>" href="<?php echo home_url(); ?>"><i class="fas fa-chevron-circle-left" style="font-size: 45px;"></i></a>
        </nav>
    <?php endif; ?>

    <div class="main_content_wrapper">
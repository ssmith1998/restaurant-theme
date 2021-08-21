<?php /* Template Name: Menu */
get_header();
?>
<div class="container pt-5">
    <h1 class="text-center mb-5 menuTitle">Menu</h1>
    <?php
    $args = [
        'post_type' => 'menu',
    ];
    // The Query
    $the_query = new WP_Query($args);

    // The Loop
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();

    ?>
            <div class="category mb-4">
                <h2 class="mb-4"><?php echo the_title(); ?></h2>
                <div class="row">
                    <?php
                    $items = get_field('post');

                    if (COUNT($items) > 0) {
                        foreach ($items as $item) {
                            // var_dump($item);
                    ?>
                            <div class="col-xs-12 col-sm-4 p-3">
                                <h4><?php echo $item->post_title; ?></h4>
                                <p><?php echo $item->post_content; ?></p>
                            </div>

                    <?php
                        }
                    }
                    ?>
                </div>

            </div>
        <?php
        }
        ?>
</div>
<?php
    } else {
        echo 'There is no Menu to display';
    }
    /* Restore original Post Data */
    wp_reset_postdata();



    get_footer()
?>
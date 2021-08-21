<?php /* Template Name: Our Story */
get_header();
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <h1 class="mb-5 mt-5" style="font-size:48px;">Our Story</h1>
            <p style="line-height:48px;">Godere in italian means “to enjoy”. We want you to enjoy your meal and stay at Godere. As a family we has built our reputation for quality through offering a wide variety of dishes using the highest standard of ingredients in a relaxing and friendly environment. As you would expect from a family-run restaurant, the menu offers traditional recipes, including Italian dishes which have been handed down through the generations.
            <p style="line-height:48px;">All dishes contain the freshest of ingredients, which are specially sourced and prepared with great care by the team of chefs at Godere.</p>
            </p>
        </div>
        <div class="col-xs-12 col-sm-4 d-flex flex-column justify-content-around pt-5" style="padding-left: 83px;">
            <div class="phone" data-aos="fade-up" data-aos-delay="100" data-aos-duration="600">
                <h2>Phone</h2>
                <p class="mt-4">0113 000 111</p>
            </div>
            <div class="location" data-aos="fade-up" data-aos-delay="300" data-aos-duration="600">
                <h2>Location</h2>
                <p class="mt-4">123 Street Lane<br />
                    North Yorkshire <br />
                    LS00 BBB</p>
            </div>
            <div class="hours" data-aos="fade-up" data-aos-delay="400" data-aos-duration="600">
                <h2>Hours</h2>
                <p class="mt-4">Mon - Fri- 9am - 11pm</p>
                <p>Sat-Sun - 12pm - 11pm</p>
            </div>
        </div>
    </div>
</div>
<section class="image-strip" style="background-image: url('<?php echo get_template_directory_uri() . '/assets/images/image-strip.png' ?>'); height:500px; background-repeat: no-repeat; background-size: cover; background-position:center; margin-top: 120px;">
</section>

<section class="reviews_section py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2 data-aos="fade-up" data-aos-anchor-placement="top-bottom" class="reviews_section__title">Trust the people..</h2>
            <div class="social d-flex">
                <i class="fab fa-twitter mr-3"></i>
                <i class="fab fa-instagram"></i>
            </div>

        </div>
        <div class="reviews pt-5">
            <div class="row">
                <?php
                $args =  [
                    'post_type' => 'reviews'
                ];
                // The Query
                $the_query = new WP_Query($args);

                // The Loop
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        global $post;
                        $starRating = get_field('rating', $post->ID);

                ?>

                        <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="600" class="col-sm-4">
                            <?php
                            for ($i = 0; $i < (int)$starRating; $i++) {
                            ?>
                                <i class="fas fa-star"></i>

                            <?php
                            }
                            ?>


                            <h1><?php echo get_the_title(); ?></h1>
                            <p><?php echo the_content(); ?></p>
                        </div>

                <?php
                    }
                } else {
                    // no posts found
                }
                /* Restore original Post Data */
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>

<?php

get_footer();

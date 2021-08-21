<?php
if (!is_front_page()) :
?>
    <footer>
        <div class="footer__content d-flex flex-column align-items-center justify-content-center py-5">
            <?php
            if (has_nav_menu('footer')) {
                $args = array(
                    'theme_location'    => 'footer',
                    'menu_class'        => 'footer-nav',
                    'container'         => false
                );
                wp_nav_menu($args);
            }
            ?>
            <div class="footer__contact">
                <p>0113 000 111</p>
            </div>
        </div>
        <?php wp_footer(); ?>
    </footer>
<?php
endif;
?>
</div>
</body>

</html>
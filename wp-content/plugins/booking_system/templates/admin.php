<div class="wrap">
    <h1>PLUGIN</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
        settings_fields('booking_system_options_group');
        do_settings_sections('booking_system_plugin');
        submit_button();
        ?>


    </form>
</div>
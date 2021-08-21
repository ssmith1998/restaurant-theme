<?php

namespace Inc\Base;

class Activate

{
    /**
     * activate
     *
     * @return void
     */
    public static function activate()
    {
        flush_rewrite_rules();
    }
}

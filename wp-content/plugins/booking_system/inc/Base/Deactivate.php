<?php

namespace Inc\Base;

class Deactivate

{
    /**
     * deactivate
     *
     * @return void
     */
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}

<?php

if (!function_exists('wrap_text')) {
    function wrap_text($text, $width = 25)
    {
        return implode("<br>", str_split($text, $width));
    }
}

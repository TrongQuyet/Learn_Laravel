<?php
if (!function_exists('get_guard')) {
    function get_guard($type = null)
    {
        return auth()->guard($type)->name;
    }
}

<?php

if (!function_exists('show_notification')) {
    function show_notification($type, $message)
    {
        session()->flash('notification', ['type' => $type, 'message' => $message]);
    }
}

<?php

use \App\Models\Contact as contact;
use \App\Models\Setting as setting;

// Settings
if (!function_exists('getSettings')) {
    function getSettings($name = 'site_title')
    {
        $setting = setting::where('name', $name)->first();
        return $setting == null ? $name : $setting->real_value;
    }
}

// Show Status
if (!function_exists('showStatus')) {
    function showStatus($val)
    {
        $text = $val ? trans('admin.active') : trans('admin.inactive');
        $class = $val ? 'success' : 'danger';
        return '<span class="chip chip-' . $class . '">' . $text . '</span>';
    }
}

// Contact Us
if (!function_exists('getContact')) {
    function getContact($type = 'data')
    {
        if ($type == 'data') {
            $contact = contact::where('readable', 0)->orderBy('created_at', 'desc')->get();
        } else {
            $contact = contact::where('readable', 0)->count();
        }
        return $contact;
    }
}

// Validate - image
if (!function_exists('v_image')) {
    function v_image($ext = null)
    {
        if ($ext === null) {
            return 'image|mimes:jpg,jpeg,png,gif,bmp';
        } else {
            return 'image|mimes:' . $ext;
        }
    }
}

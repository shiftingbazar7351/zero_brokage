<?php
 
 
 
 
 
if (!function_exists('generateSlug')) {
    function generateSlug($name)
    {
        $slug = str_replace(' ', '_', $name);
        $slug = strtolower($slug);
        return $slug;
    }
}
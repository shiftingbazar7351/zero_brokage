<?php
 
 
 
 
 
if (!function_exists('generateSlug')) {
    function generateSlug($name)
    {
        $slug = str_replace(' ', '_', $name);
        $slug = strtolower($slug);
        return $slug;
    }
}


if (!function_exists('truncateCharacters')) {
    function truncateCharacters($text, $limit = 500)
    {
        $text = strip_tags($text);
        if (strlen($text) <= $limit) {
            return $text;
        }
        $lines = str_split(substr($text, 0, $limit), 80);
        return implode('<br>', $lines) . '......';
    }
}

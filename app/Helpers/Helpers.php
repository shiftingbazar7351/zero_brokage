<?php

if (!function_exists('truncateCharacters')) {
    function truncateCharacters($text, $limit = 100)
    {
        // Remove HTML tags to ensure accurate character count
        $text = strip_tags($text);

        // Truncate text to the desired limit
        if (strlen($text) <= $limit) {
            return $text;
        }

        // Split text into an array of lines
        $lines = str_split(substr($text, 0, $limit), 50); // 50 characters per line

        return implode('<br>', $lines) . '...';
    }
}




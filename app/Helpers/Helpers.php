<?php


if (!function_exists('truncateWords')) {
    function truncateWords($text, $limit = 40)
    {
        $words = explode(' ', $text);
        if (count($words) <= $limit) {
            return $text;
        }

        return implode(' ', array_slice($words, 0, $limit)) . '...';
    }
}




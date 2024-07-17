<?php

namespace app;

class FAB_Helper
{
    public function custom_excerpt(string $content, int $length = 20): string
    {

        $excerpt = wp_strip_all_tags($content);
        $words = explode(' ', $excerpt, $length + 1);

        if (count($words) > $length) {
            array_pop($words);
            $excerpt = implode(' ', $words) . '...';
        }

        return $excerpt;

    }

    /**
     * @throws \JsonException
     */
    public function json_response($response): void
    {
        wp_die(json_encode($response, JSON_THROW_ON_ERROR));
    }
}
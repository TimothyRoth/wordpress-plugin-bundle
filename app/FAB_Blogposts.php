<?php

namespace app;

use WP_Query;

class FAB_Blogposts
{

    public function blogposts_index(array $args): array
    {
        $total_blogpost_args = [
            'post_type' => 'post',
            'posts_per_page' => -1
        ];

        if (!empty($args['posts_per_page'])) {
           $args['amount'] = $args['posts_per_page'];
        }

        $total_blogpost_query = new WP_Query($total_blogpost_args);
        $amount_of_total_blogposts = $total_blogpost_query->found_posts;

        $blogpost_args = [
            'post_type' => 'post',
            'posts_per_page' => $args['amount'],
            'order' => $args['order']
        ];

        if (!empty($args['post_ids'])) {
            $post_ids = explode(',', $args['post_ids']);
            $blogpost_args['post__in'] = $post_ids;
        }
        if (!empty($args['search_query'])) {
            $blogpost_args['s'] = $args['search_query'];
        }

        $blogposts = new WP_Query($blogpost_args);

        return [
            'amount_of_displayed_blogposts' => $args['amount'],
            'amount_of_total_blogposts' => $amount_of_total_blogposts,
            'posts' => $blogposts->posts,
        ];
    }

}
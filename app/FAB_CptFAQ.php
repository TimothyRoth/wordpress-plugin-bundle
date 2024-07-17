<?php

namespace app;

use Wp_Query;

class FAB_CptFAQ
{
    public string $Cpt_FAQ;

    public function __construct()
    {
        $this->Cpt_FAQ = 'cpt_faq';
    }

    public function init(): void
    {
        add_action('init', [$this, 'register_cpt_faq']);
    }

    public function register_cpt_faq(): void
    {

        $labels = [
            'name' => _x('FAQ', 'post type general name', 'collectors-hub'),
            'singular_name' => _x('FAQ', 'post type singular name', 'collectors-hub'),
            'add_new' => _x('Hinzufügen', 'FAQ hinzufügen', 'collectors-hub'),
            'add_new_item' => __('Neuen FAQ hinzufügen', 'collectors-hub'),
            'edit_item' => __('FAQ bearbeiten', 'collectors-hub'),
            'new_item' => __('Neue FAQ', 'collectors-hub'),
            'menu_name' => __('FAQ', 'collectors-hub'),
            'view_item' => __('FAQ anzeigen', 'collectors-hub'),
            'search_items' => __('Nach FAQs suchen', 'collectors-hub'),
            'not_found' => __('Keine FAQ gefunden', 'collectors-hub'),
            'not_found_in_trash' => __('Keine FAQ im Papierkorb', 'collectors-hub'),
            'parent_item_colon' => ''
        ];

        $args = [
            'label' => __('FAQ', 'collectors-hub'),
            'description' => __('Teile deine FAQ', 'collectors-hub'),
            'labels' => $labels,
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-list-view',
            'menu_FAQ' => 2,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'exclude_from_search' => true,
            'capability_type' => 'post',
            '_builtin' => false,
            'query_var' => true,
            'supports' => ['title', 'editor'],
            'show_in_rest' => true
        ];

        register_post_type($this->Cpt_FAQ, $args);

    }

    public function faq_index(array $args): array
    {

        $faq_args = [
            'post_type' => $this->Cpt_FAQ,
            'post_status' => 'publish',
            'posts_per_page' => $args['amount'],
            'orderby' => 'title',
            'order' => $args['order']
        ];

        if (!empty($args['post_ids'])) {
            $post_ids = explode(',', $args['post_ids']);
            $faq_args['post__in'] = $post_ids;
        }

        $faq = new Wp_Query($faq_args);
        return $faq->posts;
    }

}

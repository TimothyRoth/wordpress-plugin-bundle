<?php

namespace app;

use Wp_Query;

class FAB_CptTeam
{
    public string $Cpt_Team;

    public function __construct()
    {
        $this->Cpt_Team = 'cpt_team';
    }

    public function init(): void
    {
        add_action('init', [$this, 'register_cpt_team']);
    }

    public function register_cpt_team(): void
    {

        $labels = [
            'name' => _x('Teammitglieder', 'post type general name', 'collectors-hub'),
            'singular_name' => _x('Teammitglied', 'post type singular name', 'collectors-hub'),
            'add_new' => _x('Hinzufügen', 'Teammitglied hinzufügen', 'collectors-hub'),
            'add_new_item' => __('Neues Teammitlied hinzufügen', 'collectors-hub'),
            'edit_item' => __('Teammitglied bearbeiten', 'collectors-hub'),
            'new_item' => __('Neues Teammitglied', 'collectors-hub'),
            'menu_name' => __('Team', 'collectors-hub'),
            'view_item' => __('Teammitglied anzeigen', 'collectors-hub'),
            'search_items' => __('Nach Teammitgliedern suchen', 'collectors-hub'),
            'not_found' => __('Keine Teammitglieder gefunden', 'collectors-hub'),
            'not_found_in_trash' => __('Keine Teammitglieder im Papierkorb', 'collectors-hub'),
            'parent_item_colon' => ''
        ];

        $args = [
            'label' => __('Team', 'collectors-hub'),
            'description' => __('Erstelle dein Team', 'collectors-hub'),
            'labels' => $labels,
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-groups',
            'menu_Team' => 2,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'exclude_from_search' => true,
            'capability_type' => 'post',
            '_builtin' => false,
            'query_var' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true
        ];

        register_post_type($this->Cpt_Team, $args);

    }

    public function team_index(array $args): array
    {

        $faq_args = [
            'post_type' => $this->Cpt_Team,
            'post_status' => 'publish',
            'posts_per_page' => $args['amount'],
            'orderby' => 'title',
            'order' => $args['order']
        ];

        $team = new Wp_Query($faq_args);
        return $team->posts;
    }

}

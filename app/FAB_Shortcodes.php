<?php

namespace app;
class FAB_Shortcodes extends FAB_Helper
{

    public function init(): void
    {
        add_shortcode('show_faqs', [$this, 'fab_faq_shortcode']);
        add_shortcode('show_blogposts', [$this, 'fab_blogposts_shortcode']);
        add_shortcode('show_team', [$this, 'fab_team_shortcode']);
        add_shortcode('show_blogposts_archive', [$this, 'fab_blogposts_archive_shortcode']);
    }

    public function fab_faq_shortcode($attributes = []): false|string
    {
        $shortcode_args = shortcode_atts(
            [
                'amount' => -1,
                'post_ids' => '',
                'order' => 'ASC'
            ],
            $attributes
        );

        ob_start();
        $faq = new FAB_CptFAQ();
        $faqs = $faq->faq_index($shortcode_args); ?>

        <div class="fab-faq-container">
            <?php
            foreach ($faqs as $faq) : ?>
                <div class="single-faq">
                    <h3 class="faq-title"><?= $faq->post_title ?></h3>
                    <div class="faq-content"><?= $faq->post_content ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php return ob_get_clean();
    }

    public function fab_team_shortcode($attributes = []): false|string
    {
        $shortcode_args = shortcode_atts(
            [
                'amount' => -1,
                'order' => 'ASC'
            ],
            $attributes
        );

        ob_start();
        $team = new FAB_CptTeam();
        $members = $team->team_index($shortcode_args); ?>

        <div class="fab-team-container">
            <?php
            foreach ($members as $member) : ?>
                <div class="single-member">
                    <?= get_the_post_thumbnail($member->ID) ?>
                    <h3 class="member-title"><?= $member->post_title ?></h3>
                    <div class="member-content"><?= $member->post_content ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php return ob_get_clean();
    }

    public function fab_blogposts_shortcode($attributes = []): false|string
    {
        $shortcode_args = shortcode_atts(
            [
                'amount' => 3,
                'order' => 'DESC',
                'post_ids' => '',
                'show_archive_button' => 'true',
                'show_more_button' => 'false',
                'posts_to_add' => '',
                'search_query' => '',
                'excerpt_length' => 20
            ],
            $attributes
        );

        ob_start();

        $blogpost_query = new FAB_Blogposts();
        $blogposts = $blogpost_query->blogposts_index($shortcode_args);
        $displayed_posts = $blogposts['amount_of_displayed_blogposts'];
        $total_posts = $blogposts['amount_of_total_blogposts'];
        $posts_to_add = $shortcode_args['posts_to_add'];
        $post_order = $shortcode_args['order'];
        $excerpt_length = $shortcode_args['excerpt_length']; ?>

        <div class="fab-blogposts-container" displayed-posts="<?= $displayed_posts ?>"
             total-posts="<?= $total_posts ?>">
            <?php
            foreach ($blogposts['posts'] as $blogpost) :
                $post_date = date('d.m.Y', strtotime($blogpost->post_date));
                ?>
                <a href="<?= get_the_permalink($blogpost->ID) ?>" class="single-blogpost">
                    <div class="left">
                        <?= get_the_post_thumbnail($blogpost->ID) ?>
                    </div>
                    <div class="right">
                        <h3 class="blogpost-title"><?= $blogpost->post_title ?></h3>
                        <p class="blogpost-date"><?= $post_date ?></p>
                        <div class="blogpost-content"><?= $this->custom_excerpt($blogpost->post_content, $excerpt_length) ?></div>
                        <div class="read-more-button">Mehr lesen</div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="fab-archive-button-wrapper">
            <?php if ($shortcode_args['show_archive_button'] === 'true') : ?>
                <a href="<?= get_post_type_archive_link('post') ?>" class="show-archive-button fab-button">Zum
                    Archiv</a>
            <?php endif; ?>
        </div>
        <div class="fab-show-more-button-wrapper">
            <?php if ($shortcode_args['show_more_button'] === 'true' && $total_posts > $displayed_posts): ?>
                <div posts-to-add="<?= $posts_to_add ?>" post-order="<?= $post_order ?>"
                     excerpt_length="<?= $excerpt_length ?>"
                     class="show-more-blogposts fab-button btn-secondary btn">
                    <div>Mehr Beiträge</div>
                </div>
            <?php endif; ?>
        </div>

        <?php return ob_get_clean();
    }

    public function fab_blogposts_archive_shortcode($attributes = []): false|string
    {
        $shortcode_args = shortcode_atts(
            [
                'amount' => 3,
                'search_filter' => 'true',
                'posts_to_add' => '3',
                'show_more_button' => 'true',
                'order' => 'DESC',
                'excerpt_length' => 20
            ],
            $attributes
        );

        $amount = $shortcode_args['amount'];
        $has_search_filter = $shortcode_args['search_filter'];
        $posts_to_add = $shortcode_args['posts_to_add'];
        $has_show_more_button = $shortcode_args['show_more_button'];
        $order = $shortcode_args['order'];
        $excerpt_length = $shortcode_args['excerpt_length'];

        ob_start(); ?>
        <div class="fab-blogposts-archive">
            <?php if ($has_search_filter === "true"): ?>
                <div class="fab-search-bar">
                    <input type="text" id="fab-search-bar" name="fab-search-bar"
                           placeholder="Suche nach Blogbeiträgen ...">
                </div>
            <?php endif; ?>

            <div class="blogposts">
                <?= do_shortcode("[show_blogposts show_archive_button='false' amount='{$amount}' excerpt_length='$excerpt_length' posts_to_add='$posts_to_add' show_more_button='{$has_show_more_button}' order='{$order}']") ?>
            </div>
        </div>
        <?php return ob_get_clean();
    }
}
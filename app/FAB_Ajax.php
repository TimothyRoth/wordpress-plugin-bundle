<?php

namespace app;

use WP_Query as Query;

class FAB_Ajax extends FAB_Helper
{

    public function init(): void
    {
        add_action('wp_ajax_fab_blogpost_query', [$this, 'fab_blogpost_query']);
        add_action('wp_ajax_nopriv_fab_blogpost_query', [$this, 'fab_blogpost_query']);
    }

    /**
     * @throws \JsonException
     */
    public function fab_blogpost_query(): void
    {

        $blogposts_query = new FAB_Blogposts();
        $blogposts = $blogposts_query->blogposts_index($_POST['args']);
        $excerpt_length = (int) $_POST['args']['excerpt_length'];
        ob_start();
        foreach ($blogposts['posts'] as $blogpost):
            $post_date = date('d.m.Y', strtotime($blogpost->post_date)); ?>
            <a href="<?= get_the_permalink($blogpost->ID) ?>" class="single-blogpost">
                <div class="left">
                    <?= get_the_post_thumbnail($blogpost->ID) ?>
                </div>
                <div class="right">
                    <h3 class="blogpost-title"><?= $blogpost->post_title ?></h3>
                    <p class="blogpost-date"><?= $post_date ?></p>
                    <div class="blogpost-content"><?= $this->custom_excerpt($blogpost->post_content,  $excerpt_length)?></div>
                </div>
            </a>
        <?php endforeach;
        $this->json_response(ob_get_clean());
    }

}
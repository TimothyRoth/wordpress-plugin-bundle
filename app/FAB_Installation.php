<?php

namespace app;
class FAB_Installation
{

    public function init(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'load_plugin_scripts']);
    }

    public function load_plugin_scripts(): void
    {

        $plugin_meta_data = [
            'plugin_directory' => FAB_URI
        ];

        if (!is_admin()) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js', false, '3.6.1', true);
            wp_enqueue_script('jquery');

            wp_enqueue_script('base-plugin-bundle', FAB_URI . '/dist/main.min.js', ['wp-i18n'], '0.1', true);
            wp_enqueue_script('ajax', 'https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js', ['wp-i18n'], '0.1', true);
            wp_localize_script('base-plugin-bundle', 'ajax', ['url' => admin_url('admin-ajax.php')]);
            wp_localize_script('base-plugin-bundle', 'plugin_settings', $plugin_meta_data);
            wp_enqueue_style('base-plugin-main', FAB_URI . '/dist/main.min.css', [], '0.1', 'all');
        }
    }

}


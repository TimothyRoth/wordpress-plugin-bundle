<?php

namespace app;

class FAB_Settings
{
    public string $cpt_post_type = 'cpt_faq';
    public string $team_post_type = 'cpt_team';

    public string $deactivate_faq = 'fab_deactivate_faq';
    public string $deactivate_team = 'fab_deactivate_team';

    public function init(): void
    {
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('init', [$this, 'save_options']);
        add_action('init', [$this, 'execute_deactivation'], 999);
    }

    public function execute_deactivation(): void
    {
        if (get_option($this->deactivate_faq) === "1") {
            unregister_post_type($this->cpt_post_type);
        }

        if (get_option($this->deactivate_team) === "1") {
            unregister_post_type($this->team_post_type);
        }
    }

    public function save_options(): void
    {
        if (isset($_POST['fab_save_options'])) {
            if (isset($_POST[$this->deactivate_faq]) && $_POST[$this->deactivate_faq] === "1") {
                update_option($this->deactivate_faq, "1");
            } else {
                update_option($this->deactivate_faq, "0");
            }

            if (isset($_POST[$this->deactivate_team]) && $_POST[$this->deactivate_team] === "1") {
                update_option($this->deactivate_team, "1");
            } else {
                update_option($this->deactivate_team, "0");
            }
        }
    }

    public function add_settings_page(): void
    {
        add_menu_page(
            'FAB Options',
            'FAB Options',
            'manage_options',
            'fab_options',
            array($this, 'render_settings_page'),
            'dashicons-admin-generic',
            3
        );
    }

    public function render_settings_page(): void
    {
        ob_start(); ?>
        <h2>FAB Options</h2>
        <form method="POST">
            <input type="hidden" name="fab_save_options">
            <p>
                <label for="deactivate_faq">Deregister FAQ Post Type</label>
                <input type="checkbox" name="fab_deactivate_faq" id="fab_deactivate_faq"
                       value="1" <?php checked(get_option('fab_deactivate_faq'), 1); ?>>
            </p>
            <p>
                <label for="deactivate_team">Deregister Team Post Type</label>
                <input type="checkbox" name="fab_deactivate_team" id="fab_deactivate_team"
                       value="1" <?php checked(get_option('fab_deactivate_team'), 1); ?>>
            </p>
            <p>
                <input type="submit" value="save options">
            </p>
        </form>


        <?php echo ob_get_clean();
    }

}
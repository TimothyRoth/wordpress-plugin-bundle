<?php

use app\FAB_CptTeam;
use app\FAB_Installation;
use app\FAB_CptFAQ;
use app\FAB_Ajax;
use app\FAB_Shortcodes;
use app\FAB_Settings;

/**
 * Plugin Name: FAQ and Blogposts Addon
 * Plugin URI: www.timothy-roth.de
 * Description: Easy usage of FAQ, Blogposts and Teams including Shortcodes
 * Version: 1.0.0
 * Author: Timothy Roth
 * Author URI: www.timothy-roth.de
 * License: GPL2
 * Text Domain: faq_and_blogposts_addon
 * Domain Path: /languages
 */

define("FAB_PATH", plugin_dir_path(__FILE__));
define("FAB_URI", plugin_dir_url(__FILE__));
define("FAB_BASENAME", plugin_basename(__FILE__));
const FAB_FILE_PATH = __FILE__;

load_plugin_textdomain('faq_and_blogposts_addon', FALSE, basename(__DIR__) . '/languages/');

spl_autoload_register(static function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    $class_file = FAB_PATH . $class_name . '.php';
    if (file_exists($class_file)) {
        include $class_file;
    }
});

// Initialize instances of app
$instances = [
    FAB_Installation::class,
    FAB_Settings::class,
    FAB_CptFAQ::class,
    FAB_CptTeam::class,
    FAB_Ajax::class,
    FAB_Shortcodes::class,
];

foreach ($instances as $instance_name) {
    ${$instance_name} = new $instance_name();
    ${$instance_name}->init();
}



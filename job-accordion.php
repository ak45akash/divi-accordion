<?php
/*
Plugin Name: Job & Tender Accordion for Divi
Plugin URI: https://github.com/ak45akash/divi-accordion
Description: A custom Divi module that displays job listings and tenders in an elegant accordion format.
Version: 1.0
Author: Your Name
Author URI: https://your-website.com
License: GPL v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: jam-accordion
*/

if (!defined('ABSPATH')) {
    exit;
}

define('JAM_VERSION', '1.0.0');
define('JAM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('JAM_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Initialize the Divi modules
 */
function jam_initialize_extension() {
    if (class_exists('ET_Builder_Module')) {
        require_once JAM_PLUGIN_DIR . 'includes/JobAccordion.php';
        require_once JAM_PLUGIN_DIR . 'includes/TenderAccordion.php';
        new JAM_JobAccordion();
        new JAM_TenderAccordion();
    }
}
add_action('et_builder_ready', 'jam_initialize_extension');

/**
 * Check if Divi theme or Divi Builder is active
 */
function jam_is_divi_active() {
    $theme = wp_get_theme();
    $is_divi_theme = ('Divi' === $theme->get('Name') || 'Divi' === $theme->get('Template'));
    $is_divi_builder = defined('ET_BUILDER_VERSION') || class_exists('ET_Builder_Plugin');
    return $is_divi_theme || $is_divi_builder;
}

/**
 * Admin notice for missing Divi
 */
function jam_admin_notice_missing_divi() {
    if (!jam_is_divi_active()) {
        $message = sprintf(
            esc_html__('"%1$s" requires Divi Theme or Divi Builder plugin to be installed and activated.', 'jam-accordion'),
            '<strong>' . esc_html__('Job & Tender Accordion', 'jam-accordion') . '</strong>'
        );
        printf('<div class="notice notice-error"><p>%1$s</p></div>', $message);
    }
}
add_action('admin_notices', 'jam_admin_notice_missing_divi');

/**
 * Enqueue scripts and styles
 */
function jam_enqueue_scripts() {
    wp_enqueue_style('jam-style', JAM_PLUGIN_URL . 'css/style.css', array(), JAM_VERSION);
    wp_enqueue_style('jam-job-accordion-style', JAM_PLUGIN_URL . 'css/job-accordion-style.css', array(), JAM_VERSION);
    wp_enqueue_style('jam-tender-accordion-style', JAM_PLUGIN_URL . 'css/tender-accordion-style.css', array(), JAM_VERSION);
    wp_enqueue_script('jam-script', JAM_PLUGIN_URL . 'js/script.js', array('jquery'), JAM_VERSION, true);
}
add_action('wp_enqueue_scripts', 'jam_enqueue_scripts');

/**
 * Plugin activation hook
 */
register_activation_hook(__FILE__, 'jam_activate');
function jam_activate() {
    if (!jam_is_divi_active()) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(
            esc_html__('This plugin requires Divi Theme or Divi Builder plugin to be installed and activated.', 'jam-accordion'),
            'Plugin dependency check',
            array('back_link' => true)
        );
    }
}

/**
 * Plugin deactivation hook
 */
register_deactivation_hook(__FILE__, 'jam_deactivate');
function jam_deactivate() {
    // Cleanup if needed
} 
<?php
/**
 * Job Accordion Module Uninstaller
 *
 * @package JobAccordionModule
 * @since 1.0
 */

// If uninstall not called from WordPress, then exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Define constants for use in uninstall
define('JAM_PLUGIN_FILE', __FILE__);
define('JAM_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Clean up plugin options and any other database entries if needed
// Since this plugin doesn't create any database entries, we don't need to delete anything
// Just include this file for future additions

// Clear any cached data that may have been created
wp_cache_flush();

// If you've added any transients, you can clear them here:
// delete_transient('jam_some_transient_name');

// Optionally clear any plugin-specific user meta data if you've stored any

// Flush rewrite rules to ensure any custom permalinks are removed
flush_rewrite_rules(); 
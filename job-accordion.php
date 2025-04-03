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

// Include the Divi module files
require_once JAM_PLUGIN_DIR . 'includes/modules/JobAccordion/JobAccordion.php';
require_once JAM_PLUGIN_DIR . 'includes/modules/TenderAccordion/TenderAccordion.php';

/**
 * Check if Divi theme or Divi Builder is active
 */
function jam_is_divi_active() {
    // Check if Divi theme is active
    $theme = wp_get_theme();
    $is_divi_theme = ('Divi' === $theme->get('Name') || 'Divi' === $theme->get('Template'));
    
    // Check if Divi Builder plugin is active
    $is_divi_builder = defined('ET_BUILDER_VERSION') || class_exists('ET_Builder_Plugin');
    
    return $is_divi_theme || $is_divi_builder;
}

/**
 * Admin notice for missing Divi
 */
function jam_admin_notice_missing_divi() {
    if (isset($_GET['activate'])) unset($_GET['activate']);

    $message = sprintf(
        esc_html__('"%1$s" requires Divi Theme or Divi Builder plugin to be installed and activated.', 'job-accordion-module'),
        '<strong>' . esc_html__('Job Accordion Module', 'job-accordion-module') . '</strong>'
    );

    printf('<div class="notice notice-error"><p>%1$s</p></div>', $message);
}

/**
 * Include the module file
 */
function jam_include_module() {
    if (!jam_is_divi_active()) {
        add_action('admin_notices', 'jam_admin_notice_missing_divi');
        return;
    }

    /**
     * Job Accordion Module Class
     */
    class JAM_Job_Accordion extends ET_Builder_Module {
        public $slug = 'jam_job_accordion';
        public $vb_support = 'on';

        public function init() {
            $this->name = esc_html__('Job Accordion', 'job-accordion-module');
            $this->icon = 'n';
            $this->main_css_element = '%%order_class%%';
        }

        public function get_fields() {
            return array(
                'job_title' => array(
                    'label'           => esc_html__('Job Title', 'job-accordion-module'),
                    'type'            => 'text',
                    'option_category' => 'basic_option',
                    'description'     => esc_html__('Enter the job title here.', 'job-accordion-module'),
                    'toggle_slug'     => 'main_content',
                ),
                'job_description' => array(
                    'label'           => esc_html__('Job Description', 'job-accordion-module'),
                    'type'            => 'tiny_mce',
                    'option_category' => 'basic_option',
                    'description'     => esc_html__('Enter the job description here.', 'job-accordion-module'),
                    'toggle_slug'     => 'main_content',
                ),
                'job_location' => array(
                    'label'           => esc_html__('Job Location', 'job-accordion-module'),
                    'type'            => 'text',
                    'option_category' => 'basic_option',
                    'description'     => esc_html__('Enter the job location here.', 'job-accordion-module'),
                    'toggle_slug'     => 'main_content',
                ),
                'apply_button_url' => array(
                    'label'           => esc_html__('Apply Button URL', 'job-accordion-module'),
                    'type'            => 'text',
                    'option_category' => 'basic_option',
                    'description'     => esc_html__('Enter the URL for the apply button.', 'job-accordion-module'),
                    'toggle_slug'     => 'main_content',
                ),
                'apply_button_text' => array(
                    'label'           => esc_html__('Apply Button Text', 'job-accordion-module'),
                    'type'            => 'text',
                    'option_category' => 'basic_option',
                    'description'     => esc_html__('Enter the text for the apply button.', 'job-accordion-module'),
                    'default'         => esc_html__('Apply', 'job-accordion-module'),
                    'toggle_slug'     => 'main_content',
                ),
            );
        }

        public function get_advanced_fields_config() {
            return array(
                'fonts' => array(
                    'title' => array(
                        'label'    => esc_html__('Title', 'job-accordion-module'),
                        'css'      => array(
                            'main' => "{$this->main_css_element} .job-title",
                        ),
                        'font_size' => array(
                            'default' => '18px',
                        ),
                        'line_height' => array(
                            'default' => '1.5em',
                        ),
                    ),
                    'description' => array(
                        'label'    => esc_html__('Description', 'job-accordion-module'),
                        'css'      => array(
                            'main' => "{$this->main_css_element} .job-description",
                        ),
                        'font_size' => array(
                            'default' => '14px',
                        ),
                        'line_height' => array(
                            'default' => '1.5em',
                        ),
                    ),
                    'location' => array(
                        'label'    => esc_html__('Location', 'job-accordion-module'),
                        'css'      => array(
                            'main' => "{$this->main_css_element} .job-location",
                        ),
                        'font_size' => array(
                            'default' => '14px',
                        ),
                        'line_height' => array(
                            'default' => '1.5em',
                        ),
                    ),
                ),
                'button' => array(
                    'apply_button' => array(
                        'label' => esc_html__('Apply Button', 'job-accordion-module'),
                        'css' => array(
                            'main' => "{$this->main_css_element} .job-apply-button",
                        ),
                    ),
                ),
                'background' => array(
                    'settings' => array(
                        'color' => 'alpha',
                    ),
                    'css' => array(
                        'main' => "{$this->main_css_element}",
                    ),
                ),
                'borders' => array(
                    'default' => array(
                        'css' => array(
                            'main' => array(
                                'border_radii'  => "{$this->main_css_element}",
                                'border_styles' => "{$this->main_css_element}",
                            ),
                        ),
                    ),
                ),
                'box_shadow' => array(
                    'default' => array(
                        'css' => array(
                            'main' => "{$this->main_css_element}",
                        ),
                    ),
                ),
                'margin_padding' => array(
                    'css' => array(
                        'padding' => "{$this->main_css_element}",
                        'margin'  => "{$this->main_css_element}",
                    ),
                ),
            );
        }

        public function render($attrs, $content = null, $render_slug) {
            // Get values
            $job_title = $this->props['job_title'];
            $job_description = $this->props['job_description'];
            $job_location = $this->props['job_location'];
            $apply_button_url = $this->props['apply_button_url'];
            $apply_button_text = $this->props['apply_button_text'];

            // Generate unique ID for accordion functionality
            $accordion_id = 'job-accordion-' . $this->get_module_order();

            // Enqueue script and style
            wp_enqueue_script('jam-accordion-script', JAM_PLUGIN_URL . 'js/job-accordion.js', array('jquery'), JAM_VERSION, true);
            wp_enqueue_style('jam-accordion-style', JAM_PLUGIN_URL . 'css/job-accordion-style.css', array(), JAM_VERSION);

            // Start building the output
            $output = sprintf(
                '<div class="jam-job-accordion" id="%1$s">
                    <div class="job-header">
                        <h3 class="job-title">%2$s</h3>
                        <div class="job-location-apply">
                            <div class="job-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-4 0 32 32" fill="currentColor" stroke="none"><path d="M12,29 C10.337,29.009 2,16.181 2,12 C2,6.478 6.477,2 12,2 C17.523,2 22,6.478 22,12 C22,16.125 13.637,29.009 12,29 L12,29 Z M12,0 C5.373,0 0,5.373 0,12 C0,17.018 10.005,32.011 12,32 C13.964,32.011 24,16.95 24,12 C24,5.373 18.627,0 12,0 L12,0 Z M12,15 C10.343,15 9,13.657 9,12 C9,10.343 10.343,9 12,9 C13.657,9 15,10.343 15,12 C15,13.657 13.657,15 12,15 L12,15 Z M12,7 C9.239,7 7,9.238 7,12 C7,14.762 9.239,17 12,17 C14.761,17 17,14.762 17,12 C17,9.238 14.761,7 12,7 L12,7 Z"></path></svg>
                                <span>%3$s</span>
                            </div>
                            <a href="%5$s" class="job-apply-button no-arrow-button">%6$s</a>
                        </div>
                        <div class="toggle-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="7 10 12 15 17 10"></polyline></svg>
                        </div>
                    </div>
                    <div class="job-content">
                        <div class="job-description">%4$s</div>
                    </div>
                </div>',
                esc_attr($accordion_id),
                esc_html($job_title),
                esc_html($job_location),
                wp_kses_post($job_description),
                esc_url($apply_button_url),
                esc_html($apply_button_text)
            );

            return $output;
        }
    }
    
    new JAM_Job_Accordion();
}

add_action('et_builder_ready', 'jam_include_module');

// Register activation and deactivation hooks
register_activation_hook(__FILE__, 'jam_activate');
register_deactivation_hook(__FILE__, 'jam_deactivate');

// Activation function
function jam_activate() {
    flush_rewrite_rules();
}

// Deactivation function
function jam_deactivate() {
    flush_rewrite_rules();
}

// Enqueue scripts and styles
function jam_enqueue_scripts() {
    wp_enqueue_style('jam-job-accordion-style', JAM_PLUGIN_URL . 'css/job-accordion-style.css', array(), JAM_VERSION);
    wp_enqueue_style('jam-tender-accordion-style', JAM_PLUGIN_URL . 'css/tender-accordion-style.css', array(), JAM_VERSION);
    wp_enqueue_script('jam-accordion-script', JAM_PLUGIN_URL . 'js/job-accordion.js', array('jquery'), JAM_VERSION, true);
}
add_action('wp_enqueue_scripts', 'jam_enqueue_scripts');
add_action('et_builder_ready', 'jam_enqueue_scripts'); 
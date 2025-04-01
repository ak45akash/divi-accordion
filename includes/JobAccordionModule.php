<?php
/**
 * Job Accordion Module
 *
 * @package JobAccordionModule
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Job Accordion Module Class
 *
 * @since 1.0
 */
class ET_Builder_Module_JAM_Job_Accordion extends ET_Builder_Module {

    /**
     * Module slug
     *
     * @var string
     */
    public $slug = 'jam_job_accordion';
    
    /**
     * Visual Builder support
     *
     * @var string
     */
    public $vb_support = 'on';

    /**
     * Module credits
     *
     * @var array
     */
    protected $module_credits = array(
        'module_uri' => '',
        'author'     => '',
        'author_uri' => '',
    );

    /**
     * Init module
     *
     * @since 1.0
     */
    public function init() {
        $this->name = esc_html__( 'Job Accordion', 'job-accordion-module' );
        $this->icon = 'n';
        $this->main_css_element = '%%order_class%%';
    }

    /**
     * Get module fields
     *
     * @since 1.0
     * @return array
     */
    public function get_fields() {
        return array(
            'job_title' => array(
                'label'           => esc_html__( 'Job Title', 'job-accordion-module' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter the job title here.', 'job-accordion-module' ),
                'toggle_slug'     => 'main_content',
            ),
            'job_description' => array(
                'label'           => esc_html__( 'Job Description', 'job-accordion-module' ),
                'type'            => 'tiny_mce',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter the job description here.', 'job-accordion-module' ),
                'toggle_slug'     => 'main_content',
            ),
            'job_location' => array(
                'label'           => esc_html__( 'Job Location', 'job-accordion-module' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter the job location here.', 'job-accordion-module' ),
                'toggle_slug'     => 'main_content',
            ),
            'apply_button_url' => array(
                'label'           => esc_html__( 'Apply Button URL', 'job-accordion-module' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter the URL for the apply button.', 'job-accordion-module' ),
                'toggle_slug'     => 'main_content',
            ),
            'apply_button_text' => array(
                'label'           => esc_html__( 'Apply Button Text', 'job-accordion-module' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter the text for the apply button.', 'job-accordion-module' ),
                'default'         => esc_html__( 'Apply', 'job-accordion-module' ),
                'toggle_slug'     => 'main_content',
            ),
        );
    }

    /**
     * Get advanced fields config
     *
     * @since 1.0
     * @return array
     */
    public function get_advanced_fields_config() {
        return array(
            'fonts' => array(
                'title' => array(
                    'label'    => esc_html__( 'Title', 'job-accordion-module' ),
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
                    'label'    => esc_html__( 'Description', 'job-accordion-module' ),
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
                    'label'    => esc_html__( 'Location', 'job-accordion-module' ),
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
                    'label' => esc_html__( 'Apply Button', 'job-accordion-module' ),
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

    /**
     * Render the module
     *
     * @since 1.0
     * @param array $attrs
     * @param string $content
     * @param string $render_slug
     * @return string
     */
    public function render( $attrs, $content = null, $render_slug ) {
        // Get values
        $job_title = $this->props['job_title'];
        $job_description = $this->props['job_description'];
        $job_location = $this->props['job_location'];
        $apply_button_url = $this->props['apply_button_url'];
        $apply_button_text = $this->props['apply_button_text'];

        // Generate unique ID for accordion functionality
        $accordion_id = 'job-accordion-' . $this->get_module_order();

        // Check and enqueue script file
        $js_file_path = JAM_PLUGIN_DIR . 'includes/modules/JobAccordion/js/job-accordion.js';
        if (file_exists($js_file_path)) {
            wp_enqueue_script('jam-accordion-script', JAM_PLUGIN_URL . 'includes/modules/JobAccordion/js/job-accordion.js', array('jquery'), JAM_VERSION, true);
        } else {
            // Log error if file doesn't exist
            error_log('Job Accordion Module: JavaScript file not found at ' . $js_file_path);
        }

        // Check and enqueue style file
        $css_file_path = JAM_PLUGIN_DIR . 'includes/modules/JobAccordion/css/job-accordion.css';
        if (file_exists($css_file_path)) {
            wp_enqueue_style('jam-accordion-style', JAM_PLUGIN_URL . 'includes/modules/JobAccordion/css/job-accordion.css', array(), JAM_VERSION);
        } else {
            // Log error if file doesn't exist
            error_log('Job Accordion Module: CSS file not found at ' . $css_file_path);
        }

        // Start building the output
        $output = sprintf(
            '<div class="jam-job-accordion" id="%1$s">
                <div class="job-header">
                    <h3 class="job-title">%2$s</h3>
                    <div class="job-location">%3$s</div>
                    <div class="toggle-icon">
                        <span class="et-pb-icon">3</span>
                    </div>
                </div>
                <div class="job-content">
                    <div class="job-description">%4$s</div>
                    <a href="%5$s" class="job-apply-button et_pb_button">%6$s</a>
                </div>
            </div>',
            esc_attr($accordion_id),
            esc_html($job_title),
            esc_html($job_location),
            wp_kses_post($job_description), // Properly escape HTML content
            esc_url($apply_button_url),
            esc_html($apply_button_text)
        );

        return $output;
    }
}

/**
 * Initialize the module
 *
 * @since 1.0
 */
function jam_init_job_accordion_module() {
    if (class_exists('ET_Builder_Module')) {
        new ET_Builder_Module_JAM_Job_Accordion();
    }
}
add_action('et_builder_ready', 'jam_init_job_accordion_module');

// Also register the module with Divi's module system
function jam_register_module() {
    if (class_exists('ET_Builder_Module')) {
        if (method_exists('ET_Builder_Module', 'get_modules') && !in_array('ET_Builder_Module_JAM_Job_Accordion', ET_Builder_Module::get_modules())) {
            new ET_Builder_Module_JAM_Job_Accordion();
        }
    }
}
add_action('divi_extensions_init', 'jam_register_module'); 
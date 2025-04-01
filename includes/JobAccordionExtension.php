<?php
/**
 * Job Accordion Divi Extension
 *
 * @package JobAccordionModule
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Job Accordion Extension Class
 *
 * @since 1.0
 */
class JAM_JobAccordionExtension extends DiviExtension {

    /**
     * The gettext domain for the extension's translations.
     *
     * @since 1.0
     * @var string
     */
    public $gettext_domain = 'job-accordion-module';

    /**
     * The extension's WP Plugin name.
     *
     * @since 1.0
     * @var string
     */
    public $name = 'job-accordion-module';

    /**
     * The extension's version
     *
     * @since 1.0
     * @var string
     */
    public $version = '1.0';

    /**
     * JAM_JobAccordionExtension constructor.
     *
     * @since 1.0
     */
    public function __construct() {
        $this->plugin_dir     = JAM_PLUGIN_DIR;
        $this->plugin_dir_url = JAM_PLUGIN_URL;

        parent::__construct( $this->name, $this->version );
    }
}

// Initialize the extension
new JAM_JobAccordionExtension; 
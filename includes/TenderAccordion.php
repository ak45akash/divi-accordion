<?php

class JAM_TenderAccordion extends ET_Builder_Module {
    public $slug = 'jam_tender_accordion';
    public $vb_support = 'on';

    public function init() {
        $this->name = esc_html__('Tender Accordion', 'jam-accordion');
        $this->plural = esc_html__('Tender Accordions', 'jam-accordion');
        $this->icon = 'd';
        $this->main_css_element = '%%order_class%%';
        $this->category = esc_html__('Custom', 'jam-accordion');
        $this->help_videos = array();
    }

    public function get_fields() {
        return array(
            'title' => array(
                'label'           => esc_html__('Tender Title', 'jam-accordion'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the tender title here.', 'jam-accordion'),
                'toggle_slug'     => 'main_content',
            ),
            'description' => array(
                'label'           => esc_html__('Tender Description', 'jam-accordion'),
                'type'            => 'tiny_mce',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the tender description here.', 'jam-accordion'),
                'toggle_slug'     => 'main_content',
            ),
            'location' => array(
                'label'           => esc_html__('Location', 'jam-accordion'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the tender location here.', 'jam-accordion'),
                'toggle_slug'     => 'main_content',
            ),
            'closing_date' => array(
                'label'           => esc_html__('Closing Date', 'jam-accordion'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the tender closing date here.', 'jam-accordion'),
                'toggle_slug'     => 'main_content',
            ),
            'download_url' => array(
                'label'           => esc_html__('Download URL', 'jam-accordion'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the URL for the tender document download.', 'jam-accordion'),
                'toggle_slug'     => 'main_content',
            ),
        );
    }

    public function get_settings_modal_toggles() {
        return array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Content', 'jam-accordion'),
                ),
            ),
        );
    }

    public function get_advanced_fields_config() {
        return array(
            'fonts' => array(
                'title' => array(
                    'label'    => esc_html__('Title', 'jam-accordion'),
                    'css'      => array(
                        'main' => "{$this->main_css_element} .tender-title",
                    ),
                    'font_size' => array(
                        'default' => '18px',
                    ),
                    'line_height' => array(
                        'default' => '1.5em',
                    ),
                ),
                'description' => array(
                    'label'    => esc_html__('Description', 'jam-accordion'),
                    'css'      => array(
                        'main' => "{$this->main_css_element} .tender-description",
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
                'download_button' => array(
                    'label' => esc_html__('Download Button', 'jam-accordion'),
                    'css' => array(
                        'main' => "{$this->main_css_element} .tender-download-button",
                    ),
                ),
            ),
            'background' => array(
                'settings' => array(
                    'color' => 'alpha',
                ),
            ),
            'borders' => array(
                'default' => array(),
            ),
            'box_shadow' => array(
                'default' => array(),
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
        $title = $this->props['title'];
        $description = $this->props['description'];
        $location = $this->props['location'];
        $closing_date = $this->props['closing_date'];
        $download_url = $this->props['download_url'];

        $accordion_id = 'tender-accordion-' . $this->get_module_order();

        $output = sprintf(
            '<div class="jam-tender-accordion" id="%1$s">
                <div class="tender-header">
                    <div class="tender-title-wrapper">
                        <h3 class="tender-title">%2$s</h3>
                    </div>
                    <div class="tender-info-actions">
                        <div class="tender-location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-4 0 32 32" fill="currentColor" stroke="none"><path d="M12,29 C10.337,29.009 2,16.181 2,12 C2,6.478 6.477,2 12,2 C17.523,2 22,6.478 22,12 C22,16.125 13.637,29.009 12,29 L12,29 Z M12,0 C5.373,0 0,5.373 0,12 C0,17.018 10.005,32.011 12,32 C13.964,32.011 24,16.95 24,12 C24,5.373 18.627,0 12,0 L12,0 Z M12,15 C10.343,15 9,13.657 9,12 C9,10.343 10.343,9 12,9 C13.657,9 15,10.343 15,12 C15,13.657 13.657,15 12,15 L12,15 Z M12,7 C9.239,7 7,9.238 7,12 C7,14.762 9.239,17 12,17 C14.761,17 17,14.762 17,12 C17,9.238 14.761,7 12,7 L12,7 Z"></path></svg>
                            <span>%3$s</span>
                        </div>
                        <div class="tender-closing-date">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span>Closing: %4$s</span>
                        </div>
                        <a href="%5$s" class="tender-download-button no-arrow-button" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        </a>
                    </div>
                </div>
                <div class="tender-content">
                    <div class="tender-description">%6$s</div>
                </div>
            </div>',
            esc_attr($accordion_id),
            esc_html($title),
            esc_html($location),
            esc_html($closing_date),
            esc_url($download_url),
            wp_kses_post($description)
        );

        return $output;
    }
}

new JAM_TenderAccordion; 
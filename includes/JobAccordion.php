<?php

class JAM_JobAccordion extends ET_Builder_Module {
    public $slug = 'jam_job_accordion';
    public $vb_support = 'on';

    public function init() {
        $this->name = esc_html__('Job Accordion', 'jam-accordion');
        $this->icon = 'n';
        $this->main_css_element = '%%order_class%%';
    }

    public function get_fields() {
        return array(
            'job_title' => array(
                'label'           => esc_html__('Job Title', 'jam-accordion'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the job title here.', 'jam-accordion'),
                'toggle_slug'     => 'main_content',
            ),
            'job_description' => array(
                'label'           => esc_html__('Job Description', 'jam-accordion'),
                'type'            => 'tiny_mce',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the job description here.', 'jam-accordion'),
                'toggle_slug'     => 'main_content',
            ),
            'job_location' => array(
                'label'           => esc_html__('Job Location', 'jam-accordion'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the job location here.', 'jam-accordion'),
                'toggle_slug'     => 'main_content',
            ),
            'apply_button_url' => array(
                'label'           => esc_html__('Apply Button URL', 'jam-accordion'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the URL for the apply button.', 'jam-accordion'),
                'toggle_slug'     => 'main_content',
            ),
            'apply_button_text' => array(
                'label'           => esc_html__('Apply Button Text', 'jam-accordion'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Enter the text for the apply button.', 'jam-accordion'),
                'default'         => esc_html__('Apply', 'jam-accordion'),
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
                    'label'    => esc_html__('Description', 'jam-accordion'),
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
            ),
            'button' => array(
                'apply_button' => array(
                    'label' => esc_html__('Apply Button', 'jam-accordion'),
                    'css' => array(
                        'main' => "{$this->main_css_element} .job-apply-button",
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
        $job_title = $this->props['job_title'];
        $job_description = $this->props['job_description'];
        $job_location = $this->props['job_location'];
        $apply_button_url = $this->props['apply_button_url'];
        $apply_button_text = $this->props['apply_button_text'];

        $accordion_id = 'job-accordion-' . $this->get_module_order();

        // Add initial closed class
        $accordion_class = 'jam-job-accordion closed';

        $output = sprintf(
            '<div class="%7$s" id="%1$s">
                <div class="job-header">
                    <h3 class="job-title">%2$s</h3>
                    <div class="job-location-apply">
                        <div class="job-location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-4 0 32 32" fill="currentColor" stroke="none"><path d="M12,29 C10.337,29.009 2,16.181 2,12 C2,6.478 6.477,2 12,2 C17.523,2 22,6.478 22,12 C22,16.125 13.637,29.009 12,29 L12,29 Z M12,0 C5.373,0 0,5.373 0,12 C0,17.018 10.005,32.011 12,32 C13.964,32.011 24,16.95 24,12 C24,5.373 18.627,0 12,0 L12,0 Z M12,15 C10.343,15 9,13.657 9,12 C9,10.343 10.343,9 12,9 C13.657,9 15,10.343 15,12 C15,13.657 13.657,15 12,15 L12,15 Z M12,7 C9.239,7 7,9.238 7,12 C7,14.762 9.239,17 12,17 C14.761,17 17,14.762 17,12 C17,9.238 14.761,7 12,7 L12,7 Z"></path></svg>
                            <span>%3$s</span>
                        </div>
                        <a href="%4$s" class="job-apply-button no-arrow-button">%5$s</a>
                    </div>
                    <div class="toggle-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="7 10 12 15 17 10"></polyline></svg>
                    </div>
                </div>
                <div class="job-content">
                    <div class="job-description">%6$s</div>
                </div>
            </div>',
            esc_attr($accordion_id),
            esc_html($job_title),
            esc_html($job_location),
            esc_url($apply_button_url),
            esc_html($apply_button_text),
            wp_kses_post($job_description),
            esc_attr($accordion_class)
        );

        return $output;
    }
}

new JAM_JobAccordion; 
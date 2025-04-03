<?php

class JAM_JobAccordion extends ET_Builder_Module {
    public function init() {
        $this->name = esc_html__('Job Accordion', 'jam-accordion');
        $this->plural = esc_html__('Job Accordions', 'jam-accordion');
        $this->slug = 'jam_job_accordion';
        $this->vb_support = 'on';
        $this->main_css_element = '%%order_class%%.jam-job-accordion';
    }

    public function get_fields() {
        return array(
            'job_title' => array(
                'label' => esc_html__('Job Title', 'jam-accordion'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter the job title.', 'jam-accordion'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'text',
            ),
            'job_location' => array(
                'label' => esc_html__('Location', 'jam-accordion'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter the job location.', 'jam-accordion'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'text',
            ),
            'job_description' => array(
                'label' => esc_html__('Job Description', 'jam-accordion'),
                'type' => 'tiny_mce',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter the job description.', 'jam-accordion'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'text',
            ),
            'apply_button_url' => array(
                'label' => esc_html__('Apply Button URL', 'jam-accordion'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter the URL for the apply button.', 'jam-accordion'),
                'toggle_slug' => 'main_content',
                'dynamic_content' => 'url',
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

    public function render($attrs, $content = null, $render_slug) {
        $job_title = $this->props['job_title'];
        $job_location = $this->props['job_location'];
        $job_description = $this->props['job_description'];
        $apply_button_url = $this->props['apply_button_url'];

        // Generate unique ID for this accordion
        $accordion_id = 'job-' . $this->get_module_order() . '-' . uniqid();

        $output = sprintf(
            '<div class="jam-job-accordion" id="%5$s">
                <div class="job-header">
                    <div class="job-title-wrapper">
                        <h3 class="job-title">%1$s</h3>
                    </div>
                    <div class="job-info-actions">
                        <div class="job-location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-4 0 32 32" fill="currentColor" stroke="none"><path d="M12,29 C10.337,29.009 2,16.181 2,12 C2,6.478 6.477,2 12,2 C17.523,2 22,6.478 22,12 C22,16.125 13.637,29.009 12,29 L12,29 Z M12,0 C5.373,0 0,5.373 0,12 C0,17.018 10.005,32.011 12,32 C13.964,32.011 24,16.95 24,12 C24,5.373 18.627,0 12,0 L12,0 Z M12,15 C10.343,15 9,13.657 9,12 C9,10.343 10.343,9 12,9 C13.657,9 15,10.343 15,12 C15,13.657 13.657,15 12,15 L12,15 Z M12,7 C9.239,7 7,9.238 7,12 C7,14.762 9.239,17 12,17 C14.761,17 17,14.762 17,12 C17,9.238 14.761,7 12,7 L12,7 Z"></path></svg>
                            <span>%2$s</span>
                        </div>
                        <a href="%4$s" class="job-apply-button no-arrow-button">Apply</a>
                    </div>
                </div>
                <div class="job-content">
                    <div class="job-description">%3$s</div>
                </div>
            </div>',
            esc_html($job_title),
            esc_html($job_location),
            $job_description,
            esc_url($apply_button_url),
            esc_attr($accordion_id)
        );

        return $output;
    }
}

new JAM_JobAccordion; 
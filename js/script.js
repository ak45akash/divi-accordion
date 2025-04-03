jQuery(document).ready(function($) {
    // Accordion functionality
    $('.job-header, .tender-header').on('click', function() {
        var $accordion = $(this).closest('.jam-job-accordion, .jam-tender-accordion');
        var $content = $accordion.find('.job-content, .tender-content');
        
        // Toggle active class
        $accordion.toggleClass('active');
        
        // Animate content
        if ($accordion.hasClass('active')) {
            $content.css('max-height', $content[0].scrollHeight + 'px');
        } else {
            $content.css('max-height', 0);
        }
    });

    // Prevent link clicks from triggering accordion
    $('.job-apply-button, .tender-download-button').on('click', function(e) {
        e.stopPropagation();
    });
}); 
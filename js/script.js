jQuery(document).ready(function($) {
    // Job Accordion functionality
    $('.jam-job-accordion .job-header').on('click', function(e) {
        // Prevent action if clicking on apply button
        if ($(e.target).closest('.job-apply-button').length) {
            return;
        }
        
        var $accordion = $(this).closest('.jam-job-accordion');
        var $content = $accordion.find('.job-content');
        
        // Toggle the accordion
        $accordion.toggleClass('closed');
        
        // Toggle the content display
        if ($content.is(':visible')) {
            $content.slideUp(300);
        } else {
            $content.slideDown(300);
        }
    });
    
    // Tender Accordion functionality
    $('.jam-tender-accordion .tender-header').on('click', function(e) {
        // Prevent action if clicking on download button
        if ($(e.target).closest('.tender-download-button').length) {
            return;
        }
        
        var $accordion = $(this).closest('.jam-tender-accordion');
        var $content = $accordion.find('.tender-content');
        
        // Toggle the content display
        if ($content.is(':visible')) {
            $content.slideUp(300);
        } else {
            $content.slideDown(300);
        }
    });
}); 
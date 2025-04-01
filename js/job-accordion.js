(function($) {
    'use strict';

    $(document).ready(function() {
        // Hide all content sections initially
        $('.jam-job-accordion .job-content').hide();
        
        // Add closed class to all accordions
        $('.jam-job-accordion').addClass('closed');

        // Handle click on the header
        $('.jam-job-accordion .job-header').on('click', function(e) {
            var parent = $(this).parent();
            var content = parent.find('.job-content');
            
            // Toggle the content
            if (parent.hasClass('closed')) {
                parent.removeClass('closed');
                content.slideDown(300);
            } else {
                parent.addClass('closed');
                content.slideUp(300);
            }
            
            // Prevent default actions
            e.preventDefault();
            return false;
        });

        // Prevent apply button from triggering accordion
        $('.job-apply-button').on('click', function(e) {
            e.stopPropagation();
            return true;
        });
    });

})(jQuery); 
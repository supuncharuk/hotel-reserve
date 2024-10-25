$(document).ready(function() {
    let maxHeight = 0;

    // Reset heights to 'auto' first to account for different content
    $('.testimonial_item').css('height', 'auto');

    // Calculate the maximum height based on content
    $('.testimonial_item').each(function() {
        maxHeight = Math.max(maxHeight, $(this).outerHeight());
    });

    // Set each card's height to the maximum height
    $('.testimonial_item').css('height', maxHeight + 'px');
});

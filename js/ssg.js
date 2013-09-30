$(document).ready(function() {
	/*
	 * Initialize jQuery Colorbox
	 */
    $(".gallery").colorbox({
    	opacity: 0.8,
        loop: true,
        rel: 'group',
        current: '{current} of {total}',
        maxHeight: '95%',
        maxWidth: '95%'});
});
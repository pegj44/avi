// avi scripts

var $ = jQuery.noConflict();

$(document).ready(function() {
	
	// defaults
	/**
	 * Fit vids
	 */
	var sites = [
		"iframe[src^='http://www.dailymotion.com/embed']",
		"iframe[src*='cloudup.com']",
		"iframe[src*='animoto.com']",
		"iframe[src*='players.brightcove.net']",
		"iframe[src*='collegehumor.com']",
		"iframe[src*='flickr.com']",
		"iframe[src*='funnyordie.com']",
		"iframe[src*='hulu.com']",
		"iframe[src*='ted.com']",
		"iframe[src*='videopress.com']",
		"iframe[src*='vimeo.com']",
		"iframe[src*='vine.co']",
		"iframe[src*='videopress.com']"
	];

	$("#content,#footer,#slider:not(.revslider-wrap),.landing-offer-media,.portfolio-ajax-modal").fitVids({
		customSelector: sites.join(),
		ignore: '.no-fv'
	});


	$('.avi-share-btn').click(function(event) {
		var url = $(this).attr('href');
		var w = 575;
		var h = 520;
		var title = '';
	    // Fixes dual-screen position                         Most browsers      Firefox
	    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
	    var dualScreenTop  = window.screenTop != undefined ? window.screenTop : screen.top;

	    var width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
	    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

	    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
	    var top  = ((height / 2) - (h / 2)) + dualScreenTop;
	    var newWindow = window.open(url, title, 'width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

	    // Puts focus on the newWindow
	    if (window.focus) {
	        newWindow.focus();
	    }
	    return false;

	});

});
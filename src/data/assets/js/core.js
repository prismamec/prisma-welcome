$(document).ready(function(){
	/**** Revolution Slider ****/
	if ($.fn.revolution){
	revapi = $('#home').revolution(
	{
		delay:15000,
		startwidth:1170,
		startheight:500,
    navigationArrows:"none",
		fullWidth:"off",
		fullScreen:"on",
		navigationType:"none",
		fullScreenOffsetContainer: ""
	});
	tourSlider = $('#tourSlider').revolution(
	{
			delay:9000,
			startwidth:1170,
			startheight:550,
			hideThumbs:10,
			fullWidth:"on",
			forceFullWidth:"on"
	});
	}

	/**** Parrallax ****/
	if ($.fn.parallax){
	$('#working-section').parallax("50%", 0.1,false);

	$('.parrallax-element, .parrallax-background').each(function () {
		$(this).css('background-image', 'url(' + $(this).attr("data-background-image") + ')');
		$(this).css('height',  $(this).attr("data-background-height"));
		$(this).css('width',  $(this).attr("data-background-width"));
		$(this).parallax("50%", 0.1);
	});
	}

});

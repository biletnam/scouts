$('.navbar-toggle').click(function() {
	var nav = $('.navbar-toggle').data('toggle');
	$('.'+nav).stop().slideToggle();
	$('.navbar').toggleClass('mobile-active');
});
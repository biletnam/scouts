$(function() { setTimeout(function() { $('p.success').slideUp(); }, 3000); });
var base_url = "{{ url('/') }}";
$('.navbar-toggle').click(function() {
	var nav = $('.navbar-toggle').data('toggle');
	$('.'+nav).stop().slideToggle();
	$('.navbar').toggleClass('mobile-active');
});
$('a.add-role').click(function(e) {
	e.preventDefault();
	$('#add-role').show();
});
$('#leader').select2();

if ($('[name="body"]').length === 1) {
	CKEDITOR.replace('body');
}

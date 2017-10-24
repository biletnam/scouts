$(function(){
	banner = '<a href="https://www.hopper.be/winkel/banner/incoming?website=18bp.be&groep=A1218G&type=horizontaal"><img style="border: none;" alt="Hopper Winkel" src="https://www.hopper.be/winkel/banner/image?type=horizontaal" /></a>';
	$("<div/>")
		.addClass('hopper')
		.prependTo('footer')
		.append(banner);
});
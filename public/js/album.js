//LIGHTBOX GALLERY SCRIPT
	$(function() {
		$(".albumBody a img").hover(function(){
				$(this).stop().fadeTo("fast", 0.5);
			},
			function(){
				$(this).stop().fadeTo("fast", 1);
		});
		
		$(".albumBody a img").click(function (event){
			event.preventDefault();
			number = $(this).attr("id");
			album = $(this).attr('class');
			picture = $("<img/>").attr("src", "../Afbeeldingen/Fullscreen/" + album + "/" + number + '.jpg');
			$('#lightbox')
				.fadeIn(400)
			$("#lightbox .lightBody")
				.empty()
				.append(picture);
			$("#lightbox-shadow").fadeIn(400);
		});

		$("#close").click(function(event){
			closeThis();
		});

		$("#next").click(function(event){
			next();
		});
		$("#prev").click(function(event){
			previous();
		});

		function next() {
			if(number === 71){
				number = 1;
			}
			else{
				number++;
			}
			$(".lightBody")
				.empty()
				.append($("<img/>")
					.attr("src", "../Afbeeldingen/Fullscreen/" + album + "/" + number + '.jpg'));
		}

		function previous() {
			if(number === 1){
				number = 71;
			}
			else{
				number--;
			}
			$(".lightBody")
				.empty()
				.append($("<img/>")
				.attr("src", "../Afbeeldingen/Fullscreen/" + album + "/" + number + '.jpg'));
		}
		function closeThis() {
			$("#lightbox").fadeOut("fast");
			$('#lightbox-shadow').fadeOut("fast");
		}
	});
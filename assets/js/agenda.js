//Agenda script

$(function() {
	$("<div/>")
		.addClass("agenda")
		.appendTo("#leftie");
	$("<h3/>")
		.addClass("title")
		.text("AGENDA")
		.appendTo(".agenda");
	$("<p/>")
		.append("<p><b>Vrijdag 20 juni 19u30</b><br>Kampinfoavond</p>")

		.append("<p><b>Zaterdag 21 juni</b><br>Paaskamp jojo's</p>")

		.append("<p><b>Zondag 29 juni</b><br>Groepsuitstap Lilse Bergen</p>")
		.appendTo(".agenda");
	$("<a/>")
		.attr("href", "agenda")
		.text("Volledig Overzicht")
		.appendTo(".agenda");
});
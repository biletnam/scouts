$(function() {
	autosize($('textarea'))
});

function initMap() {
	if($('.map').length) {
		var map = addContactGoogleMaps("map", 51.2123078,4.4278965);
   		addContactGoogleMapsMarker(map, 51.2122961,4.430087200000003, "18BP Corneel Mayné", "https://www.google.be/maps/place/Langstraat+12,+2140+Antwerpen/@51.2123078,4.4278965,17z/data=!3m1!4b1!4m2!3m1!1s0x47c3f70fb77f445d:0x867ef7173254e975");
	}
}

function addContactGoogleMaps(container, latitude, longitude) {
  	var zoom = 15, 
  		disable = true, 
  		scroll = false,
  		styledMap = new google.maps.StyledMapType(
  			[
  				{
			        "featureType": "all",
			        "elementType": "labels.text.fill",
			        "stylers": [
			            {
			                "saturation": 36
			            },
			            {
			                "color": "#333333"
			            },
			            {
			                "lightness": 40
			            }
			        ]
			    },
			    {
			        "featureType": "all",
			        "elementType": "labels.text.stroke",
			        "stylers": [
			            {
			                "visibility": "on"
			            },
			            {
			                "color": "#ffffff"
			            },
			            {
			                "lightness": 16
			            }
			        ]
			    },
			    {
			        "featureType": "all",
			        "elementType": "labels.icon",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "administrative",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "color": "#fefefe"
			            },
			            {
			                "lightness": 20
			            }
			        ]
			    },
			    {
			        "featureType": "administrative",
			        "elementType": "geometry.stroke",
			        "stylers": [
			            {
			                "color": "#fefefe"
			            },
			            {
			                "lightness": 17
			            },
			            {
			                "weight": 1.2
			            }
			        ]
			    },
			    {
			        "featureType": "landscape",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#f5f5f5"
			            },
			            {
			                "lightness": 10
			            }
			        ]
			    },
			    {
			        "featureType": "poi",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#c6c6c6"
			            },
			            {
			                "lightness": 10
			            },
			            {
			                "visibility": "simplified"
			            }
			        ]
			    },
			    {
			        "featureType": "poi.park",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#dedede"
			            },
			            {
			                "lightness": 10
			            }
			        ]
			    },
			    {
			        "featureType": "road.highway",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "lightness": 17
			            },
			            {
			                "color": "#324F02"
			            }
			        ]
			    },
			    {
			        "featureType": "road.highway",
			        "elementType": "geometry.stroke",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "road.arterial",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#324F02"
			            },
			            {
			                "lightness": 1
			            },
			            {
			                "visibility": "on"
			            }
			        ]
			    },
			    {
			        "featureType": "road.arterial",
			        "elementType": "geometry.stroke",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "road.local",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#4E7A05"
			            },
			            {
			                "lightness": 1
			            }
			        ]
			    },
			    {
			        "featureType": "road.local",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "visibility": "on"
			            }
			        ]
			    },
			    {
			        "featureType": "road.local",
			        "elementType": "geometry.stroke",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "transit",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#f2f2f2"
			            },
			            {
			                "lightness": 19
			            },
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "water",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#e9e9e9"
			            },
			            {
			                "lightness": 17
			            }
			        ]
			    }
			], 
			{name: "Styled Map"}
		), 
		mapCenter = new google.maps.LatLng(latitude, longitude),

		mapOptions = {
			zoom: zoom,
			panControl: true,
			zoomControl: disable,
			scaleControl: true,
			mapTypeControl: false,
			streetViewControl: false,
			overviewMapControl: false,
			minZoom : 2,
			scrollwheel: scroll,
			center: mapCenter,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		},
		map = new google.maps.Map(document.getElementById(container), mapOptions);
		
	map.mapTypes.set('map_style', styledMap);
	map.setMapTypeId('map_style');

	function customCenter(latLng) {
        map.setCenter(latLng);
    }

    customCenter(mapCenter);
	
	google.maps.event.addDomListener(window, 'resize', function() {
	    customCenter(mapCenter);
	});

	return map;
}

function addContactGoogleMapsMarker(map, latitude, longitude, title, extern_url) {

	var marker_image = {
           	url: "assets/img/marker.svg",
           	anchor: new google.maps.Point(0, 80),
        	scaledSize: new google.maps.Size(50, 80)
        };

	var myLatlng = new google.maps.LatLng(latitude, longitude),
		marker = new google.maps.Marker({
	    	position: myLatlng,
	    	map: map,
	    	icon: marker_image
	    });

    google.maps.event.addListener(marker, "click", function() {
	    window.open(extern_url, '_blank');
	});

    return marker;
}
var s_lat = 40.68755348981749; 
var s_long = -74.3158632516861;

queryPosition();

function queryPosition(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(getPosition);
	}
}

function getPosition(position){
	if(!position) return;

	s_lat = position.coords.latitude;
	s_long = position.coords.longitude;
	
	initMap();
}

function initMap(){
	var start = {lat: s_lat, lng: s_long};
	var end = {lat: 40.6892911, lng: -74.31907919999998};

	var map = new google.maps.Map(document.getElementById('map'), {
	  center: start,
	  zoom: 7
	});

	var directionsDisplay = new google.maps.DirectionsRenderer({
	  map: map
	});

	// Set destination, origin and travel mode.
	var request = {
	  destination: end,
	  origin: start,
	  travelMode: 'DRIVING'
	};

	// Pass the directions request to the directions service.
	var directionsService = new google.maps.DirectionsService();
	directionsService.route(request, function(response, status) {
	  if (status == 'OK') {
		// Display the route on the map.
		directionsDisplay.setDirections(response);
	  }
	});
}
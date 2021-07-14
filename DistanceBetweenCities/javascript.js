//embed map   

//set to London
var latlng = {lat:51.5, lng:-0.1}
// set map options
var mapOptions = {
    //set center of map to latlng variable coordinates
    center: latlng,
    zoom: 5,
    mapTypeId: google.maps.MapTypeId.ROADMAP
};
            
//create map 
var map = new google.maps.Map(document.getElementById('map'), mapOptions);

//show route
//directionsService object to use route method and get result for request
var directionsService = new google.maps.DirectionsService();
//DirectionsRenderer object to display route
var route = new google.maps.DirectionsRenderer();

//bind route to map
route.setMap(map);

//showRoute function for the 'Show Route' button
function showRoute(){
    //create request
    var request = {
        //get origin from origin input
        origin: document.getElementById("origin").value,
        //get destination from destination input
        destination: document.getElementById("destination").value,
        //travel mode - driving
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
    }
    
    //pass request to route method
    directionsService.route(request, function(result, status){
        if(status == google.maps.DirectionsStatus.OK){
            //log the result in the console - for development purposes
            //console.log(result);

            //put travel distance etc. in directions div. change html content of directions div
            $("#directions").html("<div class='directions_info my-auto'>From: " + document.getElementById("origin").value + "<br />To: " +  document.getElementById("destination").value + "<br />Distance: " + result.routes[0].legs[0].distance.text + "<br />Driving Time: " + result.routes[0].legs[0].duration.text + "</div>");
            
            //display route
            route.setDirections(result);
        }else{
            // delete route from map
            route.setDirections({routes:[]});
            
            //error message
            $("#directions").html("<div class='directions_info my-auto'>Missing input. Please fill in the starting point and destination fields to see the route.</div>");
            
            //re-center to London again
            map.panTo(latlng);
                //alternative way to re-center to london:
                //map.setCenter(latlng);
        }
    });
}


//create autocomplete
//inputs
var origin = document.getElementById("origin");
var destination = document.getElementById("destination");
//autocomplete options
var options = {
    types: ['(cities)']
}

//autocomplete origin input
var autoOrigin = new google.maps.places.Autocomplete(origin, options);
//autocomplete destination input
var autoDestination = new google.maps.places.Autocomplete(destination, options);
            
//addListener to center the map on origin location
  //parameters: event, function to execute
autoOrigin.addListener("place_changed", onPlaceChanged);
            
//define function to execute to re-center map
function onPlaceChanged(){
                
    //get information of place entered by user
    var place = autoOrigin.getPlace();
                
    //center map to place entered by user
    map.panTo(place.geometry.location);
}


//submit a geocode request to google once so as to not overload per second limit
function geocode(address){
    geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        submitLatLng(results[0].geometry.location, address);
    } else {
        alert("Google Maps was unable to find the lat/lng for that address");
        return;
    }
  });
}

function submitLatLng(pos, address){
  var latitude = pos.lat();
  var longitude = pos.lng();
  var dc = Parse.Object.extend("Locations");
  var ud = new dc();
  ud.set("Address", address);
  ud.set("Latitude", latitude);
  ud.set("Longitude", longitude);
  ud.save();
}
//update the data in parse
function updateLatLng(geoLocation, address, email){
  var latitude = geoLocation.lat();
  var longitude = geoLocaiton.lng();
  var userData = Parse.Object.extend("UserData");
  userData.save({
    email: email,
    address: address,
    latitude: latitude,
    longitude: longitude
  }).then(function(){
    alert("yay");
  });
}

//submit a geocode request to google once so as to not overload per second limit
function submitLocationForUser(email, address){
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
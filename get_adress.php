<?php
// We define our address
$source = 'shahbag';
$destination = 'Farmgate';
$address = $source.', Dhaka';
//$address = 'Shahbag, Dhaka';
// We get the JSON results from this request
$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
// We convert the JSON to an array
$geo = json_decode($geo, true);

if ($geo['status'] = 'OK') {
  // We set our values
  $latitude = $geo['results'][0]['geometry']['location']['lat'];
  $longitude = $geo['results'][0]['geometry']['location']['lng'];
  echo $latitude;
}
$address = $destination.',Dhaka';
$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
$geo = json_decode($geo, true);

if ($geo['status'] = 'OK') {
  // We set our values
  $latitude1 = $geo['results'][0]['geometry']['location']['lat'];
  $longitude1 = $geo['results'][0]['geometry']['location']['lng'];
  echo $latitude;
}

?>


<!DOCTYPE html>
<html>
<head>
<script
src="http://maps.googleapis.com/maps/api/js">
</script>

<script>
var x=new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);
var y=new google.maps.LatLng(<?php echo $latitude1;?>,<?php echo $longitude1;?>);


function initialize()
{
var mapProp = {
  center:x,
  zoom:15,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var myTrip=[x,y,];
var flightPath=new google.maps.Polyline({
  path:myTrip,
  strokeColor:"#0000FF",
  strokeOpacity:0.8,
  strokeWeight:2
  });

flightPath.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="googleMap" style="width:1000px;height:1000px;"></div>
</body>
</html>

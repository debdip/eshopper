<?php
include 'test2.php';
$rt=new dbhelper();
$node = $rt->get_distinct_stopies();
if(isset($_POST["submit"])){
    
    $source=$_POST["node1"];
    $destination = $_POST["node2"];
    if(isset($_POST['distance'])){
        $distance=$_POST['distance'];
    }
    else $distance='null';
    if(isset($_POST['time'])){
        $time=$_POST['time'];
    }
    else $time='null';
    if(isset($_POST['cost'])){
        $cost = $_POST['cost'];
    }
    else $cost='null';
    
    if(isset($_POST['schedule'])){
       $time=$_POST['schedule'];
       $yourtime =  date('h:i a', strtotime($time)); 
       preg_match("/([0-9]{1,2}):([0-9]{1,2}) ([a-zA-Z]+)/", $yourtime, $match); // split the hour and min and am/pm 
        $hour = $match[1];
        $min = $match[2];
        $ampm = $match[3];
        //print_r($hour.':'.$min.':'.$ampm); //output
        if($hour<6 && $ampm=='am'){
            echo 'no bus';
        }
     else{
         if($min<=15){
             $min = 0;
         }
         else if($min >15 && $min <=45)
             $min = 30;
         else if($min>45){
             $hour++;
             $min=0;
         }
         $schedule=$hour.':'.$min.':'.$ampm;
         echo $schedule.'<br>' ;
        //print_r($hour.':'.$min.':'.$ampm); //output
         $array = $rt->dikjtra($source,$destination,$distance,$time,$cost);
         for($i=count($array)-1;$i>=0;$i--){
         
             $s=$array[$i];
             $address=$s.', Dhaka';
              $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
              $geo = json_decode($geo, true);
             if ($geo['status'] = 'OK') {
                 $lat[$i] = $geo['results'][0]['geometry']['location']['lat'];
                $long[$i] = $geo['results'][0]['geometry']['location']['lng'];
             }
         }
         
         
         
         
         
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
     }
        
    }
    
    
}
   

?>




<!DOCTYPE html>
<html>
<head>
<script
src="http://maps.googleapis.com/maps/api/js">
</script>

<script> 
    <?php $j=  count($array)-1; ?>
     var n = <?php echo $j; ?> ;
     var a = [];
    for(i= n;i>=0;i--){
        a[i] = new google.maps.LatLng(<?php echo $lat[$j];?>,<?php echo $long[$j];?>);
        <?php $j--;?>
    }
    
     
var x=new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);
var y=new google.maps.LatLng(<?php echo $latitude1;?>,<?php echo $longitude1;?>);
 <?php //echo $varaiable = "document.write(x)";
 ?>
     
function initialize() {
  var mapProp = {
    center:x,
    zoom:15,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
  //var myTrip = [for(i=n;i>=0;i--){document.write(a[i],)}]
 
  var myTrip=[a[0],a[1]];
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
<div id="googleMap" style="width:1000px;height:700px;"></div>

</body>
</html>
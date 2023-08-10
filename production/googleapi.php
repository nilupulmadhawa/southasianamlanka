
<?php

session_start();
// echo "ok";
$lan = $_REQUEST['q'];
$long = $_REQUEST['r'];

// echo $lan."<br/>";
// echo $long."<br/>";

function getPlaceName($latitude, $longitude)
{
  //This below statement is used to send the data to google maps api and get the place
  // name in different formats. we need to convert it as required.
  $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='
  .$latitude.','.$longitude.'&sensor=false');


  $output= json_decode($geocode);

  //Here "formatted_address" is used to display the address in a user friendly format.


  if($output->results[0]->formatted_address != NULL){
    $_SESSION['geolocation'] =  $output->results[0]->formatted_address;
    echo $_SESSION['geolocation'];
  }else{
    echo "latitude: ".$latitude;
    echo " longitude: ".$longitude;
  }


  // echo "done";
}

getPlaceName($lan,$long);

?>

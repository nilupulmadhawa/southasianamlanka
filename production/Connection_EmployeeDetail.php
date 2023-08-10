<?php
//image upload script

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$image = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

//end of image upload script

include 'connection.php';
session_start();

// $comp = $_SESSION['company'];

$priv     = mysqli_real_escape_string($conn,$_POST['priv']);
$fname    = mysqli_real_escape_string($conn,$_POST['fname']);
$username = mysqli_real_escape_string($conn,$_POST['username']);
$address  = mysqli_real_escape_string($conn,$_POST['address']);
$contact  = mysqli_real_escape_string($conn,$_POST['contact']);
$nic      = mysqli_real_escape_string($conn,$_POST['nic']);
$email    = mysqli_real_escape_string($conn,$_POST['email']);
$comp    = mysqli_real_escape_string($conn,$_POST['branch']);

$priv = intval($priv);

if($priv == 3){
  $code = $_POST['code'];
}


// get the count of the profile
$cnt = 0;
$count = mysqli_query($conn,"SELECT * FROM user");
while($row = mysqli_fetch_array($count)){
  GLOBAL $cnt;
  $cnt = $row[0];
}
$cnt = $cnt + 1;
$password = md5($nic);
//insert elements into the user table
$query = "INSERT INTO user (User_ID, UserName, Password) VALUES ('$cnt','$username','$password')";
mysqli_query($conn,$query);
if($priv == 3){
  $query = "INSERT INTO user_profile (Prof_ID,Name,Address,TPNo,NIC,Email,Image,Privilages_Priv_ID,User_User_ID,CompanyID,code)
  VALUES ($cnt,'$fname','$address','$contact','$nic','$email','$image',$priv,$cnt,$comp,0)";
  if (mysqli_query($conn, $query)) {
    echo "New record created successfully";
    // log process
    include 'functions/activity.php';
    activity($_SESSION['id'],"A New User Added");
    // end of log process
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}
else{
  $query = "INSERT INTO user_profile (Prof_ID,Name,Address,TPNo,NIC,Email,Image,Privilages_Priv_ID,User_User_ID,CompanyID, code)
  VALUES ($cnt,'$fname','$address','$contact','$nic','$email','$image',$priv,$cnt,$comp, 0)";
  if (mysqli_query($conn, $query)) {
    echo "New record created successfully";
    // log process
    include  'functions/activity.php';
    activity($_SESSION['id'],"A New User Added");
    // end of log process
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}

if($priv == 2){
  copy('images/'.$image, '../Maintain/images/'.$image);}
  else if($priv == 3){
    copy('images/'.$image, '../Rep/images/'.$image);}
    header('location:UserRegistration.php');



    ?>

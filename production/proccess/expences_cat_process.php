<?php

require_once './../../util/initialize.php';

// savedata function
if(isset($_POST['save'])){
  $expences_cat = new ExpenceCat;

  $expences_cat->cat_name = trim($_POST['cat_name']);

  try{
    $expences_cat->save();

    Activity::log_action("Expences Cat Added - " . $expences_cat->cat_name);
    $_SESSION["message"] = "Successfully Added Data.";
    Functions::redirect_to("./../expences_cat.php");


  } catch (Exception $exc) {

      $_SESSION["error"] = "Error..! Failed to add data.";
      Functions::redirect_to("./../expences_cat.php");

  }

}


// delete data function
if(isset($_GET['del'])){
  $del= Functions::custom_crypt($_GET["del"], 'd');
  echo $del;
  $expences_cat = ExpenceCat::find_by_id($del);

  try {
      $expences_cat->delete();
      Activity::log_action("Expences Cat deleted - " . $expences_cat->cat_name);
      $_SESSION["message"] = "Successfully deleted.";
      Functions::redirect_to("./../expences_cat.php");
  } catch (Exception $exc) {
      $_SESSION["error"] = "Error..! Failed to delete data.";
      Functions::redirect_to("./../expences_cat.php");
  }

}

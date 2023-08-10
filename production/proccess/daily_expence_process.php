<?php

require_once './../../util/initialize.php';

// savedata function
if(isset($_POST['save'])){
  $daily_expence = new DailyExpences;

  $daily_expence->expence_cat = trim($_POST['expence_cat']);
  $daily_expence->amount = trim($_POST['amount']);
  $daily_expence->exp_date = trim($_POST['exp_date']);
  $daily_expence->Note = trim($_POST['Note']);

  try{
    $daily_expence->save();

    Activity::log_action("Daily Expence Added - " . $daily_expence->expence_cat()->cat_name);
    $_SESSION["message"] = "Successfully Added Data.";
    Functions::redirect_to("./../daily_expences.php");

  } catch (Exception $exc) {
      $_SESSION["error"] = "Error..! Failed to add data.";
      Functions::redirect_to("./../daily_expences.php");
  }

}


// delete data function
if(isset($_GET['del'])){
  $del= Functions::custom_crypt($_GET["del"], 'd');
  echo "ok";
  $daily_expence = DailyExpences::find_by_id($del);

  try {
      $daily_expence->delete();
      Activity::log_action("Daily Expence deleted - " . $daily_expence->expence_cat()->cat_name);
      $_SESSION["message"] = "Successfully deleted.";
      Functions::redirect_to("./../daily_expences.php");
  } catch (Exception $exc) {
      $_SESSION["error"] = "Error..! Failed to delete data.";
      Functions::redirect_to("./../daily_expences.php");
  }

}

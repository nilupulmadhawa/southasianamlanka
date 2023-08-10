<?php

require_once './../../util/initialize.php';

if (isset($_POST['deactivate_user'])) {

  $user_id = trim($_POST['deactivate_user']);

  try {
    $user = User::find_by_id($user_id);
    $user->status = 0;
    $user->save();
    Activity::log_action("User De-activated : ".$user->name);
    $_SESSION["message"] = "Successfully updated.";
    Functions::redirect_to("./../user_management.php");
  } catch (Exception $exc) {
    $_SESSION["error"] = "Error..! Failed to save.";
    Functions::redirect_to("./../user_management.php");
  }

}


if (isset($_POST['activate_user'])) {

  $user_id = trim($_POST['activate_user']);

  try {
    $user = User::find_by_id($user_id);
    $user->status = 1;
    $user->save();

    Activity::log_action("User Activated: ".$user->name);
    $_SESSION["message"] = "Successfully updated.";
    Functions::redirect_to("./../user_management.php");
  } catch (Exception $exc) {
    $_SESSION["error"] = "Error..! Failed to save.";
    Functions::redirect_to("./../user_management.php");
  }

}

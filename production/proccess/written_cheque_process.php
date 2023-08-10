<?php

require_once './../../util/initialize.php';

// savedata function
if(isset($_POST['save'])){
  $written_cheque = new WrittenCheque;

  $written_cheque->cheque_number = trim($_POST['cheque_number']);
  $written_cheque->amount = trim($_POST['amount']);
  $written_cheque->bank_name = trim($_POST['bank']);
  $written_cheque->cheque_date = trim($_POST['c_date']);

  try{
    $written_cheque->save();

    Activity::log_action("Written Cheque Added - " . $written_cheque->cheque_number);
    $_SESSION["message"] = "Successfully Added Data.";
    Functions::redirect_to("./../written_cheque.php");

  } catch (Exception $exc) {
      $_SESSION["error"] = "Error..! Failed to add data.";
      Functions::redirect_to("./../written_cheque.php");
  }

}

// delete data function
if(isset($_GET['del'])){
  $del= Functions::custom_crypt($_GET["del"], 'd');
  echo "ok";
  $written_cheque = WrittenCheque::find_by_id($del);

  try {
      $written_cheque->delete();
      Activity::log_action("Written Cheque deleted - " . $written_cheque->cheque_number);
      $_SESSION["message"] = "Successfully deleted.";
      Functions::redirect_to("./../written_cheque.php");
  } catch (Exception $exc) {
      $_SESSION["error"] = "Error..! Failed to delete data.";
      Functions::redirect_to("./../written_cheque.php");
  }

}

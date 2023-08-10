<?php

require_once './../../util/initialize.php';

// savedata function
if(isset($_POST['save'])){
  $salary_payment = new SalaryPayment;

  $salary_payment->emp_id = trim($_POST['emp_id']);
  $salary_payment->salary_type = trim($_POST['salary_type']);
  $salary_payment->amount = trim($_POST['amount']);
  $salary_payment->salary_date = trim($_POST['salary_date']);
  $salary_payment->description = trim($_POST['description']);

  try{
    $salary_payment->save();

    Activity::log_action("Salary Payment Added - " . $written_cheque->cheque_number);
    $_SESSION["message"] = "Successfully Added Data.";
    Functions::redirect_to("./../salary_payment.php");

  } catch (Exception $exc) {
      $_SESSION["error"] = "Error..! Failed to add data.";
      Functions::redirect_to("./../salary_payment.php");
  }
}


// delete data function
if(isset($_GET['del'])){
  $del= Functions::custom_crypt($_GET["del"], 'd');
  echo "ok";
  $salary_payment = SalaryPayment::find_by_id($del);

  try {
      $salary_payment->delete();
      Activity::log_action("Salary Payment deleted - " . $salary_payment->emp_id()->name);
      $_SESSION["message"] = "Successfully deleted.";
      Functions::redirect_to("./../salary_payment.php");
  } catch (Exception $exc) {
      $_SESSION["error"] = "Error..! Failed to delete data.";
      Functions::redirect_to("./../salary_payment.php");
  }

}

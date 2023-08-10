<?php

require_once './../../util/initialize.php';


if (isset($_POST['customer_request'])) {
    $id = $_POST['customer_id'];
    echo json_encode(Customer::find_by_id($id));
}

if (isset($_POST["save"])) {
    $payment = new Payment();
    $payment->code = $_POST["code"];
    $payment->payment_method_id = $_POST["payment_method_id"];
    $payment->date_time = date('Y-m-d H:i:s');
    $payment->amount = $_POST["amount"];
    $payment->user_id = $_SESSION["user"]["id"];
    $payment->payment_type_id = 2;
    if ($payment->payment_method_id == 1) {
        $payment->payment_status_id = 2;
    } else {
        $payment->payment_status_id = 1;
    }

    global $database;
    $database->start_transaction();
    try {
        $payment->save();
        $payment_id = Payment::last_insert_id();

        $customer = Customer::find_by_id($_POST["customer_id"]);

        $customer_payment = new CustomerPayment();
        $customer_payment->customer_id = $customer->id;
        $customer_payment->payment_id = $payment_id;
        $customer_payment->save();

        if ($payment->payment_method_id == 1) {
            $customer->balance = ($customer->balance) - ($payment->amount);
            $customer->save();
        } else if ($payment->payment_method_id == 2) {
            $cheque = new Cheque();
            $cheque->bank_id = $_POST["c_bank_id"];
            $cheque->amount = $_POST["c_amount"];
            $cheque->cheque_no = $_POST["c_number"];
            $cheque->date = $_POST["c_date"];
            $cheque->cheque_status_id = 1;
            $cheque->save();

            $cheque_id = Cheque::last_insert_id();
            $allocated_amount = $_POST["c_allocated_amount"];

            $payment_cheque = new PaymentCheque();
            $payment_cheque->payment_id = $payment_id;
            $payment_cheque->cheque_id = $cheque_id;
            $payment_cheque->amount = $_POST["c_amount"];
            $payment_cheque->save();
        }

        $database->commit();
        Activity::log_action("Customer Payment (Code:" . $payment->code . ") - saved ");
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to("./../customer_payment.php");
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save payment";
        $_SESSION["error"] = $exc;
        Functions::redirect_to("./../customer_payment.php");
    }
}

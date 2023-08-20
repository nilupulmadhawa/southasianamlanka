<?php

require_once './../../util/initialize.php';



if (isset($_POST["invoice_balance"])) {
    $invoice_id = $_POST["invoice_id"];
    header('Content-Type: application/json');
    $invoice = Invoice::find_by_id($invoice_id);
    echo json_encode($invoice->balance);
}


if (isset($_POST["invoice_payments_request"])) {
    $result = array();
    if (isset($_SESSION["invoice_payments"])) {
        header('Content-Type: application/json');


        $invoice_payments = array();
        $total = 0;
        foreach ($_SESSION["invoice_payments"] as $index => $invoice_payment) {
            $invoice = Invoice::find_by_id($invoice_payment["invoice_id"]);
            $invoice_payment["invoice_id"] = $invoice->to_array();

            $invoice_payment["index"] = $index;
            $invoice_payments[] = $invoice_payment;

            $total += $invoice_payment["amount"];
        }


        $result["invoice_payments"] = $invoice_payments;
        $result["total"] = $total;
    }
    echo json_encode($result);
}

if (isset($_POST["add_invoice_payment"])) {
    $invoice_payment = array();
    $invoice_payment["invoice_id"] = $_POST['invoice_id'];
    $invoice_payment["amount"] = $_POST['amount'];
    $invoice_payment["balance"] = $_POST['balance'];

    if (isset($_SESSION["invoice_payments"])) {
        $_SESSION["invoice_payments"][] = $invoice_payment;
    } else {
        $_SESSION["invoice_payments"] = array();
        $_SESSION["invoice_payments"][] = $invoice_payment;
    }
}

if (isset($_POST["remove_item"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["invoice_payments"][$removeingIndex]);
}

if (isset($_POST["session_count"])) {
    if (isset($_SESSION["invoice_payments"])) {
        echo json_encode(sizeof($_SESSION["invoice_payments"]));
    }
}

if (isset($_POST["invoice_payment_request"])) {
    $index = $_POST["index"];
    if (isset($_SESSION["invoice_payments"])) {
        header('Content-Type: application/json');
        $invoice_payment = $_SESSION["invoice_payments"][$index];
        unset($_SESSION["invoice_payments"][$index]);
        echo json_encode($invoice_payment);
    }
}

if (isset($_POST["total_request"])) {
    $total = 0;
    if (isset($_SESSION["invoice_payments"])) {
        header('Content-Type: application/json');

        foreach ($_SESSION["invoice_payments"] as $index => $invoice_payment) {
            $amount = $invoice_payment["amount"];
            if ($amount > 0) {
                $total += $amount;
            }
        }
    }
    echo json_encode($total);
}

if (isset($_POST["invoice_request"])) {
    header('Content-Type: application/json');
    $filter_id = $_POST["filter_id"];

    $invoices;
    if ($filter_id == "all") {
        $invoices = Invoice::find_all();
    } else if ($filter_id == "retail") {
        $invoices = Invoice::find_all_by_invoice_type_id_has_balance(2);
    } else {
        $invoices = Invoice::find_all_by_customer_id_has_balance($filter_id);
    }

    foreach ($invoices as $index => $invoice) {
        if ($invoice->customer_id) {
            $invoices[$index]->customer_id = " (" . $invoice->customer_id()->name . ")";
        } else {
            $invoices[$index]->customer_id = " (Retail)";
        }
    }

    echo json_encode($invoices);
}

if (isset($_POST["check_session"])) {
    header('Content-Type: application/json');
    $checking_id = $_POST["id"];
    $availability = false;
    if (isset($_SESSION["invoice_payments"])) {
        foreach ($_SESSION["invoice_payments"] as $value) {
            if ($value["invoice_id"] === $checking_id) {
                $availability = true;
            }
        }
    }
    echo json_encode($availability);
}

if (isset($_POST["session_count"])) {
    if (isset($_SESSION["invoice_payments"])) {
        echo json_encode(sizeof($_SESSION["invoice_payments"]));
    }
}


if (isset($_POST["update"])) {

    $payment = Payment::find_by_id($_POST["id"]);
    $payment->code = $_POST["code"];
    $payment->payment_method_id = $_POST["payment_method_id"];
    $payment->date_time = date('Y-m-d H:i:s');

    if ($payment->payment_method_id == 2) {
        $payment->amount = $_POST["c_amount"];
    } else {
        $payment->amount = $_POST["amount"];
    }

    $payment->user_id = $_SESSION["user"]["id"];
    $payment->payment_type_id = 1;
    if ($payment->payment_method_id == 1) {
        $payment->payment_status_id = 2;
    } else {
        $payment->payment_status_id = 1;
    }

    // global $database;
    // $database->start_transaction();
    try {
        $payment->save();
        $payment_id = $_POST["id"];

        //delete all payment cheque
        $payment_cheques = PaymentCheque::find_all_by_payment_id($payment_id);
        foreach ($payment_cheques as $payment_cheque) {
            $cheque = $payment_cheque->cheque_id();
            $cheque->delete();
            $payment_cheque->delete();
        }
        $payment_invoice = PaymentInvoice::find_all_by_payment_id($payment_id);
        foreach ($payment_invoice as $payment_invoice) {
            $invoice = $payment_invoice->invoice_id();
            $invoice->balance += $payment_invoice->amount;
            $payment_invoice->delete();
        }



        if ($payment->payment_method_id == 2 || $payment->payment_method_id == 1) {
            $cheque = new Cheque();
            $cheque->bank_id = $_POST["c_bank_id"] ?? 0;
            if ($payment->payment_method_id == 2) {
                $cheque->amount = $_POST["c_amount"];
            } else {
                $cheque->amount = 0;
            }
            $cheque->cheque_no = $_POST["c_number"] ?? "";
            $cheque->date =  $_POST["c_date"] == "" ? null : $_POST["c_date"];
            $cheque->branch = $_POST["c_branch"];
            $cheque->cheque_status_id = 1;
            $cheque->save();

            $cheque_id = Cheque::last_insert_id();
            $allocated_amount = $_POST["c_number"];

            $payment_cheque = new PaymentCheque();
            $payment_cheque->payment_id = $payment_id;
            $payment_cheque->cheque_id = $cheque_id;
            //            $payment_cheque->amount=$allocated_amount;
            if ($payment->payment_method_id == 2) {
                $payment_cheque->amount = $_POST["c_amount"];
            } else {
                $payment_cheque->amount = 0;
            }
            $payment_cheque->save();
        }

        foreach ($_SESSION["invoice_payments"] as $sess_invoice_payment) {
            $payment_invoice = new PaymentInvoice();
            $payment_invoice->payment_id = $payment_id;
            $payment_invoice->invoice_id = $sess_invoice_payment["invoice_id"];
            $payment_invoice->amount = $sess_invoice_payment["amount"];
            $payment_invoice->save();

            // if ($payment->payment_method_id == 1) {
            $invoice = Invoice::get_recalculated_invoice_by_id($sess_invoice_payment["invoice_id"]);
            $invoice->save();
            // }
        }
        // die();
        $database->commit();
        Activity::log_action("Payment (Code:" . $payment->code . ") - saved ");
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to("./../payment_management.php");
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save payment";
        print_r($exc);
        // Functions::redirect_to("./../payment.php");
    }
}

if (isset($_POST["save"])) {
    $payment = new Payment();
    $payment->code = $_POST["code"];
    $payment->payment_method_id = $_POST["payment_method_id"];
    $payment->date_time = date('Y-m-d H:i:s');

    if ($payment->payment_method_id == 2) {
        $payment->amount = $_POST["c_amount"];
    } else {
        $payment->amount = $_POST["amount"];
    }


    $payment->user_id = $_SESSION["user"]["id"];
    $payment->payment_type_id = 1;
    if ($payment->payment_method_id == 1) {
        $payment->payment_status_id = 2;
    } else {
        $payment->payment_status_id = 1;
    }

    // global $database;
    // $database->start_transaction();
    try {
        $payment->save();
        $payment_id = Payment::last_insert_id();

        if ($payment->payment_method_id == 2 || $payment->payment_method_id == 1) {
            $cheque = new Cheque();
            $cheque->bank_id = $_POST["c_bank_id"] ?? 0;
            if ($payment->payment_method_id == 2) {
                $cheque->amount = $_POST["c_amount"];
            } else {
                $cheque->amount = $_POST[0];
            }
            $cheque->cheque_no = $_POST["c_number"] ?? "";
            $cheque->date =  $_POST["c_date"] == "" ? null : $_POST["c_date"];
            $cheque->branch = $_POST["c_branch"];
            $cheque->cheque_status_id = 1;
            $cheque->save();

            $cheque_id = Cheque::last_insert_id();
            $allocated_amount = $_POST["c_number"];

            $payment_cheque = new PaymentCheque();
            $payment_cheque->payment_id = $payment_id;
            $payment_cheque->cheque_id = $cheque_id;
            //            $payment_cheque->amount=$allocated_amount;
            if ($payment->payment_method_id == 2) {
                $payment_cheque->amount = $_POST["c_amount"];
            } else {
                $payment_cheque->amount = $_POST[0];
            }
            $payment_cheque->save();
        }

        foreach ($_SESSION["invoice_payments"] as $sess_invoice_payment) {
            $payment_invoice = new PaymentInvoice();
            $payment_invoice->payment_id = $payment_id;
            $payment_invoice->invoice_id = $sess_invoice_payment["invoice_id"];
            $payment_invoice->amount = $sess_invoice_payment["amount"];
            $payment_invoice->save();

            // if ($payment->payment_method_id == 1) {
            $invoice = Invoice::get_recalculated_invoice_by_id($sess_invoice_payment["invoice_id"]);
            $invoice->save();
            // }
        }

        $database->commit();
        Activity::log_action("Payment (Code:" . $payment->code . ") - saved ");
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to("./../payment.php");
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save payment";
        print_r($exc);
        // Functions::redirect_to("./../payment.php");
    }
}

//if (isset($_POST["cancel_payment"])) {
//    $payment_id = $_POST["payment_id"];
//    $payment = Payment::find_by_id($payment_id);
//
//    global $database;
//    $database->start_transaction();
//    try {
//        $payment->payment_status_id = 3;
//        $payment->save();
//
//        if ($payment->payment_method_id == 1) {
//            $payment_invoice_codes = array();
//            foreach (PaymentInvoice::find_all_by_payment_id($payment->id) as $payment_invoice) {
//                $invoice=Invoice::get_recalculated_invoice_by_id($payment_invoice->invoice_id);
//                $invoice->save();
//
//                $payment_invoice_codes[] = $invoice->code;
//            }
//
//            $database->commit();
//            Activity::log_action("Payment:" . $payment->code . " (Invoices:" . join(", ", $payment_invoice_codes) . ") - canceled ");
//            echo json_encode(TRUE);
//        } else if ($payment->payment_method_id == 2) {
//            $payment_cheques = PaymentCheque::find_all_by_payment_id($payment->id);
//            $payment_cheque_names = array();
//            foreach ($payment_cheques as $payment_cheque) {
//                $cheque = $payment_cheque->cheque_id();
//                $cheque->cheque_status_id = 3;
//                $cheque->save();
//                $payment_cheque_names[] = $cheque->cheque_no;
//            }
//
//            $payment_invoice_codes = array();
//            $payment_invoices=PaymentInvoice::find_all_by_payment_id($payment->id);
//            foreach ($payment_invoices as $payment_invoice) {
//                $invoice=Invoice::get_recalculated_invoice_by_id($payment_invoice->invoice_id);
//                $invoice->save();
//
//                $payment_invoice_codes[] = $invoice->code;
//            }
//
//            $database->commit();
//            Activity::log_action("Payment:" . $payment->code . " (Invoices:" . join(", ", $payment_invoice_codes) . " Cheques:" . join(", ", $payment_cheque_names) . ") - canceled ");
//            echo json_encode(TRUE);
//        }
//    } catch (Exception $exc) {
//        $database->rollback();
//        echo json_encode(FALSE);
//    }
//}
if (isset($_POST["cancel"])) {
    $payment_id = $_POST["payment_id"];
    $payment = Payment::find_by_id($payment_id);

    global $database;
    $database->start_transaction();
    try {
        $payment->payment_status_id = 3;
        $payment->save();

        if ($payment->payment_method_id == 1) {
            if ($payment->payment_type_id == 1) {
                $payment_invoices = PaymentInvoice::find_all_by_payment_id($payment->id);
                foreach ($payment_invoices as $payment_invoice) {
                    $invoice = Invoice::get_recalculated_invoice_by_id($payment_invoice->invoice_id);
                    $invoice->save();
                }
            } else if ($payment->payment_type_id == 2) {
                $customer_payment = CustomerPayment::find_by_payment_id($payment->id);
                $customer = $customer_payment->customer_id();
                $customer->balance = ($customer->balance) + ($payment->amount);
                $customer->save();
            }
        } else if ($payment->payment_method_id == 2) {
            $payment_cheques = PaymentCheque::find_all_by_payment_id($payment->id);

            foreach ($payment_cheques as $paymemt_cheque) {
                $cheque = $paymemt_cheque->cheque_id();
                $cheque->cheque_status_id = 3;
                $cheque->save();

                if ($payment->payment_type_id == 1) {
                    $payment_invoices = PaymentInvoice::find_all_by_payment_id($payment->id);
                    foreach ($payment_invoices as $payment_invoice) {
                        $invoice = Invoice::get_recalculated_invoice_by_id($payment_invoice->invoice_id);
                        $invoice->save();
                    }
                } else if ($payment->payment_type_id == 2) {
                    $customer_payment = CustomerPayment::find_by_payment_id($payment->id);
                    $customer = $customer_payment->customer_id();
                    $customer->balance = ($customer->balance) + ($payment->amount);
                    $customer->save();
                }
            }
        }

        $database->commit();
        //            Activity::log_action("Payment:" . $payment->code . " (Invoices:" . join(", ", $payment_invoice_codes) . " Cheques:" . join(", ", $payment_cheque_names) . ") - canceled ");
        Activity::log_action("Payment:" . $payment->code . " - canceled ");
        $_SESSION["message"] = "Successfully canceled";
        Functions::redirect_to("./../payment_management.php");
        echo json_encode(TRUE);
    } catch (Exception $exc) {
        $database->rollback();
        echo json_encode(FALSE);
    }
}

if (isset($_POST["authenticate"])) {
    $password = $_POST["password"];
    echo json_encode(Session::authenticate_password($password));
}

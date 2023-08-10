<?php

require_once './../../util/initialize.php';

function setRellaventPayments($cheque) {
    if ($cheque->cheque_status_id == 1) {
        foreach (PaymentCheque::find_all_by_payment_id($cheque->id) as $payment_cheque) {
            $payment = $payment_cheque->payment_id();
            $payment->payment_status_id = 1;
            $payment->save();
            foreach (PaymentInvoice::find_all_by_payment_id($payment_cheque->payment_id) as $payment_invoice) {
                $invoice = $payment_invoice->invoice_id();
                $invoice->balance = ($invoice->balance) - ($payment_invoice->amount);
                if (($invoice->balance) > 0) {
                    $invoice->invoice_status_id = 1;
                } else {
                    $invoice->invoice_status_id = 2;
                }
                $invoice->save();
            }
        }
    } else if ($cheque->cheque_status_id == 2) {
        foreach (PaymentCheque::find_all_by_payment_id($cheque->id) as $payment_cheque) {
            $payment = $payment_cheque->payment_id();
            $payment->payment_status_id = 2;
            $payment->save();
            foreach (PaymentInvoice::find_all_by_payment_id($payment_cheque->payment_id) as $payment_invoice) {
                $invoice = $payment_invoice->invoice_id();
                $invoice->balance = ($invoice->balance) + ($payment_invoice->amount);
                if (($invoice->balance) > 0) {
                    $invoice->invoice_status_id = 1;
                } else {
                    $invoice->invoice_status_id = 2;
                }
                $invoice->save();
            }
        }
    }
}

if (isset($_POST['save'])) {
//    $cheque = new Cheque();
//
//    $cheque->invoice_id = trim($_POST['invoice_id']);
//    $cheque->bank = trim($_POST['bank']);
//    $cheque->cheque_no = trim($_POST['chequeno']);
//    $cheque->amount = trim($_POST['amount']);
//    $cheque->date = trim($_POST['cdate']);
//    $cheque->cheque_status_id = trim($_POST['cheque_status_id']);
//
//    try {
//        $cheque->save();
//        Activity::log_action("Cheque saved - invoice:" . $cheque->invoice_id()->code);
//        $_SESSION["message"] = "Successfully saved.";
//        Functions::redirect_to("../cheque.php");
//    } catch (Exception $exc) {
//        $_SESSION["error"] = "Error..! Failed to save.";
//        Functions::redirect_to("../cheque.php");
//    }
}

if (isset($_POST['update'])) {
//    $cheque = Cheque::find_by_id($_POST["id"]);
//    $cheque->bank = trim($_POST['bank']);
//    $cheque->cheque_no = trim($_POST['chequeno']);
//    $cheque->amount = trim($_POST['amount']);
//    $cheque->date = trim($_POST['cdate']);
//    $status_cahnged;
//    if($cheque->cheque_status_id !== trim($_POST['cheque_status_id'])){
//        $status_cahnged=TRUE;
//    }else{
//        $status_cahnged=FALSE;
//    }
//    $cheque->$status_cahnged = trim($_POST['cheque_status_id']);
//
//    try {
//        
//        $cheque->save();
//        
//        if($status_cahnged){
//            setRellaventPayments($cheque);   
//        }
//        
//        Activity::log_action("Cheque updated  for - Payment:" . $cheque->invoice_id()->code." Status:".ChequeStatus::find_by_id($cheque->cheque_status_id)->name);
//        $_SESSION["message"] = "Successfully updated.";
//        Functions::redirect_to("../cheque.php");
//    } catch (Exception $exc) {
//        $_SESSION["error"] = "Error..! Failed to update.";
//        Functions::redirect_to("../cheque.php");
//    }
}


if (isset($_POST['delete'])) {
//    $cheque = Cheque::find_by_id($_POST["id"]);
//
//    try {
//        $cheque->delete();
//        Activity::log_action("Cheque deleted - invoice:" . $cheque->invoice_id()->code);
//        $_SESSION["message"] = "Successfully deleted.";
//        Functions::redirect_to("../cheque.php");
//    } catch (Exception $exc) {
//        $_SESSION["error"] = "Error..! Failed to deleted.";
//        Functions::redirect_to("../cheque.php");
//    }
}

if (isset($_POST["authenticate"])) {
    $password = $_POST["password"];
    echo json_encode(Session::authenticate_password($password));
}

//if (isset($_POST["confirm_cheque"])) {
//    $cheque = Cheque::find_by_id($_POST["cheque_id"]);
//    $cheque->cheque_status_id = $_POST["cheque_status_id"];
//
//    try {
//        $cheque->save();
//        $paymemt_cheques = PaymentCheque::find_all_by_cheque_id($cheque->id);
//        foreach ($paymemt_cheques as $paymemt_cheque) {
//            $payment = $paymemt_cheque->payment_id();
//            if ($cheque->cheque_status_id == 2) {
//                $payment->payment_status_id = 2;
//                
//                
//                
//            } else if ($cheque->cheque_status_id == 4) {
//                $payment->payment_status_id = 3;
//            }
//            $payment->save();
//
//            $payment_invoices = PaymentInvoice::find_all_by_payment_id($payment->id);
//            foreach ($payment_invoices as $payment_invoice) {
//                $invoice = Invoice::get_recalculated_invoice_by_id($payment_invoice->invoice_id);
//                $invoice->save();
//                $payment_invoice_codes[] = $invoice->code;
//            }
//        }
//
//        Activity::log_action("Cheque:" . $cheque->bank_id()->name . "-" . $cheque->cheque_no . " (Invoices:" . join(", ", $payment_invoice_codes) . ") - confirmed ");
//        echo json_encode(TRUE);
//    } catch (Exception $exc) {
//        echo json_encode(FALSE);
//    }
//}
if (isset($_POST["confirm_cheque"])) {
    $cheque = Cheque::find_by_id($_POST["cheque_id"]);
    $cheque->cheque_status_id = $_POST["cheque_status_id"];

    try {
        $cheque->save();
        $paymemt_cheques = PaymentCheque::find_all_by_cheque_id($cheque->id);
        foreach ($paymemt_cheques as $paymemt_cheque) {
            $payment = $paymemt_cheque->payment_id();
            if ($cheque->cheque_status_id == 2) {
                $payment->payment_status_id = 2;
            } else if ($cheque->cheque_status_id == 4) {
                $payment->payment_status_id = 3;
            }
            $payment->save();

            // if ($payment->payment_type_id == 1) {
            //     $payment_invoices = PaymentInvoice::find_all_by_payment_id($payment->id);
            //     foreach ($payment_invoices as $payment_invoice) {
            //         $invoice = Invoice::get_recalculated_invoice_by_id($payment_invoice->invoice_id);
            //         $invoice->save();
            //         $payment_invoice_codes[] = $invoice->code;
            //     }
            // } else if ($payment->payment_type_id == 2) {
            //     $customer_payment = CustomerPayment::find_by_payment_id($payment->id);
            //     $customer = $customer_payment->customer_id();
                
            //     if ($payment->payment_status_id == 2) {
            //         $customer->balance = ($customer->balance) - ($payment->amount);
            //     } else if ($payment->payment_status_id == 3) {

            //     }
                
            //     $customer->save();
            // }
        }

//        Activity::log_action("Cheque:" . $cheque->bank_id()->name . "-" . $cheque->cheque_no . " (Invoices:" . join(", ", $payment_invoice_codes) . ") - confirmed ");
        Activity::log_action("Cheque Status Changed:" . $cheque->bank_id()->name . "-" . $cheque->cheque_no . " - ".$cheque->cheque_status_id()->name);
        echo json_encode(TRUE);
    } catch (Exception $exc) {
        echo json_encode(FALSE);
//        echo json_encode($exc);
    }
}

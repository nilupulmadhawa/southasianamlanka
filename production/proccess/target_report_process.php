<?php
require_once './../../util/initialize.php';

if (isset($_POST['target_report'])) {
    header('Content-Type: application/json');
    $target_month_id = trim($_POST['month']);
    $target_year = trim($_POST['year']);
    $invoice_start_date =$target_year."-0".$target_month_id."-01%"; 
    $invoice_end_date   =$target_year."-0".$target_month_id."-31%"; 
    function getPayments($id,$date1,$date2 ) {
        $invoices = Invoice::find_all_by_user_id($id,$date1,$date2);

        $achieved = 0;
        $cash = 0;
        $all_cheques = 0;
        $pending_cheques = 0;
        $completed_cheques = 0;

        foreach ($invoices as $invoice) {
            $achieved += $invoice->net_amount;
            $payment_invoices = PaymentInvoice::find_all_by_invoice_id($invoice->id);
            foreach ($payment_invoices as $payment_invoice) {
                $payment = $payment_invoice->payment_id();
                if ($payment->payment_status_id != 3) {
                    if ($payment->payment_method_id == 1) {
                        $cash += $payment->amount;
                    } else if ($payment->payment_method_id == 2) {
                        $all_cheques += $payment->amount;
                        if ($payment->payment_status_id == 1) {
                            $pending_cheques += $payment->amount;
                        } else if ($payment->payment_status_id == 2) {
                            $completed_cheques += $payment->amount;
                        }
                    }
                }
            }
        }

        $arr = array("achieved" => $achieved, "cash" => $cash, "all_cheques" => $all_cheques, "pending_cheques" => $pending_cheques, "completed_cheques" => $completed_cheques);
        return $arr;
    }

    
    function calculateAchievement($target,$user_id,$invoice_start_date,$invoice_end_date){
        $achieved = 0;
        $invoices = Invoice::find_all_by_user_id($user_id,$invoice_start_date,$invoice_end_date);
        foreach ($invoices as $invoice) {
            $achieved += $invoice->net_amount;
        }
        $persentage = ($achieved/$target)*100;
        return number_format((float)$persentage, 2, '.', '');
        
    }
    
    
    $return_details = array();
    foreach (Target::find_targets_by_year_and_month($target_month_id,$target_year) as $target) {
        $target->username = User::find_by_id($target->user_id)->name;
        $target->monthly_target = $target->amount;
        $target->month = TargetMonth::find_by_id($target->target_month_id)->name;
        $target->payments = getPayments($target->user_id,$invoice_start_date,$invoice_end_date);
        $target->persentage = calculateAchievement($target->amount,$target->user_id,$invoice_start_date,$invoice_end_date);
        $return_details[] = $target;
    }
    echo json_encode($return_details);
//    echo json_encode($target_month_id." / ".$target_year);
}
?>
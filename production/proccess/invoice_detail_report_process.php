<?php
require_once './../../util/initialize.php';

if(isset($_POST['invoice_report'])){
    
    $from_date = trim($_POST['from']);
    $to_date   = trim($_POST['to']);
    
    
    function getTotalCost($invoice_id) {
        $total_cost = 0;

        foreach (InvoiceInventory::find_all_by_invoice_id($invoice_id) as $invoice_inventory) {
            $batch = $invoice_inventory->inventory_id()->batch_id();
            $sub_total_cost = ($invoice_inventory->qty) * ($batch->cost);
            $total_cost += $sub_total_cost;
        }

        return $total_cost;
    }
    
    function getFinalTotalCost($invoice_id){
        $total =0;
        $cost = 0;
        $total_cost = getTotalCost($invoice_id);
        $cost +=$total_cost;
        return $cost;
    }

    function calculateInvoiceTotal($from_date,$to_date){
        $invoice_total = 0;
        $invoices = Invoice::find_by_sql("SELECT * FROM invoice WHERE date_time BETWEEN '$from_date' AND '$to_date'");

        foreach ($invoices as $invoice) {
            $invoice_total += $invoice->net_amount;
        }
        return  $invoice_total;
    }
    
    $cost = 0;
    $output =array();
    $invoice_details = Invoice::find_by_sql("SELECT * FROM invoice WHERE date_time BETWEEN '$from_date' AND '$to_date'");
    foreach ($invoice_details as $invoice_detail) {
        
        if($invoice_detail->customer_id){ 
            $invoice_detail->customer_name = Customer::find_by_id($invoice_detail->customer_id)->name;
        }else{
            $invoice_detail->customer_name =  "Retail Customer"; 
        } 

        $invoice_detail->invoice_total = number_format(calculateInvoiceTotal($from_date,$to_date),2);
        $invoice_detail->invoice_cost  = number_format(getTotalCost($invoice_detail->id),2);
        $invoice_detail->final_cost    = number_format($cost+=getTotalCost($invoice_detail->id),2);
        $output[] = $invoice_detail;
        
//       
    }
    
    
    echo json_encode($output);
    
}


    //////////////////////////////////////////////////////////////////////////////////////////////////////////





?>








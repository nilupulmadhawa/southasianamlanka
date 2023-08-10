<?php

require_once './../../util/initialize.php';

if (isset($_POST['customer_invoice_report'])) {

    if (isset($_POST['customer_id']) && $_POST['customer_id'] != "all" && $_POST['customer_id'] != "retail") {
        $customer_id = trim($_POST['customer_id']);

        function getTotalCost($invoice_id) {
            $total_cost = 0;

            foreach (InvoiceInventory::find_all_by_invoice_id($invoice_id) as $invoice_inventory) {
                $batch = $invoice_inventory->inventory_id()->batch_id();
                $sub_total_cost = ($invoice_inventory->qty) * ($batch->cost);
                $total_cost += $sub_total_cost;
            }

            return $total_cost;
        }

        function getFinalTotalCost($invoice_id) {
            $total = 0;
            $cost = 0;
            $total_cost = getTotalCost($invoice_id);
            $cost += $total_cost;
            return $cost;
        }

        function calculateInvoiceTotal($from_date, $to_date) {
            $invoice_total = 0;
            $invoices = Invoice::find_by_sql("SELECT * FROM invoice WHERE customer_id =$customer_id");

            foreach ($invoices as $invoice) {
                $invoice_total += $invoice->net_amount;
            }
            return $invoice_total;
        }

        $invoice_total = 0;
        $cost = 0;
        $output = array();
        $invoice_details = Invoice::find_by_sql("SELECT * FROM invoice WHERE customer_id = $customer_id");
        foreach ($invoice_details as $invoice_detail) {
            if ($invoice_detail->customer_id) {
//                $invoice_detail->invoice_no = $invoice_detail->code;
                $invoice_detail->customer = $invoice_detail->customer_id()->name;
                $invoice_detail->invoice_total = $invoice_total += $invoice_detail->net_amount;
                $invoice_detail->invoice_cost = getTotalCost($invoice_detail->id);
                $invoice_detail->final_cost = $cost += getTotalCost($invoice_detail->id);
                $output[] = $invoice_detail;
                
            }


            
        }
        echo json_encode($output);
    }


//////////////////////////All Invoices///////////////////////////////////////////



    if (isset($_POST['customer_id']) && $_POST['customer_id'] == "all" ) {
        $customer_id = trim($_POST['customer_id']);

        function getTotalCost($invoice_id) {
            $total_cost = 0;

            foreach (InvoiceInventory::find_all_by_invoice_id($invoice_id) as $invoice_inventory) {
                $batch = $invoice_inventory->inventory_id()->batch_id();
                $sub_total_cost = ($invoice_inventory->qty) * ($batch->cost);
                $total_cost += $sub_total_cost;
            }

            return $total_cost;
        }

        function getFinalTotalCost($invoice_id) {
            $total = 0;
            $cost = 0;
            $total_cost = getTotalCost($invoice_id);
            $cost += $total_cost;
            return $cost;
        }

        function calculateInvoiceTotal($from_date, $to_date) {
            $invoice_total = 0;
            $invoices = Invoice::find_all();

            foreach ($invoices as $invoice) {
                $invoice_total += $invoice->net_amount;
            }
            return $invoice_total;
        }

        $invoice_total = 0;
        $cost = 0;
        $output = array();
        $invoice_details = Invoice::find_all();
        foreach ($invoice_details as $invoice_detail) {
           
//                $invoice_detail->invoice_no = $invoice_detail->code;
                if ($invoice_detail->customer_id) { $invoice_detail->customer = $invoice_detail->customer_id()->name;}else{ $invoice_detail->customer =  "Retail Customer";}
                $invoice_detail->invoice_total = $invoice_total += $invoice_detail->net_amount;
                $invoice_detail->invoice_cost = getTotalCost($invoice_detail->id);
                $invoice_detail->final_cost = $cost += getTotalCost($invoice_detail->id);
                $output[] = $invoice_detail;
                
           


            
        }
        echo json_encode($output);
    }



//////////////////////////Retail Invoices///////////////////////////////////////////


    if (isset($_POST['customer_id']) && $_POST['customer_id'] == "retail" ) {
        $customer_id = trim($_POST['customer_id']);

        function getTotalCost($invoice_id) {
            $total_cost = 0;

            foreach (InvoiceInventory::find_all_by_invoice_id($invoice_id) as $invoice_inventory) {
                $batch = $invoice_inventory->inventory_id()->batch_id();
                $sub_total_cost = ($invoice_inventory->qty) * ($batch->cost);
                $total_cost += $sub_total_cost;
            }

            return $total_cost;
        }

        function getFinalTotalCost($invoice_id) {
            $total = 0;
            $cost = 0;
            $total_cost = getTotalCost($invoice_id);
            $cost += $total_cost;
            return $cost;
        }

        function calculateInvoiceTotal($from_date, $to_date) {
            $invoice_total = 0;
            $invoice_details = Invoice::find_by_sql("SELECT * FROM invoice WHERE customer_id is null");

            foreach ($invoices as $invoice) {
                $invoice_total += $invoice->net_amount;
            }
            return $invoice_total;
        }

        $invoice_total = 0;
        $cost = 0;
        $output = array();
        $invoice_details = Invoice::find_by_sql("SELECT * FROM invoice WHERE customer_id is null");
        foreach ($invoice_details as $invoice_detail) {
                $invoice_detail->customer =  "Retail Customer";
                $invoice_detail->invoice_total = number_format($invoice_total += $invoice_detail->net_amount,2);
                $invoice_detail->invoice_cost = number_format(getTotalCost($invoice_detail->id),2);
                $invoice_detail->final_cost = number_format($cost += getTotalCost($invoice_detail->id),2);
                $output[] = $invoice_detail;
                
           


            
        }
        echo json_encode($output);
    }
}



?>








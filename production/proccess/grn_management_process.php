<?php
require_once './../../util/initialize.php';

if(isset($_POST['invoice_report'])){
    
    $from_date = trim($_POST['from']);
    $to_date   = trim($_POST['to']);
    
    
    
   
    
    $cost = 0;
    $output =array();
    $grns = GRN::find_by_sql("SELECT * FROM grn WHERE date_time BETWEEN '$from_date' AND '$to_date'");
    foreach ($grns as $grn) {
        $grn->type_name = $grn->grn_type_id()->name;
        $grn->supplier_name = $grn->supplier_id()->name;
        if($grn->purchase_order_id){$grn->purchase_order_no = $grn->purchase_order_id()->code;}else{$grn->purchase_order_no ="Direct GRN";}
        $grn->user_name = $grn->user_id()->name;
        $output[] = $grn;
        
//       
    }
    
    
    echo json_encode($output);
    
    }

    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    
  if(isset($_POST['invoice_supplier_report'])){
    
    $supplier = trim($_POST['supplier']);
    
    $cost = 0;
    $output =array();
    $grns = GRN::find_by_sql("SELECT * FROM grn WHERE supplier_id = $supplier");
    foreach ($grns as $grn) {
        $grn->type_name = $grn->grn_type_id()->name;
        $grn->supplier_name = $grn->supplier_id()->name;
        if($grn->purchase_order_id){$grn->purchase_order_no = $grn->purchase_order_id()->code;}else{$grn->purchase_order_no ="Direct GRN";}
        $grn->user_name = $grn->user_id()->name;
        $output[] = $grn;
        
//       
    }
    
    
    echo json_encode($output);
    
    } 



?>


    
    




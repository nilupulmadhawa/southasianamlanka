<?php

require_once './../util/initialize.php';

function showgrnproducts($grn_data, $product_id){
    $total = 0;

    foreach (GRNProduct::find_all_by_grn_id($grn_data->id) as $data) {
        if( $data->batch_id()->product_id == $product_id ){
            // echo "<tr style='font-size:10px;'>";
            // echo "<td>GRN</td>";
            // echo "<td style='text-align: center;'>".$data->grn_id()->code."</td>";
            // echo "<td style='text-align: center;'>".$data->grn_id()->date_time."</td>";
            // echo "<td></td>";                                        ;
            // echo "<td style='text-align: center;'>".$data->qty."</td>";
            // echo "<td style='text-align: center;'></td>";
            // echo "<td style='text-align: right;'>".$data->batch_id()->cost."</td>";
            // echo "<td style='text-align: right;'>".$data->batch_id()->retail_price."</td>";
            //
            // echo "</tr>";
            $total = $total + $data->qty;
        }
    }

    return $total;

}


function showinvoiceproducts($grn_data, $product_id){

    $total = 0;

    foreach (InvoiceInventory::find_all_by_invoice_id($grn_data->id) as $data) {
        if( $data->inventory_id()->product_id == $product_id ){
            // echo "<tr style='font-size:10px;'>";
            // echo "<td>INVOICE</td>";
            // echo "<td style='text-align: center;'>".$data->invoice_id()->code."</td>";
            // echo "<td style='text-align: center;'>".$data->invoice_id()->date_time."</td>";
            // echo "<td style='text-align: center;'>".$data->invoice_id()->customer_id()->name."</td>";
            // echo "<td style='text-align: center;'>".$data->qty."</td>";
            // echo "<td style='text-align: center;'></td>";
            // echo "<td style='text-align: right;'>".$data->inventory_id()->batch_id()->cost."</td>";
            // echo "<td style='text-align: right;'>".$data->inventory_id()->batch_id()->retail_price."</td>";
            //
            // echo "</tr>";
            $total = $total + $data->qty;
        }
    }

    return $total;

}

$inventory_qty = 0;
// $_POST['item_name'] = 1;

foreach(Product::find_all() as $data){
  $itemdata[] = $data->id;
}

// foreach($itemdata as $key => $value){
//   echo $value."<br/>";
// }



foreach($itemdata as $key => $value){
    $_POST['item_name'] = $value;
    $item_name = $_POST['item_name'];
    $time = strtotime('2009-01-01');
    $from = date('Y-m-d',$time);
    $to = date("Y-m-d");

    // echo "<tr style='font-size:10px;'>";
    // echo "<td>INITIAL BALANCE</td>";
    // echo "<td style='text-align: center;'>INITIAL</td>";
    // echo "<td style='text-align: center;'> - </td>";
    // echo "<td style='text-align: center;'> - </td>";
    // echo "<td style='text-align: center;' id='initial_balance'> 0 </td>";
    // echo "<td style='text-align: center;'> - </td>";
    // echo "<td style='text-align: center;'> - </td>";
    // echo "<td style='text-align: center;'> - </td>";
    //
    // echo "</tr>";

    $invoice_grn_total = 0;
    foreach (GRN::find_all_by_date_range($from,$to) as $data) {
        $invoice_grn = showgrnproducts( $data, $item_name );
        $invoice_grn_total = $invoice_grn_total + $invoice_grn;
    }

    $invoice_qty_total = 0;
    foreach (Invoice::find_all_by_date_range($from,$to) as $data) {
        $invoice_qty = showinvoiceproducts( $data, $item_name );
        $invoice_qty_total = $invoice_qty_total + $invoice_qty;
    }

    $inventory_qty = 0;
    foreach (Inventory::find_all_by_product_id($_POST['item_name']) as $data) {
        $inventory_qty = $inventory_qty + $data->qty;
    }

    $productD = Product::find_by_id($value);
    echo $productD->name." : ";

    if( $invoice_grn_total < ($invoice_qty_total + $inventory_qty) ){
      echo $invoice_qty_total + $inventory_qty."<br/>";

      $newdata =  new Initial();
      $newdata->product_id  = $value;
      $newdata->batch_id  = 0;
      $newdata->qty  = ($invoice_qty_total + $inventory_qty);
      $newdata->balance_date  = date("Y-m-d");
      $newdata->save();



    }else{
      echo "0 <br/>";
    }

}

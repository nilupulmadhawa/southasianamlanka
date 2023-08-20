<?php
require_once './../util/initialize.php';

// session_start();
// include 'connection.php';
// 	$sql2 = "UPDATE multiprice SET Qty = 0 ";
// 	mysqli_query($conn,$sql2);
// mysqli_close($conn);

	// print_r($_SESSION['po_products']);

// foreach(Inventory::find_all() as $data){
// 	$fix = Batch::find_by_id($data->batch_id);
// }

// foreach(Invoice::find_all_by_rep(12) as $new_data){
//   $allocated_rep = $new_data->customer_id()->allocated_rep;
//   $repname = User::find_by_id($allocated_rep);
//   echo $new_data->code." | ".$new_data->customer_id()->name." | ".$repname->name." <br/>";
// }

// foreach(Product::find_all() as $product){
//   $batch = Batch::find_all_by_product_id($product->id);
//   if( count($batch) > 1 ){
//     echo $product->name.'<br>';
//   }
// }
    
    print_r(Invoice::get_recalculated_invoice_by_id('38'));

?>

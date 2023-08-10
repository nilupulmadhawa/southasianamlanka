<?php

require_once './../util/initialize.php';

function updatestock($rowid,$qty,$reason){

	$data = Inventory::find_by_id($rowid);
	//reuired data
	$ref_id = $data->id;
	$stock_balance = $data->qty + $qty;
	$product_id = $data->product_id;
	$batch_id = $data->batch_id;
	//end of required data

	$data->qty = $data->qty + $qty;
	$product_id = $data->product_id;
	$data->save();

	$adj_data = new StockAdj();
	$adj_data->product_id = $product_id;
	$adj_data->qty = $qty;
	$adj_data->user_id = $_SESSION["user"]["id"];
	$adj_data->reason = $reason;
	$adj_data->save();

	// stock movement update start
	$stock_movement = new StockMovement();
	$stock_movement->type = "stock_adj";
	$stock_movement->ref_id = $ref_id;
	$stock_movement->user_ref = $_SESSION["user"]["id"];
	$stock_movement->qty = $qty;
	$stock_movement->stock_balance = $stock_balance;
	$stock_movement->item_id = $product_id;
	$stock_movement->inventory_id = $ref_id;
	$stock_movement->batch_id = $batch_id;
	$stock_movement->customer_id = "0";
	$stock_movement->save();
	// stock movement update ends

}

$objects = Inventory::find_all();

foreach ($objects as $delivererinventory) {

	$postdata = "row".$delivererinventory->id;
	$resondata = "reason".$delivererinventory->id;

	if(isset($_POST[$postdata])){
		if($_POST[$postdata] != NULL){

			if($_POST[$resondata] == NULL){
				$_POST[$resondata] = "General Reason";
			}

			updatestock( $delivererinventory->id, $_POST[$postdata], $_POST[$resondata] );

		}
	}

}

header('location:stock_adjustment.php');

?>

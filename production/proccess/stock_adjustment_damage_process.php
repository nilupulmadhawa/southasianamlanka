<?php

require_once './../../util/initialize.php';

function updatestock($rowid,$qty,$reason){

	$data = Inventory::find_by_id($rowid);
	$data->qty = $data->qty + $qty;
	$product_id = $data->product_id;
	$data->save();

	$adj_data = new StockAdj();
	$adj_data->product_id = $product_id;
	$adj_data->qty = $qty;
	$adj_data->user_id = $_SESSION["user"]["id"];
  $adj_data->reason = $reason;
	$adj_data->damage = 1;
	$adj_data->save();

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

header('location:../stock_adjustment_damage.php');

?>

<?php

require_once './../../util/initialize.php';

if (isset($_POST['save'])) {

  $current_batch = trim($_POST['current_batch']);
  $product_id = trim($_POST['product']);
  $cost = trim($_POST['cost']);
  $retail_price = trim($_POST['retail_price']);
  $wholesale_price = trim($_POST['wholesale_price']);
  $dollar_rate = trim($_POST['dollar_rate']);
  $stock = trim($_POST['stock']);

  global $database;
  $database->start_transaction();
  try {

    $next_id = Batch::getAutoIncrement();

    $new_batch = new Batch();
    $new_batch->product_id = $product_id;
    $new_batch->code = $next_id;
    $new_batch->cost = $cost;
    $new_batch->retail_price = $retail_price;
    $new_batch->wholesale_price = $wholesale_price;
    $new_batch->dollar_rate = $dollar_rate;
    $new_batch->save();

    $batch_id = Batch::last_insert_id();

    $current_stock = 0;
    $inventory = Inventory::find_by_batch_id($current_batch);
    // $current_stock = $inventory->qty;
    $inventory->qty = 0;
    $inventory->save();

    $new_inventory = new Inventory();
    $new_inventory->qty = $stock;
    $new_inventory->product_id = $product_id;
    $new_inventory->batch_id = $batch_id;
    $new_inventory->save();

    $inventoy_id = Inventory::last_insert_id();

    // stock movement update start
  	$stock_movement = new StockMovement();
  	$stock_movement->type = "batch_update";
  	$stock_movement->ref_id = $batch_id;
  	$stock_movement->user_ref = $_SESSION["user"]["id"];
  	$stock_movement->qty = $stock;
  	$stock_movement->stock_balance = $stock;
  	$stock_movement->item_id = $product_id;
  	$stock_movement->inventory_id = $inventoy_id;
  	$stock_movement->batch_id = $batch_id;
  	$stock_movement->customer_id = "0";
  	$stock_movement->save();
  	// stock movement update ends

    $database->commit();
    Activity::log_action("Batch Updated : ");
    $_SESSION["message"] = "Updated Successfully.";
    Functions::redirect_to("./../batch_price_update.php");
  } catch (Exception $exc) {
    $database->rollback();
    $_SESSION["error"] = "Error..! Failed to do the batch update." . $exc;
    Functions::redirect_to("./../batch_price_update.php");
  }

}

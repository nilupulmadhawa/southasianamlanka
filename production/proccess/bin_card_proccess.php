<?php

require_once './../../util/initialize.php';

if (isset($_POST['bin_card_request'])) {
    $product_id = $database->escape_value($_POST['product_id']);
    $from = $database->escape_value($_POST['from']);
    $to = $database->escape_value($_POST['to']);

    if ($product_id != "" && $from != "" && $to != "") {
        echo json_encode(getByFromTo($product_id, $from, $to));
    } else if ($product_id && ($from == "" || $to == "" )) {
        echo json_encode(getAll($product_id));
    }else{
        echo json_encode(false);
    }
//    echo json_encode(getByFromTo($product_id, $from, $to));
}

function getByFromTo($product_id, $from, $to) {
    $product = Product::find_by_id($product_id);

    global $database;
    $grns = $database->doQuery("SELECT grn.*,grn_product.qty FROM leeshya.grn INNER JOIN grn_product ON grn_product.grn_id=grn.id INNER JOIN batch ON grn_product.batch_id=batch.id WHERE batch.product_id='$product_id' AND grn.date_time BETWEEN '$from' AND '$to' ORDER BY grn.date_time ASC");
    $invoices = $database->doQuery("SELECT invoice.*,invoice_inventory.qty FROM leeshya.invoice INNER JOIN invoice_inventory ON invoice_inventory.invoice_id = invoice.id INNER JOIN inventory ON invoice_inventory.inventory_id = inventory.id INNER JOIN batch ON inventory.batch_id = batch.id WHERE batch.product_id = '$product_id' AND invoice.date_time BETWEEN '$from' AND '$to' ORDER BY invoice.date_time ASC");
    $product_returns = $database->doQuery("SELECT product_return.*,prb.qty FROM leeshya.product_return INNER JOIN product_return_batch AS prb ON prb.product_return_id=product_return.id INNER JOIN batch ON prb.batch_id=batch.id WHERE batch.product_id='$product_id' AND product_return.date_time BETWEEN '$from' AND '$to' ORDER BY product_return.date_time ASC");

    $all_array = [];
    foreach ($grns as $grn) {
        $grn["tbl"] = "grn";
        $all_array[] = $grn;
    }
    foreach ($invoices as $invoice) {
        $invoice["tbl"] = "invoice";
        $all_array[] = $invoice;
    }
    foreach ($product_returns as $product_return) {
        $product_return["tbl"] = "product_return";
        $all_array[] = $product_return;
    }

    $date_time_array = [];
    foreach ($all_array as $index => $value) {
        $date_time_array[$index] = $value["date_time"];
    }
    arsort($date_time_array);

    $final_array = [];
    foreach ($date_time_array as $index => $value) {
//    $final_array[] = $all_array[$index];
        $array = [];
        $array["id"] = $all_array[$index]["id"];
        $array["product"] = $product->name;
        $array["tbl"] = $all_array[$index]["tbl"];
        $array["date_time"] = $all_array[$index]["date_time"];
        $array["qty"] = $all_array[$index]["qty"];
        $final_array[] = $array;
    }

    return $final_array;
}

function getAll($product_id) {
    $product = Product::find_by_id($product_id);

    global $database;
    $grns = $database->doQuery("SELECT grn.*,grn_product.qty FROM leeshya.grn INNER JOIN grn_product ON grn_product.grn_id=grn.id INNER JOIN batch ON grn_product.batch_id=batch.id WHERE batch.product_id='$product_id' ORDER BY grn.date_time ASC");
    $invoices = $database->doQuery("SELECT invoice.*,invoice_inventory.qty FROM leeshya.invoice INNER JOIN invoice_inventory ON invoice_inventory.invoice_id = invoice.id INNER JOIN inventory ON invoice_inventory.inventory_id = inventory.id INNER JOIN batch ON inventory.batch_id = batch.id WHERE batch.product_id = '$product_id' ORDER BY invoice.date_time ASC");
    $product_returns = $database->doQuery("SELECT product_return.*,prb.qty FROM leeshya.product_return INNER JOIN product_return_batch AS prb ON prb.product_return_id=product_return.id INNER JOIN batch ON prb.batch_id=batch.id WHERE batch.product_id='$product_id' AND product_return.date_time ORDER BY product_return.date_time ASC");

    $all_array = [];
    foreach ($grns as $grn) {
        $grn["tbl"] = "grn";
        $all_array[] = $grn;
    }
    foreach ($invoices as $invoice) {
        $invoice["tbl"] = "invoice";
        $all_array[] = $invoice;
    }
    foreach ($product_returns as $product_return) {
        $product_return["tbl"] = "product_return";
        $all_array[] = $product_return;
    }

    $date_time_array = [];
    foreach ($all_array as $index => $value) {
        $date_time_array[$index] = $value["date_time"];
    }
    arsort($date_time_array);

    $final_array = [];
    foreach ($date_time_array as $index => $value) {
//    $final_array[] = $all_array[$index];
        $array = [];
        $array["id"] = $all_array[$index]["id"];
        $array["product"] = $product->name;
        $array["tbl"] = $all_array[$index]["tbl"];
        $array["date_time"] = $all_array[$index]["date_time"];
        $array["qty"] = $all_array[$index]["qty"];
        $final_array[] = $array;
    }

    return $final_array;
}
?>


<?php

require_once './../../util/initialize.php';

if (isset($_POST['cusomer_invoice_request'])) {
    $customer_id = $_POST['customer_id'];
    echo json_encode(Invoice::find_all_by_customer_id($customer_id));
}

if (isset($_POST["batch_request"])) {
    $batch_id = $_POST["batch_id"];
    $batch = Batch::find_by_id($batch_id);
    $batch->product_id = $batch->product_id();
    echo json_encode($batch);
}

if (isset($_POST["total_request"])) {
    echo json_encode(getTotal());
}

function getTotal() {
    $total = 0;
    if (isset($_SESSION["product_return_batches"])) {
        foreach ($_SESSION["product_return_batches"] as $product_return_batch) {
            $sub_total = $product_return_batch["qty"] * $product_return_batch["unit_price"];
            $total += $sub_total;
        }
    }
    return number_format($total, 2);
}

if (isset($_POST["add_batch"])) {
    $product_return_batch = array();
    $product_return_batch["batch_id"] = $_POST["batch_id"];
    $product_return_batch["return_reason_id"] = $_POST["return_reason_id"];
    $product_return_batch["qty"] = $_POST["qty"];
    $product_return_batch["unit_price"] = $_POST["unit_price"];

    if (isset($_SESSION["product_return_batches"])) {
        $_SESSION["product_return_batches"][] = $product_return_batch;
    } else {
        $_SESSION["product_return_batches"] = array();
        $_SESSION["product_return_batches"][] = $product_return_batch;
    }
}

if (isset($_POST["return_batches_request"])) {
    header('Content-Type: application/json');

    $product_return_batches = array();
    if (isset($_SESSION["product_return_batches"])) {
        foreach ($_SESSION["product_return_batches"] as $index => $product_return_batch) {
            $batch = Batch::find_by_id($product_return_batch["batch_id"]);
            $product_return_batch["batch_id"] = $batch->to_array();
            $product_return_batch["batch_id"]["product_id"] = $batch->product_id();
            $product_return_batch["return_reason_id"] = ReturnReason::find_by_id($product_return_batch["return_reason_id"])->name;
            $product_return_batch["index"] = $index;
            $lineTot = $product_return_batch["unit_price"] * $product_return_batch["qty"];
            $product_return_batch["line_total"] = number_format($lineTot, 2);
            $product_return_batches[] = $product_return_batch;
        }
    }

    echo json_encode($product_return_batches);
}

if (isset($_POST["remove_row"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["product_return_batches"][$removeingIndex]);
}

if (isset($_POST["remove_reload"])) {
    header('Content-Type: application/json');
    $index = $_POST["index"];
    $product_return_batch = $_SESSION["product_return_batches"][$index];
    unset($_SESSION["product_return_batches"][$index]);
    echo json_encode($product_return_batch);
}

if (isset($_POST["session_count"])) {
    if (isset($_SESSION["product_return_batches"])) {
        echo json_encode(sizeof($_SESSION["product_return_batches"]));
    }
}


if (isset($_POST["save"])) {
    $array = array();
    $array["deliverer_id"] = $_POST["deliverer_id"];
    $array["customer_id"] = $_POST["customer_id"];
    $array["invoice_id"] = $_POST["invoice_id"];
    $array["note"] = $_POST["note"];
    $array["product_return_batches"] = $_SESSION["product_return_batches"];

    $_SESSION["product_return"] = $array;
    unset($_SESSION["product_return_batches"]);
    echo json_encode(true);
}
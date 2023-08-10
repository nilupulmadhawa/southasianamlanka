<?php

require_once './../../util/initialize.php';
require_once 'system_doctor.php';

if (isset($_POST["delivery_update"])) {
  $delivery_update = $_POST["delivery_update"];

  $invoice = Invoice::find_by_id($delivery_update);
  $invoice->transport = $_POST['transport'];
  $invoice->details = $_POST['details'];
  $invoice->contact = $_POST['contact'];
  $invoice->no_of_packs = $_POST['no_of_packs'];
  $invoice->weight = $_POST['weight'];
  $invoice->paid_amount = $_POST['paid_amount'];
  $invoice->tracking_no = $_POST['tracking_no'];
  $invoice->person = $_POST['person'];
  $invoice->comment = $_POST['comment'];
  $invoice->save();

  Functions::redirect_to("./../deliverer_status.php");
}

if (isset($_GET["write"])) {
  $invoice_data = Invoice::find_by_id($_GET["write"]);
  $invoice_balance = $invoice_data->balance;
  $invoice_data->right_off = 1;
  $invoice_data->invoice_status_id = 2;
  $invoice_data->save();

  // write off function
  $write_off = new WriteOff();
  $write_off->invoice_id = $_GET["write"];
  $write_off->amount = $invoice_balance;
  $write_off->save();

  fix_invoice_balance($_GET["write"]);

  Functions::redirect_to("./../invoice_write_off.php");
}

if (isset($_POST["order_request"])) {
  header('Content-Type: application/json');
  $customer_id = $_POST["customer_id"];
  if ($customer_id) {
    echo json_encode(CustomerOrder::find_all_by_customer_id($customer_id));
  } else {
    echo json_encode(CustomerOrder::find_all());
  }
}

if (isset($_POST["deliverer_inventories_request"])) {
  header('Content-Type: application/json');
  $deliverer_id = $_POST["deliverer_id"];
  $product_id = $_POST["product_id"];

  $deliverer_inventorys = [];

  // foreach (DelivererInventory::find_all_by_deliverer_id_and_product_id_batch_asc($deliverer_id,$product_id) as $deliverer_inventory) {

  //   $inventory = $deliverer_inventory->inventory_id();
  //   $batch = $inventory->batch_id();

  //   $inventory_id = $inventory->to_array();
  //   $inventory_id["batch_id"] = $batch->to_array();

  //   $deliverer_inventory_arr=$deliverer_inventory->to_array();
  //   $deliverer_inventory_arr["inventory_id"]=$inventory_id;
  //   $deliverer_inventorys[]=$deliverer_inventory_arr;

  // }

  foreach(Inventory::find_all_by_product_id($product_id) as $inventory_data){
    $inventory = $inventory_data;
    $batch = $inventory->batch_id();

    $inventory_id = $inventory->to_array();
    $inventory_id["batch_id"] = $batch->to_array();

    $deliverer_inventory_arr=$inventory_data->to_array();
    $deliverer_inventory_arr["inventory_id"]=$inventory_id;
    $deliverer_inventorys[]=$deliverer_inventory_arr;

  }


  echo json_encode($deliverer_inventorys);
}

if (isset($_POST["inventory_request"])) {
  header('Content-Type: application/json');
  $deliverer_inventory_id = $_POST["deliverer_inventory_id"];

  // $batch_details = Batch::find_by_product_id_last($deliverer_inventory_id);

  $deliverer_inventory = Inventory::find_by_batch_id($deliverer_inventory_id);

  $batch = $deliverer_inventory->batch_id();
  $batch->avl_qty = $deliverer_inventory->qty;
  $batch->discount_limit = $deliverer_inventory->product_id()->discount_limit;

  echo json_encode($batch);
}


if (isset($_POST["invoice_inventories"])) {
  header('Content-Type: application/json');
  $customer_id = $_POST["customer_id"];
  if ($customer_id) {
    echo json_encode(CustomerOrder::find_all_by_customer_id($customer_id));
  } else {
    echo json_encode(CustomerOrder::find_all());
  }
}
if (isset($_POST["add_product"])) {
  echo "done";
  $deliverer_inventory_id = $_POST['deliverer_inventory_id'];
  $inventory_id = Inventory::find_by_batch_id($deliverer_inventory_id)->id;
  $price = $_POST['price'];
  $qty = $_POST['qty'];
  $freeissue = $_POST['freeissue'];
  //    $unit_discount = (!empty($_POST['unit_discount']))? $_POST['unit_discount']:0;
  $unit_discount = $_POST['unit_discount'];
  // $product_total = $_POST['product_total'];

  $val = 100 - $unit_discount;
  $val = $val/100;

  // $product_total = ($price*$qty) - ($unit_discount*$qty);
  $product_total = ($price*$qty) * ($val);

  $invoice_inventory = array();
  $invoice_inventory["deliverer_inventory_id"] = $inventory_id;
  $invoice_inventory["inventory_id"] = $inventory_id;
  $invoice_inventory["qty"] = $qty;
  $invoice_inventory["price"] = $price;
  $invoice_inventory["unit_discount"] = $unit_discount;
  $invoice_inventory["product_total"] = $product_total;
  $invoice_inventory["freeissue"] = $freeissue;

  if (isset($_SESSION["invoice_inventories"])) {
    $_SESSION["invoice_inventories"][] = $invoice_inventory;
  } else {
    $_SESSION["invoice_inventories"] = array();
    $_SESSION["invoice_inventories"][] = $invoice_inventory;
  }
}

if (isset($_POST["inventorys_request"])) {
  header('Content-Type: application/json');

  $invoice_inventories = array();
  if (isset($_SESSION["invoice_inventories"])) {

    foreach ($_SESSION["invoice_inventories"] as $index => $invoice_inventory) {
                 $inventory = Inventory::find_by_id($invoice_inventory["inventory_id"]);
      // $deliverer_inventory = DelivererInventory::find_by_id($invoice_inventory["deliverer_inventory_id"]);
      // $inventory = $deliverer_inventory->inventory_id();

      $invoice_inventory["batch_id"] = $inventory->batch_id();
      $invoice_inventory["product_id"] = $inventory->product_id()->name;
      // $invoice_inventory["discounted_unit_price"] = $invoice_inventory["price"] - $invoice_inventory["unit_discount"];
      $invoice_inventory["discounted_unit_price"] = $invoice_inventory["unit_discount"];

      $invoice_inventories[] = $invoice_inventory;
    }
  }

  echo json_encode($invoice_inventories);
}

if (isset($_POST["remove_inventory"])) {
  $removeingIndex = $_POST["index"];
  //    unset($_SESSION["invoice_inventories"][$removeingIndex]);

  $array=[];
  if (isset($_POST["remove_inventory"])) {
    foreach ($_SESSION["invoice_inventories"] as $index => $sess_inv) {
      //            if ($removeingIndex == $sess_inv["inventory_id"]) {
      if ($removeingIndex == $sess_inv["deliverer_inventory_id"]) {
        unset($_SESSION["invoice_inventories"][$index]);

        $array["deliverer_inventory_id"]=$sess_inv["deliverer_inventory_id"];
        $deliverer_inventory= DelivererInventory::find_by_id($sess_inv["deliverer_inventory_id"]);
        $array["product_id"]=$deliverer_inventory->inventory_id()->batch_id()->product_id;

      }
    }
  }
  echo json_encode($array);
}

if (isset($_POST["batch_request"])) {
  $batch_id = $_POST["batch_id"];
  echo json_encode(Batch::find_by_id($batch_id));
}

if (isset($_POST["total_request"])) {
  $total = 0;

  if (isset($_SESSION["invoice_inventories"])) {
    foreach ($_SESSION["invoice_inventories"] as $invoice_inventory) {
      $total += $invoice_inventory["product_total"];
    }
  }

  echo json_encode($total);
}

if (isset($_POST["load_invoice_inventories"])) {
  unset($_SESSION["invoice_inventories"]);
  $customer_order_id = $_POST["customer_order_id"];
  $deliverer_id = $_POST["deliverer_id"];
  $_SESSION["invoice_inventories"] = fillSession($customer_order_id, $deliverer_id);
}

function fillSession($customer_order_id, $deliverer_id) {

  $invoice_inventorys = array();

  $customer_order_products = CustomerOrderProduct::find_all_by_customer_order_id($customer_order_id);
  foreach ($customer_order_products as $customer_order_product) {
    $requested_qty = $customer_order_product->qty;

    $batches_exp = array();
    $deliverer_inventorys = array();
    $db_deliverer_inventorys = DelivererInventory::find_all_by_deliverer_id_product_id($deliverer_id, $customer_order_product->product_id);
    foreach ($db_deliverer_inventorys as $db_deliverer_inventory) {
      if ($db_deliverer_inventory->qty > 0) {
        $deliverer_inventorys[$db_deliverer_inventory->id] = $db_deliverer_inventory;

        $batch = Batch::find_by_inventory_id($db_deliverer_inventory->inventory_id);

        $batches_exp[$db_deliverer_inventory->id] = $batch->exp;
      }
    }

    //            $batch_keys = array_keys($batches_exp, min($batches_exp));

    asort($batches_exp);

    $final_deliverer_inventorys = array();
    $added_qty = 0;
    foreach ($batches_exp as $key => $value) {
      $temp_deliverer_inventory = $deliverer_inventorys[$key];
      if ($added_qty < $requested_qty) {
        $final_deliverer_inventorys[] = $temp_deliverer_inventory;
        $added_qty += $temp_deliverer_inventory->qty;
      }
    }

    $final_added_qty = 0;
    foreach ($final_deliverer_inventorys as $deliverer_inventory) {
      if ($final_added_qty < $requested_qty) {
        $invoice_inventory = array();
        $invoice_inventory["deliverer_inventory_id"] = $deliverer_inventory->id;
        $invoice_inventory["inventory_id"] = $deliverer_inventory->inventory_id;

        $batch = Batch::find_by_inventory_id($deliverer_inventory->inventory_id);

        $invoice_inventory["price"] = $batch->wholesale_price;

        $invoice_inventory["unit_discount"] = 0;

        $difference = $requested_qty - $final_added_qty;
        if ($deliverer_inventory->qty >= $difference) {
          $invoice_inventory["qty"] = $difference;
          $final_added_qty += $difference;
        } else {
          $invoice_inventory["qty"] = $deliverer_inventory->qty;
          $final_added_qty += $deliverer_inventory->qty;
        }

        $invoice_inventory["product_total"] = ($invoice_inventory["price"] - $invoice_inventory["unit_discount"]) * $invoice_inventory["qty"];

        $invoice_inventorys[] = $invoice_inventory;
      }
    }
  }



  return $invoice_inventorys;
}

if (isset($_POST["check_Inventory"])) {
  $checking_id = $_POST["id"];
  $availability = false;
  if (isset($_SESSION["invoice_inventories"])) {
    foreach ($_SESSION["invoice_inventories"] as $value) {
      if ($value["deliverer_inventory_id"] == $checking_id) {
        $availability = true;
      }
    }
  }
  echo json_encode($availability);
}

if (isset($_POST["session_count"])) {
  $count = false;
  if (isset($_SESSION["invoice_inventories"])) {
    //        echo json_encode(sizeof($_SESSION["invoice_inventories"]));
    $count = sizeof($_SESSION["invoice_inventories"]);
  }
  echo json_encode($count);
}

if (isset($_POST["check_qty"]) && isset($_SESSION["invoice_inventories"])) {
  $customer_order_id = $_POST["customer_order_id"];
  $deliverer_id = $_POST["deliverer_id"];

  $errors = array();
  $errors[] = 'Following product quantities are needed for the selected Customer order';

  $customer_order_products = CustomerOrderProduct::find_all_by_customer_order_id($customer_order_id);
  foreach ($customer_order_products as $customer_order_product) {
    $qty = $customer_order_product->qty;
    $product = $customer_order_product->product_id();

    $count = 0;
    foreach (DelivererInventory::find_all_by_deliverer_id_product_id($deliverer_id, $product->id) as $deliverer_inventory) {
      foreach ($_SESSION["invoice_inventories"] as $invoice_inventory) {
        if ($deliverer_inventory->inventory_id == $invoice_inventory["inventory_id"]) {
          $count += $invoice_inventory["qty"];
        }
      }
    }

    if ($count < $qty) {
      $errors[] = '* ' . $product->name . ' - ' . ($qty - $count);
    }
  }

  echo json_encode($errors);
}

//function save_invoice_inventories($invoice_id) {
//    try {
//        if (isset($_SESSION["invoice_inventories"])) {
//            $invoice_inventories = $_SESSION["invoice_inventories"];
//            foreach ($invoice_inventories as $key => $sess_invoice_inventory) {
//                $deliverer_inventory = DelivererInventory::find_by_id($sess_invoice_inventory["deliverer_inventory_id"]);
//                $deliverer_inventory->qty = ($deliverer_inventory->qty) - ($sess_invoice_inventory["qty"]);
//
//                $inventory = $deliverer_inventory->inventory_id();
//                $inventory->qty = ($inventory->qty) - ($sess_invoice_inventory["qty"]);
//
//                $invoice_inventory = new InvoiceInventory();
//                $invoice_inventory->invoice_id = $invoice_id;
//                $invoice_inventory->inventory_id = $inventory->id;
//                $invoice_inventory->qty = $sess_invoice_inventory["qty"];
//                $invoice_inventory->price = $sess_invoice_inventory["price"];
//                $invoice_inventory->unit_discount = ($sess_invoice_inventory["unit_discount"]) ? $sess_invoice_inventory["unit_discount"] : 0;
//                $invoice_inventory->gross_amount = ($invoice_inventory->qty) * ($invoice_inventory->price);
//                $invoice_inventory->net_amount = ($invoice_inventory->qty) * (($invoice_inventory->price) - ($invoice_inventory->unit_discount));
//                $invoice_inventory->save();
//
//                $deliverer_inventory->save();
//                $inventory->save();
//            }
//            unset($_SESSION["invoice_inventories"]);
//        }
//    } catch (Exception $exc) {
////        echo $exc->getTraceAsString();
//        throw new Exception($exc->getMessage());
//    }
//}
//if (isset($_POST["save"])) {
//    $user_id = $_SESSION["user"]["id"];
//    $code = $_POST["code"];
//    $deliverer_id = $_POST["deliverer_id"];
//    $gross_amount = $_POST["gross_amount"];
//    $net_amount = $_POST["net_amount"];
//    $balance = $_POST["balance"];
//    $cash = $net_amount - $balance;
//    $invType = $_POST["invType"];
//    $date_time = date('Y-m-d H:i:s');
//
////    id, code, date_time, invoice_id, invoice_status_id, gross_amount, net_amount, balance, customer_order_id, customer_id, invoice_type_id
//
//    $invoice = new Invoice();
//    $invoice->code = $code;
//    $invoice->date_time = $date_time;
//
//    $invoice->gross_amount = $gross_amount;
//    $invoice->net_amount = $net_amount;
//    $invoice->balance = $balance;
//    $invoice->user_id = $user_id;
//    $invoice->invoice_type_id = 1;
//
//    if ($invType == "invType1") {
//        $order_customer_id = $_POST["order_customer_id"];
//        $order_id = $_POST["order_id"];
//        $invoice->customer_id = $order_customer_id;
//        $invoice->customer_order_id = $order_id;
//    } else if ($invType == "invType2") {
//        $customer_id = $_POST["customer_id"];
//        $invoice->customer_id = $customer_id;
//    } else if ($invType == "invType3") {
//        $invoice->invoice_type_id = 2;
//    }
//
//    if ($balance > 0) {
//        $invoice->invoice_status_id = 1;
//    } else {
//        $invoice->invoice_status_id = 2;
//    }
//
//    global $database;
//    $database->start_transaction();
//    try {
//        $invoice->save();
//        $inserted_invoice_id = Invoice::last_insert_id();
//        save_invoice_inventories($inserted_invoice_id);
//
//        if ($cash > 0) {
//            $payment_cash = new Payment();
//            $payment_cash->code = Payment::getNextCode();
//            $payment_cash->amount = $cash;
//            $payment_cash->date_time = $date_time;
//            $payment_cash->invoice_id = $inserted_invoice_id;
//            $payment_cash->payment_method_id = 1;
//            $payment_cash->payment_status_id = 2;
//            $payment_cash->user_id = $user_id;
//            $payment_cash->save();
//
//            $inserted_payment_id = Payment::last_insert_id();
//            $payment_invoice = new PaymentInvoice();
//            $payment_invoice->payment_id = $inserted_payment_id;
//            $payment_invoice->invoice_id = $inserted_invoice_id;
//            $payment_invoice->amount = $cash;
//            $payment_invoice->save();
//        }
//
////        if ($balance > 0) {
////            $payment_credit = new Payment();
////            $payment_credit->code = Payment::getNextCode();
////            $payment_credit->amount = $balance;
////            $payment_credit->date_time = $date_time;
////            $payment_credit->invoice_id = $inserted_invoice_id;
////            $payment_credit->payment_method_id = 2;
////            $payment_credit->payment_status_id = 1;
////            $payment_credit->user_id = $user_id;
////            $payment_credit->save();
////        }
//
//        $database->commit();
//        Activity::log_action("Invoice (Code:" . $invoice_payment->code . ") - saved ");
//        $_SESSION["invoice_id"] = $inserted_invoice_id;
//        Functions::redirect_to("./../invoice_prev.php");
//    } catch (Exception $exc) {
//        $database->rollback();
//        $_SESSION["error"] = "Failed to save invoice";
//        Functions::redirect_to("./../invoice.php");
//    }
//}

if (isset($_POST["save"])) {
  $formData = $_POST["formData"];
  if (isset($_SESSION["invoice_return"]["invoice"])) {
    unset($_SESSION["invoice_return"]["invoice"]);
  }

  $array = array();
  $array['code'] = $formData["code"];
  $array['deliverer_id'] = $formData["deliverer_id"];
  $array['gross_amount'] = $formData["gross_amount"];
  $array['net_amount'] = $formData["net_amount"];
  $array['balance'] = $formData["balance"];
  $array['invType'] = $formData["invType"];
  $array['invType1'] = 1;
  $array['date_time'] = date('Y-m-d H:i:s');
  // $array['date_time'] = $formData["date_time"];
  $array['cash'] = $formData["net_amount"] - $formData["balance"];

  $array['order_id'] = (isset($formData["order_id"])) ? $formData["order_id"] : false;
  $array['order_customer_id'] = (isset($formData["order_customer_id"])) ? $formData["order_customer_id"] : false;
  $array['customer_id'] = (isset($formData["customer_id"])) ? $formData["customer_id"] : false;

  $array['invoice_inventories'] = $_SESSION["invoice_inventories"];
  unset($_SESSION["invoice_inventories"]);

  $_SESSION["invoice"] = $array;
  echo json_encode($array['order_id']);
}


if (isset($_POST["recalculate"])) {
  $invoices = Invoice::find_all();
  try {
    foreach ($invoices as $db_invoice) {
      $invoice = Invoice::get_recalculated_invoice_by_id($db_invoice->id);
      $invoice->save();
    }
    //        Activity::log_action("Invoice (Code:" . $invoice_payment->code . ") - saved ");
    $_SESSION["message"] = "Successfully re-calculated invoice balances!";
    Functions::redirect_to("./../invoice_management.php");
  } catch (Exception $exc) {
    $_SESSION["error"] = "Failed to re-calculated invoice balances";
    Functions::redirect_to("./../invoice_management.php");
  }
}

if (isset($_POST["find_invoice_by_code"])) {
  $code = $_POST["code"];
  $invoice = Invoice::find_by_code($code);
  echo json_encode(($invoice) ? $invoice->id : FALSE);
}

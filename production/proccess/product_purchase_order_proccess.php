<?php

require_once './../../util/initialize.php';

if (isset($_POST["po_product_request"])) {
  $po_products = array();
  if (isset($_SESSION["po_products"])) {
    header('Content-Type: application/json');
    //        $_SESSION["po_products"] = array_values($_SESSION["po_products"]);


    foreach ($_SESSION["po_products"] as $index => $po_product) {
      $product = Product::find_by_id($po_product["product_id"]);

      // find the dollar rate
      // if($po_product["dollar_rate"] != 0){
      //   $dollar_rate_update = $po_product["dollar_rate"];
      // }else{
      //   $batch = Batch::find_dollar_rate($po_product["product_id"]);
      //   $dollar_rate_update = $batch->dollar_rate;
      // }

      $dollar_rate_update = $po_product["dollar_rate"];


      $po_product["product_id"] = $product->name;
      $po_product["brand"] = $product->brand;
      $po_product["description"] = $product->description;
      $po_product["category"] = $product->category_id()->name;
      $po_product["index"] = $index;
      $po_product["dollar_rate"] = $dollar_rate_update;
      // $po_product["cost"] = $batch->cost;


      $po_products[] = $po_product;
    }
  }
  echo json_encode($po_products);
}

if (isset($_POST["addProduct"])) {
  $po_product = array();
  $po_product["product_id"] = $_POST['product_id'];
  $po_product["qty"] = $_POST['qty'];
  $po_product["dollar_rate"] = $_POST['dollar'];

  if($_POST['dollar'] == 0){
    if($data = Batch::find_by_product_id_last($_POST['product_id'])){
      $po_product["dollar_rate"] = $data->dollar_rate;
    }
  }

  if (isset($_SESSION["po_products"])) {
    $_SESSION["po_products"][] = $po_product;
  } else {
    $_SESSION["po_products"] = array();
    $_SESSION["po_products"][] = $po_product;
  }
}

if (isset($_POST["addProduct2"])) {
  $po_product = array();
  // $po_product["product_id"] = $_POST['product_id'];
  // $po_product["qty"] = $_POST['qty'];
  // $po_product["dollar_rate"] = $_POST['dollar'];
  // alert($_POST['brand']);
  echo "done";

  $status = 0;

  foreach(Product::find_by_brand($_POST['brand']) as $data){
    $roq = $data->roq;
    $batch = Batch::find_by_product_id_last($data->id);
    foreach(Inventory::find_all_by_product_id( $data->id ) as $data2){
      if($roq > $data2->qty){
        $po_product["product_id"] = $data->id;
        $po_product["qty"] = ($roq - $data2->qty);
        $po_product["dollar_rate"] = $batch->dollar_rate;
        $status = 1;
      }
    }

  }

  if($status == 1){
    if (isset($_SESSION["po_products"])) {
      $_SESSION["po_products"][] = $po_product;
    } else {
      $_SESSION["po_products"] = array();
      $_SESSION["po_products"][] = $po_product;
    }
  }

}

if (isset($_POST["remove"])) {
  $removeingIndex = $_POST["index"];
  unset($_SESSION["po_products"][$removeingIndex]);
}

if (isset($_POST["session_count"])) {
  if (isset($_SESSION["po_products"])) {
    echo json_encode(sizeof($_SESSION["po_products"]));
  }
}

if (isset($_POST["check_product"])) {
  $checking_product_id = $_POST["id"];
  $availability=FALSE;
  if (isset($_SESSION["po_products"])) {
    foreach ($_SESSION["po_products"] as $key => $value) {
      if ($value["product_id"] == $checking_product_id) {
        $availability = TRUE;
      }
    }
  }
  echo json_encode($availability);
}

if (isset($_POST["clearPOProducts"])) {
  if (isset($_SESSION["po_products"])) {
    unset($_SESSION["po_products"]);
  }
}

if (isset($_POST["save"])) {
  $supplier_id = $_POST["supplier_id"];
  $code = $_POST["code"];
  $date = date("Y-m-d");
  $user_id = $_SESSION["user"]["id"];

  $purchase_order = new PurchaseOrder();
  $purchase_order->purchase_order_type_id = 1;
  $purchase_order->purchase_order_status_id = 1;
  $purchase_order->supplier_id = $supplier_id;
  $purchase_order->code = $code;
  $purchase_order->date = $date;
  $purchase_order->user_id = $user_id;

  try {
    $purchase_order->save();
    $inserted_po_id = PurchaseOrder::last_insert_id();
    try {
      if (isset($_SESSION["po_products"])) {
        foreach ($_SESSION["po_products"] as $index => $po_product) {
          $purchase_order_product = new PurchaseOrderProduct();
          $purchase_order_product->purchase_order_id = $inserted_po_id;
          $purchase_order_product->product_id = $po_product["product_id"];
          $purchase_order_product->qty = $po_product["qty"];
          $purchase_order_product->save();
        }
      }
      unset($_SESSION["po_products"]);
      Activity::log_action("Product Purchase Order - saved : " . $purchase_order->code);
      $_SESSION["message"] = "Successfully saved";
      Functions::redirect_to('./../product_purchase_order.php');
    } catch (Exception $exc) {
      //            $inserted_po = PurchaseOrder::find_by_id($inserted_po_id);
      //            $inserted_po->delete();
      $_SESSION["error"] = "Failed to save Purchase Order";
      Functions::redirect_to('./../product_purchase_order.php');
    }
  } catch (Exception $exc) {
    $_SESSION["error"] = "Failed to save Purchase Order";
    Functions::redirect_to('./../product_purchase_order.php');
  }
}

if (isset($_POST["update"])) {
  $id = $_POST["id"];
  $purchase_order = PurchaseOrder::find_by_id($id);
  //    $purchase_order->purchase_order_type_id = 1;
  //    $purchase_order->purchase_order_status_id = 1;
  $purchase_order->supplier_id = $_POST["supplier_id"];
  //    $purchase_order->code = $_POST["code"];
  //    $purchase_order->date = date("Y-m-d");
  $purchase_order->user_id = $_SESSION["user"]["id"];

  try {
    $current_purchase_order_products = PurchaseOrderProduct::find_all_by_purchase_order_id($id);
    foreach ($current_purchase_order_products as $value) {
      $value->delete();
    }

    $purchase_order->save();

    try {
      if (isset($_SESSION["po_products"])) {
        foreach ($_SESSION["po_products"] as $index => $po_product) {
          $purchase_order_product = new PurchaseOrderProduct();
          $purchase_order_product->purchase_order_id = $id;
          $purchase_order_product->product_id = $po_product["product_id"];
          $purchase_order_product->qty = $po_product["qty"];
          $purchase_order_product->save();
        }
      }
      unset($_SESSION["po_products"]);
      Activity::log_action("Product Purchase Order - updated : " . $purchase_order->code);
      $_SESSION["message"] = "Successfully updated";
      Functions::redirect_to('./../product_purchase_order.php');
    } catch (Exception $exc) {
      $_SESSION["error"] = "Failed to update Purchase Order";
      Functions::redirect_to('./../product_purchase_order.php');
    }
  } catch (Exception $exc) {
    $_SESSION["error"] = "Failed to save Purchase Order";
    Functions::redirect_to('./../product_purchase_order.php');
  }
}

if (isset($_POST["delete"])) {
  $id = $_POST["id"];
  $purchase_order = PurchaseOrder::find_by_id($id);

  try {
    $current_purchase_order_products = PurchaseOrderProduct::find_all_by_purchase_order_id($purchase_order->id);
    foreach ($current_purchase_order_products as $value) {
      $value->delete();
    }

    try {
      $purchase_order->delete();
      Activity::log_action("Product Purchase Order - deleted : " . $purchase_order->code);
      unset($_SESSION["po_products"]);
      $_SESSION["message"] = "Successfully deleted";
      Functions::redirect_to('./../product_purchase_order.php');
    } catch (Exception $exc) {
      $_SESSION["error"] = "Failed to delet Purchase Order";
      Functions::redirect_to('./../product_purchase_order.php');
    }
  } catch (Exception $exc) {
    $_SESSION["error"] = "Failed to delete Purchase Order";
    Functions::redirect_to('./../product_purchase_order.php');
  }
}
?>

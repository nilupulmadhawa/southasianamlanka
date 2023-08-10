<?php

require_once './../../util/initialize.php';

if (isset($_POST["customer_order_product_request"])) {
    if (isset($_SESSION["customer_order_products"])) {
        header('Content-Type: application/json');
        $customer_order_products = array();
        foreach ($_SESSION["customer_order_products"] as $index => $customer_order_product) {
            $product = Product::find_by_id($customer_order_product["product_id"]);
            $customer_order_product["product_id"] = $product->name;
            $customer_order_product["category"] = $product->category_id()->name;
            $customer_order_product["index"] = $index;

            $customer_order_products[] = $customer_order_product;
        }

        echo json_encode($customer_order_products);
    }
}

if (isset($_POST["add_customer_product"])) {
    $customer_order_product = array();
    $customer_order_product["product_id"] = $_POST['product_id'];
    $customer_order_product["qty"] = $_POST['qty'];

    if (isset($_SESSION["customer_order_products"])) {
        $_SESSION["customer_order_products"][] = $customer_order_product;
    } else {
        $_SESSION["customer_order_products"] = array();
        $_SESSION["customer_order_products"][] = $customer_order_product;
    }
}

if (isset($_POST["remove"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["customer_order_products"][$removeingIndex]);
}

if (isset($_POST["check_customer_product"])) {
    $checking_product_id = $_POST["id"];
    $availability;
    if (isset($_SESSION["customer_order_products"])) {
        foreach ($_SESSION["customer_order_products"] as $key => $value) {
            if ($value["product_id"] == $checking_product_id) {
                $availability = true;
            }
        }
    }
    echo json_encode($availability);
}

if (isset($_POST["clear_customer_order_products"])) {
    if (isset($_SESSION["customer_order_products"])) {
        unset($_SESSION["customer_order_products"]);
    }
}

////////////////////////////////////////////////////

if (isset($_POST["save"])) {
    $date = date('Y-m-d H:i:s');

    $customer_order = new CustomerOrder();
    $customer_order->code = $_POST["code"];
    $customer_order->date_time = $date;
    $customer_order->customer_order_status_id = 1;
    $customer_order->customer_id = $_POST["customer_id"];
    $customer_order->user_id = $_SESSION["user"]["id"];

    global $database;
    $database->start_transaction();
    try {
        $customer_order->save();
        $inserted_customer_order_id = CustomerOrder::last_insert_id();
        if (isset($_SESSION["customer_order_products"])) {
            foreach ($_SESSION["customer_order_products"] as $index => $ses_customer_order_product) {
                $customer_order_product = new CustomerOrderProduct();
                $customer_order_product->customer_order_id = $inserted_customer_order_id;
                $customer_order_product->product_id = $ses_customer_order_product["product_id"];
                $customer_order_product->qty = $ses_customer_order_product["qty"];
                $customer_order_product->save();
            }
        }
        unset($_SESSION["customer_order_products"]);
        
        $database->commit();
        Activity::log_action("Customer Order - saved:" . $customer_order->code);
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to('./../customer_order.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save Order";
        Functions::redirect_to('./../customer_order.php');
    }
    
}

if (isset($_POST["update"])) {
    $customer_order_id = $_POST["id"];
    $customer_order = CustomerOrder::find_by_id($customer_order_id);
    $customer_order->customer_id = $_POST["customer_id"];
    $customer_order->user_id = $_SESSION["user"]["id"];

    global $database;
    $database->start_transaction();
    try {
        $current_customer_order_products = CustomerOrderProduct::find_all_by_customer_order_id($customer_order_id);
        foreach ($current_customer_order_products as $value) {
            $value->delete();
        }

        $customer_order->save();
        $inserted_customer_order_id = $customer_order_id;
        if (isset($_SESSION["customer_order_products"])) {
            foreach ($_SESSION["customer_order_products"] as $index => $ses_customer_order_product) {
                $customer_order_product = new CustomerOrderProduct();
                $customer_order_product->customer_order_id = $inserted_customer_order_id;
                $customer_order_product->product_id = $ses_customer_order_product["product_id"];
                $customer_order_product->qty = $ses_customer_order_product["qty"];
                $customer_order_product->save();
            }
        }
        unset($_SESSION["customer_order_products"]);
        
        $database->commit();
        Activity::log_action("Customer Order - updated:" . $customer_order->code);
        $_SESSION["message"] = "Successfully updated";
        Functions::redirect_to('./../customer_order.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to update Order";
        Functions::redirect_to('./../customer_order.php');
    }
    
}

if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    $customer_order = CustomerOrder::find_by_id($id);

    try {
        $current_customer_order_products = CustomerOrderProduct::find_all_by_customer_order_id($customer_order->id);
        foreach ($current_customer_order_products as $value) {
            $value->delete();
        }

        try {
            $customer_order->delete();
            unset($_SESSION["customer_order_products"]);
            Activity::log_action("Customer Order - deleted:" . $customer_order->code);
            $_SESSION["message"] = "Successfully deleted";
            Functions::redirect_to('./../customer_order.php');
        } catch (Exception $exc) {
            $_SESSION["error"] = "Failed to delet Purchase Order";
            Functions::redirect_to('./../customer_order.php');
        }
    } catch (Exception $exc) {
        $_SESSION["error"] = "Failed to delete Purchase Order";
        Functions::redirect_to('./../customer_order.php');
    }
}
?>
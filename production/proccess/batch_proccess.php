<?php

require_once './../../util/initialize.php';

if(isset($_POST['brand_name'])){

  $discount = $_POST['discount'];
  foreach (Product::find_by_brand($_POST['brand_name']) as $data) {
    $data->discount_limit = $discount;

    try {
        $data->save();
        Activity::log_action("Product Discount saved To :- " . $data->name. " as :". $discount);
        $_SESSION["message"] = "Successfully Discount saved.";

    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to save Discount.";

    }

  }

  Functions::redirect_to("../product_management.php");

}


if (isset($_POST['save'])) {
    if (Functions::check_privilege_redirect("Batch", "ins", "./../index.php")) {
        $batch = new Batch();

        $batch->code = trim($_POST['code']);
        $batch->mfd = trim($_POST['mfd']);
        $batch->exp = trim($_POST['exp']);
        $batch->cost = trim($_POST['cost']);
        $batch->retaill_price = trim($_POST['retaill_price']);
        $batch->whole_sale_price = trim($_POST['whole_sale_price']);

        try {
            $batch->save();
            Activity::log_action("Batch saved - " . $batch->code);
            $_SESSION["message"] = "Successfully saved.";
            Functions::redirect_to("../batch.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to save.";
            Functions::redirect_to("../batch.php");
        }
    }
}

if (isset($_POST['update'])) {
    if (Functions::check_privilege_redirect("Batch", "upd", "./../index.php")) {
        $batch = Batch::find_by_id($_POST['id']);
        // $batch->mfd = trim($_POST['mfd']);
        // $batch->exp = trim($_POST['exp']);
        $batch->cost = trim($_POST['cost']);
        $batch->retail_price = trim($_POST['retail_price']);
        $batch->whole_sale_price = trim($_POST['wholesale_price']);

        try {
            $batch->save();
            Activity::log_action("Batch updated - " . $batch->code);
            $_SESSION["message"] = "Successfully updated.";
            Functions::redirect_to("../batch.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to update.";
            Functions::redirect_to("../batch.php");
        }
    }
}


if (isset($_POST['delete'])) {
    if (Functions::check_privilege_redirect("Batch", "del", "./../index.php")) {
        $batch = Batch::find_by_id($_POST["id"]);

        try {
            $batch->delete();
            Activity::log_action("Batch deleted - " . $batch->code);
            $_SESSION["message"] = "Successfully deleted.";
            Functions::redirect_to("../batch.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to delete.";
            Functions::redirect_to("../batch.php");
        }
    }
}
?>

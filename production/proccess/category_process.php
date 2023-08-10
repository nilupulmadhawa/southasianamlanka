<?php

require_once './../../util/initialize.php';

if (isset($_POST['save'])) {
    if (Functions::check_privilege_redirect("Category", "ins", "./../index.php")) {
        $category = new Category();
        $category->name = trim($_POST['name']);

        try {
            $category->save();
            Activity::log_action("Category saved - " . $category->name);
            $_SESSION["message"] = "Successfully saved.";
            Functions::redirect_to("./../category_management.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to save.";
            Functions::redirect_to("./../category_management.php");
        }
    }
}

if (isset($_POST['update'])) {
    if (Functions::check_privilege_redirect("Category", "upd", "./../index.php")) {
        $category = Category::find_by_id($_POST['id']);
        $category->name = trim($_POST['name']);

        try {
            $category->save();
            Activity::log_action("Category updated - " . $category->name);
            $_SESSION["message"] = "Successfully updated.";
            Functions::redirect_to("./../category_management.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to update.";
            Functions::redirect_to("./../category_management.php");
        }
    }
}


if (isset($_POST['delete'])) {
    if (Functions::check_privilege_redirect("Category", "del", "./../index.php")) {
        $category = Category::find_by_id($_POST["id"]);
        try {
            $category->delete();
            Activity::log_action("Category deleted - " . $category->name);
            $_SESSION["message"] = "Successfully deleted.";
            Functions::redirect_to("./../category_management.php");
        } catch (Exception $exc) {
            $products = Product::find_all_by_category_id($category->id);
            if (!empty($products)) {
                $_SESSION["error"] = "Could not delete.. Products already added to the selected category";
                Functions::redirect_to("./../category_management.php");
            } else {
                $_SESSION["error"] = "Error..! Failed to deleted.";
                Functions::redirect_to("./../category_management.php");
            }
        }
    }
}
?>


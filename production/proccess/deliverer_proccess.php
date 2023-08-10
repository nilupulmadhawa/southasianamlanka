<?php

require_once './../../util/initialize.php';

if (isset($_POST["user_request"])) {
    $users = array();
    if (isset($_SESSION["deliverer_users"])) {
        header('Content-Type: application/json');


        foreach ($_SESSION["deliverer_users"] as $index => $user) {
            $user["user_id"] = User::find_by_id($user["user_id"])->name;
            $user["index"] = $index;
            $users[] = $user;
        }
    }
    echo json_encode($users);
}

if (isset($_POST["add_user"])) {
    $user = array();
    $user["user_id"] = $_POST['user_id'];

    if (isset($_SESSION["deliverer_users"])) {
        $_SESSION["deliverer_users"][] = $user;
    } else {
        $_SESSION["deliverer_users"] = array();
        $_SESSION["deliverer_users"][] = $user;
    }
}

if (isset($_POST["remove"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["deliverer_users"][$removeingIndex]);
}

if (isset($_POST["check_user"])) {
    $checking_id = $_POST["id"];
    $availability=FALSE;
    if (isset($_SESSION["deliverer_users"])) {
        foreach ($_SESSION["deliverer_users"] as $key => $value) {
            if ($value["user_id"] == $checking_id) {
                $availability = true;
            }
        }
    }
    echo json_encode($availability);
}

if (isset($_POST["clear_users"])) {
    if (isset($_SESSION["deliverer_users"])) {
        unset($_SESSION["deliverer_users"]);
    }
}

if (isset($_POST["save"])) {
    $deliverer = new Deliverer();
    $deliverer->route_id = $_POST["route_id"];
    $deliverer->number = $_POST["number"];
    $deliverer->name = $_POST["name"];

    try {
        $deliverer->save();
        $inserted_deliverer_id = Deliverer::last_insert_id();
        try {
            if (isset($_SESSION["deliverer_users"])) {
                foreach ($_SESSION["deliverer_users"] as $index => $ses_users) {
                    $deliverer_user = new DelivererUser();
                    $deliverer_user->user_id = $ses_users["user_id"];
                    $deliverer_user->deliverer_id = $inserted_deliverer_id;
                    $deliverer_user->save();
                }
            }
            unset($_SESSION["deliverer_users"]);
            Activity::log_action("Deliverer - saved : " . $inserted_deliverer_id);
            $_SESSION["message"] = "Successfully saved";
            Functions::redirect_to('./../deliverer.php');
        } catch (Exception $exc) {
//            $inserted_po = PurchaseOrder::find_by_id($inserted_po_id);
//            $inserted_po->delete();
            $_SESSION["error"] = "Failed to save deliverer";
            Functions::redirect_to('./../deliverer.php');
        }
    } catch (Exception $exc) {
        $_SESSION["error"] = "Failed to save deliverer";
        Functions::redirect_to('./../deliverer.php');
    }
}

if (isset($_POST["update"])) {
    $deliverer = Deliverer::find_by_id($_POST["id"]);
    $deliverer->route_id = $_POST["route_id"];
    $deliverer->number = $_POST["number"];
    $deliverer->name = $_POST["name"];

    try {
        $current_deliverer_user = DelivererUser::find_all_by_deliverer_id($deliverer->id);
        foreach ($current_deliverer_user as $value) {
            $value->delete();
        }

        $deliverer->save();

        try {
            if (isset($_SESSION["deliverer_users"])) {
                foreach ($_SESSION["deliverer_users"] as $index => $ses_users) {
                    $deliverer_user = new DelivererUser();
                    $deliverer_user->user_id = $ses_users["user_id"];
                    $deliverer_user->deliverer_id = $deliverer->id;
                    $deliverer_user->save();
                }
            }
            unset($_SESSION["deliverer_users"]);
            Activity::log_action("deliverer - updated : " . $deliverer->id);
            $_SESSION["message"] = "Successfully updated";
            Functions::redirect_to('./../deliverer.php');
        } catch (Exception $exc) {
            $_SESSION["error"] = "Failed to update deliverer";
            Functions::redirect_to('./../deliverer.php');
        }
    } catch (Exception $exc) {
        $_SESSION["error"] = "Failed to save deliverer";
        Functions::redirect_to('./../deliverer.php');
    }
}

if (isset($_POST["delete"])) {
    $deliverer = Deliverer::find_by_id($_POST["id"]);

    try {
        $current_deliverer_user = DelivererUser::find_all_by_deliverer_id($deliverer->id);
        foreach ($current_deliverer_user as $value) {
            $value->delete();
        }

        try {
            $deliverer->delete();
            Activity::log_action("deliverer - deleted : " . $deliverer->id);
            unset($_SESSION["deliverer_users"]);
            $_SESSION["message"] = "Successfully deleted";
            Functions::redirect_to('./../deliverer.php');
        } catch (Exception $exc) {
            $_SESSION["error"] = "Failed to delet deliverer";
            Functions::redirect_to('./../deliverer.php');
        }
    } catch (Exception $exc) {
        $_SESSION["error"] = "Failed to delete deliverer";
        Functions::redirect_to('./../deliverer.php');
    }
}
?>
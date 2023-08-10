<?php

require_once './../../util/initialize.php';

if (isset($_POST["purchase_order_request"])) {
    $purchase_order_id = $_POST["purchase_order_id"];
    $purchase_order = PurchaseOrder::find_by_id($purchase_order_id);
    $purchase_order->supplier_id = $purchase_order->supplier_id()->name;
    echo json_encode($purchase_order);
}


if (isset($_POST["reload_materials"])) {
    $purchase_order_id = $_POST["purchase_order_id"];
    $grn_materials = array();
    foreach (PurchaseOrderMaterial::find_all_by_purchase_order_id($purchase_order_id) as $index => $po_material) {
        $grn_material = $po_material->to_array();
        $grn_materials[] = $grn_material;
    }
    $_SESSION["material_grn_materials"] = $grn_materials;
}

if (isset($_POST["grn_material_request"])) {
    header('Content-Type: application/json');
    $grn_materials = array();
    if (isset($_SESSION["material_grn_materials"])) {
        foreach ($_SESSION["material_grn_materials"] as $index => $grn_material) {
            $material = Material::find_by_id($grn_material["material_id"]);
            $temp_grn_material = $grn_material;
            $temp_grn_material["material"] = $material->name;
            $temp_grn_material["index"] = $index;
            $grn_materials[] = $temp_grn_material;
        }
    }

    echo json_encode($grn_materials);
}

if (isset($_POST["check_material"])) {
    $checking_product_id = $_POST["id"];
    $availability;
    if (isset($_SESSION["material_grn_materials"])) {
        foreach ($_SESSION["material_grn_materials"] as $key => $value) {
            if ($value["material_id"] == $checking_product_id) {
                $availability = true;
            }
        }
    }
    echo json_encode($availability);
}

if (isset($_POST["addGRNMaterial"])) {
    $index = $_POST['index'];
    $material_id = $_POST['material_id'];
    $volume = $_POST['volume'];
    $unit_price = $_POST['unit_price'];

    $grn_material = new GRNMaterial();
    $grn_material->material_id = $material_id;
    $grn_material->volume = $volume;
    $grn_material->unit_price = $unit_price;
    $grn_material = $grn_material->to_array();

    if ($index !== "") {
        $_SESSION["material_grn_materials"][$index] = $grn_material;
    } else {
        if (isset($_SESSION["material_grn_materials"])) {
            $_SESSION["material_grn_materials"][] = $grn_material;
        } else {
            $_SESSION["material_grn_materials"] = array();
            $_SESSION["material_grn_materials"][] = $grn_material;
        }
    }
}




if (isset($_POST["remove_material"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["material_grn_materials"][$removeingIndex]);
}

if (isset($_POST["material_request"])) {
    header('Content-Type: application/json');
    $index = $_POST["index"];

    $grn_material = $_SESSION["material_grn_materials"][$index];
    $grn_material["index"] = $index;
    echo json_encode($grn_material);
}

if (isset($_POST["session_count"])) {
    if (isset($_SESSION["material_grn_materials"])) {
        echo json_encode(sizeof($_SESSION["material_grn_materials"]));
    }
}

if (isset($_POST["material_errors"])) {
    header('Content-Type: application/json');
    $errors = array();
//    $errors[]="Price is invalid :";
    foreach ($_SESSION["material_grn_materials"] as $index => $grn_material) {
        if (empty($grn_material["unit_price"])) {
            $errors[] = Material::find_by_id($grn_material["material_id"])->name;
        }
    }

    if (empty($errors)) {
        echo json_encode(FALSE);
    } else {
        echo json_encode($errors);
    }
}


//if (isset($_POST["save"])) {
//    $grn_id = $_POST["grn_id"];
//    $po_id = $_POST["po_id"];
//
//    echo $grn_id;
//    echo "</br>";
//    echo $po_id;
//}

if (isset($_POST["save"])) {
    $code = $_POST["grn_code"];
    $purchase_order_id = $_POST["purchase_order_id"];
    $supplier_id = $_POST["supplier_id"];
//    $date = date("Y-m-d");
    $date = date('Y-m-d H:i:s');
    $user_id = $_SESSION["user"]["id"];

    $grn = new GRN();
    $grn->code = $code;
    if ($purchase_order_id) {
        $grn->purchase_order_id = $purchase_order_id;
    }
    $grn->date_time = $date;
    $grn->user_id = $user_id;
    $grn->grn_type_id = 2;
    $grn->supplier_id = $supplier_id;

    global $database;
    $database->start_transaction();
    try {
        $grn->save();
        $inserted_grn_id = GRN::last_insert_id();

        if (isset($_SESSION["material_grn_materials"])) {
            foreach ($_SESSION["material_grn_materials"] as $index => $ses_grn_material) {
                $grn_material = new GRNMaterial();
                $grn_material->grn_id = $inserted_grn_id;
                $grn_material->material_id = $ses_grn_material["material_id"];
                $grn_material->volume = $ses_grn_material["volume"];
                $grn_material->unit_price = $ses_grn_material["unit_price"];
                $grn_material->user_id = $user_id;
                $grn_material->save();

                $inserted_grn_material_id = GRNMaterial::last_insert_id();

                $material_stock = MaterialStock::find_by_grn_material_id($inserted_grn_material_id);
                if (!$material_stock) {
                    $material_stock = new MaterialStock();
                    $material_stock->material_id = $ses_grn_material["material_id"];
                    $material_stock->volume = $ses_grn_material["volume"];
                    $material_stock->grn_material_id = $inserted_grn_material_id;
                    $material_stock->save();
                } else {
                    $material_stock->volume = ($material_stock->volume) + $ses_grn_material["volume"];
                    $material_stock->save();
                }

                if ($purchase_order_id) {
                    $purchase_order = PurchaseOrder::find_by_id($purchase_order_id);
                    $purchase_order->purchase_order_status_id = 2;
                    $purchase_order->save();
                }
            }
        }
        unset($_SESSION["material_grn_materials"]);

        $database->commit();
        Activity::log_action("Material GRN - saved : " . $grn->code);
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to('./../material_grn.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save GRN";
        Functions::redirect_to('./../material_grn.php');
    }
}

function isOkToUpdate($grn_id) {
//    $validation = TRUE;
//    $grn_materials = GRNMaterial::find_all_by_grn_id($grn_id);
//    foreach ($grn_materials as $index => $grn_material) {
//        $grn_material_volume = $grn_material->qty;
//        $material_stock_volume = MaterialStock::find_by_grn_material_id($grn_material->id)->volume;
//        if ($grn_material_volume != $material_stock_volume) {
//            $validation = FALSE;
//        }
//    }
    
    $validation = TRUE;
    if ($grn_materials = GRNMaterial::find_all_by_grn_id($grn_id)) {
        foreach ($grn_materials as $temp_grn_material) {
            $grn_material_volume = $temp_grn_material->volume;
            $stock_volume = MaterialStock::find_by_grn_material_id($temp_grn_material->id)->volume;
            if ($grn_material_volume != $stock_volume) {
                $validation = FALSE;
            }
        }
    }

    return $validation;
}

if (isset($_POST["update"])) {
    $grn_id = $_POST["grn_id"];
    $purchase_order_id = $_POST["po_id"];
    $date = date('Y-m-d H:i:s');
    $user_id = $_SESSION["user"]["id"];
    $supplier_id = $_POST["supplier_id"];

    $grn = GRN::find_by_id($grn_id);
    $grn->date_time = $date;
    $grn->user_id = $user_id;
    $grn->supplier_id = $supplier_id;

    global $database;
    $database->start_transaction();
    if (isOkToUpdate($grn->id)) {
        try {
            foreach (GRNMaterial::find_all_by_grn_id($grn->id) as $index => $db_grn_material) {
                $material_stock = MaterialStock::find_by_grn_material_id($db_grn_material->id);
                $material_stock->volume = ($material_stock->volume) - ($db_grn_material->volume);
//                $material_stock->save();
                $material_stock->delete();
                $db_grn_material->delete();
            }

            $grn->save();
            $inserted_grn_id = $grn_id;
            if (isset($_SESSION["material_grn_materials"])) {
                foreach ($_SESSION["material_grn_materials"] as $index => $ses_grn_material) {
                    $grn_material = new GRNMaterial();
                    $grn_material->grn_id = $inserted_grn_id;
                    $grn_material->material_id = $ses_grn_material["material_id"];
                    $grn_material->volume = $ses_grn_material["volume"];
                    $grn_material->unit_price = $ses_grn_material["unit_price"];
                    $grn_material->user_id = $user_id;
                    $grn_material->save();

                    $inserted_grn_material_id = GRNMaterial::last_insert_id();

                    $material_stock = MaterialStock::find_by_grn_material_id($inserted_grn_material_id);
                    if (!$material_stock) {
                        $material_stock = new MaterialStock();
                        $material_stock->material_id = $ses_grn_material["material_id"];
                        $material_stock->volume = $ses_grn_material["volume"];
                        $material_stock->grn_material_id = $inserted_grn_material_id;
                    } else {
                        $material_stock->volume = ($material_stock->volume) + $ses_grn_material["volume"];
                    }
                    $material_stock->save();
                }
            }
            unset($_SESSION["material_grn_materials"]);

            $database->commit();
            Activity::log_action("Material GRN - updated : " . $grn->code);
            $_SESSION["message"] = "Successfully updated";
            Functions::redirect_to('./../grn_management.php');
        } catch (Exception $exc) {
            $database->rollback();
            $_SESSION["error"] = "Failed to update GRN";
            $_SESSION["error"] = $exc;
            Functions::redirect_to('./../grn_management.php');
        }
    } else {
        $_SESSION["error"] = "Can't edit GRN, Productions already added to materials related to the GRN you tried to edit.";;
        Functions::redirect_to("./../grn_management.php");
    }
}
?>
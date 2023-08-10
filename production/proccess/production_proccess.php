<?php

require_once './../../util/initialize.php';

if (isset($_POST["production_material_request"])) {
    $production_materials = array();
    if (isset($_SESSION["production_materials"])) {
        header('Content-Type: application/json');

        foreach ($_SESSION["production_materials"] as $index => $ses_production_material) {
            $ses_production_material["material_id"] = Material::find_by_id($ses_production_material['material_id'])->name;
            $ses_production_material["index"] = $index;
            $production_materials[] = $ses_production_material;
        }
    }
    echo json_encode($production_materials);
}

if (isset($_POST["add_production_material"])) {
    $production_material = array();
    $production_material["material_id"] = $_POST['material_id'];
    $production_material["volume"] = $_POST['volume'];
    $production_material["wastage"] = $_POST['wastage'];

    if (isset($_SESSION["production_materials"])) {
        $_SESSION["production_materials"][] = $production_material;
    } else {
        $_SESSION["production_materials"] = array();
        $_SESSION["production_materials"][] = $production_material;
    }
}

if (isset($_POST["session_count"])) {
    if (isset($_SESSION["production_materials"])) {
        echo json_encode(sizeof($_SESSION["production_materials"]));
    }
}

if (isset($_POST["remove"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["production_materials"][$removeingIndex]);
}

if (isset($_POST["check_material"])) {
    $checking_id = $_POST["id"];
    $availability=FALSE;
    if (isset($_SESSION["production_materials"])) {
        foreach ($_SESSION["production_materials"] as $key => $value) {
            if ($value["material_id"] == $checking_id) {
                $availability = true;
            }
        }
    }
    echo json_encode($availability);
}

if (isset($_POST["clearProductionMaterial"])) {
    if (isset($_SESSION["production_materials"])) {
        unset($_SESSION["production_materials"]);
    }
}

if (isset($_POST["save"])) {
    $production = new Production();
    $production->code = trim($_POST['code']);
    $production->date = trim($_POST['date']);
    $production->description = trim($_POST['description']);
    $production->production_status_id = 1;

    global $database;
    $database->start_transaction();
    try {
        $production->save();
        $production_id = Production::last_insert_id();

        if (isset($_SESSION["production_materials"])) {
            foreach ($_SESSION["production_materials"] as $index => $sess_production_materials) {
                $production_material = new ProductionMaterial();
                $production_material->production_id = $production_id;
                $production_material->material_id = $sess_production_materials["material_id"];
                $production_material->volume = $sess_production_materials["volume"];
                $production_material->wastage = $sess_production_materials["wastage"];
                $production_material->save();
            }
            unset($_SESSION["production_materials"]);
        }

        $database->commit();
        Activity::log_action("Production - saved:" . $recipie_id);
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to('../production.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save Production Plan";
        Functions::redirect_to('../production.php');
    }
}

if (isset($_POST["update"])) {
    $production_id = $_POST["production_id"];
    $production = Production::find_by_id($production_id);
    $production->date = trim($_POST['date']);
    $production->description = trim($_POST['description']);

    global $database;
    $database->start_transaction();
    try {
        $production->save();

        foreach (ProductionMaterial::find_all_by_production_id($production->id) as $productionmaterial) {
            $productionmaterial->delete();
        }

        if (isset($_SESSION["production_materials"])) {
            foreach ($_SESSION["production_materials"] as $index => $sess_production_materials) {
                $production_material = new ProductionMaterial();
                $production_material->production = $production->id;
                $production_material->material_id = $sess_production_materials["material_id"];
                $production_material->volume = $sess_production_materials["volume"];
                $production_material->wastage = $sess_production_materials["wastage"];
                $production_material->save();
            }
            unset($_SESSION["production_materials"]);
        }

        $database->commit();
        Activity::log_action("Production - Updated:" . $recipie_id->id);
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to('../production_management.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to update Production Plan";
        Functions::redirect_to('../production_management.php');
    }
}


if (isset($_POST["delete"])) {
    $production_id = $_POST["production_id"];
    $production = Production::find_by_id($production_id);

    global $database;
    $database->start_transaction();
    try {
        foreach (ProductionMaterial::find_all_by_production_id($production->id) as $productionmaterial) {
            $productionmaterial->delete();
        }

        $production->delete();

        unset($_SESSION["production_materials"]);
        $database->commit();
        Activity::log_action("Production - deleted:" . $id);
        $_SESSION["message"] = "Successfully Deleted";
        Functions::redirect_to('../production_management.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to delete Production Plan";
        Functions::redirect_to('../production_management.php');
    }
}
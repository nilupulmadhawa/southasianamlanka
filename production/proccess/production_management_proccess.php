<?php

require_once './../../util/initialize.php';


if (isset($_POST['cancel_production'])) {
    $production_id = $_POST["production_id"];
    $production = Production::find_by_id($production_id);
    $production->production_status_id = 3;

    global $database;
    $database->start_transaction();
    try {
        $production->save();
        foreach (ProductionMaterialStock::find_all_by_production_id($production->id) as $production_material_stock) {
            $material_stock = $production_material_stock->material_stock_id();
            $material_stock->volume = ($material_stock->volume) + ($production_material_stock->volume);
            $material_stock->save();
        }
        
        $database->commit();
        Activity::log_action("Production - cancelled : ".$production->id);
        echo json_encode(TRUE);
    } catch (Exception $exc) {
        $database->rollback();
        echo json_encode(FALSE);
    }
}

if (isset($_POST["authenticate"])) {
    $password=$_POST["password"];
    echo json_encode(Session::authenticate_password($password));
}
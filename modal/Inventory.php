<?php

require_once __DIR__ . '/../util/initialize.php';

class Inventory extends DatabaseObject {

    protected static $table_name = "inventory";
    protected static $db_fields = array();
    protected static $db_fk = array("product_id" => "Product", "batch_id" => "Batch");

    public function product_id(){
        return parent::get_fk_object("product_id");
    }

    public function batch_id() {
        return parent::get_fk_object("batch_id");
    }


    public static function find_all_zero() {
        global $database;
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE qty = 0 ");
        return $object_array;
    }

    public static function find_all_not_in_deliverer_inventory() {
        $object_array = self::find_by_sql("SELECT * FROM inventory i WHERE i.id NOT IN (SELECT inventory_id FROM deliverer_inventory di WHERE di.inventory_id=i.id )");
        return $object_array;
    }

    public static function find_all_calculated_qty() {
        $final_inventorys = [];
        $inventorys = parent::find_all();
        foreach ($inventorys as $inventory) {
            $deliverer_inventory_qty = 0;
            $deliverer_inventorys = DelivererInventory::find_all_by_inventory_id($inventory->id);
            foreach ($deliverer_inventorys as $deliverer_inventory) {
                $deliverer_inventory_qty += (int)$deliverer_inventory->qty;
            }

            $new_qty = (int) $inventory->qty - (int) $deliverer_inventory_qty;
            if ($new_qty < 0) {
                $inventory->qty = 0;
            } else {
                $inventory->qty = $new_qty;
            }
            $final_inventorys[]=$inventory;
        }
        return $final_inventorys;
    }

    public static function find_all_calculated_qty_batch_id($value) {
        $final_inventorys = [];
        $inventorys = self::find_all_by_batch_id($value);
        foreach ($inventorys as $inventory) {
            $deliverer_inventory_qty = 0;
            $deliverer_inventorys = DelivererInventory::find_all_by_inventory_id($inventory->id);
            foreach ($deliverer_inventorys as $deliverer_inventory) {
                $deliverer_inventory_qty += (int)$deliverer_inventory->qty;
            }

            $new_qty = (int) $inventory->qty - (int) $deliverer_inventory_qty;
            if ($new_qty < 0) {
                $inventory->qty = 0;
            } else {
                $inventory->qty = $new_qty;
            }
            $final_inventorys[]=$inventory;
        }
        return $final_inventorys;
    }

//    public static function find_all_by_batch_id_not_in_deliverer_inventory($value) {
//        global $database;
//        $value = $database->escape_value($value);
//        $object_array = self::find_by_sql("SELECT * FROM inventory i WHERE i.id NOT IN (SELECT inventory_id FROM deliverer_inventory di WHERE di.inventory_id=i.id ) AND i.batch_id=$value");
//        return $object_array;
//    }

    public static function find_all_by_product_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " INNER JOIN batch ON batch.id=" . self::$table_name . ".batch_id WHERE batch.product_id ='$value'");
        return $object_array;
    }    

    public static function find_by_product_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE product_id='$value'");
        return array_shift($object_array);
    }

    public static function find_by_batch_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE batch_id='$value'");
        return array_shift($object_array);
    }

    public static function find_by_batch_id_($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE batch_id='$value'");
        return array_shift($object_array);
    }

    public static function find_all_by_batch_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE batch_id='$value'");
        return $object_array;
    }

    public static function find_batch_by_inventory_id($inventory_id) {
        $inventory = Inventory::find_by_id($inventory_id);

        $batch = new Batch();
        if ($inventory->inventory_type_id == 1) {
            $inventory_grn_product = InventoryGRNProduct::find_by_inventory_id($inventory->id);
            $batch = $inventory_grn_product->grn_product_id()->batch_id();
        } else if ($inventory->inventory_type_id == 2) {
            $inventory_production_product = InventoryProductionProduct::find_by_inventory_id($inventory->id);
            $batch = $inventory_production_product->production_product_id()->batch_id();
        }

        return $batch;
    }

    public static function find_all_by_category_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = $database->doQuery("SELECT inventory.*,SUM(inventory.qty) AS tot FROM inventory INNER JOIN batch ON batch.id=inventory.batch_id INNER JOIN product ON product.id=batch.product_id WHERE product.category_id=$value GROUP BY inventory.batch_id");
        return $object_array;
    }

    public static function find_all_by_batch_id_category_id($value, $value1) {
        global $database;
        $value = $database->escape_value($value);
        $value1 = $database->escape_value($value1);
        $object_array = self::find_by_sql("SELECT * FROM inventory INNER JOIN batch ON batch.id=inventory.batch_id INNER JOIN product ON product.id=batch.product_id WHERE product.category_id = $value AND inventory.batch_id= $value1");
        return $object_array;
    }

    public static function find_all_by_product_asc() {
        $object_array = self::find_by_sql("SELECT inventory.* FROM ".self::$table_name." INNER JOIN batch ON batch.id=inventory.batch_id INNER JOIN product ON product.id=batch.product_id ORDER BY product.name ASC");
        return $object_array;
    }

    public static function find_all_calculated_qty_by_product_id($value) {
        global $database;
        $value = $database->escape_value($value);

        $final_inventorys = [];
        $inventorys = self::find_all_by_product_id($value);
        foreach ($inventorys as $inventory) {
            $deliverer_inventory_qty = 0;
            $deliverer_inventorys = DelivererInventory::find_all_by_inventory_id($inventory->id);
            foreach ($deliverer_inventorys as $deliverer_inventory) {
                $deliverer_inventory_qty += (int)$deliverer_inventory->qty;
            }

            $new_qty = (int) $inventory->qty - (int) $deliverer_inventory_qty;
            if ($new_qty > 0) {
                $inventory->qty = $new_qty;
                $final_inventorys[]=$inventory;
            }
        }
        return $final_inventorys;
    }

    // chinthaka edits

    public static function find_all_inv_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id='$value'");
        return $object_array;
    }

}
<?php
require_once __DIR__.'/../util/initialize.php';

class GRN extends DatabaseObject{
    protected static $table_name="grn";
    protected static $db_fields=array();
    protected static $db_fk=array("purchase_order_id"=>"PurchaseOrder", "user_id"=>"User", "grn_type_id"=>"GRNType", "supplier_id"=>"Supplier");


    public function purchase_order_id(){
        return parent::get_fk_object("purchase_order_id");
    }

    public function user_id(){
        return parent::get_fk_object("user_id");
    }

    public function grn_type_id(){
        return parent::get_fk_object("grn_type_id");
    }

    public function supplier_id(){
        return parent::get_fk_object("supplier_id");
    }

    public static function getNextCode() {
        $auto_increment=parent::getAutoIncrement();
        return $auto_increment;
    }

    public static function find_all_by_purchase_order_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE purchase_order_id='$value'");
        return array_shift($object_array);
    }

    public static function find_all_by_date($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE DATE(date_time) = '$value' ");
        return $object_array;
    }

    public static function find_all_by_date_range($value,$value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE date_time BETWEEN '$value' AND '$value1'");
        return $object_array;
    }

    public static function find_all_by_product_id_date_range($product_id,$from,$to){
        global $database;
        $product_id=$database->escape_value($product_id);
        $from=$database->escape_value($from);
        $to=$database->escape_value($to);
        $object_array=self::find_by_sql("SELECT grn.* FROM ".self::$table_name." INNER JOIN grn_product ON grn_product.grn_id=grn.id INNER JOIN batch ON grn_product.batch_id=batch.id WHERE batch.product_id='$product_id' AND grn.date_time BETWEEN '$from' AND '$to' ORDER BY grn.date_time ASC");
        return $object_array;
    }

    public static function find_if_invoices_added_by_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT grn.* FROM grn INNER JOIN grn_product ON grn_product.grn_id=grn.id INNER JOIN inventory_grn_product AS igp ON igp.grn_product_id=grn_product.id INNER JOIN invoice_inventory ON invoice_inventory.inventory_id=igp.inventory_id WHERE grn.id='1'");
        return array_shift($object_array);
    }

    public static function find_if_deliver_inventories_added_by_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT grn.* FROM grn INNER JOIN grn_product ON grn_product.grn_id=grn.id INNER JOIN inventory_grn_product AS igp ON igp.grn_product_id=grn_product.id INNER JOIN deliverer_inventory ON deliverer_inventory.inventory_id=igp.inventory_id WHERE grn.id='1'");
        return array_shift($object_array);
    }

    public static function find_if_invoice_return_inventories_added_by_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT grn.* FROM grn INNER JOIN grn_product ON grn_product.grn_id=grn.id INNER JOIN inventory_grn_product AS igp ON igp.grn_product_id=grn_product.id INNER JOIN invoice_return_inventory ON invoice_return_inventory.inventory_id=igp.inventory_id WHERE grn.id='1'");
        return array_shift($object_array);
    }
}

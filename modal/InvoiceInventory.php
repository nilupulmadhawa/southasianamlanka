<?php
require_once __DIR__.'/../util/initialize.php';

class InvoiceInventory extends DatabaseObject{
    protected static $table_name="invoice_inventory";
    protected static $db_fields=array(); 
    protected static $db_fk=array("invoice_id"=>"Invoice", "inventory_id"=>"Inventory");
    
//    id, invoice_id, inventory_id, qty, price, unit_discount, net_amount, gross_amount
    
    public function invoice_id(){
        return parent::get_fk_object("invoice_id");
    }
    
    public function inventory_id(){
        return parent::get_fk_object("inventory_id");
    }
    
    public static function find_all_by_product_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT invoice_inventory.qty FROM invoice_inventory INNER JOIN inventory ON invoice_inventory.inventory_id = inventory.id WHERE product_id = '$value' ");
        return $object_array;
    }


    public static function find_all_by_product_id_invoice($value, $value2, $value3){
        global $database;

        $value=$database->escape_value($value);
        $value2=$database->escape_value($value2);
        $value3=$database->escape_value($value3);

        $object_array=self::find_by_sql("SELECT invoice_inventory.qty, invoice_inventory.net_amount FROM invoice_inventory INNER JOIN invoice ON invoice_inventory.invoice_id = invoice.id INNER JOIN inventory ON invoice_inventory.inventory_id = inventory.id WHERE product_id = '$value' AND date_time BETWEEN '$value2' AND '$value3' ");
        return $object_array;
    }

    public static function find_all_by_invoice_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE invoice_id='$value'");
        return $object_array;
    }
    
    public static function find_all_by_inventory_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE inventory_id='$value'");
        return $object_array;
    }
    
    public static function find_by_invoice_id_inventory_id($value,$value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE invoice_id='$value' AND inventory_id='$value1'");
        return array_shift($object_array);
    }
    
    public static function find_all_by_invoice_id_inventory_id($value,$value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE invoice_id='$value' AND inventory_id='$value1'");
        return array_shift($object_array);
    }
    
}

?>
<?php
require_once __DIR__.'/../util/initialize.php';

class ProductionMaterialStock extends DatabaseObject{
    protected static $table_name="production_material_stock";
    protected static $db_fields=array(); 
    protected static $db_fk=array("production_id"=>"Production", "material_stock_id"=>"MaterialStock");
        
    public function production_id(){
        return parent::get_fk_object("production_id");
    }
    
    public function material_stock_id(){
        return parent::get_fk_object("material_stock_id");
    }
    
    public static function find_all_by_production_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE production_id='$value'");
        return $object_array;
    }
}

?>
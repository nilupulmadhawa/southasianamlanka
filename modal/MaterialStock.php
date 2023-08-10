<?php
require_once __DIR__.'/../util/initialize.php';

class MaterialStock extends DatabaseObject{
    protected static $table_name="material_stock";
    protected static $db_fields=array(); 
    protected static $db_fk=array("material_id"=>"Material", "grn_material_id"=>"GrnMaterial");
    
//    public $id;
//    public $volume;
//    public $material_id;
//    public $grn_material_id;
    
    public function material_id(){
        return parent::get_fk_object("material_id");
    }
    
    public function grn_material_id(){
        return parent::get_fk_object("grn_material_id");
    }
    
    public static function find_all_by_material_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE material_id='$value'");
        return $object_array;
    }
    
    public static function find_by_grn_material_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE grn_material_id='$value'");
        return array_shift($object_array);
    }
    
    public static function array_find_all_group_by_material_id() {
        global $database;
//        $object_array = $database->doQuery("SELECT material_stock.*,SUM(material_stock.volume) AS total_volume FROM leeshya.material_stock GROUP BY material_stock.material_id");
        $object_array = $database->doQuery("SELECT material_stock.*,SUM(material_stock.volume) AS total_volume FROM material_stock GROUP BY material_stock.material_id");
        return $object_array;
    }
            
}

?>
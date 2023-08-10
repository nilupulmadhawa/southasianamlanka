<?php
require_once __DIR__.'/../util/initialize.php';

class GRNMaterial extends DatabaseObject{
    protected static $table_name="grn_material";
    protected static $db_fields=array(); 
    protected static $db_fk=array("grn_id"=>"GRN","material_id"=>"Material","user_id"=>"User");
    
//    public $id;
//    public $grn_id;
//    public $material_id;
//    public $volume;
//    public $unit_price;
//    public $user_id;
        
    public function grn_id(){
        return parent::get_fk_object("grn_id");
    }
    
    public function material_id(){
        return parent::get_fk_object("material_id");
    }
    
    public function user_id(){
        return parent::get_fk_object("user_id");
    }
    
    public static function find_all_by_grn_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE grn_id='$value'");
        return $object_array;
    }
}

?>
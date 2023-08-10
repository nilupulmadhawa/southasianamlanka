<?php
require_once __DIR__.'/../util/initialize.php';

class ProductionMaterial extends DatabaseObject{
    protected static $table_name="production_material";
    protected static $db_fields=array(); 
    protected static $db_fk=array("production_id"=>"Production","material_id"=>"Material");
    
//    public $id;
//    public $volume;
//    public $recipie_id;
//    public $material_id;
   
     public function production_id(){
        return parent::get_fk_object("production_id");
    }
    
     public function material_id(){
        return parent::get_fk_object("material_id");
    }
    
     public static function find_all_by_production_id($recipe_id){
        global $database;  
        $id=$database->escape_value($recipe_id);
        $object_array=parent::find_by_sql("SELECT * FROM ".self::$table_name." WHERE production_id = '{$id}'");
        return $object_array;
    }

}

?>
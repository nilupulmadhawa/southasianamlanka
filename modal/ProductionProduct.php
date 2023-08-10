<?php
require_once __DIR__.'/../util/initialize.php';

class ProductionProduct extends DatabaseObject{
    protected static $table_name="production_product";
    protected static $db_fields=array(); 
    protected static $db_fk=array("production_id"=>"Production", "product_id"=>"Product", "batch_id"=>"Batch");
    
//    public $id;
//    public $production_id;
//    public $product_id;
//    public $batch_id;
//    public $qty;
        
    public function production_id(){
        return parent::get_fk_object("production_id");
    }
    
    public function product_id(){
        return parent::get_fk_object("product_id");
    }
    
    public function batch_id(){
        return parent::get_fk_object("batch_id");
    }
    
    public static function getNextCode() {
        $auto_increment=parent::getAutoIncrement();
        return $auto_increment;
    }  
    
}

?>
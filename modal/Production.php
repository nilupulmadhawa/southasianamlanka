<?php
require_once __DIR__.'/../util/initialize.php';

class Production extends DatabaseObject{
    protected static $table_name="production";
    protected static $db_fields=array(); 
    protected static $db_fk=array("recipie_id"=>"Recipie", "production_status_id"=>"ProductionStatus");
    
//    public $id;
//    public $name;
//    public $recipie_id;
//    public $production_status_id;
//    public $date;
    
    public function recipie_id(){
        return parent::get_fk_object("recipie_id");
    }
    
    public function production_status_id(){
        return parent::get_fk_object("production_status_id");
    }
    
}

?>
<?php
require_once __DIR__.'/../util/initialize.php';

class Deliverer extends DatabaseObject{
    protected static $table_name="deliverer";
    protected static $db_fields=array(); 
    protected static $db_fk=array("route_id"=>"Route");
            
    public function route_id(){
        return parent::get_fk_object("route_id");
    }        
    
    public static function getNextCode() {
        $auto_increment=parent::getAutoIncrement();
        return $auto_increment;
    } 

    public static function find_all_by_user_id($user_id) {
        global $database;
        $user_id = $database->escape_value($user_id);
        $designation_id = $database->escape_value($designation_id);
        $object_array = self::find_by_sql(
            "SELECT deliverer.* "
            +" FROM deliverer"
            +" INNER JOIN deliverer_user"
            +" ON deliverer_user.deliverer_id=deliverer.id"
            +" INNER JOIN user as u"
            +" ON u.id=deliverer_user.user_id"
            +" WHERE u.id= $user_id"
            );
        return $object_array;
    } 
}

?>
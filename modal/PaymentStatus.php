<?php
require_once  __DIR__.'/../util/initialize.php';

class PaymentStatus extends DatabaseObject{
    protected static $table_name="payment_status";
    protected static $db_fields=array();
    protected static $db_fk=array();
    
//    public $id;
//    public $name;
}

?>
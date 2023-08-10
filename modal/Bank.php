<?php
require_once  __DIR__.'/../util/initialize.php';

class Bank extends DatabaseObject{
    protected static $table_name="bank";
    protected static $db_fields=array(); 
    protected static $db_fk=array("cheque_status_id"=>"ChequeStatus");
}
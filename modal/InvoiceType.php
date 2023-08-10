<?php
require_once __DIR__.'/../util/initialize.php';

class InvoiceType extends DatabaseObject{
    protected static $table_name="invoice_type";
    protected static $db_fields=array(); 
    protected static $db_fk=array();
}

?>
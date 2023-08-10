<?php

require_once __DIR__ . '/../util/initialize.php';

class Cheque extends DatabaseObject {

    protected static $table_name = "cheque";
    protected static $db_fields = array();
    protected static $db_fk = array("cheque_status_id" => "ChequeStatus", "bank_id" => "Bank");

//    public $id;
//    public $bank;
//    public $amount;
//    public $cheque_no;
//    public $date;
//    public $cheque_status_id;

    public function cheque_status_id() {
        return parent::get_fk_object("cheque_status_id");
    }

    public function bank_id() {
        return parent::get_fk_object("bank_id");
    }

    public static function find_all_by_customer_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT cheque.* FROM ".self::$table_name." INNER JOIN payment_cheque ON payment_cheque.cheque_id=cheque.id INNER JOIN payment ON payment_cheque.payment_id INNER JOIN payment_invoice ON payment_invoice.payment_id=payment.id INNER JOIN invoice ON payment_invoice.invoice_id=invoice.id WHERE customer_id='$value'");
        return $object_array;
    }

    public static function find_all_returned() {
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE cheque_status_id = 4 ");
        return $object_array;
    }


}

?>

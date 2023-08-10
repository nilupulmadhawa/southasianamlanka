<?php
require_once './../util/initialize.php';
?>

<form action="sys_check.php" method="post">
  <select name="customer_id">
    <?php
    foreach(Customer::find_all() as $customer){
      echo "<option value='".$customer->id."'>".$customer->name."</option>";
    }
    ?>
  </select>
  <button type="submit" class="btn btn-default">SUBMIT</button>
</form>

<?php
if(isset($_POST['customer_id'])){
  $customer_id = $_POST['customer_id'];
  echo "<br/>";
  echo $customer->name."<br/>";


  foreach(Invoice::find_all_by_customer_id($customer_id) as $invoice ){
    echo "<div style='border:1px solid;padding:5px;font-weight:700;'>";
    echo "Invoice id: ".$invoice->code."<br/>";
    echo "Invoice total: ".$invoice->net_amount."<br/>";

    $total_payment = 0;
    foreach(PaymentInvoice::find_all_by_invoice_id($invoice->id) as $payment){
      $total_payment = $total_payment + $payment->amount;
    }
    echo "Payment total: ".$total_payment."<br/>";

    $return_total = 0;
    foreach(ProductReturnInvoice::find_all_by_invoice_id($invoice->id) as $return){
      $return_total = $return_total + $return->return_amount;
    }
    echo "Return total: ".$return_total."<br/>";

    $write_off_total = 0;
    foreach(WriteOff::find_all_by_invoice_id($invoice->id) as $return){
      $write_off_total = $write_off_total + $return->amount;
    }
    echo "Write Off total: ".$write_off_total."<br/>";

    $overpayment_total = 0;
    foreach(OverPayment::find_all_by_invoice_id($invoice->id) as $return){
      $overpayment_total = $overpayment_total + $return->amount;
    }
    echo "Overpayment total: ".$overpayment_total."<br/>";

    echo "</div>";

    echo "<b style='background-color:green;font-weight:700;color:white;padding:1px;'>Actual Balance (According To Records): ".($invoice->net_amount - $total_payment - $return_total - $write_off_total - $overpayment_total)."</b><br/>";
    echo "<b style='background-color:red;font-weight:700;color:white;padding:1px;'>invoice Current Status: ".$invoice->invoice_status_id()->name."</b><br/>";
    echo "<b style='background-color:red;font-weight:700;color:white;padding:1px;'>Invoice Current Balance: ".$invoice->balance."</b><br/><br/><br/>";


  }

  echo "<br/>";
  echo "-------------------------------------";
}

?>

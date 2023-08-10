<?php 
require_once './../../../util/initialize.php';

$customer_id = $_REQUEST["q"];

$customer = Customer::find_by_id($customer_id);
$balances = Invoice::find_all_has_balance_sum_cuctomer($customer_id);

$total_balance = 0;

foreach($balances as $data){
	$total_balance = $total_balance + $data->balance;
}
?>
<div class="col-sm-6" style="margin-top: 10px;">
	<?php
	if($customer){
		echo "<p style='color:green;font-size:17px;'> Credit Limit: <b>".number_format($customer->balance,2)."</b></p>";
	}else{
		echo "<p style='color:orange;font-size:17px;'><b> Credit Limit: Undefined</b></p>";
	}
	echo "<p style='color:orange;font-size:17px;'> Current Credits: <b>".number_format($total_balance,2)."</b></p>";
	?>
</div>
<div class="col-sm-6" style="margin-top: 10px;">
	
	<?php
	if($customer->balance <= $total_balance){
		?>
		<div class="alert alert-danger">
			<strong>Credit Limit Reach!</strong> Customer has reached his credit limit!!
		</div>
		<input type="hidden" id="txterror" value="1" />
		<?php
		
	}else{
		?>
		<div class="alert alert-success">
			<strong>Ready!</strong> Customer is ok to proceed with invoice.
		</div>
		<input type="hidden" id="txterror" value="0" />
		<?php
		
	}
	?>

</div>


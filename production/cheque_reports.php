<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Cheques Detailed Report</h3>
			</div>

			<div class="title_right">

			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="row" id="divInvoice">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2 id="title">Select Data</h2>
							<button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>

							<div class="clearfix"></div>
						</div>
						<div class="x_content">

							<form action="cheque_reports.php" method="post">
								<div class="container-fluid divBackTopTable ">

									<div class="form-group col-md-4 col-sm-4 col-xs-12">
										<label>User :</label>
										<select name="repname" class="form-control" />
											<?php
												foreach( User::find_all() as $data ){
													echo "<option value='".$data->id."'>".$data->name."</option>";
												}
											?>
										</select>
									</div>

									<div class="form-group col-md-4 col-sm-4 col-xs-6">
										<label>From :</label>
										<input type="text" class="form-control" id="dtpFrom" name="dtpFrom" autocomplete="off" required />
									</div>

									<div class="form-group col-md-4 col-sm-4 col-xs-6">
										<label>To :</label>
										<input type="text" class="form-control" id="dtpTo" name="dtpTo" autocomplete="off" required />
									</div>

									<div class="form-group col-md-12 col-sm-12 col-xs-12">
										<label>&nbsp;</label>
										<div class="ui-widget">
											<button name="btnShow" class="btn btn-default btn-block">Show <i class="glyphicon glyphicon-arrow-down"></i></button>
										</div>
									</div>

								</div>
							</form>

							<br/>

						</div>
					</div>
				</div>


				<div class="col-md-12 col-sm-12 col-xs-12" id="print_div">
					<div class="x_panel">
						<div class="x_title" style="background-color: gray;color:white;border-radius: 5px 5px 0px 0px;font-size:20px;">
							<center><b>CHEQUE COMMISION REPORT</b></center>
							<center style="font-size:12px;"><b>DATE: <?php echo date("Y-m-d"); ?> / GENERATED BY: <?php echo $_SESSION["user"]["name"]; ?></b></center>
						</div>
						<div class="x_content">
							<div class="col-sm-12">
								<!-- DELIVERER START -->
								<?php
								if(isset($_POST['repname'])) {

									$rep_id = $_POST['repname'];
									$user_details = User::find_by_id($rep_id);

									// print_r($deliverer_data);


								 ?>
								 <div class="row" style="min-height:720px;">
								 <div class="row" style="text-align:center;font-size:20px;">
									 <label><u><?php echo $user_details->name; ?></u></label>
								 </div>
								<!-- TABLE START -->

								<table id="sata_table" class=" " cellspacing="0" width="100%">
									<thead>
										<tr>

											<th style='font-size:13px;padding: 3px;width:70px;'>DATE</th>
											<th style='font-size:13px;padding: 3px;width:225px;'>CUSTOMER NAME</th>
											<th style='font-size:13px;padding: 3px;text-align: right;'>CHQ NO</th>
											<th style='font-size:13px;padding: 3px;text-align: right;'>AMOUNT</th>
											<th style='font-size:13px;padding: 3px;text-align: right;'>CHQ/DATE</th>
											<th style='font-size:13px;padding: 3px;text-align: right;'>BANK</th>
											<th style='font-size:13px;padding: 3px;text-align: right;'>A/C No</th>
											<th style='font-size:13px;padding: 3px;text-align: right;'>A/C Holder</th>

										</tr>
									</thead>
									<tbody>

										<?php
										$cheque_total = 0;
										$value = 0;
										if(isset($_POST['dtpFrom']) && isset($_POST['dtpTo'])){

											$start = $_POST['dtpFrom'];
											$end = $_POST['dtpTo'];
											$cheque_total = 0;
											foreach(PaymentCheque::find_all() as $data ){
												if( $start < $data->cheque_id()->date ){

													$payment_data = PaymentInvoice::find_by_payment_id($data->payment_id);
													if( $payment_data->invoice_id()->customer_id()->allocated_rep == $user_details->id ){


													echo "<tr>";
													echo "<td style='font-size:12px;border-top:1px solid;padding-bottom:3px;padding-top:3px;'>".$data->cheque_id()->date."</td>";
													$cusname = mb_substr($payment_data->invoice_id()->customer_id()->name, 0, 25);
													echo "<td style='font-size:12px;border-top:1px solid;padding: 3px;'>".$cusname."</td>";
													echo "<td style='font-size:12px;text-align: right;border-top:1px solid;padding: 3px;'>".$data->cheque_id()->cheque_no."</td>";
													echo "<td style='font-size:12px;text-align: right;border-top:1px solid;padding: 3px;'>".number_format($data->cheque_id()->amount,2)."</td>";
													echo "<td style='font-size:12px;text-align: right;border-top:1px solid;padding: 3px;'>".$data->cheque_id()->date."</td>";
													echo "<td style='font-size:12px;text-align: right;border-top:1px solid;padding: 3px;'>".$data->cheque_id()->bank_id()->name."</td>";
													echo "<td style='font-size:12px;text-align: right;border-top:1px solid;padding: 3px;'>".$payment_data->invoice_id()->customer_id()->account_number."</td>";
													echo "<td style='font-size:12px;text-align: right;border-top:1px solid;padding: 3px;'>".$payment_data->invoice_id()->customer_id()->name."</td>";
													echo "</tr>";
													$cheque_total = $cheque_total + $data->cheque_id()->amount;


												}
												}
											}


											$value = ($cheque_total * 0.5)/100;



										}

										?>

									</tbody>

								</table>

								<table style="margin-top:15px;font-size:12px;">
									<tr>
										<td style="width:150px;border-top:1px solid;padding-top:3px;">TOTAL : </td>
										<td style="text-align:right;border-top:1px solid;"><?php echo number_format($cheque_total,2); ?></td>
									</tr>

									<tr>
										<td style="border-top:1px solid;padding-top:3px;">COMMISION (0.5%) : </td>
										<td style="text-align:right;border-top:1px solid;padding-top:3px;"><?php echo number_format($value,2); ?></td>
									</tr>

								</table>
								<!-- TABLE ENDS -->

								<div style="height:100px;" ></div>
							</div>
							<?php } ?>
								<!-- DELIVERER ENDS -->

							</div>




						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<?php include 'common/bottom_content.php'; ?>

<script>

	$(function () {
		$("#dtpFrom").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});

	$(function () {
		$("#dtpTo").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});



    //print_div

    $('#btn_print').click(function (){
    	PrintDiv();
    });

    function PrintDiv() {
    	var divToPrint = document.getElementById('print_div');
    	var popupWin = window.open('', '_blank', 'width=800,height=500');
    	popupWin.document.open();
    	popupWin.document.write('<html><head><link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    	popupWin.document.close();
    }
</script>

<?php 
require_once './../../../util/initialize.php';
?>
<div class="table-responsive">
	<table id="tbl" class="table table-bordered table-condensed table-striped table-responsive customBorder">
		<thead>
			<tr>

				<th>Invoice Number</th>
				<th style="text-align: center;">Customer Name</th>
				<th style="text-align: right;">Return Amount</th>
				<th style="text-align: center;">Action</th>
				
			</tr>
		</thead>
		<tbody >
			
			<?php 
			$line_total = 0;
			$indx = 0;
			if(isset($_SESSION['product_return_invoice'])){


				foreach($_SESSION['product_return_invoice'] as $index => $data){
					$invoice = Invoice::find_by_id($data['invoice_id']);
					

					echo "<tr>";
					echo "<td>".$invoice->code."</td>";
					echo "<td style='text-align:center;'>".$invoice->customer_id()->name."</td>";
					echo "<td style='text-align:right;'>".number_format($data['amount'],2)."</td>";
					
					echo "<td style='text-align:center;'><button title='Remove' onclick='removeReload1(this)' id='".$index."' style='float:left;' type='button' class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button></td>".$index;
					echo "</tr>";
					$line_total = $line_total + $data['amount'];
					$indx++;
				}

				

			}

			echo "<tr>";
			echo "<td colspan='2' style='text-align:right;'>TOTAL</td>";
			echo "<td style='text-align:right;'><b>".number_format($line_total,2)."</b></td>";
			echo "<td></td>";
			echo "</tr>";

			?>
			
		</tbody>
	</table>
</div>
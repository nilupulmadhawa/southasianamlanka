<?php 
require_once './../../../util/initialize.php';
?>
<div class="table-responsive">
	<table id="tbl" class="table table-bordered table-condensed table-striped table-responsive customBorder">
		<thead>
			<tr>
				<th>Item Name</th>
				<th style='text-align:center;'>Return Reason</th>
				<th style='text-align:center;'>Batch Detail</th>
				<th style='text-align:right;'>Unit</th>
				<th style='text-align:right;'>Discount</th>
				<th style='text-align:center;'>Qty</th>
				<th style='text-align:right;'>Line Total</th>
				<th style='text-align:center;'>Action</th>
			</tr>
		</thead>
		<tbody >
			
			<?php 
			$line_total = 0;
			$indx = 0;
			if(isset($_SESSION['product_return_item'])){


				foreach($_SESSION['product_return_item'] as $index => $data){
					$item = Product::find_by_id($data['customer_id']);
					$batch = Batch::find_by_id($data['batch_id']);
					$return_reason = ReturnReason::find_by_id($data['return_reason']);
					$discount = $data['discount'];
					$qty = $data['qty'];

					if($data['price']){
						$wholesale_price = $data['price'];
					}else{
						$wholesale_price = $batch->wholesale_price;
					}

					$val = 0;
					$discountedtotal = 0;

					$val = 100 - $discount;
					$val = $val / 100;
					$discountedtotal = $wholesale_price*$qty*$val;

					echo "<tr>";
					echo "<td>".$item->name."</td>";
					echo "<td style='text-align:center;'>".$return_reason->name."</td>";
					echo "<td style='text-align:center;'>".$batch->id."</td>";
					echo "<td style='text-align:right;'>".$wholesale_price."</td>";
					echo "<td style='text-align:right;'>".$discount."%</td>";
					echo "<td style='text-align:center;'>".$qty."</td>";
					echo "<td style='text-align:right;'>".number_format($discountedtotal,2)."</td>";
					echo "<td style='text-align:center;'><button title='Remove' onclick='removeReload(this)' id='".$index."' style='float:left;' type='button' class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button></td>";
					echo "</tr>";
					$line_total = $line_total + $discountedtotal;
					$indx++;
				}

				

			}

			echo "<tr>";
			echo "<td colspan='6' style='text-align:right;'>TOTAL</td>";
			echo "<td style='text-align:right;'>".number_format($line_total,2)."</td>";
			echo "<td></td>";
			echo "</tr>";

			?>
			
		</tbody>
	</table>
</div>
<?php 
require_once './../../../util/initialize.php';
?>
<div class="table-responsive">
	<table id="tbl" class="table table-bordered table-condensed table-striped table-responsive customBorder">
		<thead>
			<tr>
				<th>Item Name</th>
				<th>Batch</th>
				<th>Qty</th>
				
				<th style='text-align:center;'>Action</th>
			</tr>
		</thead>
		<tbody >
			
			<?php 
			
			if(isset($_SESSION['transfer_return_item'])){


				foreach($_SESSION['transfer_return_item'] as $index => $data){
					$batch = Batch::find_by_id($data['batch_id']);
					$qty = $data['qty'];				

					echo "<tr>";
					echo "<td>".$batch->product_id()->name."</td>";
					echo "<td style='text-align:center;'>".$batch->id."</td>";
					echo "<td style='text-align:center;'>".$qty."</td>";
					echo "<td style='text-align:center;'><button title='Remove' onclick='removeReload(this)' id='".$index."' style='float:left;' type='button' class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button></td>";
					echo "</tr>";
					
					
				}

				

			}
			

			?>
			
		</tbody>
	</table>
</div>
<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Item Wise Details</h3>
            </div>

            <div class="title_right">
                <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center> Search Details </center></h3></div>
                        <div class="x_content">


                            <form class="form-horizontal" method="post" action="item_wise_detailed_report_specific.php" >



                              <div class="form-group">
                                <label class="control-label col-sm-2">Product:</label>
                                <div class="col-sm-10">
                                  <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="item_name" required>
                                    <?php 
                                    foreach (Product::find_all() as $data) {
                                        echo "<option value='".$data->id."'>".$data->brand." || ".$data->name." || ".$data->description."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Until Date:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="dtpFrom" name="dtpFrom" placeholder="yyyy-mm-dd" autocomplete="off" />
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-primary">View</button>
                          </div>
                      </div>
                  </form>



              </div>
          </div>
      </div>

  </div>

  <div class="row" id="print_div">  

    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
        <div class="x_panel">

            <div class="x_content">

                <p><b>ITEM NAME: <?php if(isset($_POST['item_name'])){ $data=Product::find_by_id($_POST['item_name']); echo $data->brand." || ".$data->name." || ".$data->description; } ?></b></p>

            </div>

        </div>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="x_panel">

            <div class="x_content">
                <div class="table-responsive">


                    <table id="sata_table" class="table table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr style='font-size:10px;'>

                                <th>Type</th>
                                <th>Code</th>
                                <th style='text-align: center;'>Date</th>
                                <th style='text-align: center;'>Customer</th>
                                <th style='text-align: center;'>Qty</th>
                                <th style="text-align:center;">Balance</th>
                                <th style="text-align:right;">Cost</th>
                                <th style="text-align:right;">Retail</th>
                                

                            </tr>
                        </thead>
                        <tbody id="table_body">

                            <?php

                            function showgrnproducts($grn_data, $product_id , $until){
                                $total = 0;

                                foreach (GRNProduct::find_all_by_grn_id($grn_data->id) as $data) {
                                    if( $data->batch_id()->product_id == $product_id ){

                                        if($until >= $data->grn_id()->date_time ){
                                        echo "<tr style='font-size:10px;'>";
                                        echo "<td>GRN</td>";
                                        echo "<td style='text-align: center;'>".$data->grn_id()->code."</td>";
                                        echo "<td style='text-align: center;'>".$data->grn_id()->date_time."</td>";
                                        echo "<td></td>";                                        ;
                                        echo "<td style='text-align: center;'>".$data->qty."</td>";
                                        echo "<td style='text-align: center;'></td>";
                                        echo "<td style='text-align: right;'>".$data->batch_id()->cost."</td>";
                                        echo "<td style='text-align: right;'>".$data->batch_id()->retail_price."</td>";
                                        
                                        echo "</tr>";
                                    }

                                        $total = $total + $data->qty;
                                    }
                                }

                                return $total;

                            }


                            function showinvoiceproducts($grn_data, $product_id, $until){

                                $total = 0;

                                foreach (InvoiceInventory::find_all_by_invoice_id($grn_data->id) as $data) {
                                    if( $data->inventory_id()->product_id == $product_id ){

                                        if( $until >= $data->invoice_id()->date_time){

                                        
                                        echo "<tr style='font-size:10px;'>";
                                        echo "<td>INVOICE</td>";
                                        echo "<td style='text-align: center;'>".$data->invoice_id()->code."</td>";
                                        echo "<td style='text-align: center;'>".$data->invoice_id()->date_time."</td>";
                                        echo "<td style='text-align: center;'>".$data->invoice_id()->customer_id()->name."</td>";
                                        echo "<td style='text-align: center;'>".$data->qty."</td>";
                                        echo "<td style='text-align: center;'></td>";
                                        echo "<td style='text-align: right;'>".$data->inventory_id()->batch_id()->cost."</td>";
                                        echo "<td style='text-align: right;'>".$data->inventory_id()->batch_id()->retail_price."</td>";
                                        
                                        echo "</tr>";

                                    }

                                        $total = $total + $data->qty;
                                    }
                                }

                                return $total;

                            }

                            $inventory_qty = 0;

                            if( isset($_POST['item_name']) ){

                                $dtpFrom = $_POST['dtpFrom'];

                                $item_name = $_POST['item_name'];
                                $time = strtotime('2009-01-01');
                                $from = date('Y-m-d',$time);
                                $to = date("Y-m-d");

                                echo "<tr style='font-size:10px;'>";
                                echo "<td>INITIAL BALANCE</td>";
                                echo "<td style='text-align: center;'>INITIAL</td>";
                                echo "<td style='text-align: center;'> - </td>";
                                echo "<td style='text-align: center;'> - </td>";
                                echo "<td style='text-align: center;' id='initial_balance'> 0 </td>";
                                echo "<td style='text-align: center;'> - </td>";
                                echo "<td style='text-align: center;'> - </td>";
                                echo "<td style='text-align: center;'> - </td>";

                                echo "</tr>";

                                $invoice_grn_total = 0;
                                foreach (GRN::find_all_by_date_range($from,$to) as $data) {
                                    $invoice_grn = showgrnproducts( $data, $item_name, $dtpFrom );
                                    $invoice_grn_total = $invoice_grn_total + $invoice_grn;
                                }

                                $invoice_qty_total = 0;
                                foreach (Invoice::find_all_by_date_range($from,$to) as $data) {
                                    $invoice_qty = showinvoiceproducts( $data, $item_name, $dtpFrom );
                                    $invoice_qty_total = $invoice_qty_total + $invoice_qty;
                                }


                                foreach (Inventory::find_all_by_product_id($_POST['item_name']) as $data) {
                                    $inventory_qty = $inventory_qty + $data->qty;
                                }
                                
                            }

                            ?>

                        </tbody>                                    
                    </table>
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

    <?php 
    if( isset($_POST['item_name']) ){
        ?>
        window.onload = function(){
            var initialbalance = <?php if( $invoice_grn_total < ($invoice_qty_total + $inventory_qty) ){ echo $invoice_qty_total + $inventory_qty; } else { echo 0; }  ?>;
            document.getElementById("initial_balance").innerHTML = initialbalance;

            var balances = initialbalance;

            var table = document.getElementById("sata_table");
            for (var i = 0, row; row = table.rows[i]; i++) {

             // for (var j = 0, col; col = row.cells[j]; j++) {                

                if(document.getElementById("sata_table").rows[i].cells[0].innerHTML == "INVOICE"){
                    balances = balances - document.getElementById("sata_table").rows[i].cells[4].innerHTML;
                    document.getElementById("sata_table").rows[i].cells[5].innerHTML = balances;                   
                }

                if(document.getElementById("sata_table").rows[i].cells[0].innerHTML == "GRN"){
                    balances = balances + document.getElementById("sata_table").rows[i].cells[4].innerHTML;
                    document.getElementById("sata_table").rows[i].cells[5].innerHTML = balances;                    
                }
                
             // }  
         }

     }
 <?php } ?>


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

    $('#btn_print').click(function () {
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

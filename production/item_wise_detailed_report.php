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

                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                    <div class="x_panel">
                        <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center> Search Details </center></h3></div>
                        <div class="x_content">
                            <div class="table-responsive">

                                <form class="form-horizontal" method="post" action="item_wise_detailed_report.php" >
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
                                <label class="control-label col-sm-2" >From:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="dtpFrom" name="dtpFrom" placeholder="From" autocomplete="off">
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-sm-2" >To:</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="dtpTo" name="dtpTo" placeholder="To" autocomplete="off">
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

</div>

<div class="row" id="print_div">  

    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
        <div class="x_panel">
            
            <div class="x_content">

                <p><b>ITEM NAME: <?php if(isset($_POST['item_name'])){ $data=Product::find_by_id($_POST['item_name']); echo $data->brand." || ".$data->name." || ".$data->description; } ?></b></p>

            </div>

        </div>
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4 table-responsive">
        <div class="x_panel">
            <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center> GRN Details </center></h3></div>
            <div class="x_content">
                <div class="table-responsive">


                    <table id="sata_table" class="table table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Date</th>
                                <th style='text-align: center;'>GRN ID</th>             
                                <th style='text-align: center;'>QTY</th>

                            </tr>
                        </thead>
                        <tbody id="table_body">

                            <?php

                            function showgrnproducts($grn_data, $product_id){

                                foreach (GRNProduct::find_all_by_grn_id($grn_data->id) as $data) {
                                    if( $data->batch_id()->product_id == $product_id ){
                                        echo "<tr>";
                                        echo "<td>".$grn_data->date_time."</td>";
                                        echo "<td style='text-align: center;'>".$grn_data->code."</td>";
                                        echo "<td style='text-align: center;'>".$data->qty."</td>";
                                        echo "</tr>";
                                    }
                                }

                            }

                            if( isset($_POST['item_name']) && isset($_POST['dtpTo']) && isset($_POST['dtpFrom']) ){

                                $item_name = $_POST['item_name'];
                                $from = $_POST['dtpFrom'];
                                $to = $_POST['dtpTo'];

                                foreach (GRN::find_all_by_date_range($from,$to) as $data) {
                                    showgrnproducts($data, $item_name);
                                }
                            }

                            ?>

                        </tbody>                                    
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4 table-responsive">
        <div class="x_panel">
            <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center> Invoiced Details </center></h3></div>
            <div class="x_content">
                <div class="table-responsive">

                    <table id="sata_table" class="table table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Date</th>
                                <th style='text-align: center;'>Invoice ID</th>             
                                <th style='text-align: center;'>QTY</th>

                            </tr>
                        </thead>
                        <tbody id="table_body">

                            <?php

                            function showinvoiceproducts($grn_data, $product_id){

                                foreach (InvoiceInventory::find_all_by_invoice_id($grn_data->id) as $data) {
                                    if( $data->inventory_id()->product_id == $product_id ){
                                        echo "<tr>";
                                        echo "<td>".$grn_data->date_time."</td>";
                                        echo "<td style='text-align: center;'>".$grn_data->code."</td>";
                                        echo "<td style='text-align: center;'>".$data->qty."</td>";
                                        echo "</tr>";
                                    }
                                }

                            }

                            if( isset($_POST['item_name']) && isset($_POST['dtpTo']) && isset($_POST['dtpFrom']) ){

                                $item_name = $_POST['item_name'];
                                $from = $_POST['dtpFrom'];
                                $to = $_POST['dtpTo'];

                                foreach (Invoice::find_all_by_date_range($from,$to) as $data) {
                                    showinvoiceproducts($data, $item_name);
                                }
                            }
                            
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-4 col-sm-4 col-xs-4 table-responsive">
        <div class="x_panel">
            <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center> Returned Details </center></h3></div>
            <div class="x_content">
                <div class="table-responsive">

                    <table id="sata_table" class="table table-bordered " cellspacing="0" width="100%">
                        <thead>
                            <tr>

                                <th>Date</th>
                                <th style='text-align: center;'>Returned ID</th>             
                                <th style='text-align: center;'>QTY</th>

                            </tr>
                        </thead>
                        <tbody id="table_body">

                            <?php

                            function showreturnproducts($grn_data, $product_id){

                                foreach (ProductReturnBatch::find_all_by_product_return_id($grn_data->id) as $data) {
                                    if( $data->batch_id()->product_id == $product_id ){
                                        echo "<tr>";
                                        echo "<td>".$grn_data->date_time."</td>";
                                        echo "<td style='text-align: center;'>".$grn_data->id."</td>";
                                        echo "<td style='text-align: center;'>".$data->qty."</td>";
                                        echo "</tr>";
                                    }
                                }

                            }

                            if( isset($_POST['item_name']) && isset($_POST['dtpTo']) && isset($_POST['dtpFrom']) ){

                                $item_name = $_POST['item_name'];
                                $from = $_POST['dtpFrom'];
                                $to = $_POST['dtpTo'];

                                foreach (ProductReturn::find_all_by_date_range($from,$to) as $data) {
                                    showreturnproducts($data, $item_name);
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

<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Stock Details</h3>
      </div>

      <div class="title_right">
        <!-- <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button> -->
        <a class="btn btn-default pull-right" href="stock_report_new_print.php" target='_blank'> <i class="fa fa-print"></i> PRINT </a>

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="row" id="divInvoice">

        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive" id="print_div">
          <div class="x_panel">
            <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center>Stock Report</center></h3></div>
            <div class="x_content">
              <div class="table-responsive">

                <table id="sata_table" class="table table-striped " cellspacing="0" width="100%">
                  <thead>
                    <tr style='font-size:10px;'>
                      <th style="width:100px;"></th>
                      <th>Part Number</th>
                      <th>Description</th>
                      <th>Stock Qty</th>
                      <th style="text-align: right;">Cost</th>
                      <th style="text-align: right;">Line Total</th>
                    </tr>
                  </thead>
                  <tbody id="table_body">

                    <?php

                    function qty($product_id){
                      $qty = 0;
                      foreach (Inventory::find_all_by_product_id($product_id) as $data) {
                        $qty = $qty + $data->qty;
                      }
                      return $qty;
                    }

                    function cost($product_id){
                      $cost = 0;
                      foreach (Inventory::find_all_by_product_id($product_id) as $data) {
                        $cost = $data->batch_id()->cost;
                      }
                      return $cost;
                    }

                    $total = 0;

                    foreach(Product::find_all_by_distinct_brand() as $data){

                      echo "<tr style='font-size:10px;'>";
                      echo "<td colspan='6'>".$data->brand."</td>";
                      echo "</tr>";


                      $rowcount = 0;

                      $linetotal = 0;

                      foreach(Product::find_all_by_brand($data->brand) as $product){

                        $stockqty = qty($product->id);
                        if($stockqty > 0){
                          $cost_price = cost($product->id);
                          if($rowcount == 0){
                            echo "<tr style='font-size:10px;'>";
                            echo "<td><i>location</i></td>";
                            echo "<td colspan='5'><i>store</i></td>";
                            echo "</tr>";
                          }
                          echo "<tr style='font-size:10px;'>";
                          echo "<td></td>";
                          echo "<td>".$product->name."</td>";
                          echo "<td>".$product->description."</td>";
                          echo "<td>";
                          foreach (Inventory::find_all_by_product_id($product->id) as $inventory_data) {
                            echo "Batch: ".$inventory_data->batch_id()->code." || QTY:".$inventory_data->qty."<br/>";
                          }
                          echo "</td>";
                          echo "<td style='text-align:right;'>";
                          $costTotal = 0;
                          foreach (Inventory::find_all_by_product_id($product->id) as $inventory_data) {
                            echo $inventory_data->batch_id()->cost."<br/>";
                            $costTotal = $costTotal + $inventory_data->batch_id()->cost * $inventory_data->qty;
                          }
                          echo "</td>";

                          echo "<td style='text-align:right;'>".number_format(($costTotal),2)."</td>";

                          $total = $total + ($costTotal);

                          $linetotal = $linetotal + ($costTotal);
                          echo "</tr>";
                          ++$rowcount;


                        }
                      }

                      echo "<tr style='background-color:teal;color:white;'>";
                      echo "<td colspan='5' style='text-align:right;'>Total: </td>";
                      echo "<td style='text-align:right;'>".number_format($linetotal,2)."</td>";
                      echo "</tr>";



                      $rowcount = 0;

                      foreach (ProductReturnBatch::find_all_damage() as $return) {

                        if($return->batch_id()->product_id()->brand == $data->brand){

                          if($rowcount == 0){
                            echo "<tr style='font-size:10px;'>";
                            echo "<td><i>location</i></td>";
                            echo "<td colspan='4'><i>damage</i></td>";
                            echo "</tr>";
                            ++$rowcount;
                          }

                          echo "<tr style='font-size:10px;'>";
                          echo "<td></td>";
                          echo "<td>".$return->batch_id()->product_id()->name."</td>";
                          echo "<td>".$return->batch_id()->product_id()->description."</td>";
                          echo "<td>".$return->qty."</td>";
                          echo "<td style='text-align:right;'>".$return->batch_id()->cost."</td>";
                          $total = $total + $return->batch_id()->cost;
                          echo "</tr>";

                        }
                      }
                    }

                    echo "<tr style='font-size:15px;font-weight:bold;'>";

                    echo "<td style='text-align:right;' colspan='5'>TOTAL</td>";
                    echo "<td style='text-align:right;'>".number_format($total)."</td>";
                    echo "</tr>";
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

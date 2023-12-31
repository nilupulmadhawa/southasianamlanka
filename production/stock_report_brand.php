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
        <?php if(isset($_POST['brand'])){ ?>
          <a class="btn btn-default pull-right" href="stock_report_brand_print.php?brand=<?php echo $_POST['brand']; ?>" target='_blank'> <i class="fa fa-print"></i> PRINT </a>
        <?php } ?>
      </div>
    </div>

    <!-- FORM START -->

    <form class="form-inline" method="post" action="stock_report_brand.php">
      <div class="form-group">
        <label for="email">Select Brand:</label>
        <!-- <input type="text" class="form-control" > -->
        <select class="form-control" name="brand">
          <?php
          foreach(Product::find_all_by_distinct_brand() as $data){
            echo "<option>".$data->brand."</option>";
          }
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">SELECT</button>
    </form>

    <!-- FORM END -->

    <div class="clearfix"></div>

    <div class="row">
      <div class="row" id="divInvoice">

        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive" id="print_div">
          <div class="x_panel">
            <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center>Stock Report</center></h3>
              <center style="font-size:12px;"><b>DATE: <?php echo date("Y-m-d"); ?> / GENERATED BY: <?php echo $_SESSION["user"]["name"]; ?></b></center>
            </div>
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


                    if(isset($_POST['brand'])){
                      $brand_name = $_POST['brand'];
                      $total = 0;



                      echo "<tr style='font-size:10px;'>";
                      echo "<td colspan='6'>".$brand_name."</td>";
                      echo "</tr>";


                      $rowcount = 0;

                      $linetotal = 0;

                      foreach(Product::find_all_by_brand($brand_name) as $product){

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
                          echo "<td>".$stockqty."</td>";
                          echo "<td style='text-align:right;'>".number_format($cost_price,2)."</td>";
                          echo "<td style='text-align:right;'>".number_format(($cost_price*$stockqty),2)."</td>";

                          $total = $total + ($cost_price*$stockqty);

                          $linetotal = $linetotal + ($cost_price*$stockqty);
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

                        if($return->batch_id()->product_id()->brand == $brand_name){

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


                      echo "<tr style='font-size:15px;font-weight:bold;'>";

                      echo "<td style='text-align:right;' colspan='5'>TOTAL</td>";
                      echo "<td style='text-align:right;'>".number_format($total)."</td>";
                      echo "</tr>";

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

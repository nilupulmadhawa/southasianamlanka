<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Brand Wise Sales Report</h3>
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
              <div>

                <form class="form-horizontal" method="post" action="brand_wise_sales_report.php" >

                  <div class="form-group">
                    <label class="control-label col-sm-2" >Brand:</label>
                    <div class="col-sm-10">
                      <select name="brand" class="form-control">
                        <?php
                        foreach (Product::find_all_by_distinct_brand() as $data) {
                          echo "<option>".$data->brand."</option>";
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
            <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center> Brand Wise Sales (
              <?php
             if(isset($_POST['brand'])){
               echo $_POST['brand'];
             }
             ?>
             ) </center></h3>
             <p><center>
               <?php
               if(isset($_POST['brand'])){
                 echo " From: ".$_POST['dtpFrom']." To: ".$_POST['dtpTo']." By: ".$_SESSION["user"]["name"] ;
               }
               ?>
             </center></p>
           </div>
            <div class="x_content">
              <div class="table-responsive">


                <table class="table-bordered " cellspacing="0" width="100%">
                  <thead>
                    <tr>

                      <th style="padding:3px;"></th>
                      <th style="padding:3px;">Item Name</th>
                      <th style='text-align: right;padding:3px;'>Sales Qty</th>

                    </tr>
                  </thead>
                  <tbody id="table_body">

                    <?php

                    function invoicetotal( $product_id, $start, $end ){
                      $invedtotal = 0;
                      foreach(InvoiceInventory::find_all_by_product_id_invoice( $product_id, $start, $end ) as $data ){
                        // $invedtotal = $invedtotal + ( $data->qty * $data->net_amount );
                        $invedtotal = $invedtotal +  $data->qty;
                        // print_r($data);
                      }
                      return $invedtotal;
                    }

                    if( isset($_POST['dtpFrom']) && isset($_POST['dtpTo']) ){
                      $brand = "NULL";
                      $amount = 0;
                      foreach( Product::find_all_by_brand($_POST['brand']) as $data ){

                        $qty = invoicetotal($data->id, $_POST['dtpFrom'], $_POST['dtpTo']);

                        if($qty > 0){

                          echo "<tr>";
                          if($brand != $data->brand){
                            echo "<td style='font-weight:bold;padding:3px;'>".$data->brand."</td>";
                            echo "<td style='padding:3px;'>".$data->name."</td>";
                            echo "<td style='text-align:right;padding:3px;' >".$qty."</td>";
                            $brand = $data->brand;
                          }else{
                            echo "<td style='padding:3px;'></td>";
                            echo "<td style='padding:3px;'>".$data->name."</td>";
                            echo "<td style='text-align:right;padding:3px;' >".$qty."</td>";
                          }
                          echo "</tr>";
                          $amount = $amount + $qty;
                        }

                      }
                      // echo "<tr style='font-size:20px;font-weight:bold;'>";
                      // echo "<td></td>";
                      // echo "<td style='text-align:right;'>TOTAL: </td>";
                      // echo "<td style='text-align:right;' >".$amount."</td>";
                      // echo "</tr>";
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

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
            <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center> Search </center></h3></div>
            <div class="x_content">


              <form class="form-horizontal" method="post" action="item_wise_detailed_report_new_update.php" >



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
                  <label class="control-label col-sm-2">Date Range:</label>
                  <div class="col-sm-5">
                    <label class="col-sm-12">From:</label>
                    <input type="text" class="form-control" id="dtpFrom" name="dtpFrom" placeholder="yyyy-mm-dd" autocomplete="off" />
                  </div>

                  <div class="col-sm-5">
                    <label class="col-sm-12">To:</label>
                    <input type="text" class="form-control" id="dtpTo" name="dtpTo" placeholder="yyyy-mm-dd" autocomplete="off" />
                  </div>
                </div>


                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-block">View</button>
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
                        <th style="text-align:center;">Batch</th>
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
                      if(isset($_POST['item_name']) && isset($_POST['dtpFrom']) && isset($_POST['dtpTo'])){
                        $item_name = $_POST['item_name'];
                        $dtpFrom = $_POST['dtpFrom'];
                        $dtpTo = $_POST['dtpTo'];

                        foreach(StockMovement::find_by_item_date($item_name,$dtpFrom,$dtpTo) as $table_data){

                          echo "<tr>";
                          echo "<td>".$table_data->type."</td>";
                          $batch = Batch::find_by_id($table_data->batch_id);
                          echo "<td style='text-align:center;'>".$batch->code."</td>";
                          echo "<td>".$table_data->ref_id."</td>";
                          echo "<td>".$table_data->operated_id."</td>";
                          if($table_data->type == 'invoice'){
                            $customer = Invoice::find_by_id($table_data->ref_id)->customer_id()->name;
                            echo "<td>".$customer."</td>";
                          }else if($table_data->type == 'grn'){
                            echo "<td> - </td>";
                          }else if($table_data->type == 'return'){
                            // $customer = ProductReturn::find_by_id($table_data->ref_id)->customer_id;
                            echo "<td>";
                            foreach(ProductReturnInvoice::find_all_by_product_return_id($table_data->ref_id) as $returndata){
                              echo $returndata->invoice_id()->customer_id()->name."<br/>";
                            }
                            echo "</td>";
                          }else{
                            echo "<td> - </td>";
                          }
                          echo "<td style='text-align:center;'>".$table_data->qty."</td>";
                          echo "<td style='text-align:center;'>".$table_data->stock_balance."</td>";

                          echo "<td style='text-align:right;'>".number_format($batch->cost,2)."</td>";
                          echo "<td style='text-align:right;'>".number_format($batch->retail_price,2)."</td>";
                          echo "</tr>";

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

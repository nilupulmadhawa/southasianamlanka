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


              <form class="form-horizontal" method="post" action="item_wise_detailed_report_new.php" >

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
                        <th style='text-align: center;'>Code</th>
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

                      function showgrnproducts($grn_data, $product_id){
                        $total = 0;

                        foreach (GRNProduct::find_all_by_grn_id($grn_data->id) as $data) {
                          if( $data->batch_id()->product_id == $product_id ){
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
                            $total = $total + $data->qty;
                          }
                        }

                        return $total;

                      }




                      $inventory_qty = 0;

                      if( isset($_POST['item_name']) ){

                        $item_name = $_POST['item_name'];
                        $time = strtotime('2009-01-01');
                        $from = date('Y-m-d',$time);
                        $to = date("Y-m-d");
                        $xmasDay = new DateTime($to.' + 1 day');
                        $to = $xmasDay->format('Y-m-d');



                        $balanceqty = 0;
                        if($data = Initial::find_by_product_id($item_name)){
                          // echo "ok";

                          echo "<tr style='font-size:10px;'>";
                          echo "<td>INITIAL BALANCE</td>";
                          echo "<td style='text-align: center;'>BAL".sprintf('%05d', $data->id)."</td>";
                          echo "<td style='text-align: center;'> ".$data->balance_date." </td>";
                          echo "<td style='text-align: center;'> - </td>";
                          echo "<td style='text-align: center;' id='initial_balance'> ".$data->qty." </td>";
                          echo "<td style='text-align: center;'> - </td>";
                          echo "<td style='text-align: center;'> - </td>";
                          echo "<td style='text-align: center;'> - </td>";
                          echo "</tr>";
                          $balanceqty = $data->qty;
                        }


                        // grn balance calculation
                        $invoice_grn_total = 0;
                        foreach (GRN::find_all_by_date_range($from,$to) as $data) {

                          foreach (GRNProduct::find_all_by_grn_id($data->id) as $dataw) {
                            if( $dataw->batch_id()->product_id == $item_name ){

                              $balanceqty = $balanceqty + $dataw->qty;
                              echo "<tr style='font-size:10px;'>";
                              echo "<td>GRN</td>";
                              echo "<td style='text-align: center;'>".$dataw->grn_id()->code."</td>";
                              echo "<td style='text-align: center;'>".$dataw->grn_id()->date_time."</td>";
                              echo "<td></td>";                                        ;
                              echo "<td style='text-align: center;'>".$dataw->qty."</td>";
                              echo "<td style='text-align: center;'>".$balanceqty."</td>";
                              echo "<td style='text-align: right;'>".$dataw->batch_id()->cost."</td>";
                              echo "<td style='text-align: right;'>".$dataw->batch_id()->retail_price."</td>";
                              echo "</tr>";

                            }
                          }
                        }

                        // invoice balance calculation
                        $invoice_qty_total = 0;
                        foreach (Invoice::find_all_by_date_range($from,$to) as $data) {
                          foreach (InvoiceInventory::find_all_by_invoice_id($data->id) as $datas) {
                            if( $datas->inventory_id()->product_id == $item_name ){
                              // echo $balanceqty;
                              $balanceqty = $balanceqty - $datas->qty;
                              echo "<tr style='font-size:10px;'>";
                              echo "<td>INVOICE</td>";
                              echo "<td style='text-align: center;'>".$datas->invoice_id()->code."</td>";
                              echo "<td style='text-align: center;'>".$datas->invoice_id()->date_time."</td>";
                              echo "<td style='text-align: center;'>".$datas->invoice_id()->customer_id()->name."</td>";
                              echo "<td style='text-align: center;'>".$datas->qty."</td>";
                              echo "<td style='text-align: center;'>".$balanceqty."</td>";
                              echo "<td style='text-align: right;'>".$datas->inventory_id()->batch_id()->cost."</td>";
                              echo "<td style='text-align: right;'>".$datas->inventory_id()->batch_id()->retail_price."</td>";
                              echo "</tr>";

                            }
                          }
                        }

                        foreach(ProductReturn::find_all_by_product_id_date_range($item_name,$from,$to) as $return_data){

                          echo "<tr style='font-size:10px;'>";
                          echo "<td>RETURN</td>";
                          $dt = new DateTime($return_data->date_time);
                          echo "<td style='text-align: center;'>SR". $dt->format('y').$dt->format('m').$dt->format('d').sprintf('%06d', $return_data->id)."</td>";
                          echo "<td style='text-align: center;'>".$return_data->date_time."</td>";
                          $return_invoice_data = ProductReturnInvoice::find_by_product_return_id($return_data->id);
                          echo "<td style='text-align:center;'>".$return_invoice_data->invoice_id()->customer_id()->name."</td>";
                          $return_batch_data = ProductReturnBatch::find_all_by_product_return_id($return_data->id);
                          foreach($return_batch_data as $view_batch_data){
                            if($view_batch_data->batch_id()->product_id == $item_name){
                              $balanceqty = $balanceqty + $view_batch_data->qty;
                              echo "<td style='text-align:center;'>".$view_batch_data->qty."</td>";
                              echo "<td style='text-align:center;'>".$balanceqty."</td>";
                              echo "<td style='text-align:right;'>".$view_batch_data->batch_id()->cost."</td>";
                              echo "<td style='text-align:right;'>".$view_batch_data->batch_id()->retail_price."</td>";
                            }
                          }

                          echo "</tr>";
                        }

                        // stock adjestment calculation
                        foreach (StockAdj::find_all_by_date_range($from,$to, $item_name) as $datass) {
                          $balanceqty = $balanceqty + $datass->qty;
                          echo "<tr style='font-size:10px;'>";


                          $test = strtotime($datass->current_date_time);
                          $code = date('y',$test).date('m',$test).date('d',$test).sprintf('%05d', $datass->id);
                          if($datass->damage == 1){
                              echo "<td>TRANSFER</td>";
                            echo "<td style='text-align: center;'>TR".$code."</td>";

                          }else{
                              echo "<td>ADJESTMENT</td>";
                            echo "<td style='text-align: center;'>AD".$code."</td>";

                          }
                          echo "<td style='text-align: center;'>".$datass->current_date_time."</td>";
                          echo "<td style='text-align: center;'> - </td>";
                          echo "<td style='text-align: center;'>".$datass->qty."</td>";
                          echo "<td style='text-align: center;'>".$balanceqty."</td>";
                          echo "<td style='text-align: right;'> - </td>";
                          echo "<td style='text-align: right;'> - </td>";
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

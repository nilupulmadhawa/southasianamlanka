<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Rep Wise Sales Summary</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="row" id="divInvoice">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2 id="title">Date Range</h2>
              <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>

              <div class="clearfix"></div>
            </div>



            <!--========================================================-->

            <div class="x_content">

              <div class="container-fluid  ">

                <ul class="nav nav-tabs bar_tabs" >

                  <li class="active"><a data-toggle="tab" href="#div2" id="div_clear2">Date Range Filter</a></li>
                </ul>

                <div class="tab-content">

                  <div id="div2" class="tab-pane fade in active">

                    <form action="sales_report_summary_rep.php" method="post">

                      <div class="form-group col-md-3 col-sm-3 col-xs-3">
                        <label>Rep :</label>
                        <select class="form-control" name="Rep">
                          <option value="0">ALL</option>
                          <?php
                          foreach( User::find_all() as $data ){
                            echo "<option value='".$data->id."'>".$data->name."</option>";
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group col-md-3 col-sm-3 col-xs-3">
                        <label>From :</label>
                        <input type="text" class="form-control" id="dtpFrom" name="dtpFrom" placeholder="yyyy-mm-dd" autocomplete="off" />
                      </div>

                      <div class="form-group col-md-3 col-sm-3 col-xs-3">
                        <label>To :</label>
                        <input type="text" class="form-control" id="dtpTo" name="dtpTo" placeholder="yyyy-mm-dd" autocomplete="off" />
                      </div>

                      <div class="form-group col-md-2 col-sm-2 col-xs-2 ">
                        <label>&nbsp;</label>
                        <div class="ui-widget">
                          <button type="submit" name="btnShow" class="btn btn-default">Show <i class="glyphicon glyphicon-arrow-down"></i></button>
                        </div>
                      </div>

                    </form>

                  </div>
                </div>

              </div>

              <br/>
            </div>

          </div>
        </div>
      </div>
      <!--<div class="col-md-12 col-sm-12 col-xs-12" >-->
      <div class="x_panel" id="print_div">
        <div class="x_title" style="background-color: gray;color:white;border-radius: 5px 5px 0px 0px;"><h3><center>SALES SUMMARY <?php
        if( isset($_POST['Rep']) && isset($_POST['dtpFrom']) && isset($_POST['dtpTo']) ){
          echo "<br/>From: ".$_POST['dtpFrom']." || ".$_POST['dtpTo'];
          if($_POST['Rep'] == 0){
            echo " ALL CUSTOMERS";
          }else{
            echo "<br/>SALES PERSON: ".User::find_by_id($_POST['Rep'])->name;
          }
        }
        $net_total = 0;
        ?></center></h3>

        <center style="font-size:12px;"><b>DATE: <?php echo date("Y-m-d"); ?> / GENERATED BY: <?php echo $_SESSION["user"]["name"]; ?></b></center></div>
        <div class="x_content">
          <div class="table-responsive">

            <table id="sata_table" class="table-striped " cellspacing="0" width="100%">
              <thead>
                <tr style="font-size:12px;">
                  <th>LN</th>
                  <th style="width:125px;text-align:left;" >Date</th>
                  <th style="text-align:center;padding-left:10px;" >Bill No</th>

                  <th style='text-align:right;padding-right:15px;' >Net Amount</th>
                  <th style='text-align:center;'>Customer</th>
                  <!--<th>Cost Amount</th>-->
                  <!-- <th>&nbsp;</th> -->
                </tr>
              </thead>
              <tbody>

              <?php
              if(isset($_POST['dtpFrom']) && isset($_POST['dtpTo']) && isset($_POST['Rep'])){
                $rep = $_POST['Rep'];
                $from = $_POST['dtpFrom'];
                $to = $_POST['dtpTo'];

                $line = 1;

                if($rep == 0){
                  // all for daterange start
                  foreach(Invoice::find_all_by_date_range($from,$to) as $invoice_data){
                    echo "<tr>";
                    echo "<td>".$line."</td>";
                    echo "<td style='width:125px;text-align:left;'>".$invoice_data->date_time."</td>";
                    echo "<td style='text-align:center;padding-left:10px;'>".$invoice_data->code."</td>";
                    echo "<td style='text-align:right;padding-right:15px;'>".$invoice_data->net_amount."</td>";
                    echo "<td style='text-align:center;'>".$invoice_data->customer_id()->name."</td>";
                    echo "</tr>";
                    $net_total = $net_total + $invoice_data->net_amount;
                    ++$line;
                  }
                  // all for daterange ends
                }else{
                  // all for daterange start
                  foreach(Invoice::find_all_by_customer_id_user($rep,$from,$to) as $invoice_data){
                    echo "<tr>";
                    echo "<td>".$line."</td>";
                    echo "<td style='width:125px;text-align:left;'>".$invoice_data->date_time."</td>";
                    echo "<td style='text-align:center;padding-left:10px;'>".$invoice_data->code."</td>";
                    echo "<td style='text-align:right;padding-right:15px;'>".$invoice_data->net_amount."</td>";
                    echo "<td style='text-align:center;'>".$invoice_data->customer_id()->name."</td>";
                    echo "</tr>";
                    $net_total = $net_total + $invoice_data->net_amount;
                    ++$line;
                  }
                  // all for daterange ends
                }
              }
              ?>

              </tbody>
            </table>
            <hr/>
            <table class="table-striped" style="font-size:12px;">
              <tr>
                <td style="border-bottom:1px solid;padding-top:3px;">Net Amount:</td>
                <td style="text-align:right;border-bottom:1px solid;padding-top:3px;"><?php echo number_format($net_total,2); ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!--</div>-->
    </div>
  </div>
</div>

<?php include 'common/bottom_content.php'; ?>

<script>

$('#div_clear1').click(function () {
  $('#table_body').empty();
  $('#invoiced_total').html("0.00");
  $('#total_cost').html("0.00");
  $('#profit').html("0.00");
  $("#dtpFrom").val("yyyy-mm-dd");
  $("#dtpTo").val("yyyy-mm-dd");


});

$('#div_clear2').click(function () {
  $('#table_body').empty();
  $('#invoiced_total').html("0.00");
  $('#total_cost').html("0.00");
  $('#profit').html("0.00");
  $('#cmbFilter').prop('selectedIndex', 0);

});

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

//select customer////////////////////////////////////////

</script>

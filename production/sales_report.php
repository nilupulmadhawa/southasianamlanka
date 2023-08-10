<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Sales Report By Date Range</h3>
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
                            <h2 id="title">Select Date Range</h2>
                            <!-- <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button> -->

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form action="sales_report.php" method="post">
                                <div class="container-fluid divBackTopTable ">
                                    <div class="form-group col-md-5 col-sm-5 col-xs-5">
                                        <label>From :</label>
                                        <input type="text" class="form-control" id="dtpFrom" name="dtpFrom" autocomplete="off" />
                                    </div>

                                    <div class="form-group col-md-5 col-sm-5 col-xs-5">
                                        <label>To :</label>
                                        <input type="text" class="form-control" id="dtpTo" name="dtpTo" autocomplete="off" />
                                    </div>

                                    <div class="form-group col-md-2 col-sm-2 col-xs-2 ">
                                        <label>&nbsp;</label>
                                        <div class="ui-widget">
                                            <button name="btnShow" class="btn btn-default">Show <i class="glyphicon glyphicon-arrow-down"></i></button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <br/>

                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" id="print_div">
                    <div class="x_panel">
                        <div class="x_title" style="background-color: gray;color:white;border-radius: 5px 5px 0px 0px;"><h3><center>Sales Report
                          <?php
                          if(isset($_POST['dtpFrom']) && isset($_POST['dtpTo'])){
                            ?>
                            <a class="btn btn-default pull-right" href="sales_report_print.php?dtpFrom=<?php echo $_POST['dtpFrom']; ?>&&dtpTo=<?php echo $_POST['dtpTo']; ?>" target='_blank'> <i class="fa fa-print"></i> PRINT </a>

                            <?php
                          }
                          ?>
                        </center></h3></div>
                        <div class="x_content">
                            <div class="table-responsive">

                                <table id="sata_table" class="table table-striped " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style='text-align: right;'>Date</th>
                                            <th style='text-align: right;'>Bill No</th>
                                            <th style='text-align: right;'>Total</th>
                                            <th style='text-align: right;'>Discount</th>
                                            <th style='text-align: right;'>Net</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">

                                        <?php
                                        if(isset($_POST['dtpFrom']) && isset($_POST['dtpTo'])){

                                            foreach (Customer::find_all() as $cus_data) {

                                                $gross_total = 0;
                                                $dis_total = 0;
                                                $net_total = 0;
                                                $rowcount = 0;
                                                foreach (Invoice::find_all_by_customer_id($cus_data->id) as $inv_data) {

                                                    if($rowcount == 0){
                                                        echo "<tr>";
                                                        echo "<td colspan='6'><b>".$cus_data->name."</b></td>";
                                                        echo "</tr>";
                                                        ++$rowcount;
                                                    }

                                                    echo "<tr>";
                                                    echo "<td></td>";
                                                    echo "<td style='text-align: right;'>".$inv_data->date_time."</td>";
                                                    echo "<td style='text-align: right;'>".$inv_data->code."</td>";
                                                    echo "<td style='text-align: right;'>".$inv_data->gross_amount."</td>";
                                                    echo "<td style='text-align: right;'>".($inv_data->gross_amount - $inv_data->net_amount)."</td>";
                                                    echo "<td style='text-align: right;'>".$inv_data->net_amount."</td>";

                                                    echo "</tr>";
                                                    $gross_total = $gross_total + $inv_data->gross_amount;
                                                    $dis_total = $dis_total + ($inv_data->gross_amount - $inv_data->net_amount);
                                                    $net_total = $net_total + $inv_data->net_amount;
                                                }
                                                if($net_total > 0){
                                                  echo "<tr>";
                                                  echo "<td colspan='4' style='text-align:right;'><b>".number_format($gross_total,2)."</b></td>";
                                                  echo "<td style='text-align:right;'><b>".number_format($dis_total,2)."</b></td>";
                                                  echo "<td style='text-align:right;'><b>".number_format($net_total,2)."</b></td>";
                                                  echo "</tr>";
                                              }

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

 $('#btnShow').click(function () {

    submitData();
});

 function submitData() {
    var from = $("#dtpFrom").val();
    var to = $("#dtpTo").val();

    $.ajax({
        type: 'POST',
        url: "proccess/invoice_detail_report_process.php",
        data: {invoice_report: true, from: from, to: to},
        dataType: 'json',
        async: false,
        success: function (data) {
//                alert(data);
$('#table_body').empty();
var trHTML = "";
$.each(data, function (index, value) {
    trHTML += "<tr ><td>" + value["code"] +"</td><td>" + value["date_time"] + "</td><td>" + value["customer_name"] + "</td><td>" + value["net_amount"] +" LKR</td></tr>";

});


//                   var trFootHTML = "";
$.each(data, function (index, value) {
    var total_cost = 0;
    $('#invoiced_total').html(value["invoice_total"]+" LKR");
//
total_cost = parseInt(total_cost);
total_cost = total_cost + (value["final_cost"]);
$('#total_cost').html(total_cost+" LKR");
var profit = (value["invoice_total"])-(total_cost);
//
$('#profit').html(profit+ " LKR");

});

$('#table_body').append(trHTML);
//
},
error: function (xhr){
    alert(xhr.responseText);
}
});
}

    //print_div

    $('#btn_print').click(function (){
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

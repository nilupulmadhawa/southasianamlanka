<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">


            </div>

            <div class="title_right">
                <!-- <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button> -->
                <a class="btn btn-default pull-right" href="non_collected_invoice_print.php" target='_blank'> <i class="fa fa-print"></i> PRINT </a>

            </div>
        </div>

        <div class="clearfix"></div>
        <?php Functions::output_result(); ?>


        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content" id="print_div">

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
                        $date = date("Y-m-d h:i:s");
                        $date = strtotime($date.' -2 months');
                        $two_months = date('Y-m-d h:i:s', $date);

                        echo $two_months;



                        foreach (Customer::find_all() as $cus_data) {

                            $gross_total = 0;
                            $dis_total = 0;
                            $net_total = 0;
                            $rowcount = 0;
                            foreach (Invoice::find_all_before_date($cus_data->id, $two_months) as $inv_data) {

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


                      ?>

                  </tbody>

              </table>

          </div>
      </div>

  </div>
</div>
</div>
</div>
<!-- /page content -->

<?php include 'common/bottom_content.php'; ?>

<script>
    window.onfocus = function () {
//        location.reload();
};

$(document).ready(function () {
    $('#tblMain').DataTable({
        "paging": false,
//            "ordering": false,
"info": false
});
});


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

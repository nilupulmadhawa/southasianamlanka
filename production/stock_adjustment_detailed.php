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
        <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>
      </div>

    </div>

    <div class="clearfix"></div>
    <?php Functions::output_result(); ?>


    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_content" id="print_div">

          <table class="table table-striped table-bordered" cellspacing="0" width="100%" style="font-size: 12px;">
            <thead>
              <tr>
                <th>Adjustment ID</th>
                <th>Date Time</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Part Number</th>
                <th>Adjustment</th>
                <th>Reason</th>
                <th>Done By</th>
              </tr>
            </thead>
            <tbody>

              <?php


              $objects = StockAdj::find_all();

              foreach ($objects as $data) {
                $test = strtotime($data->current_date_time);
                $code = date('y',$test).date('m',$test).date('d',$test).sprintf('%05d', $data->id);
                ?>
                <tr>
                  <td>AD<?php echo $code; ?></td>
                  <td><?php echo $data->current_date_time; ?></td>
                  <td><?php echo $data->product_id()->brand; ?></td>
                  <td><?php echo $data->product_id()->description; ?></td>
                  <td><?php echo $data->product_id()->name; ?></td>
                  <td><?php echo $data->qty; ?></td>
                  <td><?php echo $data->reason; ?></td>
                  <td><?php echo $data->user_id()->name; ?></td>
                </tr>
                <?php
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

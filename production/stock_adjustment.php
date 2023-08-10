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

      </div>
    </div>

    <div class="clearfix"></div>
    <?php Functions::output_result(); ?>


    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_content" id="print_div">


          <form method="post" action="stock_adjustment_process.php">

            <input type="hidden" class="form-control" name="deliverer" value="<?php echo $_POST['deliverer_id']  ?>" />

            <table id="tblMain" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Brand</th>
                  <th>Description</th>
                  <th>Part Number</th>
                  <th>Quantity</th>
                  <th>Reason</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                <?php


                $objects = Inventory::find_all();

                foreach ($objects as $data) {

                  ?>
                  <tr>
                    <td><?php echo $data->product_id()->brand; ?></td>
                    <td><?php echo $data->product_id()->description; ?></td>
                    <td><?php echo $data->product_id()->name; ?></td>

                    <td><?php echo $data->qty ?></td>

                    <td>
                      <input type="text" class="form-control" name="reason<?php echo $data->id;  ?>" value="" />
                    </td>


                    <td>
                      <input type="number" class="form-control" name="row<?php echo $data->id;  ?>" value="" />
                    </td>
                  </tr>
                  <?php
                }

                ?>
              </tbody>
            </table>

            <button type="submit" class="btn btn-primary btn-block">UPDATE <i class="glyphicon glyphicon-arrow-down"></i></button>
          </form>

        </div>
      </div>
      <div class="x_panel">
        <div onclick="window.location.href:''" class="x_content">

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

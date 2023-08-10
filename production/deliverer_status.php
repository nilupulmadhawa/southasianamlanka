<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">

        <h3>Delivery Status Update</h3>

      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>
    <?php Functions::output_result(); ?>


    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_content" id="print_div">



            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>

                  <th>Invoice Number</th>
                  <th>Customer</th>
                  <th></th>


                </tr>
              </thead>
              <tbody>

                <?php
                $objects = Invoice::find_all_decending();

                foreach ($objects as $data) {

                  if(!empty($data->customer_id()->name)){
                    echo "<tr>";
                    echo "<td>".$data->code."</td>";
                    echo "<td>".$data->customer_id()->name."</td>";
                    echo "<td>";
                    ?>
                    <form  action="proccess/invoice_proccess.php" method="post">
                      <div class="col-sm-3" >
                        <label>Transport Method:</label>
                        <input type="hidden" class="form-control" name="delivery_update" value="<?php echo $data->id; ?>">
                        <input type="text" class="form-control" name="transport"  value="<?php echo $data->transport; ?>">
                      </div>
                      <div class="col-sm-3">
                        <label for="pwd">Details:</label>
                        <input type="text" class="form-control" name="details"  value="<?php echo $data->details; ?>">
                      </div>
                      <div class="col-sm-3">
                        <label for="pwd">Contact:</label>
                        <input type="text" class="form-control" name="contact"  value="<?php echo $data->contact; ?>">
                      </div>
                      <div class="col-sm-3">
                        <label for="pwd">No Of Packs:</label>
                        <input type="text" class="form-control" name="no_of_packs"  value="<?php echo $data->no_of_packs; ?>">
                      </div>
                      <div class="col-sm-3">
                        <label for="pwd"><br/>Weight:</label>
                        <input type="text" class="form-control" name="weight"  value="<?php echo $data->weight; ?>">
                      </div>

                      <div class="col-sm-3">
                        <label for="pwd"><br/>Paid Amount:</label>
                        <input type="text" class="form-control" name="paid_amount"  value="<?php echo $data->paid_amount; ?>">
                      </div>

                      <div class="col-sm-3">
                        <label for="pwd"><br/>Tracking No:</label>
                        <input type="text" class="form-control" name="tracking_no"  value="<?php echo $data->tracking_no; ?>">
                      </div>

                      <div class="col-sm-3">
                        <label for="pwd">Conformation time and Person:</label>
                        <input type="text" class="form-control" name="person"  value="<?php echo $data->person; ?>">
                      </div>

                      <div class="col-sm-12">
                        <label for="pwd">Comment:</label>
                        <input type="text" class="form-control" name="comment"  value="<?php echo $data->comment; ?>">
                      </div>

                      <div class="col-sm-12">
                        <br/>
                        <button type="submit" class="btn btn-primary btn-block">UPDATE</button>

                      </div>
                    </form>
                    <?php
                    echo "</td>";
                    echo "</tr>";
                  }
                }
                ?>
              </tbody>
            </table>
          </form>

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

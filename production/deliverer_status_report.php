<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Payment Management</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <td>Invoice Number</td>
                  <td>Customer</td>
                  <td>Transport Method</td>
                  <td>Details</td>
                  <td>Contact</td>
                  <td>Weight</td>
                  <td>Paid Amount</td>
                  <td>No Of Packs</td>
                  <td>Tracking No</td>
                  <td>Conformation time and Person:</td>
                  <td>Comment</td>
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
                    echo "<td>".$data->transport."</td>";
                    echo "<td>".$data->details."</td>";
                    echo "<td>".$data->contact."</td>";
                    echo "<td>".$data->weight."</td>";
                    echo "<td>".$data->paid_amount."</td>";
                    echo "<td>".$data->no_of_packs."</td>";
                    echo "<td>".$data->tracking_no."</td>";
                    echo "<td>".$data->person."</td>";
                    echo "<td>".$data->comment."</td>";
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

$('#datatable-responsive').dataTable( {
  "paging": false
} );
</script>

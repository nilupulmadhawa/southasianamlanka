<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Write Off Invoice Detailed Report</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <?php Functions::output_result(); ?>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Invoice Number</th>
                  <th>Amount</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach(WriteOff::find_all() as $data){
                  echo "<tr>";
                  echo "<td>".$data->invoice_id()->code."</td>";
                  echo "<td>".$data->amount."</td>";
                  echo "<td>".$data->write_off_date."</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="x_panel">

        </div>
      </div>
    </div>
  </div>
</div>

<!--/page content-->
<?php include './common/bottom_content.php'; ?>

<script>
window.onfocus = function () {
  //        location.reload();
};
</script>

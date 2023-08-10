<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Initial Inventory Report</h3>
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
            <a href="inventory.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>

                  <th>Balance ID</th>
                  <th>Product</th>
                  <th style="text-align:center;">Quantity</th>
                  <th style="text-align:center;">Balance Date</th>

                </tr>
              </thead>
              <tbody>

                <?php
                foreach(Initial::find_all() as $data){
                  echo "<tr>";
                  echo "<td>BAL".sprintf('%05d', $data->id)."</td>";
                  echo "<td>";

                  $product_data = Product::find_by_id($data->product_id);
                  echo $product_data->name;

                  echo "</td>";

                  echo "<td style='text-align:center;'>".$data->qty."</td>";
                  echo "<td style='text-align:center;'>".$data->balance_date."</td>";
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

</script>

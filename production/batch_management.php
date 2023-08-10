<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Batch Management</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <!-- <a href="batch.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a> -->
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="tblMain" class="table table-striped table-bordered  nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>GRN Number</th>
                  <th>Brand</th>
                  <th>Part Number</th>
                  <th>Description</th>
                  <th>Cost</th>
                  <th>Retail Price</th>
                  <th>Updated Dollar Rate</th>

                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                <?php

                // $total_records = Batch::row_count();
                // $pagination = new Pagination($total_records);
                $objects = Batch::find_all();

                foreach ($objects as $batch) {
                  ?>
                  <tr>
                    <td><?php echo $batch->code ?></td>
                    <td>
                      <?php
                      $initial = 1;
                      foreach(GRNProduct::find_all_by_batch_id($batch->id) as $data){
                        $initial = 0;
                        echo $data->grn_id()->code." ";
                      }

                      if($initial == 1){
                        if($data = Initial::find_by_product_id($batch->product_id)){
                          echo "BAL".sprintf('%05d', $data->id);
                        }
                      }
                      ?>
                    </td>
                    <td><?php echo $batch->product_id()->brand ?></td>
                    <td><?php echo $batch->product_id()->name ?></td>
                    <td><?php echo $batch->product_id()->description ?></td>
                    <td><?php echo number_format($batch->cost ,2)?></td>
                    <td><?php echo number_format($batch->retail_price,2) ?></td>
                    <td><?php echo number_format($batch->dollar_rate,2) ?></td>

                    <td>

                      <a href="batch.php?id=<?php echo Functions::custom_crypt($batch->id); ?>">
                        <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
                      </a>

                    </td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="x_panel">
          <div onclick="window.location.href:''" class="x_content">
            <?php
            // echo $pagination->get_pagination_links_html1("batch_management.php");
            ?>
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
</script>

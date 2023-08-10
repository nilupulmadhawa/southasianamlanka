<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>
<!-- page content -->
<div class="right_col" role="main" style="background-color:white;">
  <div class="">
    <div class="row">
      <div class="col-sm-12" style="text-align:center;padding:5px;">
        <?php
        // include 'proccess/backup_process.php';
        ?>
        <!-- <a href="backup/" class="btn btn-primary btn-xs" target='_blank'> View Backups <a> -->
        </div>
        <div class="row tile_count">

          <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="text-align:center;">
            <span class="count_top"><i class="fa fa-user"></i> PLACE A GRN</span>
            <div class="count"><a href="product_grn.php" style="padding:20px;" class="btn btn-primary btn-block" role="button">ADD PPRODUCT GRN</a></div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="text-align:center;">
            <span class="count_top"><i class="fa fa-user"></i> Place A Payment</span>
            <div class="count"><a href="invoice_by_deliverer.php" style="padding:20px;" class="btn btn-primary btn-block" role="button">ADD INVOICE</a></div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="text-align:center;">
            <span class="count_top"><i class="fa fa-user"></i> Make A Payment</span>
            <div class="count green"><a href="payment.php" style="padding:20px;" class="btn btn-primary btn-block" role="button">ADD PAYMENT</a></div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="text-align:center;">
            <span class="count_top"><i class="fa fa-user"></i> Place A Return</span>
            <div class="count"><a href="product_return_by_deliverer.php" style="padding:20px;" class="btn btn-primary btn-block" role="button">PRODUCT RETURN</a></div>
          </div>



        </div>

        <div class="page-title">
          <div class="title_right">
            <a href="sys_check.php" class="btn btn-primary" target="_blank">SYS CHECK<a/>
            </div>
          </div>


          <div class="clearfix"></div>
          <?php Functions::output_result(); ?>
          <div class="row" style="padding: 5px;">
            <div class="col-sm-6">
              <a href="index_noncollect.php" class="btn btn-primary btn-block" style="padding-top:20px;padding-bottom:20px;font-weight:800;"> VIEW NON COLLECTED INVOCE DETAILED REPORT </a>
            </div>
            <div class="col-sm-6">
              <a href="index_target.php" class="btn btn-primary btn-block" style="padding-top:20px;padding-bottom:20px;font-weight:800;"> VIEW TARGET REPORT </a>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- /page content -->
    <?php include 'common/bottom_content.php'; ?>
    <script>

    </script>

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
        include 'proccess/backup_process.php';
        ?>
        <a href="backup/" class="btn btn-primary btn-xs" target='_blank'> View Backups <a>
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

          <div class="col-sm-12" style="margin-bottom:50px;text-align:center;">
            <label> <b style="font-size:15px;font-weight:900;">TARGET ACHIEVEMENT REPORT</b> </label>
            <table class="table table-striped " cellspacing="0" width="100%" style="font-size:15px;font-weight:900;">
              <thead>
                <tr>

                  <th style='text-align: left;'>User Name</th>
                  <th style='text-align: right;'>Monthly Target</th>
                  <th style='text-align: right;'>Current Achievement</th>
                  <th style='text-align: right;'>Returns</th>
                  <th style='text-align: right;'>Current ( After Returns ) Achievement</th>
                  <th style='text-align: center;'></th>
                  <th style='text-align: center;'>Sales Commision</th>
                  <th style='text-align: center;'>Status</th>

                </tr>
              </thead>
              <tbody>
                <?php
                foreach( User::find_all() as $data ){
                  echo "<tr>";
                  echo "<td style='text-align:left;'>".$data->name."</td>";
                  echo "<td style='text-align:right;'>".number_format($data->target,2)."</td>";
                  $total = 0;
                  $current_month = date('m');
                  $current_year = date('Y');

                  // INVOICE TOTAL
                  foreach(Invoice::find_all_by_rep_month( $current_month, $data->id, $current_year ) as $invoice_data){
                    $total = $total + $invoice_data->net_amount;
                  }

                  // PRODUCT Return
                  $total_amount = 0;
                  $return_datas = ProductReturn::find_all_month($current_month, $current_year);
                  foreach( $return_datas as $retrun_data ){
                    foreach( ProductReturnInvoice::find_all_by_product_return_id($retrun_data->id) as $datas ){
                      if($datas->invoice_id()->customer_id()->allocated_rep == $data->id ){
                        $total_amount = $total_amount - $datas->return_amount;
                      }
                    }
                  }

                  echo "<td style='text-align:right;'>".number_format($total,2)."</td>";
                  echo "<td style='text-align:right;'>".number_format($total_amount,2)."</td>";
                  $total = $total + $total_amount;
                  echo "<td style='text-align:right;'>".number_format($total,2)."</td>";
                  echo "<td style='text-align:right;'>";
                  if( $data->target == 0 ){
                    $target_calculation = 1;
                  }else{
                    $target_calculation = $data->target;
                  }
                  // echo $target_calculation;
                  $calculation = ($total) / $target_calculation  ;
                  $calculation = $calculation * 100;
                  echo number_format($calculation);
                  echo "%";
                  $progress = 0;
                  if($calculation>100){
                    $progress = 100;
                  }else{
                    $progress = $calculation;
                  }
                  echo"</td>";
                  echo"<td style='text-align:center;'>";
                  $commision = $total * 0.5;
                  $commision = $commision / 100;
                  echo number_format($commision,2);
                  echo "</td>";
                  echo "<td>";
                  ?>
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                    aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress; ?>%">
                    <span class="sr-only"><?php echo $calculation; ?>% Complete</span>
                  </div>
                </div>
                <?php
                echo "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>


        </div>

      </div>

    </div>
  </div>
</div>
<!-- /page content -->
<?php include 'common/bottom_content.php'; ?>
<script>

</script>

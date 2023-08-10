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

        <!-- non collected details -->
        <div class="col-sm-6" style="border:1px solid;border-radius: 10px;text-align: center;min-height: 400px;">
          <label style="font-size: 15px;text-transform: uppercase;font-weight: bold;">Non Collected Customer Details: ( Over Two Months )</label>


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
<!-- /page content -->
<?php include 'common/bottom_content.php'; ?>
<script>

</script>

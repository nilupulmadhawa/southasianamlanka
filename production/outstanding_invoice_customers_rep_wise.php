<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>
<style>
.rightalign{
  text-align:right;
}

form::after{
  display: inline;
}
</style>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Outstanding Report - Rep Wise</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">


          <form class="form-inline" action="outstanding_invoice_customers_rep_print.php" method="post" target="_blank">

            <div class="form-group">
              <label for="email">Rep Name:</label>
              <select class="form-control" name="rep">
                <option value='0'>All</option>
                <?php
                foreach(User::find_all() as $data){
                  echo "<option value='".$data->id."'>".$data->name."</option>";
                }
                ?>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">PRINT</button>
          </form>

          <!-- <button class="btn btn-default pull-right" id="btn_print" style="display: inline;"><i class="fa fa-print"></i>Print</button> -->
          <!-- <a class="btn btn-default pull-right" href="outstanding_invoice_customers_rep_print.php" target='_blank'> <i class="fa fa-print"></i> PRINT </a> -->

          <div class="x_content" id="div_print">
            <table id="datatable-responsive" class="" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <!--<th>ID</th>-->
                  <th style="text-align: left;">Invoice Number</th>
                  <th style="text-align:right;">Date</th>
                  <th style="text-align:right;">Net Invoice Amount</th>
                  <th style="text-align:right;">Paid Amount</th>
                  <th style="text-align:right;">Balance</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total = 0;

                $customers=array();
                if (!isset($_POST["slct_cust"]) or $_POST["slct_cust"] == 0) {
                  $customers = Customer::find_all();
                }else{
                  $customers[] = Customer::find_by_id($_POST["slct_cust"]);
                }

                $tone = 0;
                $ttwo =0;
                $tthree = 0;
                $tfour = 0;
                $tfive = 0;
                $tsix = 0;
                $ta = 0;

                $full_total = 0;

                foreach ($customers as $customer) {
                  $invoices = Invoice::customer_id_pending($customer->id);
                  $inv_count = count($invoices);

                  $outperiod = $customer->period;

                  if ($inv_count != 0) {
                    ?>
                    <tr>
                      <td colspan="8" style="text-align: left; padding-top: 10px;font-weight:800;">
                        <?php
                        $balance = 0;
                        $balance_str = "";

                        echo $customer->name . " ( " . $customer->address . " ) " . $customer->phone;
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="9"><hr style="margin: 0px 0px 5px;"/></td>
                    </tr>

                    <?php
                    $one = 0;
                    $two = 0;
                    $three = 0;
                    $four = 0;
                    $five = 0;
                    $six = 0;
                    $line_total = 0;
                    $total_balance = 0;
                    foreach ($invoices as $invoice) {
                      ?>
                      <tr>
                        <td style="text-align:left;border-bottom:1px solid;padding-top:3px;"><?php echo $invoice->code; ?></td>
                        <td style="text-align: right;border-bottom:1px solid;padding-top:3px;"><?php echo $invoice->date_time; ?></td>
                        <td style="text-align: right;border-bottom:1px solid;padding-top:3px;"><?php echo number_format($invoice->net_amount,2); ?></td>
                        <td style="text-align: right;border-bottom:1px solid;padding-top:3px;"><?php echo number_format($invoice->net_amount - $invoice->balance,2); ?></td>
                        <td style="text-align: right;border-bottom:1px solid;padding-top:3px;"><?php echo number_format($invoice->balance,2); ?></td>
                      </tr>
                      <?php
                      $total_balance = $total_balance + $invoice->balance;
                    }

                    ?>
                    <tr style="font-weight:800;">
                      <td colspan="4" style="text-align:right;">CUSTOMER TOTAL BALANCE</td>
                      <td style="text-align: right;"><?php echo number_format($total_balance,2); ?></td>
                    </tr>
                    <?php
                    $full_total = $full_total + $total_balance;
                  }
                }
                ?>

                <tr style="font-weight:800;font-size:17px;">
                  <td colspan="4" style="text-align:right;padding-top:20px;">TOTAL BALANCE</td>
                  <td style="text-align: right;padding-top:20px;"><?php echo number_format($full_total,2); ?></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--/page content-->
<?php include 'common/bottom_content.php'; ?>

<script>
$('#btn_print').click(function () {
  //window.print("reservation.php");
  PrintDiv();
});
function PrintDiv() {
  var divToPrint = document.getElementById('div_print');
  var popupWin = window.open('', '_blank', 'width=800,height=500');
  popupWin.document.open();
  popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
  popupWin.document.close();
}

window.onfocus = function () {
  //location.reload();
};
</script>

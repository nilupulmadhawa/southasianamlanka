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
        <h3>Return Cheque Report - Rep Wise</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">


          <!-- <form class="form-inline" action="outstanding_invoice_customers_rep_print.php" method="post" target="_blank">

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
          </form> -->

          <!-- <button class="btn btn-default pull-right" id="btn_print" style="display: inline;"><i class="fa fa-print"></i>Print</button> -->
          <!-- <a class="btn btn-default pull-right" href="outstanding_invoice_customers_rep_print.php" target='_blank'> <i class="fa fa-print"></i> PRINT </a> -->

          <div class="x_content" id="div_print">
            <table id="datatable-responsive" class="" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <!--<th>ID</th>-->
                  <th style="text-align: center;">Cheque Number</th>
                  <th style="text-align: center;">Bank</th>
                  <th style="text-align: center;">Branch</th>
                  <th style="text-align:center;">Date</th>
                  <th style="text-align:center;">Status</th>
                  <th style="text-align:right;">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $users=User::find_all();

                foreach ($users as $user) {
                  $cheques = Cheque::find_by_sql("SELECT c.* FROM hna0s9ce_saaims.payment_cheque pc
                                                INNER JOIN hna0s9ce_saaims.payment_invoice pi ON pi.payment_id = pc.payment_id
                                                INNER JOIN hna0s9ce_saaims.invoice i ON i.id = pi.invoice_id
                                                INNER JOIN hna0s9ce_saaims.cheque c ON c.id = pc.cheque_id
                                                WHERE i.user_id = $user->id AND (c.cheque_status_id = 3 OR c.cheque_status_id = 4)");
                  $inv_count = count($cheques);


                  if ($inv_count != 0) {
                    ?>
                    <tr>
                      <td colspan="8" style="text-align: left; padding-top: 10px;font-weight:800;">
                        <?php
                        echo $user->name . " ( " . $user->address . " ) " . $user->contact_no;
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="9"><hr style="margin: 0px 0px 5px;"/></td>
                    </tr>

                    <?php
                    foreach ($cheques as $cheque) {
                      ?>
                      <tr>
                        <td style="text-align:center;border-bottom:1px solid;padding-top:3px;"><?php echo $cheque->cheque_no; ?></td>
                        <td style="text-align: center;border-bottom:1px solid;padding-top:3px;"><?php echo $cheque->bank_id()->name ?></td>
                        <td style="text-align: center;border-bottom:1px solid;padding-top:3px;"><?php echo $cheque->branch?? "-"?></td>
                        <td style="text-align: center;border-bottom:1px solid;padding-top:3px;"><?php echo $cheque->date; ?></td>
                        <td style="text-align: center;border-bottom:1px solid;padding-top:3px;"><?php echo $cheque->cheque_status_id()->name ?></td>
                        <td style="text-align: right;border-bottom:1px solid;padding-top:3px;"><?php echo number_format($cheque->amount); ?></td>
                      </tr>
                      <?php
                    }
                    ?>
                    <tr>
                        <td colspan="9" style="height:35px"></td>
                    </tr>
                    <?php
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

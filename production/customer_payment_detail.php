<?php
require_once './../util/initialize.php';

if (isset($_GET["id"])) {
  $id= $_GET["id"];
  if($customer = Customer::find_by_id($id)){

  }else{
    Session::set_error("Entry not available...");
    Functions::redirect_to("index.php");
  }
}else{
  Functions::redirect_to("index.php");
}

include './common/upper_content.php';

?>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3 style='font-weight:800;'>PAYMENT DETAILED</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>CUSTOMER NAME: <b><?php echo $customer->name; ?></b> <span class="badge" style="color:black;background-color:#dfe6e9;"> <?php if($customer->status == 0){ echo "PENDING"; }elseif($customer->status == 1){ echo "APPROVED"; }elseif($customer->status == 2){ echo "REJECTED"; } ?> <?php if($customer->status_by!=0){ echo " (By: ".$customer->status_by()->name.")";}else{ echo " ( By: System Initial )"; } ?></span> </h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <div class="col-md-12 col-sm-12 col-xs-12 profile_left">

                <!-- table start -->

                <table class=" dt table table-striped dt-button-collection table-condensed"  width="100%">
                  <thead>
                    <tr>
                      <th>Payment</th>
                      <th>Invoice</th>
                      <th>Payment Date</th>
                      <th>Paying Method</th>
                      <th style='text-align:center;'>Cheque Number</th>
                      <th style='text-align:center;'>Bank Name</th>
                      <th style='text-align:center;'>Cheque Date</th>

                      <th>Amount</th>
                      <th>Status</th>
                      <th>User</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $status = 0;
                    $repeat = 0;
                    foreach (Payment::find_all_by_customer_id($customer->id) as $payment) {
                      if($payment->id != $status){
                        $status = $payment->id;
                        $repeat = 1;
                      }else{
                        $repeat = 0;
                      }

                      if($repeat != 0){

                      ?>
                      <tr id="<?php echo $payment->id ?>">
                        <td><?php echo $payment->code ?></td>


                        <td>
                          <?php
                          $invoices = array();
                          foreach (PaymentInvoice::find_all_by_payment_id($payment->id) as $payment_invoice) {
                            $invoices[] = $payment_invoice->invoice_id()->code;
                          }
                          echo join(", ", $invoices);
                          ?>
                        </td>
                        <td><?php echo $payment->date_time; ?></td>
                        <td><?php echo $payment->payment_method_id()->name; ?></td>
                        <?php
                        if($payment->payment_method_id == 2){
                          $cheque_details = PaymentCheque::find_by_payment_id($payment->id);
                          ?>
                          <td style='text-align:left;'> <?php echo $cheque_details->cheque_id()->cheque_no; ?>  </td>
                          <td style='text-align:left;'> <b><?php echo $cheque_details->cheque_id()->bank_id()->name; ?></b>  </td>
                          <td style='text-align:left;'> <?php echo $cheque_details->cheque_id()->date; ?>  </td>
                          <?php
                        }else{
                          ?>
                          <td>--</td>
                          <td>--</td>
                          <td>--</td>
                          <?php
                        }
                        ?>
                        <td><?php echo $payment->amount ?></td>

                        <td><?php echo $payment->payment_status_id()->name ?></td>

                        <td><a target="_blank" href="user_profile.php"><?php echo User::find_by_id($payment->user_id)->name; ?></a></td>
                        <td>
                          <form action="payment_prev.php" method="post" target="_blank" style="float: left;">
                            <input type="hidden" name="payment_id" value="<?php echo $payment->id ?>"/>
                            <button type="submit" name="view" class="btn btn-primary btn-xs" ><i class="fa fa-external-link-square"></i> View</button>
                          </form>
                        </td>
                      </tr>
                      <?php
                    }
                    }
                    ?>
                  </tbody>
                </table>

                <!-- table ends -->


              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->
  <?php include './common/bottom_content.php'; ?><!-- bottom content -->
  <script>


  </script>

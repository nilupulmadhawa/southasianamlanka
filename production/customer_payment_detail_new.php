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
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach(PaymentInvoice::find_all_by_customer_id($customer->id) as $payment_invoice_data){
                      echo "<tr>";
                      $payment_data = Payment::find_by_id($payment_invoice_data->payment_id);
                      echo "<td>".$payment_invoice_data->payment_id."</td>";
                      echo "<td>".$payment_invoice_data->invoice_id()->code."</td>";
                      echo "<td>".$payment_data->date_time."</td>";
                      echo "<td>".$payment_data->payment_method_id()->name."</td>";
                      if($payment_data->payment_method_id == 2){
                        $paymentcheque = PaymentCheque::find_by_payment_id($payment_invoice_data->payment_id);
                        echo "<td>".$paymentcheque->cheque_id()->cheque_no."</td>";
                        echo "<td>".$paymentcheque->cheque_id()->bank_id()->name."</td>";
                        echo "<td>".$paymentcheque->cheque_id()->date."</td>";
                        echo "<td>".$payment_invoice_data->amount."</td>";
                        if($paymentcheque->cheque_id()->cheque_status_id == 1){
                          echo "<td style='background-color:orange;color:white;'>".$paymentcheque->cheque_id()->cheque_status_id()->name."</td>";

                        }else if($paymentcheque->cheque_id()->cheque_status_id == 2){
                          echo "<td style='background-color:green;color:white;'>".$paymentcheque->cheque_id()->cheque_status_id()->name."</td>";

                        }else if($paymentcheque->cheque_id()->cheque_status_id == 3){
                          echo "<td style='background-color:yellow;color:white;'>".$paymentcheque->cheque_id()->cheque_status_id()->name."</td>";

                        }else if($paymentcheque->cheque_id()->cheque_status_id == 4){
                          echo "<td style='background-color:red;color:white;'>".$paymentcheque->cheque_id()->cheque_status_id()->name."</td>";

                        }
                      }else{
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        echo "<td>".$payment_invoice_data->amount."</td>";
                        echo "<td style='background-color:green;color:white;'>Done</td>";
                      }

                      ?>
                      <td>
                        <form action="payment_prev.php" method="post" target="_blank" style="float: left;">
                          <input type="hidden" name="payment_id" value="<?php echo $payment_invoice_data->payment_id ?>"/>
                          <button type="submit" name="view" class="btn btn-primary btn-xs" ><i class="fa fa-external-link-square"></i> View</button>
                        </form>
                      </td>
                      <?php
                      echo "</tr>";
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

<?php
require_once './../util/initialize.php';

//if (isset($_POST["invoice_id"]) && $invoice = Invoice::find_by_id($_POST["invoice_id"])) {
//    $invoice_inventorys = InvoiceInventory::find_all_by_invoice_id($invoice->id);
//    if ($invoice->customer_id) {
//        $Customer = $invoice->customer_id();
//    } else {
//        $Customer = new Customer();
//    }
//} else {
//    Functions::redirect_to("./invoice_management.php");
//}
$checkcount = 0;
$invoice_id_print = Invoice::find_to_be_printed();
$checkcount = count($invoice_id_print);

if ($checkcount > 0) {

  foreach($invoice_id_print as $print){
    $invoice_id = $print->id;
  }

  // $invoice_id = 1;
    if ($invoice = Invoice::find_by_id($invoice_id)) {
        $customer = new Customer();
        if ($invoice->customer_id) {
            $customer = Customer::find_by_id($invoice->customer_id);
        }
        $order = new CustomerOrder();
        if (isset($invoice->customer_order_id)) {
            $order = CustomerOrder::find_by_id($invoice->customer_order_id);
            $customer = $order->customer_id();
        }

        $invoice_inventorys = InvoiceInventory::find_all_by_invoice_id($invoice->id);
    } else {
        Session::set_error("Entry not available...");
        Functions::redirect_to("./invoice_management.php");
    }
}

include './common/upper_content.php';
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>AUTOMATED INVOICE PRINT</h3>
            </div>
            <div class="title_right">
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if($checkcount>0){
          echo $checkcount."<br/>";
          ?>
        <div id="div_to_print">
            <div class="row" >
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_content">

                            <section class="content invoice">
                                <div class="row" style="padding-left:20px;">
                                    <div class="col-xs-6 invoice-header">
                                      <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:left;">
                                        <p style="font-size:20px;margin-bottom:-5px;"><b><?php echo ProjectConfig::$project_name; ?></b></p>
                                        <address>
                                            <?php echo ProjectConfig::$address_html; ?>
                                            <?php echo ProjectConfig::$tel_html; ?>
                                        </address>
                                      </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                          <!-- <small>To</small> -->
                                          <address>
                                              <strong><?php echo $customer->name; ?></strong>
                                              <br><?php echo $customer->address; ?>
                                              <br><?php echo $customer->phone; ?>
                                              <br><?php echo $customer->email; ?>
                                          </address>
                                        </div>
                                        <!-- <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right">
                                            <h2 style="font-size:12px;margin-bottom:-10px;">Date : <?php echo $invoice->date_time; ?></h2>
                                            <h2 style="font-size:12px;margin-bottom:-10px;">Invoice No : <?php echo $invoice->code; ?></h2>
                                            <h2 style="font-size:12px;"><b>Amount : </b> <?php echo number_format($invoice->net_amount, 2); ?> LKR</h2>

                                        </div> -->
                                    </div>
                                      <div class="col-xs-6 invoice-header">
                                        <div class="col-md-3 col-sm-3 col-xs-3" style="text-align: left">
                                              </div>

                                        <div class="col-md-3 col-sm-3 col-xs-3" style="text-align: left;padding-top:10px;">
                                            <p style="font-size:12px;margin-bottom:-5px;">Date</p>
                                            <p style="font-size:12px;margin-bottom:-5px;">Invoice No</p>
                                            <p style="font-size:12px;margin-bottom:-5px;"><b>Amount </b> </p>
                                            <p style="font-size:11px;margin-bottom:-5px;">Invoice Type </p>

                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: left;padding-top:10px;">
                                            <p style="font-size:12px;margin-bottom:-5px;">: <?php echo $invoice->date_time; ?></p>
                                            <p style="font-size:12px;margin-bottom:-5px;">: <?php echo $invoice->code; ?></p>
                                            <p style="font-size:12px;margin-bottom:-5px;"><b>: </b> <?php echo number_format($invoice->net_amount, 2); ?> LKR</p>
                                            <p style="font-size:12px;margin-bottom:-5px;">: <?php
                                            if (isset($invoice_id)) {
                                              echo $invoice->invoice_method;
                                            }else{
                                              echo $invoice->invoice_type_id1;
                                            }


                                            ?> </h2>

                                        </div>

                                      </div>
                                </div>
                                <div class="row invoice-info">

                                    <!-- <div class="col-xs-4 invoice-col">
                                        <small>From</small>
                                        <address>
                                            <?php echo ProjectConfig::$address_html; ?>
                                            <br/>
                                            <?php echo ProjectConfig::$tel_html; ?>
                                        </address>
                                    </div> -->

                                    <!-- <div class="col-xs-4 invoice-col">

                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <b>Ammount:</b> <?php echo number_format($invoice->net_amount, 2); ?> LKR
                                    </div> -->

                                </div>
                                <div class="row" style="font-size:12px;">
                                  <div style="padding:50px;">
                                    <div class="col-xs-12 table">
                                        <table class="table table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <!-- <th>Inventory ID</th> -->
                                                    <th style='font-size:10px;'>Item</th>
                                                    <th style='text-align:center;font-size:10px;'>QTY</th>
                                                    <!-- <th style='text-align:right;font-size:10px;'>Price (Rs.)</th> -->
                                                    <!-- <th style='text-align:right;font-size:10px;'>Discount (Rs.)</th> -->
                                                    <th style='text-align:right;font-size:10px;'>Amount (Rs.)</th>
                                                    <!-- <th style='text-align:right;font-size:10px;'>Net Amount (Rs.)</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php
                                                    foreach ($invoice_inventorys as $invoice_inventory) {
                                                        echo "<tr>";
                                                        // echo "<td>" . $invoice_inventory->inventory_id . "</td>";
                                                        echo "<td style='font-size:10px;'>" . $invoice_inventory->inventory_id()->product_id()->name . " (Batch:" . $invoice_inventory->inventory_id()->batch_id()->code . ")</td>";
                                                        echo "<td style='text-align:center;font-size:10px;'>" . $invoice_inventory->qty . "</td>";
                                                        // echo "<td style='text-align:right;font-size:10px;'>" . $invoice_inventory->price . "</td>";

                                                        $unit_discount_str = $invoice_inventory->unit_discount;
                                                        if ((int) $invoice_inventory->unit_discount < 0) {
                                                            $unit_discount_str = "";
                                                        }

                                                        // echo "<td style='text-align:right;font-size:10px;'>" . $unit_discount_str . "</td>";

                                                        // echo "<td style='text-align:right;font-size:10px;'>" . $invoice_inventory->gross_amount . "</td>";
                                                        echo "<td style='text-align:right;font-size:10px;'>" . $invoice_inventory->net_amount . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                      </div>
                                    </div>
                                </div>
                                <div class="ccontainer" style="padding:30px;">
                                    <!--<div class="col-xs-6 col-xs-offset-6" style="text-align: right;">-->
                                    <div class="col-xs-6" style="text-align: right;">
                                        <!-- <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:50%;font-size:11px;">Gross Total (Rs.):</th>
                                                        <td style="font-size:11px;"><?php echo number_format($invoice->gross_amount, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="font-size:11px;">Discount (%) :</th>
                                                        <?php
                                                        $discont = ($invoice->gross_amount) - ($invoice->net_amount);
                                                        $discont = ($discont*100) / $invoice->gross_amount
                                                        ?>

                                                        <td style="font-size:11px;"><?php echo $discont; ?>%</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="font-size:11px;">Net Total (Rs.) :</th>
                                                        <td style="font-size:11px;"><?php echo number_format($invoice->net_amount, 2); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> -->
                                    </div>
                                    <div class="col-xs-6" style="text-align: right;">
                                      <div class="table-responsive">
                                          <table class="table table-striped">
                                              <tbody>
                                                  <tr>
                                                      <th style="width:50%;font-size:11px;">Gross Total (Rs.):</th>
                                                      <td style="font-size:11px;"><?php echo number_format($invoice->gross_amount, 2); ?></td>
                                                  </tr>
                                                  <tr>
                                                      <th style="font-size:11px;">Discount (%) :</th>
                                                      <?php
                                                      $discont = ($invoice->gross_amount) - ($invoice->net_amount);
                                                      $discont = ($discont*100) / $invoice->gross_amount
                                                      ?>

                                                      <td style="font-size:11px;"><?php echo $discont; ?>%</td>
                                                  </tr>
                                                  <tr>
                                                      <th style="font-size:11px;">Net Total (Rs.) :</th>
                                                      <td style="font-size:11px;"><?php echo number_format($invoice->net_amount, 2); ?></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th style="font-size:11px;">Cash (Rs.) :</th>
                                                        <td style="font-size:11px;"><strong><?php echo number_format(($invoice->net_amount) - ($invoice->balance), 2); ?></strong></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="font-size:11px;">Balance/Credit (Rs.) :</th>
                                                        <td style="font-size:11px;"><strong><?php echo number_format($invoice->balance, 2); ?></strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="ccontainer" style="padding:30px;">
                                    <!--<div class="col-xs-6 col-xs-offset-6" style="text-align: right;">-->
                                    <div class="col-xs-12" style="text-align: right;">
                                    <div class="col-xs-6" style="text-align: right;">
                                      <div class="table-responsive">
                                          <div class="col-xs-12" style="border:1px solid;padding-top:50px;text-align:center;">
                                            .................................<br/>
                                            <b>SALES REP/ASM SIGNATURE</b>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-6" style="text-align: right;">
                                        <div class="table-responsive">
                                            <div class="col-xs-12" style="border:1px solid;padding-top:50px;text-align:center;">
                                              .................................<br/>
                                              <b>CUSTOMERS SIGNATURE</b>
                                            </div>
                                        </div>
                                      </div>
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <?php } ?>
        <div class="x_panel">
            <div class="row no-print">



            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?php include './common/bottom_content.php'; ?>
<script>

  setTimeout(function(){
   window.location.reload(1);
  }, 5000);

   $('#btn_invoice_print').click(function () {
       PrintDiv();
   });
   <?php if($checkcount > 0){ ?>
   PrintDiv();
   <?php
   $invoice = Invoice::find_by_id($invoice_id);
   $invoice->is_printed = 1;
   $invoice->save();
 } ?>

    function PrintDiv() {
        var divToPrint = document.getElementById('div_to_print');
        var popupWin = window.open('', '_blank', 'width=800,height=500');
        popupWin.document.open();
        popupWin.document.write('<html><head><link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }

    $("#btnCheckout").click(function () {
        confirmSave();
    });

    function confirmSave() {
        $.confirm({
            icon: 'fa fa-question-circle',
            type: 'green',
            title: 'Checkout',
            content: 'Are you sure you want to Checkout ?',
            buttons: {
                yes: {
                    text: 'Yes',
                    btnClass: 'btn-green',
                    keys: ['enter'],
                    action: function () {
                        submitData();
                    }
                },
                cancel: function () {
                }
            }
        });
    }

    function submitData() {
        $.ajax({
            type: 'POST',
            url: "proccess/invoice_prev_proccess.php",
            data: {finalize: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                if (data) {
                    PrintDiv();
                }
//                FormOperations.postForm('invoice_management.php');
                $(location).attr('href', 'invoice_management.php');
            },
            error: function (xhr) {
//                alert("An error occured: " + xhr.status + " " + xhr.statusText);
                alert(xhr.responseText);
            }
        });
    }

    function confirmDelete(element) {
        var invoice_id = $(element).data("invoice_id");
        $.confirm({
            icon: 'fa fa-warning',
            type: 'red',
            title: 'Delete',
            content: 'Are you sure you want to delete this invoice?',
            buttons: {
                yes: {
                    text: 'Yes',
                    btnClass: 'btn-red',
//                    keys: ['enter'],
                    action: function () {
                        window.location = "proccess/invoice_delete_proccess.php?id=" + invoice_id;
                    }
                },
                cancel: function () {
                }
            }
        });
    }

</script>

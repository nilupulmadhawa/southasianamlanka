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

if (isset($_SESSION["invoice"]) && isset($_POST["new_invoice"])) {
  //    $ses_invoice = $_SESSION["invoice"];
  //
  //    $customer = new Customer();
  //    if ($ses_invoice["customer_id"]) {
  //        $customer = Customer::find_by_id($ses_invoice["customer_id"]);
  //    }
  //    $order = new CustomerOrder();
  //    if (isset($ses_invoice["customer_order_id"])) {
  //        $order = CustomerOrder::find_by_id($ses_invoice["customer_order_id"]);
  //        $customer = $order->customer_id();
  //    }
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $ses_invoice = $_SESSION["invoice"];
  $invoice = new Invoice();
  $invoice->code = $ses_invoice["code"];
  $invoice->date_time = $ses_invoice["date_time"];
  $invoice->invoice_status_id = 1;
  $invoice->gross_amount = $ses_invoice["gross_amount"];
  $invoice->net_amount = $ses_invoice["net_amount"];
  $invoice->balance = $ses_invoice["balance"];
  $invoice->invoice_type_id = $ses_invoice["invType"];
  $invoice->invoice_type_id1 = $ses_invoice["invType1"];
  $invoice->user_id = $ses_invoice["code"];

  $_SESSION['geolocation'] = NULL;

  $customer = new Customer();
  if ($ses_invoice["customer_id"]) {
    $customer = Customer::find_by_id($ses_invoice["customer_id"]);
    $invoice->customer_id = $customer->id;
  }
  $order = new CustomerOrder();
  if ($ses_invoice["order_customer_id"]) {
    $order = CustomerOrder::find_by_id($ses_invoice["order_id"]);
    $customer = $order->customer_id();
    $invoice->customer_order_id = $order->id;
    $invoice->customer_id = $order->customer_id;
  }

  $invoice_inventorys = array();
  foreach ($ses_invoice["invoice_inventories"] as $sess_invoice_inventory) {
    $invoice_inventory = new InvoiceInventory();
    $invoice_inventory->inventory_id = $sess_invoice_inventory["inventory_id"];
    $invoice_inventory->qty = $sess_invoice_inventory["qty"];
    $invoice_inventory->freeissue = $sess_invoice_inventory["freeissue"];
    $invoice_inventory->price = $sess_invoice_inventory["price"];
    $invoice_inventory->unit_discount = ($sess_invoice_inventory["unit_discount"]) ? $sess_invoice_inventory["unit_discount"] : 0;
    $invoice_inventory->gross_amount = ($invoice_inventory->qty) * ($invoice_inventory->price);
    $invoice_inventory->net_amount = ($invoice_inventory->qty) * (($invoice_inventory->price) - ($invoice_inventory->unit_discount));
    $invoice_inventorys[] = $invoice_inventory;
  }
} else if (isset($_GET["invoice_id"])) {
  if ($invoice = Invoice::find_by_id($_GET["invoice_id"])) {
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
} else if (isset($_POST["invoice_id"])) {
  if ($invoice = Invoice::find_by_id($_POST["invoice_id"])) {
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
} else {
  Functions::redirect_to("./invoice_management.php");
}

include './common/upper_content.php';
?>

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style>
.invSection{
  font-family: 'Roboto', sans-serif;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Invoice View</h3>
      </div>
      <div class="title_right">
      </div>
    </div>
    <div class="clearfix"></div>
    <div id="div_to_print" class="invSection">
      <div class="row" >
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">

            <div class="x_content">

              <section class="content invoice">
                <div class="row" style="padding-left:20px;">

                  <!-- <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:left;">
                  <div class="col-md-1 col-sm-1 col-xs-1" style="padding-top:10px;">
                  <img src="images/inv_logo.png" class="img-responsive">
                </div>
                <div class="col-md-11 col-sm-11 col-xs-11">
                <p style="font-size:30px;margin-bottom:-5px;"><b><?php echo ProjectConfig::$project_name; ?></b></p>
                <address>
                <?php echo ProjectConfig::$address_html; ?>
                <?php echo ProjectConfig::$tel_html; ?>
              </address>
            </div>
          </div> -->

          <div class="col-xs-12">
            <table style="width:800px;">

              <tr>
                <!-- <td style="width:10%;padding:5px;"><img src="images/cbl.png" class="img-responsive"></td> -->
                <td colspan="2" style="text-align:center;">
                  <p style="font-size:15px;text-transform: uppercase;"><b style="font-size:20px;"><?php echo ProjectConfig::$project_name; ?></b> <br/> NO: 332/29, LESSLISS LAND, RATHNAPURA ROAD, MUNAGAMA, HOARANA. <br/>
                    TEL: <?php echo ProjectConfig::$tel_html; ?> || FAX: 011 588 3813 || HOTLINE: 0777 191 784 / 0703 963 615</p>
                  </td>

                </tr>

              </table>

              <table style="width:800px;">

              <tr>
                <!-- <td style="width:10%;padding:5px;"><img src="images/cbl.png" class="img-responsive"></td> -->
                <td colspan="2" style="text-align:center;border-bottom: 1px solid">

                  <?php
                  if($invoice->is_printed == 1){
                    echo '<p style="font-size:17px;text-transform: uppercase;"><b>INVOICE COPY</b></p>';
                  }else{
                    echo '<p style="font-size:17px;text-transform: uppercase;"><b>INVOICE</b></p>';
                  }
                  ?>

                  </td>

                </tr>

              </table>

              <!-- <hr/> -->

              <table style="width:800px;font-size:12px;">

                <tr>
                  <td style="width:450px;padding-bottom:3px;"><b><u>CUSTOMER DETAILS</u></b></td>
                  <td></td>
                  <td></td>
                </tr>

                <tr>
                  <td><?php echo $customer->name; ?></td>
                  <td>Date</td>
                  <td>: <?php echo $invoice->date_time; ?> (Credit Period: 4 Months Only) </td>
                </tr>

                <tr>
                  <td><?php echo $customer->address; ?></td>
                  <td style="font-size: 12px;"><b>Invoice No</b></td>
                  <td style="font-size: 12px;">: <b><?php echo $invoice->code; ?></b></td>
                </tr>

                <tr>
                  <td><?php echo $customer->phone; ?></td>
                  <td>Sales By: </td>
                  <td>: <?php

                  $deliverer = new Deliverer();
                  if ($invoice->deliverer_id) {
                    $deliverer = Deliverer::find_by_id($invoice->deliverer_id);
                  }
                  echo $deliverer->name;

                  ?> </td>
                </tr>


                <tr style="font-size: 18px;">
                  <td></td>
                  <td><b>Amount</b></td>
                  <td>: <b><?php echo number_format($invoice->net_amount, 2); ?></b></td>
                </tr>





              </table>




            </div>



</div>

<div class="row" style="font-size:12px;margin-bottom:-50px;min-height:170px;">
  <div style="padding:20px;">
    <div class="col-xs-12 table">
      <table class="table-striped" style="width:800px;">
        <thead>
          <tr>
            <!-- <th>Inventory ID</th> -->
            <th style='font-size:12px;'>Item</th>
            <th style='font-size:12px;'>Description</th>
            <th style='font-size:12px;'>Part Number</th>
            <th style='font-size:12px;text-align: center;'>Brand</th>
            <th style='text-align:right;font-size:12px;text-align:center;'>QTY</th>
            <th style='text-align:right;font-size:12px;text-align:right;padding-left:7px;'>Amount</th>

            <!-- <th style='text-align:right;font-size:10px;'>Free Issue</th> -->
            <th style='text-align:right;font-size:12px;text-align: right;padding-left:7px;'>Discount</th>
            <th style='text-align:right;font-size:12px;text-align:right;padding-left:7px;'>Value</th>
            <!-- <th style='text-align:right;font-size:10px;'>Net Amount</th> -->
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            $rowcount = 1;
            foreach ($invoice_inventorys as $invoice_inventory) {
              echo "<tr style='padding:5px;'>";
              // echo "<td>" . $invoice_inventory->inventory_id . "</td>";
              echo "<td style='font-size:14px;padding:2px;'>".$rowcount ."</td>";
              ++$rowcount;
              echo "<td style='font-size:14px;padding:2px;'>".$invoice_inventory->inventory_id()->product_id()->description ."</td>";
              echo "<td style='font-size:14px;padding:2px;'>".$invoice_inventory->inventory_id()->product_id()->name ."</td>";

              $brand_name = $invoice_inventory->inventory_id()->product_id()->brand;
              $result = substr($brand_name, 0, 9);
              echo "<td style='font-size:11px;padding:2px;text-align:center;width:70px;'>" .$result. "</td>";

               echo "<td style='text-align:right;font-size:14px;text-align:center;'>" . $invoice_inventory->qty . "</td>";
               $value = 100 - $invoice_inventory->unit_discount;
               $value = $value / 100;
              $uPrice = ($invoice_inventory->price);
              echo "<td style='text-align:right;font-size:14px; padding-left:7px;'>" . number_format($uPrice,2) . "</td>";


              // echo "<td style='text-align:right;font-size:10px;'>" . $invoice_inventory->freeissue . "</td>";

              $unit_discount_str = $invoice_inventory->unit_discount;
              if ((int) $invoice_inventory->unit_discount < 0) {
                $unit_discount_str = "";
              }

              echo "<td style='text-align:right;font-size:14px;text-align:right;padding-left:7px;'>" . $unit_discount_str . "%</td>";

              // echo "<td style='text-align:right;font-size:10px;'>" . $invoice_inventory->gross_amount . "</td>";
              echo "<td style='text-align:right;font-size:14px;padding-left:7px;'>" . number_format($uPrice*$value*$invoice_inventory->qty,2) . "</td>";
              echo "</tr>";
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="container" style="padding:5px;">


  <div class="col-xs-12" style="text-align: right;">
    <!-- <div class="table-responsive" style="margin-bottom:-15px;"> -->
    <table style="width:400px;margin-left:400px;" class="table-striped">
      <tbody>
        <tr>
          <th style="width:235px;font-size:12px;padding:3px;">Gross Total (Rs.)</th>
          <th>:</th>
          <td style="font-size:12px;text-align:right;"> <?php echo number_format($invoice->gross_amount, 2); ?></td>
        </tr>
        <tr>
          <th style="font-size:12px;padding:3px;">Discount (%) </th>
          <?php
          $discont = ($invoice->gross_amount) - ($invoice->net_amount);
          if($invoice->gross_amount == 0){
          $discont = 0;
          }else{
              $discont = ($discont*100) / $invoice->gross_amount;
          }
          ?>
          <th>:</th>

          <td style="font-size:12px;text-align:right;"> <?php echo number_format($discont); ?>%</td>
        </tr>
        <tr>
          <th style="font-size:12px;padding:3px;">Net Total (Rs.) </th>
          <th>:</th>
          <td style="font-size:12px;text-align:right;"> <?php echo number_format($invoice->net_amount, 2); ?></td>
        </tr>
      </tbody>
    </table>
    <!-- </div> -->

  </div>
</div>
<!--<hr/>-->
<table style="width:800px;text-align:center;font-size:12px;margin-top:40px;">
  <tr>
    <td>   ...............................................<br/>
          SALES BY (<?php echo $deliverer->name; ?>)
    </td>
    <td>
      ...............................................<br/>
        CHECKED BY
    </td>
    <td>
      ...............................................<br/>
        RECIEVED BY (SIGNATURE AND STAMP)
    </td>
  </tr>

  <tr>
    <td colspan="3" style="font-size:12px;text-align:center;border-top:1px solid;">
      <p style="margin-bottom:0px;margin-top:5px;">*Cheques should be drawn to "SOUTH ASIAN AUTOMOBILES (PVT) LTD".</p>
      <p>යම් අඩුපාඩුවක් ඇතොත් දින 7ක් ඇතුලත දැනුම් දීමටත්, බිල්පත් අදාල චෙක්පත් දින 60ක් ඇතුලත ලබා දීමට කාරුණික වන්න.</p>
    </td>

  </tr>
</table>

<!-- <div class="container" style="padding:30px;">
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
  <div class="col-xs-12" style="font-size:12px;padding-top:10px;">
    <p style="margin-bottom:-5px;">*Cheques should be named to jeewaka herbals products (PVT) Ltd.</p>
    <p>*All credit bills should be settled within 30 days.</p>
  </div>
</div> -->
</section>
</div>
</div>
</div>
</div>
</div>
<div class="x_panel">
  <div class="row no-print">
    <div class="col-xs-12">
      <a href="invoice_by_deliverer.php" class="pull-right" style="float: left">
        <button class="btn btn-primary" ><i class="glyphicon glyphicon-edit"></i> New invoice</button>
      </a>
      <?php
      if (isset($invoice->id) && !empty($invoice->id)) {
        ?>

        <button onclick="confirmDelete(this);" data-invoice_id="<?php echo Functions::custom_crypt($invoice->id); ?>" class="btn btn-danger" ><i class="glyphicon glyphicon-trash"></i> Delete</button>
        <?php
        if($discont > 0 && $invoice->discount_approval == 0){
          ?>
          <a href="proccess/invoice_prev_proccess.php?approve=<?php echo $invoice->id; ?>" class="btn btn-info" role="button">Approve</a>
          <?php
        }else{
          ?>
          <button class="btn btn-default"  id="btn_invoice_print" ><i class="fa fa-print"></i> Print</button>
          <?php
        }
        ?>

        <?php ?>

        <?php
      } else {
        ?>
        <button id="btnCheckout" type="button" name="finalize" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Checkout</button>
        <?php
      }
      ?>


    </div>
  </div>
</div>
</div>
</div>
<!-- /page content -->
<?php include './common/bottom_content.php'; ?>
<script>

  function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            }
        };
        xmlhttp.open("GET", "proccess/invoice_prev_proccess.php?print=" + str, true);
        xmlhttp.send();
    }
}

$('#btn_invoice_print').click(function () {
  PrintDiv();
  showHint(<?php echo $invoice->id; ?>);
});

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

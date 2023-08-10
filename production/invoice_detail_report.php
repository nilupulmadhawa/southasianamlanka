<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Invoice Detail By Date Range</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="row" id="divInvoice">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2 id="title">Select Date Range</h2>
              <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>

              <div class="clearfix"></div>
            </div>



            <!--========================================================-->

            <div class="x_content">

              <div class="container-fluid  ">

                <ul class="nav nav-tabs bar_tabs" >
                  <li class="active"><a data-toggle="tab" href="#div1" id="div_clear1">Customer Vise Filter</a></li>
                </ul>

                <div class="tab-content">
                  <div class="tab-pane fade in active">
                    <!--<div class="form-group col-md-6 col-sm-6 col-xs-12 ">-->


                    <form class="form-inline" action="invoice_detail_report.php" method="post">

                      <label>Select Invoice</label>
                      <div class="ui-widget">
                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="invoice_id" >
                          <?php
                          foreach (Invoice::find_all() as $data) {
                            ?>
                            <option value="<?php echo $data->id; ?>"><?php echo $data->code; ?> || <?php echo $data->customer_id()->name; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                      <br/>
                      <button type="submit" class="btn btn-primary btn-block">VIEW</button>

                    </form>


                    <!--</div>-->
                  </div>

                </div>

              </div>

              <br/>
            </div>

          </div>
        </div>
      </div>
      <!--<div class="col-md-12 col-sm-12 col-xs-12" >-->
      <div class="x_panel" id="print_div">
        <div class="x_title" style="background-color: gray;color:white;border-radius: 5px 5px 0px 0px;"><h3><center>INVOICE COSTING</center></h3></div>
        <div class="x_content">
          <div class="table-responsive">

            <table id="sata_table" class="table table-striped " cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Invoice No</th>
                  <th>Invoice Date</th>
                  <th>Customer</th>
                  <th>Brand</th>
                  <th>Part Number</th>
                  <th>Qty</th>
                  <th style='text-align:right;'>Cost Unit</th>
                  <th style='text-align:right;'>Retail Unit</th>
                  <th style='text-align:right;'>Cost Value</th>
                  <th style='text-align:right;'>Discounted<br/> Retail Value</th>
                  <th style="text-align:right;">Profit</th>

                </tr>
              </thead>
              <tbody id="table_body">
                <?php
                if(isset($_POST['invoice_id'])){

                  $invoice_id = $_POST['invoice_id'];
                  $invoice_data = Invoice::find_by_id($invoice_id);
                  echo "<tr>";
                  echo "<td>".$invoice_data->code."</td>";
                  echo "<td>".$invoice_data->date_time."</td>";
                  echo "<td colspan='9'>".$invoice_data->customer_id()->name." | ".$invoice_data->customer_id()->address." </td>";
                  echo "</tr>";

                  $total_profit = 0;
                  foreach( InvoiceInventory::find_all_by_invoice_id($invoice_id) as $invoice_inventory ){
                    echo "<tr>";
                    echo "<td colspan='3'></td>";
                    echo "<td>".$invoice_inventory->inventory_id()->product_id()->brand."</td>";
                    echo "<td>".$invoice_inventory->inventory_id()->product_id()->name."</td>";
                    echo "<td>".$invoice_inventory->qty."</td>";
                    $cost_price = $invoice_inventory->inventory_id()->batch_id()->cost;
                    echo "<td style='text-align:right;font-size:14px; padding-left:7px;'>".number_format($cost_price,2)."</td>";


                    $uPrice = ($invoice_inventory->price);
                    echo "<td style='text-align:right;font-size:14px; padding-left:7px;'>" . number_format($uPrice,2) . "</td>";
                    echo "<td style='text-align:right;font-size:14px; padding-left:7px;'>".number_format(($cost_price*$invoice_inventory->qty),2)."</td>";

                    $discounted_value = 0;
                    $discounted_value = 100 - $invoice_inventory->unit_discount;
                    $discounted_value = $discounted_value / 100;
                    $discounted_value = $uPrice * $discounted_value;
                    echo "<td style='text-align:right;font-size:14px; padding-left:7px;'>".number_format(($discounted_value * $invoice_inventory->qty),2)."</td>";

                    $profit = ($discounted_value * $invoice_inventory->qty) - ($cost_price*$invoice_inventory->qty);
                    $total_profit = $total_profit + $profit;
                    echo "<td style='text-align:right;font-size:14px; padding-left:7px;'>".number_format($profit,2)."</td>";
                    echo "</tr>";
                  }

                  echo "<tr style='font-weight:800;'>";
                  echo "<td colspan='10' style='text-align:right;'>TOTAL</td>";
                  echo "<td style='text-align:right;font-size:14px; padding-left:7px;'>".number_format($total_profit,2)."</td>";
                  echo "</tr>";

                  echo "<tr style='font-weight:800;'>";
                  echo "<td colspan='10' style='text-align:right;'>DISCOUNT</td>";
                  echo "<td style='text-align:right;font-size:14px; padding-left:7px;'>".number_format( ($invoice_data->gross_amount - $invoice_data->net_amount),2)."</td>";
                  echo "</tr>";

                  echo "<tr style='font-weight:800;'>";
                  echo "<td colspan='10' style='text-align:right;'>NET PROFIT</td>";
                  echo "<td style='text-align:right;font-size:14px; padding-left:7px;'>".number_format( $total_profit - ($invoice_data->gross_amount - $invoice_data->net_amount) ,2)."</td>";
                  echo "</tr>";



                }
                ?>
              </tbody>
              <tfoot id="table_footer" style="background-color: gray;color:white;border-radius: 0px 0px 5px 5px;">

              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <!--</div>-->
    </div>
  </div>
</div>

<?php include 'common/bottom_content.php'; ?>

<script>

$('#btn_print').click(function () {
  PrintDiv();
});

function PrintDiv() {
  var divToPrint = document.getElementById('print_div');
  var popupWin = window.open('', '_blank', 'width=800,height=500');
  popupWin.document.open();
  popupWin.document.write('<html><head><link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
  popupWin.document.close();
}

</script>

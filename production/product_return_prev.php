<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

if (isset($_POST['view']) && isset($_POST['product_return_id'])) {
  $product_return_id=$_POST['product_return_id'];
  if($product_return = ProductReturn::find_by_id($product_return_id)) {
    $product_return_id = trim($_POST['product_return_id']);
    $product_return_batches = ProductReturnBatch::find_all_by_product_return_id($product_return->id);
    $ProductReturnInvoice = ProductReturnInvoice::find_all_by_product_return_id($product_return->id);
  } else {
    Session::set_error("Entry not available...");
    Functions::redirect_to("invoice_management.php");
  }
}else if ( isset($_GET['product_return_id'])) {
  $product_return_id=$_GET['product_return_id'];
  if($product_return = ProductReturn::find_by_id($product_return_id)) {
    $product_return_id = trim($_GET['product_return_id']);
    $product_return_batches = ProductReturnBatch::find_all_by_product_return_id($product_return->id);
    $ProductReturnInvoice = ProductReturnInvoice::find_all_by_product_return_id($product_return->id);
  } else {
    Session::set_error("Entry not available...");
    Functions::redirect_to("invoice_management.php");
  }
}
?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Invoice Return Details</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">

              <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>

            </div>

            <div class="container" id="divInvoice" style="font-size: 10px;">
              <div class="x_content">
                <div class="col-sm-12">

                  <div class="col-xs-6">
                    <table class="" style="text-align: left;font-size: 12px;width: 100%;">

                      <tr>
                        <td><b>Return Note Number :</b></td>
                        <td> SR<?php $dt = new DateTime($product_return->date_time); echo $dt->format('y').$dt->format('m').$dt->format('d').sprintf('%06d', $product_return->id); ?> </td>
                      </tr>

                      <tr>
                        <td><b>Deliverer :</b></td>
                        <td id="Ddeliverer"><?= Deliverer::find_by_id($product_return->deliverer_id)->name ?></td>
                      </tr>
                      <tr>
                        <td><b>Date :</b></td>
                        <td id="date_time"><?= $product_return->date_time ?></td>
                      </tr>
                    </table>
                  </div>

                  <div class="col-xs-6">
                    <table class="" style="text-align: left;font-size: 12px;width: 100%;">

                      <tr>
                        <td style='width:200px;'><b>Manual Return Note Number :</b></td>
                        <td id="user"><?= $product_return->return_number; ?></td>
                      </tr>
                      <tr>
                        <td style='width:50px;vertical-align: top;'><b>Note :</b></td>
                        <td id="note"><?= $product_return->note ?></td>
                      </tr>
                      <tr>
                        <td><b>User :</b></td>
                        <td id="user"><?= User::find_by_id($product_return->user_id)->name; ?></td>

                      </tr>


                    </table>
                  </div>

                </div>
                <div class="col-xs-12">

                  <div class=" table-responsive" id="table_body" style="border-radius: 5px;margin-top: 15px;">

                    <div class="x_title" style="background-color: gray;">
                      <p style="color: white;font-size: 12px;"><b>Returned Product Details</b></p>
                    </div>
                    <table class="table-striped table-bordered" style="font-size: 12px;width:100%;">
                      <thead>
                        <th style='padding-left:3px;'>Batch Code</th>
                        <th style='padding-left:3px;'>Product</th>
                        <th style='text-align:center;'>Qty</th>
                        <th style='text-align:right;padding-right:3px;'>Unit Price</th>
                        <th style="text-align: center;">Discount</th>
                        <th style='text-align:right;padding-right:3px;'>Line Total</th>
                        <th style="text-align: center;">Additional Discount</th>
                        <th style='text-align:right;padding-right:3px;'>Final Total</th>
                        <th style='text-align:center;'>Reason</th>
                      </thead>
                      <tbody id="tbl">
                        <?php
                        $return_total = 0;
                        foreach ($product_return_batches as $data) {
                          $product_id = Batch::find_by_id($data->batch_id)->product_id;
                          $product_name = Product::find_by_id($product_id)->name;

                          $linetotal  = 0;
                          $dis = 0;

                          $dis = 100 - $data->discount;
                          $dis = $dis/100;
                          $linetotal = $data->unit_price*$data->qty*$dis;

                          $linetotals  = 0;
                          $final_discount = 0;

                          $final_discount = 100 - $data->additional_discount;
                          $final_discount = $final_discount/100;
                          $linetotals = $linetotal*$final_discount;

                          ?>
                          <tr>
                            <td style='padding-left:3px;'><?= Batch::find_by_id($data->batch_id)->code; ?></td>
                            <td style='padding-left:3px;'><?= $product_name ?></td>
                            <td style='text-align:center;'><?= $data->qty ?></td>
                            <td style="text-align: right;padding-right:3px;"><?= number_format($data->unit_price,2) ?></td>

                            <td style="text-align: center;"><?= $data->discount ?>%</td>
                            <td style="text-align: right;padding-right:3px;"><?= number_format($linetotal,2) ?></td>


                            <td style="text-align: center;"><?= $data->additional_discount ?>%</td>
                            <td style="text-align: right;padding-right:3px;"><?= number_format($linetotals,2) ?></td>

                            <td style='text-align:center;'><?= ReturnReason::find_by_id($data->return_reason_id)->name ?></td>
                          </tr>
                          <?php
                          $return_total = $return_total + ($linetotals);
                        }

                        echo "<tr style='color:white;background-color:teal;'>";
                        echo "<td style='text-align:right;padding-right:3px;' colspan='7'>TOTAL: </td>";
                        echo "<td style='text-align: right;padding-right:3px;'><b>".number_format($return_total,2)."<b></td>";
                        echo "<td></td>";
                        echo "</tr>";
                        ?>

                      </tbody>
                    </table>
                  </div>

                </div>


                <div class="col-xs-12">

                  <div class=" table-responsive" id="table_body" style="border-radius: 5px;margin-top: 15px;">

                    <div class="x_title" style="background-color: gray;">
                      <h4 style="color: white;font-size: 12px;"><b>Returned Invoice Details</b></h4>
                    </div>
                    <table class="table-striped table-bordered" style="font-size: 12px;width:100%   ;">
                      <thead>
                        <th>Invoice Number</th>
                        <th>Set Off Unpaid Invoice No:</th>
                        <th>Customer Name</th>
                        <th style='text-align: right;'>Return Amount</th>

                      </thead>
                      <tbody id="tbl">
                        <?php
                        $total = 0;
                        foreach ($ProductReturnInvoice as $data) {
                          if(!empty($data->right_off)){
                            $right_off = $data->right_off;
                          }else{
                            $right_off = 0;
                          }
                          echo "<tr>";
                          if( $right_off == 0){
                            echo "<td>".$data->invoice_id()->code."</td>";
                            echo "<td style='text-align:center;'>-</td>";
                          }else{
                            echo "<td>".$data->invoice_id()->code."</td>";
                            echo "<td>".$data->right_off()->code."</td>";
                          }

                          echo "<td>".$data->invoice_id()->customer_id()->name."</td>";
                          echo "<td style='text-align:right;'>".number_format($data->return_amount,2)."</td>";
                          echo "</tr>";
                          $total = $total + $data->return_amount;
                        }

                        echo "<tr style='color:white;background-color:teal;'>";
                        echo "<td style='text-align:right;' colspan='3'>TOTAL: </td>";
                        echo "<td style='text-align: right;'><b>".number_format($total,2)."<b></td>";
                        echo "</tr>";

                        ?>

                      </tbody>
                    </table>
                  </div>

                </div>

                <div class="row">

                  <div class="col-xs-6" style="text-align: center;padding-top: 50px;"> ------------------------------------ <br/> Checked By </div>

                  <div class="col-xs-6" style="text-align: center;padding-top: 50px;"> ------------------------------------ <br/> Approved By </div>

                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php include 'common/bottom_content.php'; ?>
<script>
$('#btn_print').click(function () {
  //
  PrintDiv();
});

function PrintDiv() {
  var divToPrint = document.getElementById('divInvoice');
  var popupWin = window.open('', '_blank', 'width=800,height=500');
  popupWin.document.open();
  popupWin.document.write('<html><head><link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()"><br/><h3 style="text-align:center;">Return Invoice Report</h3><hr><br/><div>' + divToPrint.innerHTML + '</div></body></html>');
  popupWin.document.close();
}
</script>

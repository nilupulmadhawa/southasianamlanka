<?php
require_once './../util/initialize.php';

if (isset($_GET["id"])) {
    $id= Functions::custom_crypt($_GET["id"], 'd');
    if($grn = GRN::find_by_id($id)){

    }else{
        Session::set_error("Entry not available...");
        Functions::redirect_to("./grn_management.php");
    }
}else{
    Functions::redirect_to("./grn_management.php");
}


include 'common/upper_content.php';
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>GRN</h3>
            </div>

            <div class="title_right">
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" id="div_to_print">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>GRN<small><?php echo ProjectConfig::$project_name ?></small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <section class="content grn">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-xs-12 grn-header">
                                    <h1>
                                        <i class="glyphicon glyphicon-list-alt"></i> GRN
                                        <small class="pull-right"><?php echo "Date : " . date("Y/m/d"); ?></small>
                                    </h1>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row grn-info">

                                <div class="col-sm-4 grn-col">
                                    <b>GRN No : </b><?php echo $grn->code; ?> <br>
                                    <b>User(GRN): </b><?php echo $grn->user_id()->name; ?>
                                    <br>
                                    <br>
                                    <?php
                                    if ($grn->purchase_order_id) {
                                        ?>
                                        <b>Purchase Order ID: </b> <?php echo $grn->purchase_order_id()->code; ?> <br>
                                        <b>User(Purchase Order): </b> <?php echo $grn->purchase_order_id()->user_id()->name; ?>
                                        <br>
                                        <?php
                                    }
                                    ?>

                                </div>
                                <!-- /.col 
                                </div> -->

                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-xs-12 table">


                                     <?php

                                     if($grn->grn_type_id()->name == "Product"){?>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Brand</th>
                                                    <th>Description</th>
                                                    <th>Part Number</th>
                                                    <th>Batch</th>
                                                    <th>Qty</th>

                                                    <th>Unit Cost</th>
                                                    <th>Unit Retail</th>

                                                    <th>Total Cost</th>
                                                    <th>Total Retail</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 

                                         // foreach (InvoiceInventory::find_all_by_product_id() as $data){
                                         //    print_r($data);
                                         // }

                                             function total_invoiced($product_id){
                                                $count = 0;
                                                foreach (InvoiceInventory::find_all_by_product_id($product_id) as $data){

                                                    $count = $count + $data->qty;

                                                }
                                                return $count;
                                            }



                                            $grn_total = 0;

                                            foreach (GRNProduct::find_all_by_grn_id($grn->id) as $data) {

                                                $invoiced_qty = total_invoiced($data->batch_id()->product_id);

                                                $grn_total = $grn_total + ($invoiced_qty * $data->batch_id()->cost);

                                            }

                                            // echo $grn_total;





                                            $cost_total =0;
                                            $wholesale_total = 0;
                                            $retail_total = 0;
                                            foreach ( GRNProduct::find_all_by_grn_id($grn->id) as $product) {
                                             $batch = $product->batch_id();

                                             $cost_total += ($batch->cost*$product->qty);

                                             $retail_total += ($batch->retail_price*$product->qty);
                                             ?>
                                             <tr>
                                                <td><?= $product->batch_id()->product_id()->brand ?></td>
                                                <td><?= $product->batch_id()->product_id()->description ?></td>
                                                <td><?= $product->batch_id()->product_id()->name ?></td>
                                                <td><?= $product->batch_id()->code ?></td>

                                                <td><?= $product->qty ?></td>
                                                <td><?= number_format($batch->cost,2); $costed = $batch->cost; ?></td>
                                                <td><?= number_format($batch->retail_price,2) ?></td>

                                                <td><?= number_format($batch->cost*$product->qty,2); ?></td>
                                                <td><?= number_format($batch->retail_price*$product->qty,2) ?></td>
                                                <td style="width:200px;"><?php 

                                                $qtyy = total_invoiced( $product->batch_id()->product_id ); 
                                                $data =  $qtyy / $product->qty;
                                                $data =  $data*100;

                                                if($data > 100){
                                                    $data = 100;
                                                }

                                                ?>

                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $data; ?>%">
                                                  <b style="color:black"><?php echo intval($data); ?>%</b>
                                              </div>
                                          </div>

                                      </td>                                      

                      </tr>        


                  <?php }?>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><h5><b>Total</b></h5></td>
                    <td style="font-weight: bolder;border-bottom: 1px double gray;border-top:1px double gray;"><h5><?=number_format($cost_total,2)?></h5></td>
                    <td style="font-weight: bolder;border-bottom: 1px double gray;border-top: 1px double gray;"><h5><?=number_format($retail_total,2)?></h5></td>
                    <td style="font-weight: bolder;border-bottom: 1px double gray;border-top: 1px double gray;text-align: center;"><h5><?=number_format($grn_total,2)?> <br/> SOLD PERCENTAGE: <b><?php $percentage = ($grn_total * 100)/$cost_total; echo intval($percentage); ?> %</b> </h5></td>
                </tr>
            </tbody>
        </table>
    <?php }
    ?>

</div>
<!-- /.col -->
</div>
<!-- /.row -->


<!-- this row will not appear when printing -->

</section>
</div>
</div>
</div>
</div>
<div class="x_panel">
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-default" id="btn_grn_print"><i class="fa fa-print"></i> Print</button>
<!--                    <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
    <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
</div>
</div>
</div>
</div>
</div>
<!-- /page content -->
<?php include 'common/bottom_content.php'; ?>

<script>
    $('#btn_grn_print').click(function () {
        //            window.print("reservation.php");
        PrintDiv();
    });

    function PrintDiv() {
        var divToPrint = document.getElementById('div_to_print');
        var popupWin = window.open('', '_blank', 'width=800,height=500');
        popupWin.document.open();
        popupWin.document.write('<html><head><link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>


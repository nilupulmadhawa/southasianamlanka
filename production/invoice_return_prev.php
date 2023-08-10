<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

if (isset($_POST['view'])) {
    $invoice_return_id = trim($_POST['invoice_id']);
    $invoice_details   = Invoice::find_by_id(InvoiceReturn::find_by_id($invoice_return_id)->invoice_id);
//    $invoice_inventory_data = InvoiceInventory::find_by_sql("SELECT * FROM invoice_return_inventory WHERE invoice_return_id = $invoice_return_id");
    $invoice_inventory_data  = InvoiceReturnInventory::find_by_sql("SELECT * FROM invoice_return_inventory WHERE invoice_return_id = $invoice_return_id");
    
}
//if (isset($_POST['view'])) {
//    $product_return_id = trim($_POST['product_return_id']);
//}
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

                            <div class="clearfix"></div>
                        </div>
                        <div class="container" id="divInvoice">
                            <div class="x_content">

                                <div class="table-responsive" style="border-radius: 5px;">
                                    <div class="x_title" style="background-color: gray;">
                                        <h4 style="color: white;"><b>Invoice Details</b></h4>
                                    </div>
                                    <table class="table table-striped" style="text-align: left;">
                                        <tr>
                                            <td><b>Invoice No</b></td>
                                            <td id="invoice_no"><?=$invoice_details->code?></td>
                                            <td><b>Customer</b></td>
                                            <td id="customer"><?= Customer::find_by_id($invoice_details->customer_id)->name?></td>
                                            <td><b>Invoice Date</b></td>
                                            <td id="invoice_date"><?=$invoice_details->date_time?></td>
                                        </tr>

                                        <tr>
                                            <td><b>Gross Amount</b></td>
                                            <td id="gross"><?=$invoice_details->gross_amount?></td>
                                            <td><b>Net Amount</b></td>
                                            <td id="net"><?=$invoice_details->net_amount?></td>
                                            <td><b>Balance</b></td>
                                            <td id="balance"><?=$invoice_details->balance?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Invoice Status</b></td>
                                            <td id="invoice_status"><?= InvoiceStatus::find_by_id($invoice_details->invoice_status_id)->name?></td>
                                            <td><b>Invoice Type</b></td>
                                            <td id="invoice_type"><?= InvoiceType::find_by_id($invoice_details->invoice_type_id)->name?></td>
                                            <td><b>Bill Issued By</b></td>
                                            <td id="issued"><?= User::find_by_id($invoice_details->user_id)->name?></td>
                                        </tr>

                                    </table>

                                </div>
                                
                                <div class=" table-responsive" id="table_body" style="border-radius: 5px;margin-top: 15px;">

                                    <div class="x_title" style="background-color: gray;">
                                        <h4 style="color: white;"><b>Returned Product Details</b></h4>
                                    </div>
                                    <hr>
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Batch Code</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Man. Date</th>
                                        <th>Exp. Date</th>
                                        <th>Cost</th>
                                        <th>Retail</th>
                                        <th>Wholesale</th>
                                        <th>Reason</th>
                                        
                                        </thead>
                                        <tbody id="tbl">
                                            <?php
                                            foreach ($invoice_inventory_data as $data) {
                                                $batch_code    = Batch::find_by_id(Inventory::find_by_id($data->inventory_id)->batch_id);
                                                $Product_name = Product::find_by_id((Inventory::find_by_id($data->inventory_id)->product_id))->name;
                                            ?>
                                            <tr>
                                                <td><?=$batch_code->code?></td>
                                                <td><?=$Product_name?></td>
                                                <td><?=$data->qty?></td>
                                                <td><?= $batch_code->mfd?></td>
                                                <td><?= $batch_code->exp?></td>
                                                <td><?= $batch_code->cost?></td>
                                                <td><?= $batch_code->retail_price?></td>
                                                <td><?= $batch_code->wholesale_price?></td>
                                                <td><?= ReturnReason::find_by_id($data->return_reason_id)->name?></td>
                                            </tr>    
                                            <?php    
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
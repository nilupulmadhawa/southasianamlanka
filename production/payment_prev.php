<?php
require_once './../util/initialize.php';

//if(isset($_POST["payment_id"])){
//    $_SESSION["payment_id"]=$_POST["payment_id"];
//}

if (isset($_POST["payment_id"]) && $payment = Payment::find_by_id($_POST["payment_id"])) {
//    unset($_SESSION["invoice_id"]);
//    $invoiceID = $_POST['invoice_id'];
}else if (isset($_GET["payment_id"]) && $payment = Payment::find_by_id($_GET["payment_id"])) {
//    unset($_SESSION["invoice_id"]);
//    $invoiceID = $_POST['invoice_id'];
} else {
    Functions::redirect_to("./payment_management.php");
}

include './common/upper_content.php';
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payment View</h3>
            </div>

            <div class="title_right">
            </div>
        </div>

        <div class="clearfix"></div>
        <div id="div_to_print">
        <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <section class="content invoice">
                            <div class="x_title">
                                <!--<h2>Payment NO: #<?php echo $payment->code; ?></h2>-->
                                <div class="clearfix"></div>
                            </div>

                            <!-- title row -->
                            <div class="row">
                                <div class="col-xs-12 invoice-header">
                                    <h3>
                                        <?php $username   =  User::find_by_id($payment->user_id); ?>
                                        <i class="fa fa-file"></i> <?php echo ProjectConfig::$project_name; ?>
                                        <small class="pull-right">Date       : <?php echo $payment->date_time; ?></small><br/>
                                        <small class="pull-right">Issued By  : <?php echo $username->name; ?></small>

                                    </h3>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">

                                    <address>
                                        <strong><?php echo ProjectConfig::$project_name; ?></strong>
                                        <br> <?php echo ProjectConfig::$address_html; ?>
                                        <br><?php echo ProjectConfig::$tel_html; ?>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">

                                </div>

                                <div class="col-sm-4 invoice-col">

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-xs-12 table">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr style='background-color:#b2bec3;'>
                                                <!--<th>No</th>-->
                                                <th>Invoice No</th>
                                                <th>Customer</th>
                                                <th style='text-align:right;'>Invoice Amount</th>
                                                <th style='text-align:right;'>Paid Amount</th>
                                                <th style='text-align:center;'>Invoice Type</th>
                                                <th style='text-align:right;'>Invoice Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <?php
                                                $total = 0;
                                                $payment_invoices = PaymentInvoice::find_all_by_payment_id($payment->id);

                                                foreach ($payment_invoices as $payment_invoice){
                                                    $inv=$payment_invoice->invoice_id();
                                                    echo "<tr>";
                                                    echo "<td>".$inv->code."</td>";
                                                    echo "<td>".$inv->customer_id()->name."</td>";
                                                    echo "<td style='text-align:right;'>".$inv->net_amount."</td>";
                                                    echo "<td style='text-align:right;'>".$payment_invoice->amount."</td>";
                                                    echo "<td style='text-align:center;'>".$inv->invoice_type_id()->name."</td>";
                                                    echo "<td style='text-align:right;'>".$inv->invoice_status_id()->name."</td>";
                                                    echo "</tr>";
                                                    $total = $total + $payment_invoice->amount;
                                                }


                                                echo "<tr style='background-color:#b2bec3;'>";
                                                echo "<td style='text-align:right;font-weight:bold;'> </td>";
                                                echo "<td style='text-align:right;font-weight:bold;'> </td>";
                                                echo "<td style='text-align:right;font-weight:bold;'>TOTAL: </td>";
                                                echo "<td style='text-align:right;font-weight:bold;'>".number_format($total,2)."</td>";
                                                echo "<td style='text-align:center;' colspan='2'></td>";
                                                echo "</tr>";


                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-xs-6 " style="text-align: left;">
                                <?php
                                 if($payment->payment_method_id==2){
                                    $payment_cheque = PaymentCheque::find_by_payment_id($payment->id);
                                    $cheque=$payment_cheque->cheque_id();
                                    echo '<h3 style="text-align:left;">Check Details</h3>
                                          <div class="table-responsive">
                                           <table class="table" style="text-align:rignt;">
                                            <tbody>
                                            <tr>
                                                    <th>Bank :</th>
                                                    <td>'.$cheque->bank_id()->name.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Cheque No :</th>
                                                    <td>'.$cheque->cheque_no.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Cheque Date :</th>
                                                    <td>'. $cheque->date.'</td>
                                                </tr>

                                                <tr>
                                                    <th>Check Status :</th>
                                                    <td><strong>'. $cheque->cheque_status_id()->name.'</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Cheque Amount :</th>
                                                    <td><strong>'. $cheque->amount.'</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>';

                                 } ?>
                                 </div>
                                 <div class="col-xs-6 " >
                                    <h3 style="text-align:left;">Payment Details</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Payment No :</th>
                                                    <td><?php echo $payment->code ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Method :</th>
                                                    <td><?php echo $payment->payment_method_id()->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Date "</th>
                                                    <td><?php echo $payment->date_time ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Status :</th>
                                                    <td><?php echo $payment->payment_status_id()->name ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Amount :</th>
                                                    <td><strong><?php echo $payment->amount; ?></strong></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
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
        </div>
            <div class="x_panel">
                <div class="row no-print">
                    <div class="col-xs-12">
                        <button class="btn btn-default"  id="btn_invoice_print"><i class="fa fa-print"></i> Print</button>
                        <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>

                    </div>
                </div>
            </div>
    </div>
</div>
<!-- /page content -->
<?php include './common/bottom_content.php'; ?>
<script>

        $('#btn_invoice_print').click(function (){
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


//
</script>

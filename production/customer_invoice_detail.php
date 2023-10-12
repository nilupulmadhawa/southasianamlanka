<?php
require_once './../util/initialize.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    if ($customer = Customer::find_by_id($id)) {
    } else {
        Session::set_error("Entry not available...");
        Functions::redirect_to("index.php");
    }
} else {
    Functions::redirect_to("index.php");
}

include './common/upper_content.php';

?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 style='font-weight:800;'>INVOICE DETAILED</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>CUSTOMER NAME: <b><?php echo $customer->name; ?></b> <span class="badge" style="color:black;background-color:#dfe6e9;"> <?php if ($customer->status == 0) {
                                                                                                                                                        echo "PENDING";
                                                                                                                                                    } elseif ($customer->status == 1) {
                                                                                                                                                        echo "APPROVED";
                                                                                                                                                    } elseif ($customer->status == 2) {
                                                                                                                                                        echo "REJECTED";
                                                                                                                                                    } ?> <?php if ($customer->status_by != 0) {
                                                                                                                                                                echo " (By: " . $customer->status_by()->name . ")";
                                                                                                                                                            } else {
                                                                                                                                                                echo " ( By: System Initial )";
                                                                                                                                                            } ?></span> </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="col-md-12 col-sm-12 col-xs-12 profile_left">

                            <!-- table start -->

                            <table class="table dt table-striped dt-button-collection table-condensed" width="100%">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th style='min-width:100px;'>Return ID</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Gross Amount(LKR)</th>
                                        <th>Net Amount(LKR)</th>
                                        <th>Outstanding(LKR)</th>
                                        <th>Write Off</th>
                                        <th>Write Off ID</th>
                                        <th>User</th>
                                        <th class="col-sm-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- invoice table body start -->
                                    <?php
                                    $grossTotal = 0;
                                    $netTotal = 0;
                                    $outstandingTotal = 0;
                                    $customerinvoices = Invoice::find_all_by_customer_id($customer->id);
                                    foreach ($customerinvoices as $customerinvoice) {
                                    ?>

                                        <tr>
                                            <td><a target="_blank" href="invoice_prev.php"><?php echo $customerinvoice->code ?></a></td>

                                            <td>
                                                <?php
                                                foreach (ProductReturnInvoice::find_all_by_invoice_id($customerinvoice->id) as $payment_invoice) {

                                                    $dt = new DateTime($payment_invoice->product_return_id()->date_time);
                                                    $return_id = 'SR' . $dt->format('y') . $dt->format('m') . $dt->format('d') . sprintf('%06d', $payment_invoice->product_return_id()->id);

                                                    echo "<a href='product_return_prev.php?product_return_id=" . $payment_invoice->product_return_id()->id . "' style='margin-right:10px;' target='_blank'><b style='background-color:#00b894;padding:2px;border-radius:5px;color:white;'>" . $return_id . "</b></a>";
                                                }
                                                ?>
                                            </td>

                                            <td><?php echo $customerinvoice->date_time ?></td>
                                            <td><?php echo $customerinvoice->invoice_status_id()->name ?></td>
                                            <td><?php echo $customerinvoice->gross_amount ?></td>
                                            <td><?php echo $customerinvoice->net_amount ?></td>
                                            <?php
                                            if ($customerinvoice->right_off == 1) {
                                            ?>
                                                <td>0.00</td>
                                                <td><?php echo $customerinvoice->balance ?></td>
                                                <td><?php foreach (WriteOff::find_all_by_invoice_id($customerinvoice->id) as $writeOff) {
                                                        echo "RO" . $writeOff->id . " ";
                                                    } ?></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><?php echo $customerinvoice->balance ?></td>
                                                <td>0.00</td>
                                                <td></td>
                                            <?php
                                            }
                                            ?>

                                            <?php
                                            $grossTotal = $grossTotal +  $customerinvoice->gross_amount;
                                            $netTotal = $netTotal + $customerinvoice->net_amount;
                                            $outstandingTotal  = $outstandingTotal + $customerinvoice->balance;
                                            ?>

                                            <td><a target="_blank" href="user_profile.php?user_id=<?php echo $customerinvoice->user_id;  ?>"><?php echo $customerinvoice->user_id()->username ?></a></td>
                                            <td>
                                                <form action="invoice_prev.php" method="post" target="_blank" style="float: left;">
                                                    <input type="hidden" name="invoice_id" value="<?php echo $customerinvoice->id ?>" />
                                                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> View</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <!-- invoice table body ends -->
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
<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Over Payments</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <?php Functions::output_result(); ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="tblMain" class="table table-striped table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Condition</th>
                                    <th>Customer</th>

                                    <th>Date&Time</th>
                                    <th>gross_amount</th>
                                    <th>net_amount</th>
                                    <th>Over Payment</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php


                                $objects = Invoice::find_all_has_minus_balance();

                                foreach ($objects as $invoice) {

                                ?>
                                    <tr>

                                        <td class="col-md-1"><?php echo $invoice->code ?></td>
                                        <td class="col-md-1"><?php echo $invoice->invoice_type_id()->name ?></td>
                                        <td class="col-md-1">
                                            <?php

                                            if ($invoice->invoice_condition_id == 1) {
                                                echo $invoice->invoice_condition_id()->name;
                                            } else if ($invoice->invoice_condition_id == 2) {
                                                $product_return_invoice = ProductReturnInvoice::find_by_invoice_id($invoice->id);
                                            ?>
                                                <form action="product_return_prev.php" method="post" target="_blank" style="float: left;">
                                                    <input type="hidden" name="product_return_id" value="<?php echo $product_return_invoice->product_return_id; ?>" />
                                                    <button type="submit" name="view" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-new-window"></i> View</button>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="col-md-1">
                                            <?php
                                            if ($invoice->customer_id) {
                                                echo $invoice->customer_id()->name;
                                            }
                                            ?>
                                        </td>

                                        <td class="col-md-1"><?php echo $invoice->date_time ?></td>

                                        <td class="col-md-1"><?php echo $invoice->gross_amount ?></td>
                                        <td class="col-md-1"><?php echo $invoice->net_amount ?></td>
                                        <td class="col-md-1"><?php echo $invoice->balance ?></td>

                                        <td class="col-md-1">
                                            <form action="invoice_prev.php" method="post" target="_blank" style="float: left;">
                                                <input type="hidden" name="invoice_id" value="<?php echo $invoice->id ?>" />
                                                <button type="submit" name="view" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-new-window"></i> View</button>
                                            </form>
                                            <form action="proccess/over_payment_proccess.php" method="post">
                                                <input type="hidden" name="invoice_id" value="<?php echo $invoice->id ?>" />
                                                <button type="submit" name="delete" value="delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-new-window"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="x_panel">

                </div>
            </div>
        </div>
    </div>
</div>

<!--/page content-->
<?php include 'common/bottom_content.php'; ?>

<script>
    window.onfocus = function() {
        //        location.reload();
    };

    $(document).ready(function() {
        $('#tblMain').DataTable({
            "paging": false,
            // "ordering": false,
            "info": false
        });
    });
</script>
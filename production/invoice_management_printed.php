<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Invoice Management</h3>
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
                        <a href="invoice.php" target="_blank">
                            <button id="btnNew" type="button" class="btn btn-round btn-primary"><i class="glyphicon glyphicon-plus"></i> Add New</button>
                        </a>
                        <!--                        <form action="proccess/invoice_proccess.php" method="post" target="_blank" style="float: left;">
            <button type="submit" name="recalculate" class="btn btn-round btn-success" ><i class="fa fa-refresh"></i> Re-calculate Invoices</button>
          </form>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="tblMain" class="table table-striped table-bordered nowrap " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <!--<th>ID</th>-->
                                    <th>Invoice Number</th>
                                    <th>Customer</th>
                                    <th>Invoiced By</th>
                                    <th>Condition</th>
                                    <th>Date & Time</th>
                                    <!--<th>Amended Invoice</th>-->
                                    <th>Gross Amount</th>
                                    <th>Net Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                // $total_records = Invoice::row_count();
                                // $pagination = new Pagination($total_records);
                                // $objects = Invoice::find_all_by_limit_offset($pagination->records_per_page, $pagination->offset());
                                $objects = Invoice::find_all_printed();

                                foreach ($objects as $invoice) {
                                    //$invoice=Invoice::get_recalculated_invoice_by_id($db_invoice->id);
                                ?>
                                    <tr>
                                        <!--<td class="col-md-1" ><?php // echo $invoice->id        
                                                                    ?></td>-->
                                        <td class="col-md-1"><?php echo $invoice->code ?></td>
                                        <td class="col-md-1">
                                            <?php
                                            if ($invoice->customer_id) {
                                                echo $invoice->customer_id()->name;
                                            }
                                            ?>
                                        </td>
                                        <td class="col-md-1"><?php echo $invoice->user_id()->name; ?></td>
                                        <td class="col-md-1">
                                            <?php
                                            //echo $invoice->invoice_condition_id()->name;
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


                                        <td class="col-md-1"><?php echo $invoice->date_time ?></td>
                                        <!--<td class="col-md-1" ><?php // echo $invoice->invoice_id        
                                                                    ?></td>-->
                                        <td class="col-md-1"><?php echo $invoice->gross_amount ?></td>
                                        <td class="col-md-1"><?php echo $invoice->net_amount ?></td>
                                        <td class="col-md-1">
                                            <form action="invoice_prev.php" method="post" style="float: left;">
                                                <input type="hidden" name="invoice_id" value="<?php echo $invoice->id ?>" />
                                                <button type="submit" name="view" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-new-window"></i> View</button>
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
                    <div onclick="window.location.href:''" class="x_content">
                        <?php
                        // echo $pagination->get_pagination_links_html1("invoice_management.php");
                        ?>
                    </div>
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
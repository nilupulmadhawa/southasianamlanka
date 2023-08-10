<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Invoice Return Management</h3>
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
                        <a href="invoice_return_by_deliverer.php" target="_blank">
                            <button id="btnNew" type="button" class="btn btn-round btn-primary" ><i class="glyphicon glyphicon-plus"></i> Add New</button>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Invoice</th>
                                    <th>Date/Time</th>
                                    <!--<th>Products</th>-->
                                    <th>Note</th>
                                    <th>User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 

                                <?php
                                foreach (InvoiceReturn::find_all() as $invoice_return) {
//                                    $invoice=Invoice::get_recalculated_invoice_by_id($db_invoice->id);
                                    ?>
                                    <tr>
                                        <td><?php echo $invoice_return->id  ?></td>
                                        <td><?php echo $invoice_return->invoice_id()->code ?></td>
                                        <td><?php echo $invoice_return->invoice_id()->date_time ?></td>
                                        <!--<td><?php // echo $invoice_return->invoice_id()->note ?></td>-->
                                        <td><?php echo $invoice_return->
                                                note ?></td>
                                        <td><?php echo $invoice_return->invoice_id()->user_id()->username ?></td>                                   

                                        <td>
                                            <form action="invoice_return_prev.php" method="post" target="_blank" style="float: left;">
                                                <input type="hidden" name="invoice_id" value="<?php echo $invoice_return->id ?>"/>
                                                <button type="submit" name="view" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-new-window"></i> View</button>
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
            </div>
        </div>
    </div>
</div>

<!--/page content--> 
<?php include 'common/bottom_content.php'; ?>

<script>
    window.onfocus = function () {
        location.reload();
    };
</script>
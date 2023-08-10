<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Customer Order Management</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="customer_order.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date-Time</th>
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach (CustomerOrder::find_all() as $customer_order) {
                                    ?>
                                    <tr>
                                        <td><?php echo $customer_order->id ?></td>
                                        <td><?php echo $customer_order->code ?></td>
                                        <td><?php echo $customer_order->customer_id()->name ?></td>
                                        <td><?php echo $customer_order->date_time ?></td>
                                        <td><?php echo $customer_order->customer_order_status_id()->name ?></td>
                                        <td><?php echo $customer_order->customer_id()->name ?></td>
                                        <td>
                                            <a href="customer_order.php?id=<?php echo Functions::custom_crypt($customer_order->id); ?>">
                                                <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
                                            </a>
                                            <a href="invoice_by_deliverer.php?id=<?php echo Functions::custom_crypt($customer_order->id); ?>">
                                                <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Invoice</button>
                                            </a>
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

<!-- /page content -->
<?php include 'common/bottom_content.php'; ?>

<script>
    window.onfocus = function () {
        location.reload(); 
    };
</script>

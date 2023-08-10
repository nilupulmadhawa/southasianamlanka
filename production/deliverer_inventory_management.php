<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Deliverer Inventory Management</h3>
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
                        <a href="deliverer_inventory.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="tblMain" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Deliverer</th>
                                    <th>Product</th>
                                    <th>Batch</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                
                                $total_records = DelivererInventory::row_count();
                                $pagination = new Pagination($total_records);
                                $objects = DelivererInventory::find_all_by_limit_offset($pagination->records_per_page, $pagination->offset());
                                
                                foreach ($objects as $delivererinventory) {
                                    $inventory=$delivererinventory->inventory_id();
                                    ?>
                                    <tr>
                                        <td><?php echo $delivererinventory->deliverer_id()->name ?></td>
                                        <td><?php echo $inventory->product_id()->name ?></td>
                                        <td>
                                            <?php $batch = $inventory->batch_id(); ?>
                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="<?php echo "#" . $inventory->batch_id; ?>"><?php echo $batch->code; ?></button>
                                            <!-- Modal -->
                                            <div id="<?php echo $inventory->batch_id; ?>" class="modal fade " role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Batch</h4>
                                                        </div>
                                                        <div class="modal-body">                                                               
                                                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                                                <div class="form-group">
                                                                    <label class="x_title washed" style="display: block;">Batch Code</label>
                                                                    <label><?php echo $batch->code; ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="x_title washed" style="display: block;">Manufacture Date</label>
                                                                    <label><?php echo $batch->mfd; ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="x_title washed" style="display: block;">Expire Date</label>
                                                                    <label><?php echo $batch->exp; ?></label>
                                                                </div>
                                                            </div>
                                                            <br/>
                                                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                                                <div class="form-group">
                                                                    <label class="x_title washed" style="display: block;">Cost Price</label>
                                                                    <label><?php echo $batch->cost; ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="x_title washed" style="display: block;">Retail Price</label>
                                                                    <label><?php echo $batch->retail_price; ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="x_title washed" style="display: block;">Wholesale Price</label>
                                                                    <label><?php echo $batch->wholesale_price; ?></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                        </td>
                                        <td><?php echo $delivererinventory->qty ?></td>
<!--                                        <td>
                                            <a href="deliverer_inventory.php?deliverer_id=<?php // echo Functions::custom_crypt($delivererinventory->deliverer_id); ?>">
                                                <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
                                            </a>
                                        </td>-->
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
                        echo $pagination->get_pagination_links_html1("deliverer_inventory_management.php");
                        ?>
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
//        location.reload(); 
    };
    
    $(document).ready(function () {
        $('#tblMain').DataTable({
            "paging": false,
//            "ordering": false,
            "info": false
        });
    });
</script>


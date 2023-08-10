<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Main Inventory Management</h3>
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
                        <a href="inventory.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Batch</th>
                                    <th>Quantity</th>
                                    <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach (Inventory::find_all_calculated_qty() as $inventory) {
                                    ?>
                                    <tr>
                                        <td><?php echo $inventory->id ?></td>
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
                                        <td><?php echo $inventory->qty ?></td>
    <!--                                        <td>
                                            <form action="inventory.php" method="post" target="_blank" style="float: left;">
                                                <input type="hidden" name="id" value="<?php echo $inventory->id ?>"/>
                                                <button type="submit" name="view" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
                                            </form>

                                        </td>-->
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
<?php include './common/bottom_content.php'; ?>

<script>
    window.onfocus = function () {
//        location.reload();
};
</script>
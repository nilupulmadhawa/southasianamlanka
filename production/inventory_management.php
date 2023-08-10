<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>All Inventory Management</h3>
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
                        <table id="tblMain" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th>Brand</th>
                                    <th>Part Number</th>
                                    <th>Description</th>
                                    <!-- <th>Batch</th> -->
                                    <th>Quantity</th>
                                    <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                // $total_records = Product::row_count();
                                // $pagination = new Pagination($total_records);
                                $objects = Product::find_all();
                                foreach ($objects as $product) {
                                    ?>
                                    <tr>
                                        
                                        <td><?php echo $product->brand; ?></td>
                                        <td><?php echo $product->name; ?></td>
                                        <td><?php echo $product->description; ?></td>
                                        <td><?php 
                                        $invqty = 0;
                                        foreach ( Inventory::find_all_by_product_id($product->id) as $inventory ) {
                                            $invqty = $invqty + $inventory->qty;
                                        }

                                        echo $invqty;

                                        ?></td>

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
<?php include './common/bottom_content.php'; ?>

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
<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Stock Adjustments</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <?php Functions::output_result(); ?>
        <div class="row">
            <div class="row" id="divInvoice">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 id="title">Stock Adjustments</h2>
                            <!--<button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>-->
                            <div class="clearfix"></div>
                        </div>



                        <!--========================================================-->

                        

                    </div>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Batch ID</th>
                                <th>Qty</th>
                                <th></th>
                               
                            </tr>
                        </thead>
                        <tbody id = "tbl_body">

                            <?php
                            foreach (Inventory::find_all() as $data) {
                                ?>
                                <tr>

                                    <td><?php echo $data->product_id()->name; ?></td>
                                    <td><?php echo $data->batch_id; ?></td>
                                    <td><?php echo $data->qty; ?></td>
                                    <td>
                                    	
                                    	<form>
                                    		<input type="text" name="qty" placeholder="Qty">
                                    		<input type="text" name="reason" placeholder="Reason">
                                    		<button>CHANGE</button>
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
<!-- /page content -->

<?php include 'common/bottom_content.php'; ?>

<script>
   
</script>

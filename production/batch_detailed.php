<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

if (isset($_GET["id"])) {
    $id= Functions::custom_crypt($_GET["id"], 'd');
    if($batch = Batch::find_by_id($id)){
        
    }else{
        Session::set_error("Entry not available...");
        $batch = new Batch();
    }
}
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Batch Summary For Batch ID: <?php echo $batch->id; ?></h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <!-- <a href="batch.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a> -->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Date</th>
                                    <th>Qty</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                // $total_records = Batch::row_count();
                                // $pagination = new Pagination($total_records);
                                $objects = Batch::find_all();

                                foreach ($objects as $batch) {
                                    ?>
                                    <tr>
                                        <td><?php echo $batch->code ?></td>
                                        <td><?php echo $batch->product_id()->brand ?></td>
                                        <td><?php echo $batch->product_id()->name ?></td>
                                        <td><?php echo $batch->product_id()->description ?></td>
                                        <td><?php echo $batch->cost ?></td>
                                        <td><?php echo $batch->retail_price ?></td>
                                        <td><?php echo $batch->wholesale_price ?></td>
                                        <td>
                                            
                                            <a href="batch_detailed.php?id=<?php echo Functions::custom_crypt($batch->id); ?>">
                                                <button class="btn btn-primary btn-xs" > View </button>
                                            </a>

                                        </td>
                                        <td>

                                            <a href="batch.php?id=<?php echo Functions::custom_crypt($batch->id); ?>">
                                                <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
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
                <div class="x_panel">
                    <div onclick="window.location.href:''" class="x_content">
                        <?php
                        // echo $pagination->get_pagination_links_html1("batch_management.php");
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
</script>

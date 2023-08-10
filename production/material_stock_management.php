<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Material Stock Management</h3>
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
                        <a href="material_grn.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add GRN</button></a>
                        <!--<h2>Material Stock</h2>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Material</th>
                                    <th>GRN</th>
                                    <th>Unit Cost</th>
                                    <th>Volume</th>
                                    <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                
                                $total_records = MaterialStock::row_count();
                                $pagination = new Pagination($total_records);
                                $objects = MaterialStock::find_all_by_limit_offset($pagination->records_per_page, $pagination->offset());
                                
                                foreach ($objects as $material_stock) {
                                    ?>
                                    <tr>
                                        <td><?php echo $material_stock->id ?></td>
                                        <td><?php echo $material_stock->material_id()->name ?></td>
                                        <td><?php echo $material_stock->grn_material_id()->grn_id()->code ?></td>
                                        <td><?php echo $material_stock->grn_material_id()->unit_price ?></td>
                                        <td><?php echo $material_stock->volume ?></td>
<!--                                        <td>
                                            <form action="material.php" method="post" target="_blank" style="float: left;">
                                                <input type="hidden" name="id" value="<?php echo $material->id ?>"/>
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
                <div class="x_panel">
                    <div onclick="window.location.href:''" class="x_content">
                        <?php
                        echo $pagination->get_pagination_links_html1("material_stock_management.php");
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
        location.reload(); 
    };
</script>
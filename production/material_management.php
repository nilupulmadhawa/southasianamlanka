<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Material Management</h3>
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
                        <a href="material.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                
                                $total_records = Material::row_count();
                                $pagination = new Pagination($total_records);
                                $objects = Material::find_all_by_limit_offset($pagination->records_per_page, $pagination->offset());
                                
                                foreach ($objects as $material) {
                                    ?>
                                    <tr>
                                        <td><?php echo $material->id ?></td>
                                        <td><?php echo $material->name ?></td>
                                        <td>
                                            <form action="material.php" method="post" target="_blank" style="float: left;">
                                                <input type="hidden" name="id" value="<?php echo $material->id ?>"/>
                                                <button type="submit" name="view" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
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
                        echo $pagination->get_pagination_links_html1("material_management.php");
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
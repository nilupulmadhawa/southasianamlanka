<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Production Plan Management</h3>
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
                        <a href="production_plan.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <!--<th>ID</th>-->
                                    <th>Date</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                                    
                                <?php
                                foreach (Production::find_all() as $production) {
                                    ?>
                                    <tr>
                                        <!--<td><?php // echo $production->id ?></td>-->
                                        <td><?php echo $production->date ?></td>
                                        <td><?php echo $production->code ?></td>
                                        <td><?php echo $production->description ?></td>
                                        <td><?php echo $production->production_status_id()->name ?></td>
                                        <td>
                                            <a href="production.php?id=<?php echo Functions::custom_crypt($production->id); ?>">
                                                <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
                                            </a>
<!--                                            <form action="user_profile.php" method="post" target="_blank" >
                                                <input type="hidden" name="id" value="<?php // echo $production->id ?>"/>
                                                <button type="submit" name="view" class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-new-window"></i> View</button>
                                            </form>-->
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
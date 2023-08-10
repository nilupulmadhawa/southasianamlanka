<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Customer Management</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <?php Functions::output_result(); ?>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="customer.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>

                        <!-- model start -->

                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">CHANGE ALLOCATED REP (BULK)</button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"> CHANGE ALLOCATED REP (BULK) </h4>
                              </div>
                              <div class="modal-body">

                                <!-- form start -->
                                <form class="form-inline" action="proccess/customer_proccess.php" method="post">

                                  <div class="form-group">
                                    <label for="email">From:</label>
                                    <select class="form-control" name='change_from'>
                                      <?php
                                      foreach(User::find_all() as $data){
                                        echo "<option>".$data->name."</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>


                                  <div class="form-group">
                                    <label for="email">To:</label>
                                    <select class="form-control" name='change_to'>
                                      <?php
                                      foreach(User::find_all() as $data){
                                        echo "<option>".$data->name."</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <br/>

                                  <button type="submit" class="btn btn-primary btn-block">Set</button>
                                </form>
                                <!-- form end -->

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>

                        <!-- model ends -->

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="tblMain" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>BR Number</th>
                                    <th>Name</th>
                                    <th>Business <br/> Contact</th>
                                    <th>Personal <br/> Contact</th>
                                    <th>Authorized <br/> Person</th>
                                    <th>Email</th>
                                    <th>Town</th>
                                    <th>Address</th>
                                    <th>Credit Limit</th>
                                    <th>Allocated Rep</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                // $total_records = Customer::row_count();
                                // $pagination = new Pagination($total_records);
                                // $objects = Customer::find_all_by_limit_offset($pagination->records_per_page, $pagination->offset());
                                $objects = Customer::find_all();

                                foreach ($objects as $customer) {

                                    $empty_check = 0;

                                    if($customer->name == NULL || $customer->code == NULL || $customer->route_id == NULL || $customer->address == NULL || $customer->phone == NULL || $customer->email == NULL || $customer->balance == NULL || $customer->period == NULL || $customer->code_image == NULL || $customer->stock_insurance == NULL || $customer->stock_insurance_image == NULL || $customer->stock_mortgaged == NULL || $customer->bank_gurantee == NULL || $customer->bank_gurantee_image == NULL || $customer->fax == NULL || $customer->prop_name_email == NULL || $customer->prop_id == NULL || $customer->prop_tel == NULL || $customer->intro_a == NULL || $customer->intro_b == NULL || $customer->po_name_designation == NULL || $customer->bank_name == NULL || $customer->month_purchase == NULL || $customer->balance_increase == NULL || $customer->payment_method == NULL || $customer->status == NULL || $customer->id_image == NULL ){

                                        $empty_check = 1;

                                    }
                                    if($empty_check == 1){

                                        ?>
                                        <tr style="background-color: #d35400;color:white;">
                                            <?php
                                        }else{
                                            ?>
                                            <tr>
                                                <?php
                                            }
                                            ?>
                                            <td><?php echo $customer->code ?></td>
                                            <td><?php echo $customer->name ?></td>
                                            <td><?php echo $customer->phone ?></td>
                                            <td><?php echo $customer->prop_tel ?></td>
                                            <td><?php echo $customer->po_name_designation ?></td>
                                            <td><?php echo $customer->email ?></td>
                                            <td><?php echo $customer->route_id()->name ?></td>
                                            <td><?php echo $customer->address ?></td>
                                            <td><?php echo number_format($customer->balance,2); ?></td>
                                            <?php
                                                $user_id = $customer->allocated_rep;
                                                $data = User::find_by_id($user_id);

                                            ?>
                                            <td><?php echo $data->name; ?></td>
                                            <td><?php
                                            if($customer->status == 0){
                                                echo "<b style='color:gray;'>Pending</b>";
                                            }elseif ($customer->status == 1) {
                                                echo "<b style='color:green;'>Approved</b>";
                                            }elseif ($customer->status == 2) {
                                                echo "<b style='color:red;'>Rejected</b>";
                                            }
                                            ?></td>
                                            <td>
                                                <a href="customer.php?id=<?php echo Functions::custom_crypt($customer->id); ?>">
                                                    <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
                                                </a>
                                                <a href="customer_profile.php?id=<?php echo Functions::custom_crypt($customer->id); ?>">
                                                    <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Profile</button>
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
                            // echo $pagination->get_pagination_links_html1("customer_management.php");
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

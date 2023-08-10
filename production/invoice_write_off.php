<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Invoice Write Off</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <!-- form start -->

            <form action="invoice_write_off.php" method="post">

              <div class="form-group">
                <label for="email">Customer Name</label>
                <select class="form-control" name="customer_id">
                  <?php
                  foreach(Customer::find_all() as $cus_data){
                    echo "<option value='".$cus_data->id."'>".$cus_data->name."</option>";
                  }
                  ?>
                </select>
              </div>

              <button type="submit" class="btn btn-primary">View</button>
            </form>

            <!-- form ends -->

            <table id="datatable-responsive" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>

                  <td>Invoice Number</td>
                  <td style='text-align:center;'>Customer</td>
                  <td style='text-align:center;'>Invoice Placed By</td>
                  <td style='text-align:center;'>Invoice Amount</td>
                  <td style='text-align:center;'>Outstanding</td>
                  <td style='text-align:center;'></td>

                </tr>
              </thead>
              <tbody>

                <?php
                if(isset($_POST['customer_id'])){
                  $customer_id = $_POST['customer_id'];
                  foreach(Invoice::find_all_pending_customer_id($customer_id) as $data){

                    echo "<tr>";
                    echo "<td>".$data->code."</td>";
                    echo "<td style='text-align:center;'>".$data->customer_id()->name."</td>";
                    echo "<td style='text-align:center;'>".$data->user_id()->name."</td>";
                    echo "<td style='text-align:right;'>".$data->net_amount."</td>";
                    echo "<td style='text-align:right;'>".$data->balance."</td>";
                    echo "<td style='text-align:center;'><a href='proccess/invoice_proccess.php?write=".$data->id."' class='btn btn-warning btn-xs'>Write Off</a></td>";
                    echo "</tr>";

                  }
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
$('#datatable-responsive').dataTable( {
  "paging": false
} );
</script>

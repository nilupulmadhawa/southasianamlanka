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
        <?php Functions::output_result(); ?>
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
            <table id="datatable-responsive" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>

                  <td>Invoice Number</td>
                  <td>Customer</td>
                  <td style='text-align:center;'>Overpayment</td>
                  <td style='text-align:center;'></td>

                </tr>
              </thead>
              <tbody>

                <?php
                foreach(Invoice::find_all_has_minus_balance() as $data){
                  echo "<tr>";
                  echo "<td>".$data->code."</td>";
                  echo "<td style='text-align:left;'>".$data->customer_id()->name."</td>";
                  echo "<td style='text-align:right;'>".$data->balance."</td>";
                  echo "<td style='text-align:center;'>";
                  ?>
                  <form class="form-inline" action="proccess/over_payment_proccess.php" method="post">

                    <div class="form-group">
                      <label for="email">Settelement:</label>
                      <input type="hidden" class="form-control" name="from_invoice" value="<?php echo $data->id; ?>" >
                      <input type="text" class="form-control" name="amount" >
                    </div>

                    <div class="form-group">
                      <label for="pwd">Invoice ID:</label>
                      <select class="form-control" name="invoice_id">
                        <?php
                        foreach(Invoice::find_all_outstandings_by_customer_id($data->customer_id) as $cusinvoice){
                          echo "<option value='".$cusinvoice->id."'>".$cusinvoice->code." || Balance:  ".$cusinvoice->balance."</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">SETTLE</button>
                  </form>
                  <?php
                  echo "</td>";
                  echo "</tr>";
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

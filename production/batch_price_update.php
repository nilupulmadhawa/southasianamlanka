<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->
<div class="right_col" role="main">
  <div class="">


    <div class="clearfix"></div>

    <?php Functions::output_result(); ?>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 id="title" style='font-weight:800;'>Batch Update</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <!-- form start -->
            <form class="form-horizontal" action="batch_price_update.php" method="post">

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Batch</label>
                <div class="col-sm-6">
                  <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="batch_id">
                    <?php
                    require_once 'common/find_all.php';
                    $table_name = "batch";
                    $database_result = find_all_table($table_name);
                    while($row = mysqli_fetch_assoc($database_result)) {
                      // echo "<option value='".$row["id"]."'>".$row["code"]."</option>";
                      echo "<option value='".$row["id"]."'>".$row["code"]." | ".Product::find_by_id($row["product_id"])->name." | Cost Price: ".$row["cost"]." | Retail Price: ".$row["retail_price"]." | Wholesale Price: ".$row["wholesale_price"]."</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" style="font-weight:800;"> SELECT BATCH </button>
                </div>
              </div>

            </form>
            <!-- form ends -->

          </div>
        </div>
      </div>

      <!-- second row -->

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <?php
            if(isset($_POST['batch_id'])){
              $batch_id = $_POST['batch_id'];
              $batch = Batch::find_by_id($batch_id);
              ?>
              <div class="row">
                <div class="col-sm-6">
                  <label style="font-size:20px;font-weight:800;"> - CURRENT VALUES - </label>
                  <ul style="font-size:20px;">
                    <li><b>Product Name :</b> <?php echo $batch->product_id()->name; ?></li>
                    <li><b>Code:</b> <?php echo $batch->code; ?></li>
                    <li><b>Cost:</b> <?php echo number_format($batch->cost,2); ?></li>
                    <li><b>Retail Price:</b> <?php echo number_format($batch->retail_price,2); ?></li>
                    <li><b>WholeSale Price:</b> <?php echo number_format($batch->wholesale_price,2); ?></li>
                    <li><b>Current Stock:</b> <?php
                    $inventory = Inventory::find_by_batch_id($batch->id);
                    echo $inventory->qty;
                    ?></li>
                  </ul>
                </div>
                <div class="col-sm-6">

                  <label style="font-size:20px;font-weight:800;"> - NEW VALUES - </label>

                  <!-- form start -->
                  <form class="form-horizontal" action="proccess/batch_price_update_proccess.php" method="post">

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Cost Price:</label>

                      <input type="hidden" name="current_batch" value="<?php echo $batch->id; ?>">

                      <input type="hidden" name="product" value="<?php echo $batch->product_id; ?>">

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="Cost Price" name="cost" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Retail Price:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="Retail Price" name="retail_price" required>
                      </div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Wholesale Price:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="WholeSale Price" name="wholesale_price" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Dollar Rate:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="Dollar Rate" name="dollar_rate" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Stock:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" placeholder="Stock" value="<?php echo $inventory->qty;  ?>" name="stock" required>
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="save" class="btn btn-primary btn-block">Update</button>
                      </div>
                    </div>


                  </form>
                  <!-- form ends -->
                </div>
              </div>
              <?php
            }
            ?>

          </div>
        </div>
      </div>


    </div>
  </div>
</div>
<!--/page content-->
<?php include 'common/bottom_content.php'; ?>

<script>


</script>

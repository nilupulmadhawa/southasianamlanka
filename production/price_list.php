<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Price List Report</h3>
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

            <form class="form-inline" action="print_brand_print.php" method="post" target='_blank'>

              <div class="form-group">
                <label for="email">BRAND:</label>
                <select class="form-control" name="brand">
                  <?php
                  foreach(Product::find_all_by_distinct_brand() as $brand){
                    echo "<option>".$brand->brand."</option>";
                  }
                  ?>
                </select>
              </div>

              <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> PRINT</button>
              <a class="btn btn-primary pull-right" href="price_list_print.php" target='_blank'> <i class="fa fa-print"></i> PRINT ALL </a>
            </form>


            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Part Number</th>
                  <th>Brand</th>
                  <th>Description</th>
                  <th style='text-align:right;'>Selling Price</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach(Product::find_all() as $product){
                  foreach(Batch::find_all_by_product_id_last($product->id) as $batch){
                    // $inventory = Inventory::find_by_product_id($product->id);
                    $qty = 0;
                    // foreach ( Inventory::find_all_by_product_id($product->id) as $inventory ) {
                    //     $qty = $qty + $inventory->qty;
                    // }
                    // if( $qty > 0){
                      echo "<tr>";
                      echo "<td>".$product->name."</td>";
                      echo "<td>".$product->brand."</td>";
                      echo "<td>".$product->description."</td>";
                      echo "<td style='text-align:right;'>".number_format($batch->retail_price,2)."</td>";
                      echo "</tr>";
                    // }
                  }
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
</script>

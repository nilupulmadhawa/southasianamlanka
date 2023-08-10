<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Product Management</h3>
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
            <a href="product.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>

            <!-- model start -->

            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">BULK UPDATES</button>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> BULK UPDATES </h4>
                  </div>
                  <div class="modal-body">

                    <label>Brand Wise Discount Update</label>
                    <!-- form start -->
                    <form class="form-inline" action="proccess/batch_proccess.php" method="post">

                      <div class="form-group">
                        <label for="email">Brand:</label>
                        <select class="form-control" name='brand_name'>
                          <?php
                          foreach(Product::find_all_by_distinct_brand() as $data){
                            echo "<option>".$data->brand."</option>";
                          }
                          ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="email">Discount (%) :</label>
                        <input type="text" class="form-control" name="discount" >
                      </div>


                      <button type="submit" class="btn btn-primary">Set</button>
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
            <table id="tblMain" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>

                  <th>Part Number</th>
                  <th>Category</th>
                  <th>Brand</th>
                  <th>Description</th>
                  <th>Vehicle Application</th>
                  <th>Re-order level:-</th>
                  <th>Max Qty:-</th>
                  <th>Min Qty:-</th>
                  <th>Image:-</th>
                  <th>Discount Limit:-</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody>
                <?php

                // $total_records = Product::row_count();
                // $pagination = new Pagination($total_records);
                $objects = Product::find_all();

                foreach ($objects as $product) {
                  ?>
                  <tr>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo $product->category_id()->name; ?></td>
                    <td><?php echo $product->brand; ?></td>
                    <td><?php echo $product->description; ?></td>
                    <td><?php echo $product->vehicle_application; ?></td>
                    <td><?php echo $product->roq; ?></td>
                    <td><?php echo $product->max_qty; ?></td>
                    <td><?php echo $product->min_qty; ?></td>
                    <?php
                    $image = "uploads/products/dflt.png";
                    if ($product->image) {
                      $image = "uploads/products/" . $product->image;
                    }
                    ?>
                    <td><a href='<?php echo $image; ?>' target="_blank"><img id="imgImage" src="<?php echo $image; ?>" alt=":( image not found..!" class="image img-responsive img-thumbnail" style="width:100px;"></a></td>
                    <td><?php echo $product->discount_limit; ?>%</td>

                    <td>
                      <a href="product.php?id=<?php echo Functions::custom_crypt($product->id); ?>">
                        <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
                      </a>
                      <!--                                            <form action="user_profile.php" method="post" target="_blank" >
                      <input type="hidden" name="id" value="<?php // echo $product->id ?>"/>
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
      <div class="x_panel">
        <div onclick="window.location.href:''" class="x_content">
          <?php
          // echo $pagination->get_pagination_links_html1("product_management.php");
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
window.onfocus = function () {
  //        location.reload();
};
$(document).ready(function () {
  $('#tblMain').DataTable({
    "paging": false,
    //            "ordering": false,
    "order": [[ 1, "desc" ]],
    "info": false
  });
});
</script>

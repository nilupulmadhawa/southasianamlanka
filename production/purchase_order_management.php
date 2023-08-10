<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Purchase Order Management</h3>
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
            <!-- <a href="product_purchase_order.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add Product PO</button></a>
            <a href="material_purchase_order.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add Material PO</button></a> -->
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Purchase Order Number</th>
                  <th>Supplier</th>
                  <th style='text-align:right;'>Total FOB</th>
                  <th style='text-align:center;'>User</th>
                  <th style='text-align:center;'>Action</th>
                </tr>
              </thead>
              <tbody>

                <?php

                $total_records = PurchaseOrder::row_count();
                $pagination = new Pagination($total_records);
                $objects = PurchaseOrder::find_all_by_limit_offset($pagination->records_per_page, $pagination->offset());

                foreach ($objects as $purchase_order) {
                  ?>
                  <tr>
                    <td><?php echo $purchase_order->date ?></td>
                    <td><?php echo sprintf('%05d', $purchase_order->code); ?></td>
                    <td><?php echo $purchase_order->supplier_id()->name ?></td>

                    <td style='text-align:right;'><?php
                    $total = 0;
                    foreach(PurchaseOrderProduct::find_all_by_purchase_order_id($purchase_order->id) as $data){
                      $total = $total + $data->dollar_rate*$data->qty;
                    }
                    echo number_format($total,2);
                    ?></td>
                    <td style='text-align:center;'><?php echo $purchase_order->user_id()->name ?></td>
                    <td style='text-align:center;'>
                      <a href="purchase_order_view.php?id=<?php echo $purchase_order->id; ?>" class="btn btn-primary btn-xs" target='_blank'> View Purchase Order </a>
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
            echo $pagination->get_pagination_links_html1("route_management.php");
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
// window.onfocus = function () {
//     location.reload();
// };
</script>

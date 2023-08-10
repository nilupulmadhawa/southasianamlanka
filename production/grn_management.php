<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>GRN Management</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <?php Functions::output_result(); ?>
    <div class="row">
      <div class="row" id="divInvoice">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2 id="title">GRN Filter</h2>
              <!--<button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>-->
              <div class="clearfix"></div>
            </div>



            <!--========================================================-->

            <div class="x_content">

              <div class="container-fluid  ">

                <ul class="nav nav-tabs bar_tabs" >
                  <li class="active"><a data-toggle="tab" href="#div1" id="div_clear1">Filter By Supplier</a></li>
                  <li ><a data-toggle="tab" href="#div2" id="div_clear2">Filter By Date Range</a></li>
                </ul>

                <div class="tab-content">
                  <div id="div1" class="tab-pane fade in active">
                    <!--<div class="form-group col-md-6 col-sm-6 col-xs-12 ">-->
                    <label>Select Customer</label>
                    <div class="ui-widget">
                      <select class="form-control" id="cmbFilter" name="filter_id" required="">
                        <option selected="" value="0">Select Supplier</option>
                        <?php
                        foreach (Supplier::find_all() as $supplier) {
                          ?>
                          <option value="<?php echo $supplier->id; ?>"><?php echo $supplier->name; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <!--</div>-->
                  </div>
                  <div id="div2" class="tab-pane fade">
                    <div class="form-group col-md-5 col-sm-5 col-xs-5">
                      <label>From :</label>
                      <input type="text" class="form-control" id="dtpFrom" name="dtpFrom" placeholder="yyyy-mm-dd"/>
                    </div>

                    <div class="form-group col-md-5 col-sm-5 col-xs-5">
                      <label>To :</label>
                      <input type="text" class="form-control" id="dtpTo" name="dtpTo" placeholder="yyyy-mm-dd"/>
                    </div>

                    <div class="form-group col-md-2 col-sm-2 col-xs-2 ">
                      <label>&nbsp;</label>
                      <div class="ui-widget">
                        <button id="btnShow" name="btnShow" class="btn btn-default">Show <i class="glyphicon glyphicon-arrow-down"></i></button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <br/>
            </div>

          </div>
        </div>
      </div>
      <div class="x_panel">
        <div class="x_title">
          <a href="product_grn.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add Product GRN</button></a>
          <!-- <a href="material_grn.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add Material GRN</button></a> -->
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Date</th>
                <th>GRN Number</th>
                <th>Purchase Order No</th>
                <th>Supplier</th>
                <th style='text-align:right;'>Amount</th>
                <th>User</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id = "tbl_body">

              <?php
              foreach (GRN::find_all() as $grn) {
                ?>
                <tr>
                  <td><?php echo $grn->date_time ?></td>
                  <td><?php echo $grn->code ?></td>
                  <td>
                    <?php
                    if (!empty($grn->purchase_order_id)) {
                      echo $grn->purchase_order_id()->code;
                    } else {
                      echo "(Direct GRN)";
                    }
                    ?>
                  </td>
                  <td><?php echo $grn->supplier_id()->name ?></td>
                  <td style='text-align:right;'>
                    <?php
                    $grnTotal = 0;
                    foreach ( GRNProduct::find_all_by_grn_id($grn->id) as $product) {
                      $grnTotal = $grnTotal + ( $product->batch_id()->cost * $product->qty );
                    }
                    echo number_format($grnTotal,2);
                    ?>
                  </td>
                  <td><?php echo $grn->user_id()->name ?></td>
                  <td>
                    <?php
                    if ($grn->grn_type_id == 1) {
                      ?>
                      <a href="product_grn.php?id=<?php echo Functions::custom_crypt($grn->id); ?>">
                        <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
                      </a>
                      <?php
                    } else if ($grn->grn_type_id == 2) {
                      ?>
                      <a href="material_grn.php?id=<?php echo Functions::custom_crypt($grn->id); ?>">
                        <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
                      </a>
                      <?php
                    }
                    ?>
                    <a href="grn_prev.php?id=<?php echo Functions::custom_crypt($grn->id); ?>">
                      <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> View</button>
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
    </div>
  </div>
</div>
<!-- /page content -->

<?php include 'common/bottom_content.php'; ?>

<script>
window.onfocus = function () {
  //        location.reload();
};




/////////////////////Filter By Date Range//////////////////////

$('#div_clear1').click(function () {
  $('#table_body').empty();
  $("#dtpFrom").val("yyyy-mm-dd");
  $("#dtpTo").val("yyyy-mm-dd");


});

$('#div_clear2').click(function () {
  $('#table_body').empty();
  $('#cmbFilter').prop('selectedIndex', 0);

});

$(function () {
  $("#dtpFrom").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd'
  });
});

$(function () {
  $("#dtpTo").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd'
  });
});

$('#btnShow').click(function () {
  submitData();
});

function submitData() {
  var from = $("#dtpFrom").val();
  var to = $("#dtpTo").val();

  $.ajax({
    type: 'POST',
    url: "proccess/grn_management_process.php",
    data: {invoice_report: true, from: from, to: to},
    dataType: 'json',
    async: false,
    success: function (data) {
      $('#tbl_body').empty();
      var trHTML = "";
      $.each(data, function (index, value) {
        var btnEdit = "";
        if (value['grn_type_id'] == "1") {
          btnEdit = "<form action='product_grn.php' method='post' target='_blank' style='float: left;'><input type='hidden' name='grn_id' value='" + value["id"] + "'/><button type='submit' name='view' class='btn btn-primary btn-xs' ><i class='glyphicon glyphicon-edit'></i> Edit</button></form>";
        } else {
          btnEdit = "<form action='material_grn.php' method='post' target='_blank' style='float: left;'><input type='hidden' name='grn_id' value='" + value["id"] + "'/><button type='submit' name='view' class='btn btn-primary btn-xs' ><i class='glyphicon glyphicon-edit'></i> Edit</button></form>";
        }
        var btnView = "<form action='grn_prev.php' method='post' target='_blank' style='float: left;'><input type='hidden' name='grn_id' value='" + value["id"] + "'/><button type='submit' name='view' class='btn btn-primary btn-xs' ><i class='glyphicon glyphicon-edit'></i> View</button></form>";
        trHTML += "<tr><td>" + value["code"] + "</td><td>" + value["date_time"] + "</td><td>" + value["type_name"] + "</td><td>" + value["purchase_order_no"] + "</td><td>" + value["supplier_name"] + "</td><td>" + value["user_name"] + "</td><td>" + btnEdit + "" + btnView + "<td></tr>";
      });
      $('#tbl_body').append(trHTML);
    },
    error: function (xhr) {
      alert(xhr.responseText);
    }
  });
}
/////////////////////////////////////////Filter By Customer/////////////////////////////////////////

$('#cmbFilter').change(function () {
  submitSupplierData();
});

function submitSupplierData() {
  var supplier = $('#cmbFilter').val();
  $.ajax({
    type: 'POST',
    url: "proccess/grn_management_process.php",
    data: {invoice_supplier_report: true, supplier: supplier},
    dataType: 'json',
    async: false,
    success: function (data) {
      //                alert(data);
      $('#tbl_body').empty();
      var trHTML = "";
      $.each(data, function (index, value) {
        var btnEdit = "";
        if (value['grn_type_id'] == "1") {
          btnEdit = "<form action='product_grn.php' method='post' target='_blank' style='float: left;'><input type='hidden' name='grn_id' value='" + value["id"] + "'/><button type='submit' name='view' class='btn btn-primary btn-xs' ><i class='glyphicon glyphicon-edit'></i> Edit</button></form>";
        } else {
          btnEdit = "<form action='material_grn.php' method='post' target='_blank' style='float: left;'><input type='hidden' name='grn_id' value='" + value["id"] + "'/><button type='submit' name='view' class='btn btn-primary btn-xs' ><i class='glyphicon glyphicon-edit'></i> Edit</button></form>";
        }
        var btnView = "<form action='grn_prev.php' method='post' target='_blank' style='float: left;'><input type='hidden' name='grn_id' value='" + value["id"] + "'/><button type='submit' name='view' class='btn btn-primary btn-xs' ><i class='glyphicon glyphicon-edit'></i> View</button></form>";
        trHTML += "<tr><td>" + value["code"] + "</td><td>" + value["date_time"] + "</td><td>" + value["type_name"] + "</td><td>" + value["purchase_order_no"] + "</td><td>" + value["supplier_name"] + "</td><td>" + value["user_name"] + "</td><td>" + btnEdit + "" + btnView + "<td></tr>";
      });
      $('#tbl_body').append(trHTML);
    },
    error: function (xhr) {
      alert(xhr.responseText);
    }
  });
}

</script>

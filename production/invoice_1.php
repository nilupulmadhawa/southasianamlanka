<?php
require_once './../util/initialize.php';


//unset($_SESSION["invoice_inventories"]);
//if (isset($_POST["deliverer_id"])) {
//    $deliverer = Deliverer::find_by_id($_POST["deliverer_id"]);
//
//    if (isset($_POST["customer_id"])) {
//        $customer = Customer::find_by_id($_POST["customer_id"]);
//    }
//    if (isset($_POST["customer_order_id"]) && !empty($_POST["customer_order_id"])) {
//        $customer_order = CustomerOrder::find_by_id($_POST["customer_order_id"]);
//        $customer = $customer_order->customer_id();
//    }
//} else {
//    Functions::redirect_to("invoice_by_deliverer.php");
//}
////////////////////////////////////////////////////////////////////////////

unset($_SESSION["invoice_inventories"]);

$return_invoice = FALSE;
$total = 0;
if (isset($_POST["returning_invoice"]) && isset($_SESSION["product_return"])) {
  $return_invoice = TRUE;
  $product_return = $_SESSION["product_return"];

  $deliverer = Deliverer::find_by_id($product_return["deliverer_id"]);
  if (isset($product_return["product_return_batches"])) {
    foreach ($product_return["product_return_batches"] as $product_return_batch) {
      $sub_total = $product_return_batch["qty"] * $product_return_batch["unit_price"];
      $total += $sub_total;
    }
  }

  //    $customer = new Customer();
  $customer = Customer::find_by_id($product_return["customer_id"]);

  $invoice = new Invoice();
  $order = new CustomerOrder();
} else if (isset($_POST["deliverer_id"])) {
  $invoice_deliverer_id = $_POST["deliverer_id"];
  if ($deliverer = Deliverer::find_by_id($_POST["deliverer_id"])) {
    unset($_SESSION["product_return"]);
    unset($_SESSION["invoice"]);

    if (isset($_POST["customer_id"])) {
      $customer = Customer::find_by_id($_POST["customer_id"]);
    }
    if (isset($_POST["customer_order_id"]) && !empty($_POST["customer_order_id"])) {
      $customer_order = CustomerOrder::find_by_id($_POST["customer_order_id"]);
      $customer = $customer_order->customer_id();
    }
  } else {
    Session::set_error("Deliverer no longer available...");
    Functions::redirect_to("invoice_by_deliverer.php");
  }
} else {
  Functions::redirect_to("invoice_by_deliverer.php");
}

include './common/upper_content.php';
?>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Invoice</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">

      <!-- Modal -->
      <div id="mdlBatch" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Batch</h4>
            </div>
            <div class="modal-body">
              <div class="col-md-6 col-sm-6 col-xs-12" >
                <div class="form-group">
                  <label class="x_title washed" style="display: block;">Batch Code</label>
                  <label id="lblBatchCodePrev"></label>
                </div>
                <div class="form-group">
                  <label class="x_title washed" style="display: block;">Manufacure Date</label>
                  <label id="lblBatchMFD"></label>
                </div>
                <div class="form-group">
                  <label class="x_title washed" style="display: block;">Expire Date</label>
                  <label id="lblBatchEXP"></label>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12" >
                <div class="form-group">
                  <label class="x_title washed" style="display: block;">Cost Price</label>
                  <label id="lblBatchCost"></label>
                </div>
                <div class="form-group">
                  <label class="x_title washed" style="display: block;">Retail Price</label>
                  <label id="lblBatchRetailPrice"></label>
                </div>
                <div class="form-group">
                  <label class="x_title washed" style="display: block;">Wholesale Price</label>
                  <label id="lblBatchWholesalePrice"></label>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>



      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <form id="form" action="proccess/invoice_proccess.php" method="post" class="form-horizontal form-label-left" >
            <div class="x_title">
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label>Deliverer</label>
                <input type="hidden" id="txtDeliverer" class="form-control" name="deliverer_id" value="<?php echo $deliverer->id ?>" />
                <input type="text" class="form-control" value="<?php echo $deliverer->name . " (" . $deliverer->number . ")" ?>" required="required" readonly=""/>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Invoice Code</label>

                <?php

                $deliverer_invoices = Invoice::find_all_by_deliverer_id($invoice_deliverer_id);

                $number_of_invoices = 0;
                foreach ($deliverer_invoices as $data) {
                  $number_of_invoices++;
                }
                $number_of_invoices++;
                // echo $number_of_invoices;
                $deliverer_object = Deliverer::find_by_id($invoice_deliverer_id);
                $deliverer_name = $deliverer_object->name;

                $number_of_invoices = sprintf('%05u', $number_of_invoices);

                ?>

                <input type="text" id="txtCode" name="code" class="form-control" placeholder="Enter Code" value="<?php echo strtoupper($deliverer_name[0].$deliverer_name[1]);  ?><?php echo date("y"); ?><?php echo date("m"); ?><?php echo date("d"); ?><?php echo $number_of_invoices;  ?>" required="required" />
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label>Date</label>
                <input type="text" id="txtDateTime" name="date_time" placeholder="yyyy-mm-dd HH:mm:ss" class="form-control" value="<?php // echo $grn->date_time;      ?>"/>
              </div>
              <div class="clearfix"></div>
            </div>

            <!--style="display: <?php echo ($return_invoice) ? 'disabled' : ''; ?>"-->
            <!--style="pointer-events: none; opacity: 0.8;"-->

            <div class="form-group col-md-6 col-sm-6 col-xs-12">
              <label>Invoice Code</label>
            </div>

            <div id="divInvType" class="x_content"  >
              <ul id="invType" class="nav nav-tabs bar_tabs" >
                <li id="invType2" class="invType <?php echo((!isset($customer_order)) && isset($customer)) ? 'active' : ''; ?>"><a data-toggle="tab" href="#divCus">Customer wise Invoice</a></li>


              </ul>

              <div class="tab-content">

                <div id="divCus" class="tab-pane fade <?php echo((!isset($customer_order)) && isset($customer)) ? 'in active' : ''; ?>">
                  <br/>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label>Customer</label>
                    <select id="cmbCustomer" name="customer_id" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" onchange="showHint(this.value)">

                      <option disabled="" selected="">Select Customer</option>
                      <?php
                      foreach (Customer::find_all() as $db_customer) {
                        if ($db_customer->id == $customer->id) {
                          ?>
                          <option selected="" value="<?php echo $db_customer->id; ?>"><?php echo $db_customer->name; ?></option>
                          <?php
                        } else {
                          ?>
                          <option value="<?php echo $db_customer->id; ?>"><?php echo $db_customer->name; ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>

                    <span id="txtHint"></span>

                  </div>
                </div>

              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="row">
      <div id="divInventorys" class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Select Products</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container-fluid divBackTopTable ">

              <div class="form-group col-md-3 col-sm-3 col-xs-3 ">
                <label>Product</label>
                <br/>

                <!-- start model -->

                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">SELECT PRODUCT</button>

                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Product Selector</h4>
                      </div>
                      <div class="modal-body">
                        <table id="tblMain" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size: 12px;">
                          <thead>
                            <tr>
                              <th>Product ID</th>
                              <th>Product ID</th>
                              <th>Brand</th>
                              <th>Part Number</th>
                              <th>Description</th>
                              <th>Quantity</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $objects = Product::find_all();
                            foreach ($objects as $product) {

                              $invqty = 0;
                              foreach ( Inventory::find_all_by_product_id($product->id) as $inventory ) {
                                $invqty = $invqty + $inventory->qty;
                              }

                              if( 1 == 1 ){
                                $image = "uploads/products/dflt.png";
                                if ($product->image) {
                                  $image = "uploads/products/" . $product->image;
                                }

                                ?>
                                <tr>

                                  <td><a href='<?php echo $image; ?>' target="_blank"><img id="imgImage" src="<?php echo $image; ?>" alt=":( image not found..!" class="image img-responsive img-thumbnail" style="width:60px;"></a></td>
                                  <td><?php echo $product->id; ?></td>
                                  <td><?php echo $product->brand; ?></td>
                                  <td><?php echo $product->name; ?></td>
                                  <td><?php echo $product->description; ?></td>
                                  <td><?php


                                  echo $invqty;

                                  ?></td>
                                  <td><button type="button" class="btn btn-primary" onclick="myFunction(<?php echo $product->id; ?>)">Select</button></td>

                                </tr>
                                <?php
                              }
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>

                <!-- end model -->

              </div>

              <div class="form-group col-md-9 col-sm-9 col-xs-9 ">
                <label>Product</label>
                <select id="cmbProduct" name="deliverer_inventory_id" class="form-control">
                  <option disabled="" selected="">Select Product</option>

                  <?php


                  foreach (Product::find_all() as $product) {

                    $batch_details = Batch::find_by_product_id_last($product->id);

                    $deliverer_inventory = Inventory::find_by_product_id($product->id);

                    if($deliverer_inventory){
                      ?>
                      <option value="<?php echo $product->id; ?>"> (<?php echo $batch_details->code; ?>) <?php echo $product->brand; ?> || <?php echo $product->name; ?> ||  <?php echo $product->description; ?> || Retail Price: <?php if($batch_details){ echo $batch_details->retail_price; }else{ echo "0.00"; } ?> || Stock: <?php if($deliverer_inventory){ echo $deliverer_inventory->qty; }else{ echo "0"; } ?>  </option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>




                <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                  <!-- <label>Batch</label> -->
                  <input type="hidden" id="inpDelivererId" value="<?php echo $deliverer->id; ?>">
                  <select id="cmbDelivererInventory" name="deliverer_inventory_id" class="form-control">
                    <!-- <option disabled="" selected="">Select Batch</option> -->
                  </select>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                  <div class="container-fluid divBackWhite">
                    <div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label class=" washed" style="display: block;"><small>Available Qty.</small></label>
                      <label id="lblAvlQty"></label>
                    </div>
                    <!-- <div class="form-group col-md-2 col-sm-2 col-xs-4">
                      <label class=" washed" style="display: block;"><small>MFD</small></label>
                      <label id="lblMFD"></label>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-4">
                      <label class=" washed" style="display: block;"><small>EXP</small></label>
                      <label id="lblEXP"></label>
                    </div> -->
                    <!--<div class="form-group col-md-2 col-sm-2 col-xs-4">-->
                    <!--    <label class=" washed" style="display: block;"><small>Cost</small></label>-->
                    <!--    <label id="lblCost"></label>-->
                    <!--</div>-->
                    <div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label class=" washed" style="display: block;"><small>Discount (%)</small></label>
                      <label id="lblWholesalePrice"></label>
                    </div>
                    <div class="form-group col-md-4 col-sm-4 col-xs-4">
                      <label class=" washed" style="display: block;"><small>Retail Price</small></label>
                      <label id="lblRetailPrice"></label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <br/>
                  <div class="form-group col-md-1 col-sm-1 col-xs-12">
                    <label id="lblPriceType"> Wholesale</label> <br/>
                    <input type="checkbox" id="chbPriceType" class="js-switch" />
                  </div>
                  <div class="form-group col-md-2 col-sm-2 col-xs-12">
                    <label>Quantity</label>
                    <input type="number" id="qty" name="qty" value="1" required="required" min="1" max="5000" class="form-control col-md-7 col-xs-12">
                  </div>
                  <div class="form-group col-md-3 col-sm-3 col-xs-12">
                    <label>Discount per one unit (%)</label>
                    <input type="text" class="form-control" placeholder="Discount" id="txtProductDiscount">
                  </div>
                  <div class="form-group col-md-3 col-sm-3 col-xs-12">
                    <label>Total (Rs.)</label>
                    <input type="text" class="form-control" placeholder="Total" disabled="" id="txtTotal">
                  </div>
                  <div class="form-group col-md-3 col-sm-3 col-xs-12">
                    <label>Action</label>
                    <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-down"></i> Add <i class="fa fa-cart-plus"></i></button>
                  </div>
                </div>
              </div>
              <br/>
              <div>
                <table id="tbl" class="table table-bordered table-condensed table-striped table-responsive customBorder">
                  <thead>
                    <tr>
                      <th class="col-md-5 col-sm-5 col-xs-5">Product</th>
                      <th class="col-md-1 col-sm-1 co2-xs-1">Unit Price</th>
                      <th class="col-md-2 col-sm-2 co2-xs-2">Discounted Unit Price</th>
                      <th class="col-md-1 col-sm-1 col-xs-1">Quantity</th>
                      <th class="col-md-2 col-sm-2 co2-xs-2">Line Total</th>
                      <th class="col-md-1 col-sm-1 col-xs-1">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
                <div id="divNotification">

                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="display: <?php echo ($return_invoice) ? 'initial' : 'none'; ?>">
                    <label>The Balance Continued</label>
                    <input type="text" class="form-control" placeholder="The Balance Continued" disabled="" value="<?php echo $total; ?>">
                  </div>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label>Gross Total (Rs.)</label>
                    <input type="text" class="form-control" placeholder="Gross Total" disabled="" id="txtGrossTotal">
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label>Discount (Rs.) <?php echo " ( +" . number_format($total, 2) . " )"; ?></label>
                    <input type="text" class="form-control" placeholder="Discount" id="txtFinalDiscount">
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label>Total (Rs.)</label>
                    <input type="text" class="form-control" placeholder="Total" disabled="" id="txtNetTotal">
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label>Cash</label>
                    <input type="text" class="form-control" placeholder="Cash" id="txtCash">
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label>Balance (Credit)</label>
                    <input type="text" class="form-control" placeholder="Total" disabled="" id="txtBalance">
                  </div>
                </div>
              </div>

              <div class="clearfix"></div>
              <div class="modal-footer">
                <button id="btnSave" type="button" class="btn btn-success">Next <i class="fa fa-chevron-circle-right"></i></button>
              </div>
            </div>

          </div>


        </div>

      </div>
    </div>
  </div>
  <?php include './common/bottom_content.php'; ?>
  <script>

  function myFunction(str){
    // alert(str);

    // cmbProduct
    document.getElementById("cmbProduct").value = str;
    reloadDelivererInventorys();
    $('#myModal').modal('hide');
  }

  $(document).ready(function () {
    $('#tblMain').DataTable({
      "paging": false,
      //            "ordering": false,
      "info": false
    });
  });

  function showHint(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "proccess/live_feed/customer_ourtsanding.php?q=" + str, true);
      xmlhttp.send();
    }
  }

  window.onload = function () {
    $("#txtDateTime").datetimepicker('setDate', new Date());
    fillProductTable();
    calculate_final_total();

    var customer_order_id = $("#cmbOrder").val();
    var deliverer_id = $("#txtDeliverer").val();

    if (customer_order_id && deliverer_id) {
      loadInventories(customer_order_id, deliverer_id);
    }

  };

  $('#txtDateTime').datetimepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    timeFormat: 'HH:mm:ss'
  });

  var wholesale_price = 0;
  var retail_price = 0;
  var product_total = 0;
  var avl_qty = 0;

  var gross_amount;
  var net_amount;
  var balance;

  $("#cmbOrderCustomer").change(function (e) {
    e.preventDefault;
    var cus_id = $("#cmbOrderCustomer").val();
    fillCustomerOrders(cus_id);
  });

  $("#cmbOrderCustomer").click(function (e) {
    e.preventDefault;
    var cus_id = $("#cmbOrderCustomer").val();
    fillCustomerOrders(cus_id);
  });

  function fillCustomerOrders(cus_id) {
    $('#cmbOrder option').remove();
    $.ajax({
      type: 'POST',
      url: "proccess/invoice_proccess.php",
      data: {order_request: true, customer_id: cus_id},
      dataType: 'json',
      async: false,
      success: function (data) {
        var trHTML = "";
        trHTML += "<option disabled='' selected='' >Select Customer Order</option>";
        $.each(data, function (index, value) {
          trHTML += "<option value=" + value["id"] + ">" + value["code"] + "</option>";
        });
        $('#cmbOrder').append(trHTML);
      }
    });
  }


  $("#cmbProduct").change(function (e) {
    e.preventDefault;
    reloadDelivererInventorys();
  });

  function reloadDelivererInventorys(){
    loadDelivererInventoryPrev();
    var product_id = $("#cmbProduct").val();
    var deliverer_id = $("#inpDelivererId").val();
    fillDelivererInventorys(deliverer_id, product_id);
  }

  function fillDelivererInventorys(deliverer_id, product_id) {
    $('#cmbDelivererInventory option').remove();
    var trHTML = "";
    // trHTML += "<option disabled='' selected='' >Select Batch</option>";
    if (deliverer_id && product_id) {
      $.ajax({
        type: 'POST',
        url: "proccess/invoice_proccess.php",
        data: {deliverer_inventories_request: true, deliverer_id: deliverer_id, product_id: product_id},
        dataType: 'json',
        async: false,
        success: function (data) {
          //                    alert(JSON.stringify(data));
          $.each(data, function (index, value) {
            if(value["qty"] > 0){
              trHTML += "<option value=" + value["inventory_id"]["batch_id"]["id"] + ">" + "Batch:" + value["inventory_id"]["batch_id"]["code"] + " | Qty:" + value["qty"] + "</option>";

              fillInventoryDetails(value["inventory_id"]["batch_id"]["id"]);

            }

          });
        }
      });
    }
    $('#cmbDelivererInventory').append(trHTML);
  }

  function loadDelivererInventoryPrev() {
    wholesale_price = 0;
    retail_price = 0;
    $('#cmbDelivererInventory').prop('selectedIndex', 0);
    $("#lblAvlQty").text(null);
    $("#lblMFD").text(null);
    $("#lblEXP").text(null);
    // $("#lblCost").text(null);
    $("#lblWholesalePrice").text(null);
    $("#lblRetailPrice").text(null);
    $("#qty").val(1);
    $("#txtProductDiscount").val(null);
    $("#txtTotal").val(null);

    //        $("#chbPriceType").removeAttr("checked");
  }

  $("#cmbDelivererInventory").change(function (e) {
    e.preventDefault;
    var deliverer_inventory_id = $("#cmbDelivererInventory").val();
    fillInventoryDetails(deliverer_inventory_id);
  });

  function fillInventoryDetails(deliverer_inventory_id) {
    if (deliverer_inventory_id){
      $.ajax({
        type: 'POST',
        url: "proccess/invoice_proccess.php",
        data: {inventory_request: true, deliverer_inventory_id: deliverer_inventory_id},
        dataType: 'json',
        async: false,
        success: function (data) {
          avl_qty = data.avl_qty;
          $("#lblAvlQty").text(avl_qty);
          // $("#lblMFD").text(data.mfd);
          // $("#lblEXP").text(data.exp);
          // $("#lblCost").text(data.cost);
          wholesale_price = data.wholesale_price;
          retail_price = data.retail_price;
          discount_limit = data.discount_limit;

          $("#lblWholesalePrice").text(discount_limit);
          $("#lblRetailPrice").text(retail_price);
          if (data.avl_qty > 0) {
            $("#qty").val(1);
            $("#qty").prop("disabled", false);
            $("input").attr({
              "max": data.avl_qty,
              "min": 1
            });
          } else {
            $("#qty").val(0);
            $("#qty").prop("disabled", true);
            $("input").attr({
              "max": 0,
              "min": 0
            });
          }
          calculateTotal();
        }
      });
    }
  }

  $("#chbPriceType").change(function (e) {
    e.preventDefault;
    setPriceType();
    calculateTotal();
  });
  function setPriceType() {
    if ($("#chbPriceType").is(':checked')) {
      $("#lblPriceType").text("Wholesale");
      //            $("#lblBatchRetailPrice").addClass("border");
      //            $("#lblBatchWholesalePrice").removeClass("border");
    } else {
      $("#lblPriceType").text("Retail");
      //            $("#lblBatchRetailPrice").removeClass("border");
      //            $("#lblBatchWholesalePrice").addClass("border");
    }
  }

  $("#qty").change(function (e) {
    e.preventDefault;
    calculateTotal();
  });
  $("#txtProductDiscount").keyup(function (e) {
    e.preventDefault;
    calculateTotal();
  });
  function calculateTotal() {
    discount = $("#txtProductDiscount").val();
    qty = $("#qty").val();

    if(discount != null){
      var settledis = 100 - discount;
      settledis = settledis/100;
    }else {
      settledis = 1;
    }

    if ($("#chbPriceType").is(':checked')) {

      product_total = ((wholesale_price * settledis) * qty).toFixed(2);
    } else {

      product_total = ((retail_price * settledis) * qty).toFixed(2);
    }

    $("#txtTotal").val(product_total);
  }

  function loadProduct() {
    wholesale_price = 0;
    retail_price = 0;
    $('#cmbDelivererInventory').prop('selectedIndex', 0);
    $("#lblAvlQty").text(null);
    $("#lblMFD").text(null);
    $("#lblEXP").text(null);
    $("#lblCost").text(null);
    $("#lblWholesalePrice").text(null);
    $("#lblRetailPrice").text(null);
    $("#qty").val(1);
    $("#txtProductDiscount").val(null);
    $("#txtTotal").val(null);

    //        $("#chbPriceType").removeAttr("checked");
  }

  function checkInventory(id) {
    var result;
    $.ajax({
      type: 'POST',
      url: "proccess/invoice_proccess.php",
      data: {check_Inventory: true, id: id},
      dataType: 'json',
      async: false,
      success: function (data) {
        result = data;
      }
    });

    return result;
  }

  function getProductErrors() {
    var errors = new Array();
    var element;
    var element_value;

    //        return preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $value);
    //        return preg_match("/^[0-9]+$/", $value);

    element = $("#cmbDelivererInventory");
    element_value = element.val();
    if (element_value) {
      if (checkInventory(element_value)) {
        errors.push("Product - Already added to the table!");
        element.css({"border": "1px solid red"});
      } else {
        element.css({"border": "1px solid #ccc"});
      }
    } else {
      errors.push("Product - Not Selected");
      element.css({"border": "1px solid red"});
    }

    element = $("#qty");
    element_value = element.val();
    if (element_value !== "" && Validation.validateOnlyNumber(element_value) && parseInt(element_value) > 0) {
      var qty = parseInt(element_value);
      if (qty > avl_qty) {
        errors.push("Product quantiry exeeds available stock ");
        element.css({"border": "1px solid red"});
      } else {
        element.css({"border": "1px solid #ccc"});
      }
    } else {
      errors.push("Product quantiry - Invalid");
      element.css({"border": "1px solid red"});
    }

    element = $("#txtProductDiscount");
    element_value = element.val();
    //        if (element_value !== "" && Validation.validatePrice(element_value)) {
    if (element_value == "") {
      element.css({"border": "1px solid #ccc"});
    } else {
      //            var reg=new RegExp("^[0-9]+\.[0-9]{0,2}$");
      //            var reg = new RegExp("^[-+]?[0-9]+\(.[0-9]{0,2})?$");
      if (new RegExp("^[-+]?[0-9]+\(.[0-9]{0,2})?$").test(element_value)) {
        element.css({"border": "1px solid #ccc"});
      } else {
        errors.push("Product discount - Invalid");
        element.css({"border": "1px solid red"});
      }
    }

    element = $("#txtTotal");
    element_value = element.val();
    if (element_value !== "" && Validation.validatePrice(element_value)) {
      element.css({"border": "1px solid #ccc"});
    } else {
      errors.push("Total - Invalid");
      element.css({"border": "1px solid red"});
    }

    return errors;
  }

  $("#btnAdd").click(function (e) {
    e.preventDefault;
    addProduct();
  });
  function addProduct() {

    var errors = getProductErrors();

    if (errors === undefined || errors.length === 0) {

      var deliverer_inventory_id = $("#cmbDelivererInventory").val();
      var qty = $("#qty").val();
      var temp_unit_discount = $("#txtProductDiscount").val();
      var unit_discount = (temp_unit_discount != "") ? temp_unit_discount : 0;
      var price;
      if ($("#chbPriceType").is(':checked')) {
        price = wholesale_price;
      } else {

        price = retail_price;
      }

      $.ajax({
        type: "POST",
        url: "proccess/invoice_proccess.php",
        data: {add_product: true, deliverer_inventory_id: deliverer_inventory_id, price: price, qty: qty, unit_discount: unit_discount, product_total: product_total},
        success: function (data) {
          calculate_final_total();
          fillProductTable();
          loadProduct();
          new PNotify({
            title: 'Success',
            text: 'Product added to the table!',
            type: 'success',
            styling: 'bootstrap3'
          });
        }
      });
    } else {
      $.alert({
        icon: 'fa fa-exclamation-circle',
        backgroundDismiss: true,
        type: 'red',
        title: 'Validation error!',
        content: errors.join("</br>")
      });
    }
  }

  function fillProductTable() {
    $('#tbl tbody').remove();
    $.ajax({
      type: 'POST',
      url: "proccess/invoice_proccess.php",
      data: {inventorys_request: true},
      dataType: 'json',
      async: false,
      success: function (data) {
        var trHTML = "";
        $.each(data, function (index, value) {
          var batch = "<a style='cursor:pointer;' id='" + value["batch_id"]["id"] + "' onclick='showBatch(this)' >  Batch:" + value["batch_id"]["code"] + " </a>";
          //                    var batch = "<input class='btn btn-xs' type='button' style='cursor:pointer;' id='"+ value["batch_id"]["id"] +"' onclick='showBatch(this)' value='"+value["batch_id"]["code"]+"'>";
          var btnRemove = "<button title='Remove' style='float:left;' type='button' onclick='removeRow(this)' id='" + value["deliverer_inventory_id"] + "' class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>";
          var btnRemoveReload = "<button title='Remove and edit' type='button' onclick='removeReload(this)' id='" + value["deliverer_inventory_id"] + "' class='btn btn-primary btn-xs'> <i class='fa fa-close'> </i> <i class='fa fa-edit'></i></button>";
          trHTML += "<tr id='" + value["deliverer_inventory_id"] + "'><td>" + value["product_id"] + " (" + batch + ")</td><td>" + value["price"] + "</td><td>" + value["discounted_unit_price"] + "</td><td>" + value["qty"] + "</td><td>" + value["product_total"] + "</td><td class='col-sm-2'>" + btnRemove + btnRemoveReload + "</td></tr>";
        });
        $('#tbl').append(trHTML);

        checkInventoriesQty();
      }

    });

  }

  function showBatch(element) {
    $.ajax({
      type: 'POST',
      url: "proccess/invoice_proccess.php",
      data: {batch_request: true, batch_id: element.id},
      dataType: 'json',
      async: false,
      success: function (data) {
        $("#lblBatchCodePrev").text(data.code);
        $("#lblBatchMFD").text(data.mfd);
        $("#lblBatchEXP").text(data.exp);
        $("#lblBatchCost").text(data.cost);
        $("#lblBatchRetailPrice").text(data.retail_price);
        $("#lblBatchWholesalePrice").text(data.wholesale_price);
        $('#mdlBatch').modal('show');
      }
    });
  }

  function scrollTo(element_id) {
    $('html,body').animate({
      scrollTop: $(element_id).offset().top},
      'slow');
    }

    function removeReload(element) {
      $.ajax({
        type: "POST",
        url: "proccess/invoice_proccess.php",
        data: {remove_inventory: true, index: element.id},
        success: function (data) {
          calculate_final_total();
          fillProductTable();

          //                $('#cmbDelivererInventory').prop('selectedIndex', element.id);
          $('#cmbDelivererInventory').val(element.id);
          fillInventoryDetails($("#cmbDelivererInventory").val());

          scrollTo("#divInventorys");
        }
      });
    }

    function removeRow(element) {
      $.ajax({
        type: "POST",
        url: "proccess/invoice_proccess.php",
        data: {remove_inventory: true, index: element.id},
        success: function (data) {
          calculate_final_total();
          fillProductTable();
          loadProduct();
          new PNotify({
            title: 'Success',
            text: 'Product removed from table!',
            type: 'success',
            styling: 'bootstrap3'
          });
        }
      });
    }

    function getTotal() {
      var total;
      $.ajax({
        type: "POST",
        url: "proccess/invoice_proccess.php",
        data: {total_request: true},
        dataType: 'json',
        async: false,
        success: function (data) {
          total = data;
        }
      });
      return total;
    }

    $("#txtFinalDiscount").keyup(function (e) {
      e.preventDefault;
      calculate_final_total();
    });

    $("#txtCash").keyup(function (e) {
      e.preventDefault;
      calculate_final_total();
    });

    function calculate_final_total() {
      //        var continued_balance = (<?php // echo $total;      ?>).toFixed(2);
      var continued_balance = parseInt(<?php echo $total; ?>);
      //        var continued_balance = (0).toFixed(2);
      //        gross_amount = getTotal() + (-continued_balance);
      gross_amount = getTotal();

      final_discount = continued_balance;
      element = $("#txtFinalDiscount");
      element_value = element.val();
      if (element_value === "") {
        element.css({"border": "1px solid #ccc"});
      } else {
        if (Validation.validatePrice(element_value)) {
          element.css({"border": "1px solid #ccc"});
          final_discount += parseFloat(element_value);
        } else {
          element.css({"border": "1px solid red"});
        }
      }

      $("#txtGrossTotal").val(gross_amount.toFixed(2));

      var values = 100 - final_discount;
      values = values / 100;

      // net_amount = (gross_amount - final_discount);
      net_amount = (gross_amount * values);


      $("#txtNetTotal").val(net_amount.toFixed(2));

      calculate_balance();
    }

    function calculate_balance() {
      cash = 0;
      element = $("#txtCash");
      element_value = element.val();
      if (element_value === "") {
        element.css({"border": "1px solid #ccc"});
      } else {
        if (Validation.validatePrice(element_value)) {
          element.css({"border": "1px solid #ccc"});
          cash = element_value;
        } else {
          element.css({"border": "1px solid red"});
        }
      }

      balance = (net_amount - cash);
      $("#txtBalance").val(balance.toFixed(2));
    }

    $("#cmbOrder").change(function (e) {
      //        e.preventDefault;
      var customer_order_id = $("#cmbOrder").val();
      var deliverer_id = $("#txtDeliverer").val();
      loadInventories(customer_order_id, deliverer_id);
    });

    function loadInventories(customer_order_id, deliverer_id) {
      $.ajax({
        type: "POST",
        url: "proccess/invoice_proccess.php",
        data: {load_invoice_inventories: true, customer_order_id: customer_order_id, deliverer_id: deliverer_id},
        success: function (data) {
          fillProductTable();
          calculate_final_total();
          loadProduct();
          new PNotify({
            title: 'Products loaded',
            text: 'Products for the Order, loaded to the table!',
            type: 'info',
            styling: 'bootstrap3'
          });

        }
      });
    }

    $(".invType").click(function (e) {
      e.preventDefault;
      checkInventoriesQty(this.id);
    });

    function checkInventoriesQty(invType) {
      $("#divNotification").empty();
      if (!invType) {
        var invType = $("#invType .active").attr('id');
      }
      if (invType == "invType1") {
        var customer_order_id = $("#cmbOrder").val();
        var deliverer_id = $("#txtDeliverer").val();
        if (customer_order_id && deliverer_id) {
          $.ajax({
            type: "POST",
            url: "proccess/invoice_proccess.php",
            data: {check_qty: true, customer_order_id: customer_order_id, deliverer_id: deliverer_id},
            dataType: 'json',
            async: false,
            success: function (data) {
              var notifiation = '<div class="alert alert-warning" style="color:black;"> <i class="fa fa-warning"></i> ' + data.join('</br>') + '</div>';
              $("#divNotification").append(notifiation);
            }
          });
        }
      }
    }


    //////////////////////////////////////////////
    function sessionCount() {
      var result;
      $.ajax({
        type: 'POST',
        url: "proccess/invoice_proccess.php",
        data: {session_count: true},
        dataType: 'json',
        async: false,
        success: function (data) {
          result = data;
        }
      });
      return result;
    }

    function find_invoice_by_code(value) {
      var result;
      $.ajax({
        type: 'POST',
        url: "proccess/invoice_proccess.php",
        data: {find_invoice_by_code: true, code: value},
        dataType: 'json',
        async: false,
        success: function (data) {
          result = data;
        }
      });
      return result;
    }

    function getErrors() {
      var errors = new Array();
      var element;
      var element_value;

      //        element = $("#txtCode");
      //        element_value = element.val();
      //        if (element_value === "") {
      //            errors.push("Invoice Code - Invalid");
      //            element.css({"border": "1px solid red"});
      //        } else {
      //            element.css({"border": "1px solid #ccc"});
      //        }

      element = $("#txtCode");
      element_value = element.val();
      if (element_value.trim() != "") {
        if (find_invoice_by_code(element_value)) {
          errors.push("Invoice Code - Already Added");
        } else {
          element.css({"border": "1px solid red"});
          element.css({"border": "1px solid #ccc"});
        }
      } else {
        errors.push("Invoice Code - Invalid");
        element.css({"border": "1px solid red"});

      }


      element = $("#txterror");
      element_value = element.val();
      if (element_value.trim() == 1) {
        errors.push("Credit Limit - Customer Credit Limit Reached");
        element.css({"border": "1px solid red"});
      } else {
        element.css({"border": "1px solid #ccc"});
      }

      element = $("#txtDateTime");
      element_value = element.val();
      if (element_value && (new RegExp("^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[1-9]|1[0-9]|2[0-4]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9])$").test(element_value))) {
        element.css({"border": "1px solid #ccc"});
      } else {
        errors.push("DateTime - Not Selected");
        element.css({"border": "1px solid red"});
      }

      var invType = $("#invType .active").attr('id');
      $("#divInvType").css({"border": "none"});
      if (invType == "invType1") {
        element = $("#cmbOrder");
        element_value = element.val();
        if (element_value) {
          element.css({"border": "1px solid #ccc"});
        } else {
          errors.push("Customer Order - Not selected");
          element.css({"border": "1px solid red"});
        }
      } else if (invType == "invType2") {
        element = $("#cmbCustomer");
        element_value = element.val();
        if (element_value) {
          element.css({"border": "1px solid #ccc"});
        } else {
          errors.push("Customer - Not selected");
          element.css({"border": "1px solid red"});
        }
      } else if (invType == "invType3") {

      } else {
        errors.push("Invoice Type - Not selected");
        $("#divInvType").css({"border": "none"});
      }

      var tbl_inventorys = sessionCount();
      element = $("#tbl");
      element_value = element.val();
      if (!tbl_inventorys) {
        errors.push("Products - Not selected");
        element.css({"border": "1px solid red"});
      } else {
        element.css({"border": "1px solid #ccc"});
      }

      //        var balance = (<?php // echo $total;     ?>).toFixed(2);
      //        if (net_amount < balance) {
      //            errors.push("Amount - Not enough to complete return");
      //            element.css({"border": "1px solid red"});
      //        } else {
      //            element.css({"border": "1px solid #ccc"});
      //        }

      if (net_amount < 0) {
        errors.push("Amount - Not enough to complete return");
        element.css({"border": "1px solid red"});
      } else {
        element.css({"border": "1px solid #ccc"});
      }

      return errors;
    }

    function validateForm() {
      var errors = getErrors();
      if (errors === undefined || errors.length === 0) {
        return true;
      } else {
        $.alert({
          icon: 'fa fa-exclamation-circle',
          backgroundDismiss: true,
          type: 'red',
          title: 'Validation error!',
          content: errors.join("</br>")
        });
        return false;
      }
    }

    //    $("#btnSave").click(function () {
    //        var arr = {"save": true, "gross_amount": gross_amount, "net_amount": net_amount, "balance": balance, "invType": $("#invType .active").attr('id')};
    //        FormOperations.submitForm(validateForm(), "#form", arr);
    //    });

    $("#btnSave").click(function () {
      if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Invoice", "ins")) {
        confirmSave();
      }
    });

    function confirmSave() {
      if (validateForm()) {
        $.confirm({
          icon: 'fa fa-question-circle',
          type: 'green',
          title: 'Proceed',
          content: 'Are you sure you want to proceed ?',
          buttons: {
            yes: {
              text: 'Yes',
              btnClass: 'btn-green',
              keys: ['enter'],
              action: function () {
                submitData();
              }
            },
            cancel: function () {
            }
          }
        });
      }
    }

    function submitData() {
      var form = $('#form').serializeArray();
      var formData = {};
      for (var index in form) {
        var element = form[index];
        formData[element.name] = element.value;
      }
      //        $.each(form, function (index, value) {
      //            formData[value.name]=value.value;
      //        });
      var continued_balance = (<?php echo $total; ?>).toFixed(2);
      formData["gross_amount"] = gross_amount;
      formData["net_amount"] = net_amount;
      formData["balance"] = balance;
      formData["invType"] = $("#invType .active").attr('id');

      //        alert(JSON.stringify(formData));

      $.ajax({
        type: 'POST',
        url: "proccess/invoice_proccess.php",
        //            data: {save: true, gross_amount: gross_amount, net_amount: net_amount, balance: balance, invType: $("#invType .active").attr('id')},
        data: {save: true, formData: formData},
        dataType: 'json',
        async: false,
        success: function (data) {
          //                if (data) {
          //                      $(location).attr('href', 'invoice_final_prev.php');
          //                }
          if ("<?php echo $return_invoice; ?>") {
            //                    $(location).attr('href', 'invoice_final_prev.php');
            //                    FormOperations.postForm('invoice_return_final_prev.php');
            FormOperations.postForm('invoice_return_final_prev.php', {"new_invoice": true});
          } else {
            //                    $(location).attr('href', 'invoice_prev.php');
            FormOperations.postForm('invoice_prev.php', {"new_invoice": true});
          }
        }
      });
    }


  </script>

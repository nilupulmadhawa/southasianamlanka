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
              <div class="col-md-6 col-sm-6 col-xs-12">
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
              <div class="col-md-6 col-sm-6 col-xs-12">
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
          <form id="form" action="proccess/invoice_proccess.php" method="post"
          class="form-horizontal form-label-left">
          <div class="x_title">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <label>Deliverer</label>
              <input type="hidden" id="txtDeliverer" class="form-control" name="deliverer_id"
              value="<?php echo $deliverer->id ?>"/>
              <input type="text" class="form-control"
              value="<?php echo $deliverer->name . " (" . $deliverer->number . ")" ?>"
              required="required" readonly=""/>
            </div>
            <div class="form-group col-md-6 col-sm-6 col-xs-12">
              <label>Invoice Code</label>
              <?php
              $deliver_count = Invoice::find_all_by_deliverer_id($deliverer->id);
              $invID = count($deliver_count);
              ?>
              <input type="text" id="txtCode" name="code" class="form-control"
              placeholder="Enter Code"
              value="Inv-<?php echo substr($deliverer->name, 0, 4) . "-" . $invID; ?>"
              required="required"/>
            </div>
            <div class="form-group col-md-6 col-sm-6 col-xs-12">
              <label>Invoice Type</label>
              <select name="invType1" class="form-control">
                <option value='Urgent'>Urgent</option>
                <option value='Normal'>Normal</option>
                <!-- <option value='Cheque'>Cheque</option> -->
              </select>
            </div>
            <div class="form-group col-md-6 col-sm-6 col-xs-12">
              <label>Location : <span style="color:blue;" id="txtHint"></span></label>
              <p id="geo"></p>
            </div>
            <!-- <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <label>Date</label>
            <input type="text" id="txtDateTime" name="date_time" placeholder="yyyy-mm-dd HH:mm:ss" class="form-control" value="<?php // echo $grn->date_time;          ?>"/>
          </div> -->
          <div class="clearfix"></div>
        </div>
        <!--style="display: <?php echo ($return_invoice) ? 'disabled' : ''; ?>"-->
        <!--style="pointer-events: none; opacity: 0.8;"-->
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
          <label>Invoice Type</label>
        </div>
        <div id="divInvType" class="x_content">
          <ul id="invType" class="nav nav-tabs bar_tabs">
            <li id="invType2"
            class="invType <?php echo ((!isset($customer_order)) && isset($customer)) ? 'active' : ''; ?>">
            <a data-toggle="tab" href="#divCus">Customer wise Invoice</a></li>
            <li id="invType3" class="invType"><a data-toggle="tab" href="#divRetCus">Retail Customer
              Invoice</a></li>
              <!--<li id="invType1" class="invType <?php // echo(isset($customer_order)) ? 'active' : '';                         ?>"><a data-toggle="tab" href="#divOrder">Order wise Invoice</a></li>-->
              <?php
              if (!$return_invoice) {
                ?>
                <!-- <li id="invType1" class="invType <?php echo (isset($customer_order)) ? 'active' : ''; ?>"><a data-toggle="tab" href="#divOrder">Order wise Invoice</a></li> -->
                <?php
              }
              ?>

            </ul>

            <div class="tab-content">
              <div id="divCus"
              class="tab-pane fade <?php echo ((!isset($customer_order)) && isset($customer)) ? 'in active' : ''; ?>">
              <br/>
              <div class="form-group col-xs-12">
                <label>Customer</label>
                <select id="cmbCustomer" name="customer_id" class="form-control js-example-basic-multiple" style="width: 100%;">
                  <option disabled="" selected="">Select Customer</option>
                  <?php
                  foreach (Customer::find_all() as $db_customer) {
                    if ($db_customer->id == $customer->id) {
                      ?>
                      <option selected=""
                      value="<?php echo $db_customer->id; ?>"><?php echo $db_customer->name." | ".$db_customer->route_id()->name." | ".$db_customer->address; ?></option>
                      <?php
                    } else {
                      ?>
                      <option value="<?php echo $db_customer->id; ?>"><?php echo $db_customer->name." | ".$db_customer->route_id()->name." | ".$db_customer->address; ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div id="divRetCus" class="tab-pane fade">
              <div class="x_content">
                <h2>Retail Customer invoice</h2>
              </div>
            </div>
            <div id="divOrder"
            class="tab-pane fade in <?php echo (isset($customer_order)) ? 'in active' : ''; ?>">
            <br/>
            <div class="form-group col-md-6 col-sm-6 col-xs-12">
              <label>Customer</label>
              <!--<input type="text" class="form-control" placeholder="Customer Name" id="cmbCustomer">-->
              <select id="cmbOrderCustomer" name="order_customer_id" class="form-control">
                <option disabled="" selected="">Select Customer</option>
                <?php
                foreach (Customer::find_all() as $db_customer) {
                  if ($db_customer->id == $customer->id) {
                    ?>
                    <option selected=""
                    value="<?php echo $db_customer->id; ?>"><?php echo $db_customer->name; ?></option>
                    <?php
                  } else {
                    ?>
                    <option value="<?php echo $db_customer->id; ?>"><?php echo $db_customer->name; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group col-md-6 col-sm-6 col-xs-12">
              <label>Orders</label>
              <select id="cmbOrder" name="order_id" class="form-control">
                <option disabled="" selected="">Select Customer Order</option>
                <?php
                foreach (CustomerOrder::find_all() as $db_customer_order) {
                  if ($db_customer_order->id == $customer_order->id) {
                    ?>
                    <option selected=""
                    value="<?php echo $db_customer_order->id; ?>"><?php echo $db_customer_order->code; ?></option>
                    <?php
                  } else {
                    ?>
                    <option value="<?php echo $db_customer_order->id; ?>"><?php echo $db_customer_order->code; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
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
        <!-- <div class="col-sm-12" style="text-align:right;font-size:20px;">TOTAL AMOUNT: 0.00 LKR</div> -->
        <h2>Select Products</h2>
        <div class="clearfix"></div>

      </div>
      <div class="x_content">
        <div class="container-fluid divBackTopTable ">
          <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
            <label>Product</label>


            <!-- table start -->

            <div class="panel-group" id="accordion">
              <?php
              $catcount = 0;
              foreach (Category::find_all() as $cat) {
                ++$catcount;
                // echo $cat->name."<br/>";
                ?>

                <div class="panel panel-default">
                  <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion"
                    href="<?php echo "#" . $cat->id; ?>">
                    <h4 class="panel-title">
                      <p><?php echo $cat->name; ?></p>
                    </h4>
                  </a>
                </div>
                <div id="<?php echo $cat->id; ?>" class="panel-collapse collapse">
                  <div class="panel-body">

                    <table id='<?php echo "table" . $catcount; ?>'
                      class="table table-striped">
                      <thead>
                        <tr>
                          <th>Product Name</th>
                          <th>Price</th>
                          <th>Discount</th>
                          <th>Discount Ptg</th>
                          <th>Dis. Price</th>
                          <th>Qty</th>
                          <th>FreeIssue</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // $catID = 1;
                        $tablerowcount = 1;
                        foreach (Product::find_all_by_category($cat->id) as $product) {

                          // echo $deliverer->id."<br/>";
                          // print_r( DelivererInventory::find_all_by_deliverer_id_product_id2($deliverer->id,$product->id) );
                          // echo "---------------------------------<br/>";

                          foreach (DelivererInventory::find_all_by_deliverer_id_product_id2($deliverer->id, $product->id) as $subinv) {

                            // echo "deliverer inv ID: ".$subinv->id."<br/>";


                            foreach (Inventory::find_all_inv_id($subinv->inventory_id) as $invdetails) {
                              // echo "inv batch ID: ".$invdetails->batch_id."<br/>";

                              foreach (Batch::find_all_by_product_id($invdetails->product_id) as $batch) {
                                $rowcountname = "table" . $catcount . "row" . $tablerowcount;
                                $rowcountname2 = "table" . $catcount . "row" . $tablerowcount . "del";
                                $rowcountname3 = "table" . $catcount . "row" . $tablerowcount . "dis";
                                $rowcountname4 = "table" . $catcount . "row" . $tablerowcount . "disptg";
                                $rowcountname5 = "table" . $catcount . "row" . $tablerowcount . "freeissue";
                                // $rowcountname4 = "table".$catcount."row".$tablerowcount."view";

                                ++$tablerowcount;
                                echo "<tr>";
                                echo "<td>" . $product->name . "</td>";
                                echo "<td>" . $batch->retail_price . "</td>";
                                echo "<td><input type='text' id='" . $rowcountname3 . "' name='" . $rowcountname3 . "' class='form-control' value='0' onchange='myFunction(this)' ></td>";
                                echo "<td><input type='text' id='" . $rowcountname4 . "' name='" . $rowcountname4 . "' class='form-control' value='0' onchange='myFunction2(this)' ></td>";
                                echo "<td id=''>" . $batch->retail_price . "</td>";
                                echo "<td><input type='text' id='" . $rowcountname . "' name='" . $rowcountname . "' class='form-control' placeholder='Qty' value='0'></td>";
                                echo "<td><input type='text' id='" . $rowcountname5 . "' name='" . $rowcountname5 . "' class='form-control' placeholder='Free Issue' value='0'></td>";

                                echo "<td><input type='hidden' id='" . $rowcountname2 . "' name='" . $rowcountname2 . "' value='" . $subinv->id . "' ></td>";
                                echo "</tr>";

                              }

                            }


                          }


                        }
                        ?>
                      </tbody>
                    </table>

                  </div>

                </div>

              </div>


              <?php

            }

            ?>


            <div class="col-sm-12" style="text-align:right;margin-top:15px;">
              <button id="btnAddAll" type="button" class="btn btn-primary">ADD TO INVOICE
              </button>
            </div>
          </div>

          <!-- table ends -->


        </div>


      </div>
      <br/>
      <div>
        <table id="tbl"
        class="table table-bordered table-condensed table-striped table-responsive customBorder">
        <thead>
          <tr>
            <th class="col-md-5 col-sm-5 col-xs-5">Product</th>
            <th class="col-md-1 col-sm-1 co2-xs-1">Unit Price</th>
            <!-- <th class="col-md-2 col-sm-2 co2-xs-2">Discounted Unit Price</th> -->
            <th class="col-md-1 col-sm-1 col-xs-1">Quantity</th>
            <th class="col-md-2 col-sm-2 co2-xs-2">Line Total</th>
            <th class="col-md-2 col-sm-2 co2-xs-2">Free Issue</th>
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
        <div class="form-group col-md-12 col-sm-12 col-xs-12"
        style="display: <?php echo ($return_invoice) ? 'initial' : 'none'; ?>">
        <label>The Balance Continued</label>
        <input type="text" class="form-control" placeholder="The Balance Continued"
        disabled="" value="<?php echo $total; ?>">
      </div>
    </div>
    <div class="form-group col-md-6 col-sm-6 col-xs-12">
      <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <label>Gross Total (Rs.)</label>
        <input type="text" class="form-control" placeholder="Gross Total" disabled=""
        id="txtGrossTotal">
      </div>
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
        <label>Discount (%) </label>
        <input type="text" class="form-control" placeholder="Discount"
        id="txtFinalDiscount">
      </div>
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
        <label>Total (Rs.)</label>
        <input type="text" class="form-control" placeholder="Total" disabled=""
        id="txtNetTotal">
      </div>
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
        <label>Cash</label>
        <input type="text" class="form-control" placeholder="Cash" id="txtCash">
      </div>
      <div class="form-group col-md-6 col-sm-6 col-xs-12">
        <label>Balance (Credit)</label>
        <input type="text" class="form-control" placeholder="Total" disabled=""
        id="txtBalance">
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
  <div class="modal-footer">
    <button id="btnSave" type="button" class="btn btn-success">Next <i
      class="fa fa-chevron-circle-right"></i></button>
    </div>
  </div>

</div>


</div>

</div>
</div>
</div>
<?php include './common/bottom_content.php'; ?>
<script>

$(function() {
  // console.log( "ready!" );
  $('.js-example-basic-multiple').select2();
});

function myFunction(element) {
  var dis = $(element).val();
  // var qty1 = parseFloat(qty);
  // $(element).closest('tr').find( "td:eq( 1 )" ).text(qty1);
  var pice = $(element).closest('tr').find("td:eq( 1 )").text();
  // var dis = $(element).closest('tr').find( "td:eq( 2 )" ).text();
  // alert(dis);
  pice1 = parseInt(pice);
  dis1 = parseInt(dis);
  var newamount = pice1 - dis1;
  newamount = newamount.toFixed(2);
  $(element).closest('tr').find("td:eq( 4 )").text(newamount);

}

function myFunction2(element) {
  var dis = $(element).val();
  // var qty1 = parseFloat(qty);
  // $(element).closest('tr').find( "td:eq( 1 )" ).text(qty1);
  var pice = $(element).closest('tr').find("td:eq( 1 )").text();
  // var dis = $(element).closest('tr').find( "td:eq( 2 )" ).text();
  // alert(dis);


  pice1 = parseInt(pice);
  dis1 = parseInt(dis);
  dis1 = dis1 * pice1 / 100;
  var newamount = pice1 - dis1;
  newamount = newamount.toFixed(2);
  $(element).closest('tr').find("td:eq( 4 )").text(newamount);

}

window.onload = function () {
  // $("#txtDateTime").datetimepicker('setDate', new Date());
  fillProductTable();
  calculate_final_total();

  var customer_order_id = $("#cmbOrder").val();
  var deliverer_id = $("#txtDeliverer").val();

  if (customer_order_id && deliverer_id) {
    loadInventories(customer_order_id, deliverer_id);
  }

  getLocation();

};

var geo = document.getElementById("geo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showPosition);
  } else {
    geo.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showHint(str1,str2) {
  if (str1.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "googleapi.php?q=" + str1 + "&&r=" + str2, true);
    xmlhttp.send();
  }
}

function showPosition(position) {
  // geo.innerHTML = "Latitude: " + position.coords.latitude +
  //     "<br>Longitude: " + position.coords.longitude;

  showHint( position.coords.latitude , position.coords.longitude );
}

// $('#txtDateTime').datetimepicker({
//     changeMonth: true,
//     changeYear: true,
//     dateFormat: 'yy-mm-dd',
//     timeFormat: 'HH:mm:ss'
// });

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

$("#cmbProduct").click(function (e) {
  e.preventDefault;
  reloadDelivererInventorys();
});

$("#cmbProduct").change(function (e) {
  e.preventDefault;
  reloadDelivererInventorys();
});

function reloadDelivererInventorys() {
  loadDelivererInventoryPrev();
  var product_id = $("#cmbProduct").val();
  var deliverer_id = $("#inpDelivererId").val();
  fillDelivererInventorys(deliverer_id, product_id);
}

function fillDelivererInventorys(deliverer_id, product_id) {
  $('#cmbDelivererInventory option').remove();
  var trHTML = "";
  trHTML += "<option disabled='' selected='' >Select Batch</option>";
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
          trHTML += "<option value=" + value["id"] + ">" + "Batch:" + value["inventory_id"]["batch_id"]["code"] + " | Qty:" + value["qty"] + "</option>";
        });
      }
    });
  }
  $('#cmbDelivererInventory').append(trHTML);
}

$("#cmbDelivererInventory").change(function (e) {
  e.preventDefault;
  var deliverer_inventory_id = $("#cmbDelivererInventory").val();
  fillInventoryDetails(deliverer_inventory_id);
});

function fillInventoryDetails(deliverer_inventory_id) {
  if (deliverer_inventory_id) {
    $.ajax({
      type: 'POST',
      url: "proccess/invoice_proccess.php",
      data: {inventory_request: true, deliverer_inventory_id: deliverer_inventory_id},
      dataType: 'json',
      async: false,
      success: function (data) {
        avl_qty = data.avl_qty;
        $("#lblAvlQty").text(avl_qty);
        $("#lblMFD").text(data.mfd);
        $("#lblEXP").text(data.exp);
        $("#lblCost").text(data.cost);
        wholesale_price = data.wholesale_price;
        retail_price = data.retail_price;
        $("#lblWholesalePrice").text(wholesale_price);
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
    $("#lblPriceType").text("Retail");
    //            $("#lblBatchRetailPrice").addClass("border");
    //            $("#lblBatchWholesalePrice").removeClass("border");
  } else {
    $("#lblPriceType").text("Whole");
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
  if ($("#chbPriceType").is(':checked')) {
    product_total = ((retail_price - discount) * qty).toFixed(2);
  } else {
    product_total = ((wholesale_price - discount) * qty).toFixed(2);
  }

  $("#txtTotal").val(product_total);
}

function loadDelivererInventoryPrev() {
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
      price = retail_price;
    } else {
      price = wholesale_price;
    }

    $.ajax({
      type: "POST",
      url: "proccess/invoice_proccess.php",
      data: {
        add_product: true,
        deliverer_inventory_id: deliverer_inventory_id,
        price: price,
        qty: qty,
        unit_discount: unit_discount,
        product_total: product_total
      },
      success: function (data) {
        calculate_final_total();
        fillProductTable();
        loadDelivererInventoryPrev();
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
        // var btnRemoveReload = "<button title='Remove and edit' type='button' onclick='removeReload(this)' id='" + value["deliverer_inventory_id"] + "' class='btn btn-primary btn-xs'> <i class='fa fa-close'> </i> <i class='fa fa-edit'></i></button>";
        var btnRemoveReload = "";
        var newvalue = value["price"] - value["unit_discount"];
        trHTML += "<tr id='" + value["deliverer_inventory_id"] + "'><td>" + value["product_id"] + " (" + batch + ")</td><td>" + newvalue.toFixed(2) + "</td><td>" + value["qty"] + "</td><td>" + value["product_total"] + "</td><td>" + value["freeissue"] + "</td><td class='col-sm-2'>" + btnRemove + btnRemoveReload + "</td></tr>";
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
    scrollTop: $(element_id).offset().top
  },
  'slow');
}

function removeReload(element) {
  $.ajax({
    type: "POST",
    url: "proccess/invoice_proccess.php",
    dataType: 'json',
    async: false,
    data: {remove_inventory: true, index: element.id},
    success: function (data) {
      calculate_final_total();
      fillProductTable();

      $("#cmbProduct").val(data.product_id);
      reloadDelivererInventorys();

      //                $('#cmbDelivererInventory').prop('selectedIndex', element.id);
      //                $('#cmbDelivererInventory').val(element.id);
      $('#cmbDelivererInventory').val(data.deliverer_inventory_id);
      fillInventoryDetails(data.deliverer_inventory_id);

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
      loadDelivererInventoryPrev();
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
  //        var continued_balance = (<?php // echo $total;          ?>).toFixed(2);
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
      final_discount += parseInt(element_value);
    } else {
      element.css({"border": "1px solid red"});
    }
  }
  final_discount = (gross_amount * final_discount) / 100;
  $("#txtGrossTotal").val(gross_amount.toFixed(2));
  net_amount = (gross_amount - final_discount);
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
      loadDelivererInventoryPrev();
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

  // element = $("#txtDateTime");
  // element_value = element.val();
  // if (element_value && (new RegExp("^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[1-9]|1[0-9]|2[0-4]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]):(0[0-9]|1[0-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9])$").test(element_value))) {
  //     element.css({"border": "1px solid #ccc"});
  // } else {
  //     errors.push("DateTime - Not Selected");
  //     element.css({"border": "1px solid red"});
  // }

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

  //        var balance = (<?php // echo $total;         ?>).toFixed(2);
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

$("#btnAddAll").click(function (e) {
  e.preventDefault;

  // alert('test');
  // alert(document.getElementById("table1").rows[0].cells[0].innerHTML);

  // var table = $("#allproductdata");
  var catcount = <?php echo $catcount; ?>;
  var step = 1;
  var step1 = 0;
  while (step <= catcount) {
    var tables = '#table' + step
    var tables1 = 'table' + step
    var count = $(tables + ' tr').length;
    var rowcount = 0;
    var rowcount1 = 1;
    // alert(count);
    while (rowcount < count) {
      if (rowcount != 0) {

        var ref = tables1 + "row" + rowcount1;
        var ref2 = tables1 + "row" + rowcount1 + "del";
        var ref3 = tables1 + "row" + rowcount1 + "dis";
        var ref4 = tables1 + "row" + rowcount1 + "disptg";
        var ref5 = tables1 + "row" + rowcount1 + "freeissue";
        // alert(ref);
        var columnvalue1 = document.getElementById(ref).value;
        var columnvalue2 = document.getElementById(ref2).value;
        var columnvalue4 = document.getElementById(ref3).value;
        var columnvalue5 = document.getElementById(ref4).value;
        var columnvalue6 = document.getElementById(ref5).value;

        // alert(columnvalue6);


        // alert(document.getElementById(tables1).rows[rowcount1].cells[1].innerHTML);
        var columnvalue3 = document.getElementById(tables1).rows[rowcount1].cells[1].innerHTML;

        if (columnvalue5 > 0) {
          columnvalue4 = (100 - columnvalue5) * columnvalue3 / 100;
          columnvalue4 = columnvalue3 - columnvalue4;
        }
        // alert(columnvalue4);

        // alert(columnvalue);
        if (columnvalue1 > 0 || columnvalue6 > 0) {
          addProductNew(columnvalue2, columnvalue1, columnvalue3, columnvalue4, columnvalue6);
        }


        rowcount1 = rowcount1 + 1;
      }
      ++rowcount;
    }
    ++step;
    ++step1;
  }


});

function addProductNew(deliverer_inventory_id, qty, retail_price, discount, freeissue) {

  // alert(freeissue);
  // var deliverer_inventory_id = $("#cmbDelivererInventory").val();
  // var qty = $("#qty").val();
  var temp_unit_discount = discount;
  var unit_discount = (temp_unit_discount != "") ? temp_unit_discount : 0;
  var price;
  if ($("#chbPriceType").is(':checked')) {
    price = retail_price;
  } else {
    price = wholesale_price;
  }
  price = retail_price;

  $.ajax({
    type: "POST",
    url: "proccess/invoice_proccess.php",
    data: {
      add_product: true,
      deliverer_inventory_id: deliverer_inventory_id,
      price: price,
      qty: qty,
      unit_discount: unit_discount,
      product_total: product_total,
      freeissue: freeissue
    },
    success: function (data) {
      calculate_final_total();
      fillProductTable();
      loadDelivererInventoryPrev();
      // new PNotify({
      //   title: 'Success',
      //   text: 'Product added to the table!',
      //   type: 'success',
      //   styling: 'bootstrap3'
      // });
    }
  });

}

</script>

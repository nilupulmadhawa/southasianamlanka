<?php
require_once './../util/initialize.php';
require_once './../util/validate_login.php';
include 'common/upper_content.php';

unset($_SESSION["po_products"]);



if (isset($_POST["id"]) && $purchase_order = PurchaseOrder::find_by_id($_POST["id"])) {
    if ($purchase_order->purchase_order_type_id == 1 && ($po_products = PurchaseOrderProduct::find_all_by_purchase_order_id($purchase_order->id))) {
        $temp_po_products = array();
        foreach ($po_products as $po_product) {
            $temp_po_product = array();
            $temp_po_product["product_id"] = $po_product->product_id;
            $temp_po_product["qty"] = $po_product->qty;
            $temp_po_product["dollar_rate"] = 0;
            $temp_po_products[] = $temp_po_product;
        }

        // $_SESSION["po_products"] = $temp_po_products;
    }
} else {
    $purchase_order = new PurchaseOrder();

    $object = Inventory::find_all_zero();
    $_SESSION["po_products"] = array();
    $po_product = array();
    foreach ($object as $data) {
        $po_product["product_id"] = $data->product_id;

        $roq = 0;
        if($data->product_id()->roq == NULL){
           $roq = 0;
        }else{
            $roq = $data->product_id()->roq;
        }

        $po_product["qty"] = $roq;
        $po_product["dollar_rate"] = 0;
        // $_SESSION["po_products"][] = $po_product;

    }

}
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Purchase Order (Products)</h3>
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
                        <h2 id="title"><?php echo (empty($product->id)) ? 'Add' : 'Edit'; ?> Purchase Order</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="x_content">
                            <form id="formPO" action="proccess/product_purchase_order_proccess.php" method="post" class="form-horizontal form-label-left" >
                                <input type="hidden" id="id" name="id" value="<?php echo $purchase_order->id; ?>">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" id="code" name="code" value="<?php
                                    if (empty($purchase_order)) {
                                        echo $purchase_order->code;
                                        } else {
                                            echo PurchaseOrder::getNextCode();
                                        }
                                        ?>" readonly="" required="" class="form-control col-md-7 col-xs-12">
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select class="form-control" id="cmbSupplier" name="supplier_id" required="">
                                                <option disabled="" selected="">Select Supplier</option>
                                                <?php
                                                foreach (Supplier::find_all() as $supplier) {
                                                    if ($supplier->id == $purchase_order->supplier_id) {
                                                        ?>
                                                        <option selected="" value="<?php echo $supplier->id; ?>"><?php echo $supplier->name; ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $supplier->id; ?>"><?php echo $supplier->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Purchase Order Products</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <!-- IMPORT PRODUCT -->
                            <div class="container-fluid divBackTopTable">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Product</label>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="cmbProduct" name="product_id" required="">
                                            <option disabled="" selected="">Select Product</option>
                                            <?php
                                            foreach (Product::find_all() as $product) {
                                                ?>
                                                <option value="<?php echo $product->id; ?>"><?php echo $product->brand; ?> || <?php echo $product->name; ?> || <?php echo $product->description; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" id="qty" name="number" value="1" required="required" min="1" max="5000" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <div class="form-group">
                                        <label>Dollar Rate</label>
                                        <input type="number" id="dollar" name="dollar" value="0" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Action</label>
                                        <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="glyphicon glyphicon-chevron-down"></i> Add</button>
                                    </div>
                                </div>
                            </div>

                            <hr/>

                            <!-- IMPORT BRAND -->
                            <div class="container-fluid divBackTopTable">
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="cmbBrand" name="brand_id" required="">
                                            <option disabled="" selected="">Select Brnad</option>
                                            <?php
                                            foreach(Product::find_all_by_distinct_brand() as $data){
                                              echo "<option value='".$data->brand."'>".$data->brand."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Action</label>
                                        <button id="btnAdd2" type="button" class="btn btn-block btn-primary"><i class="glyphicon glyphicon-chevron-down"></i> Add</button>
                                    </div>
                                </div>

                            </div>

                            <div class="x_content"></div>
                            <div class="x_content">
                                <table id="tblPOP" class="table table-bordered table-responsive customBorder">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Part Number</th>
                                            <th>Brand</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th style="text-align:right;">Unit Price</th>
                                            <th style="text-align:right;">Total USD</th>
                                            <th class="col-sm-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class=" col-md-4 col-sm-4 col-xs-12">
                                    <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                                </div>
                                <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo ($purchase_order->id) ? 'initial' : 'none'; ?>">
                                    <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                                </div>
                                <div class=" col-md-4 col-sm-4 col-xs-12">
                                    <a href="product_purchase_order.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/page content-->

    <?php include 'common/bottom_content.php'; ?>

    <script>
        window.onload = function () {
               // $.alert({
               //     type: 'red',
               //     title: 'Welcome!',
               //     content: 'Mahesh!',
               // });
               fillProductTable();
           };

           function fillProductTable() {
            $('#tblPOP tbody').remove();
            $.ajax({
                type: 'POST',
                url: "proccess/product_purchase_order_proccess.php",
                data: {po_product_request: true},
                dataType: 'json',
                async: false,
                success: function (data) {
                    var trHTML = "";
                    var dollartotal = 0;
                    var costtotal = 0;
                    var qtytotal = 0;
                    $.each(data, function (index, value) {
                        var btnRemove = "<button type='button' onclick='removeProduct(this)' id='" + data[index]["index"] + "'class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>";
                        trHTML += "<tr id='" + data[index]["index"] + "'><td>" + data[index]["category"] + "</td><td>" + data[index]["product_id"] + "</td><td>" + data[index]["brand"] + "</td><td>" + data[index]["description"] + "</td><td>" + data[index]["qty"] + "</td><td style='text-align:right;'>" + data[index]["dollar_rate"] + "</td><td style='text-align:right;'>" + (data[index]["dollar_rate"] * data[index]["qty"]).toFixed(2) + "</td><td>" + btnRemove + "</td></tr>";
                        dollartotal = dollartotal + (data[index]["qty"] * data[index]["dollar_rate"]);
                        qtytotal = parseInt(qtytotal) + parseInt(data[index]["qty"]);
                    });
                    trHTML += "<tr><td colspan='4' style='text-align:right;'>TOTAL QTY: </td><td style='text-align:left;'>"+ qtytotal +"</td><td style='text-align:right;'>TOTAL FOB: </td><td style='text-align:right;'>"+ dollartotal.toFixed(2) +"</td><td></td></tr>";
                    $('#tblPOP').append(trHTML);
                }
            });
        }

        function checkProduct(id) {
            var result;
            $.ajax({
                type: 'POST',
                url: "proccess/product_purchase_order_proccess.php",
                data: {check_product: true, id: id},
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

            element = $("#cmbProduct");
            element_value = element.val();
            if (!element_value) {
                errors.push("Product - Not Selected");
                element.css({"border": "1px solid red"});
            } else {
                if (checkProduct(element_value)) {
                    errors.push("Product - Already added");
                    element.css({"border": "1px solid red"});
                } else {
                    element.css({"border": "1px solid #ccc"});
                }
            }

            element = $("#qty");
            element_value = element.val();
            if (element_value === "") {
                errors.push("Quantity - Invalid");
                element.css({"border": "1px solid red"});
            } else {
                element.css({"border": "1px solid #ccc"});
            }

            return errors;
        }

        function clearProductForm() {
            $('#cmbProduct').prop('selectedIndex', 0);
            $("#qty").val(1);
        }


        $('#btnAdd').click(function (e) {
            e.preventDefault();
            addProduct();
        });

        $('#btnAdd2').click(function (e) {
            e.preventDefault();
            addProduct2();
        });

        function addProduct() {
            var errors = getProductErrors();
            if (errors === undefined || errors.length === 0) {

                var product = $("#cmbProduct").val();
                var qty = $("#qty").val();
                var dollar = $("#dollar").val();

                $.ajax({
                    type: "POST",
                    url: "proccess/product_purchase_order_proccess.php",
                    data: {addProduct: true, product_id: product, qty: qty, dollar:dollar },
                    success: function (data) {
                        fillProductTable();
                        clearProductForm();
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

        function addProduct2() {
            var errors = getProductErrors2();
            if (errors === undefined || errors.length === 0) {

                var brand = $("#cmbBrand").val();

                $.ajax({
                    type: "POST",
                    url: "proccess/product_purchase_order_proccess.php",
                    data: {addProduct2: true, brand: brand },
                    success: function (data) {
                        fillProductTable();
                        clearProductForm();
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

        function getProductErrors2() {
            var errors = new Array();
            var element;
            var element_value;

            return errors;
        }

        function removeProduct(element) {
            $.ajax({
                type: "POST",
                url: "proccess/product_purchase_order_proccess.php",
                data: {remove: true, index: element.id},
                success: function (data) {
                    fillProductTable();
                    new PNotify({
                        title: 'Success',
                        text: 'Product removed from temporary table!',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                }
            });
        }

        function clearPOProducts() {
            $.ajax({
                type: "POST",
                url: "proccess/product_purchase_order_proccess.php",
                data: {clearPOProducts: true},
                success: function (data) {

                }
            });
        }







    ///////////////////////////////////Common
    function sessionCount() {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/product_purchase_order_proccess.php",
            data: {session_count: true},
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

        element = $("#code");
        element_value = element.val();
        if (element_value == "") {
            errors.push("Code - Not valid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#cmbSupplier");
        element_value = element.val();
        if (!element_value) {
            errors.push("Supplier - Not selected");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        var tbl_inventorys=sessionCount();
        element = $("#tblPOP");
        element_value = element.val();
        if (!tbl_inventorys) {
            errors.push("Products - Not selected");
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

    $("#btnSave").click(function () {
        var id = <?php echo ($purchase_order->id) ? 1 : 0; ?>;
        FormOperations.confirmSave(validateForm(), "#formPO", id, null);
    });

    $("#btnDelete").click(function () {
        FormOperations.confirmDelete("#formPO");
    });
</script>

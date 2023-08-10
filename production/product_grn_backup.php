<?php
require_once './../util/initialize.php';

unset($_SESSION["product_grn_products"]);
if (isset($_POST["grn_id"]) && $grn = GRN::find_by_id($_POST["grn_id"])) {
    $validation = TRUE;
    $grn_products = array();
    foreach (GRNProduct::find_all_by_grn_id($grn->id) as $index => $temp_grn_product) {
        $grn_product = $temp_grn_product->to_array();
        $grn_product["batch_id"] = $temp_grn_product->batch_id()->to_array();
        $grn_products[] = $grn_product;
        
        $inventorys = Inventory::find_all_by_grn_product_id($temp_grn_product->id);
        foreach ($inventorys as $inventory) {
            $deliverer_inventory = DelivererInventory::find_all_by_inventory_id($inventory->id);
            if (!empty($deliverer_inventory) && (count($deliverer_inventory) > 0)) {
                $validation = FALSE;
            }
        }
    }

    if ($validation) {
        $_SESSION["product_grn_products"] = $grn_products;
    } else {
        unset($_SESSION["product_grn_products"]);
        $_SESSION["error"] = "Can't edit GRN, Invoices already added to products related to the GRN you tried to edit.";
        Functions::redirect_to("./grn_management.php");
    }
} else {
    $grn = new GRN();
    if (isset($_POST["po_id"]) && $purchase_order = PurchaseOrder::find_by_id($_POST["po_id"])) {
        
    } else {
        $purchase_order = new PurchaseOrder();
//        Functions::redirect_to("./purchase_order_management.php");
    }
}

include './common/upper_content.php';
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Goods Revieved Note (Products)</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php Functions::output_result(); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 id="title"><?php echo (empty($grn->id)) ? 'Add' : 'Edit'; ?> Product GRN</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="formGRN" action="proccess/product_grn_proccess.php" method="post" class="form-horizontal form-label-left" >
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" class="form-control" id="txtGRNId" name="grn_id" value="<?php echo $grn->id; ?>"/>
                                <label>GRN Code</label>
                                <input type="text" id="txtGRNCode" name="grn_code" class="form-control" value="<?php echo (empty($grn->id)) ? GRN::getNextCode() : $grn->code; ?>" required="required" readonly=""/>
                            </div>
                       
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Supplier</label>
                                <select class="form-control" id="cmbSupplier" name="supplier_id" required="">
                                    <option selected="" disabled="" >Select Supplier</option>
                                    <?php
                                    foreach (Supplier::find_all() as $db_supplier) {
                                        if ($grn->supplier_id == $db_supplier->id) {
                                            ?>
                                            <option value="<?php echo $db_supplier->id; ?>"><?php echo $db_supplier->code; ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $db_supplier->id; ?>"><?php echo $db_supplier->code; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>Purchase Order</label>
                                <select class="form-control" id="cmbPO" name="purchase_order_id" required="">
                                    <option selected="" value="0">Continue Without PO</option>
                                    <?php
                                    foreach (PurchaseOrder::find_all_by_purchase_order_type_id(1) as $db_purchase_order) {
                                        if ($purchase_order->id == $db_purchase_order->id) {
                                            ?>
                                            <option value="<?php echo $db_purchase_order->id; ?>"><?php echo $db_purchase_order->code; ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $db_purchase_order->id; ?>"><?php echo $db_purchase_order->code; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>


                                <div id="divPOPrev" class="x_content divBackDarck ">
                                    <div class="container-fluid ">                                    
                                        <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class=" washed" style="display: block;"><small>Code</small></label>
                                            <label id="lblPOCode"></label>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class=" washed" style="display: block;"><small>Date</small></label>
                                            <label id="lblPODate"></label>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class=" washed" style="display: block;"><small>Supplier</small></label>
                                            <label id="lblPOSupplier"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="divProduct">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Select Products</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="divBackTopTable">
                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                                    <input type="hidden" class="form-control" id="txtIndex" name="index" value=""/>
                                    <input type="hidden" class="form-control" id="txtProduct" name="product" value=""/>
                                    <label>Product</label>
                                    <select class="form-control" id="cmbProduct" name="product_id" required="">
                                        <option disabled="" selected="">Select Product</option>
                                        <?php
                                        foreach (Product::find_all() as $product) {
                                            ?>
                                            <option value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Quantity</label>
                                    <input type="number" id="numQty" name="number" value="1" required="required" min="1" max="5000" class="form-control col-md-7 col-xs-12">
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                                    <label>Batch</label>
                                    <select class="form-control" id="cmbBatch" name="batch_id">
                                        <option selected="" value="0">New Batch</option>
                                        <?php
                                        foreach (Batch::find_all() as $batch) {
                                            $grnp = GRNProduct::find_by_batch_id($batch->id);
                                            ?>
                                            <option value="<?php echo $batch->id; ?>"><?php echo ($grnp) ? $batch->code . "(" . $grnp->product_id()->name . ")" : $batch->code . ""; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 " id="divNewBatch">
                                    <!--<label>Batch Details</label>-->

                                    <div class="container-fluid divBack">
                                        <div class="x_title">
                                            <h2>Batch Details</h2>
                                            <!--<label>Batch Details</label>-->
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12" >
                                            <div class="form-group">
                                                <label>Code</label>
                                                <input type="text" class="form-control" placeholder="Code" id="txtBatchCode" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Manufacure Date</label>
                                                <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtMfd">
                                            </div>
                                            <div class="form-group">
                                                <label>Expire Date</label>
                                                <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtExp">
                                            </div>

                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12" >
                                            <div class="form-group">
                                                <label>Cost Price</label>
                                                <input type="text" class="form-control" placeholder="Cost Price" id="txtCostPrice">
                                            </div>
                                            <div class="form-group">
                                                <label>Retail Price</label>
                                                <input type="text" class="form-control" placeholder="Retail Price" id="txtRetailPrice">
                                            </div>
                                            <div class="form-group">
                                                <label>Whole-Sale Price</label>
                                                <input type="text" class="form-control" placeholder="Wholesale Price" id="txtWholesalePrice">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="modal-footer">
                                <div class=" col-md-6 col-sm-6 col-xs-12">
                                    <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-down"></i> <span id="lblBtnAdd"> Add</span></button>
                                </div>
                                <!--<div class=" col-md-6 col-sm-6 col-xs-12" style="display: <?php // echo (empty($product->id)) ? 'none' : 'initial';          ?>">-->
                                <div class=" col-md-6 col-sm-6 col-xs-12">
                                    <button id="btnClear" type="button" class="btn btn-block btn-primary"><i class="fa fa-close"></i> Clear</button>
                                </div>
                            </div>
                        </div>
                        <br/>

                        <!--                    </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>GRN Products</h2>
                                                <div class="clearfix"></div>
                                            </div>-->

                        <div class="x_content">
                            <table class="table table-responsive table-bordered table-condensed table-striped table-responsive customBorder" id="tblGRNP">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Batch</th>
                                        <th class="col-sm-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <div class="clearfix"></div>
                        <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                            </div>
<!--                            <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($grn->id)) ? 'none' : 'initial'; ?>">
                                <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                            </div>-->
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <a href="product_grn.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?php include './common/bottom_content.php'; ?><!-- bottom content -->
<script>
    window.onload = function () {
        loadForm();
    };

    function loadForm() {
        var po_id = $("#cmbPO").val();
        fillPOPrev(po_id);
//        fillProductTable();
        loadProductTable(po_id);
        loadBatchForm();

    }

    $("#btnClear").click(function () {
        loadProductForm();
    });

    $(function () {
        $("#txtMfd").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });

    $(function () {
        $("#txtExp").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });

    $("#cmbProduct").change(function (e) {
        e.preventDefault;
        var product_id = $("#cmbProduct").val();
        fillBatches(product_id);
    });

    function fillBatches(product_id) {
        if (product_id) {
            $('#cmbBatch').empty();
            loadBatchForm();
            $.ajax({
                type: 'POST',
                url: "proccess/product_grn_proccess.php",
                data: {batches_request: true, product_id: product_id},
                dataType: 'json',
                async: false,
                success: function (data) {
                    var generatedHTML = "";
                    generatedHTML += "<option selected='' value='0'>New Batch</option>";
                    $.each(data, function (index, value) {
                        generatedHTML += "<option value='" + value["id"] + "'>" + value["code"] + " (" + value["product"] + ")</option>";
                    });
                    $('#cmbBatch').append(generatedHTML);
                }
            });
        }
    }

    $("#cmbPO").change(function (e) {
        e.preventDefault;
        var po_id = $("#cmbPO").val();
        fillPOPrev(po_id);
        loadProductTable(po_id);
    });


    function fillPOPrev(po_id) {
        if (po_id == 0) {
            $("#divPOPrev").css({"display": "none"});
            $("#lblPOCode").text();
            $("#lblPODate").text();
            $("#lblPOSupplier").text();
        } else {
            $.ajax({
                type: 'POST',
                url: "proccess/product_grn_proccess.php",
                data: {purchase_order_request: true, purchase_order_id: po_id},
                dataType: 'json',
                async: false,
                success: function (data) {
                    $("#lblPOCode").text(data.code);
                    $("#lblPODate").text(data.date);
                    $("#lblPOSupplier").text(data.supplier_id);
                    $("#divPOPrev").css({"display": "initial"});
                }
            });
        }
    }

    function loadProductTable(po_id) {
        if (po_id!=0) {
            $.ajax({
                type: 'POST',
                url: "proccess/product_grn_proccess.php",
                data: {reload_products: true, purchase_order_id: po_id},
                success: function (data) {
//                        fillProductTable();
                }
            });
        }
        fillProductTable();
    }

    function fillProductTable() {
        $('#tblGRNP tbody').remove();
        $.ajax({
            type: 'POST',
            url: "proccess/product_grn_proccess.php",
            data: {grn_product_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                var trHTML = "";
                $.each(data, function (index, value) {
                    var btnEdit2 = "<button type='button' onclick='editProduct(this)' id='" + data[index]["index"] + "' class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-edit'></i> Assign Batch</button>";

                    var batch = (data[index]["batch_id"]["code"]) ? data[index]["batch_id"]["code"] : btnEdit2;

                    var btnEdit = "<button type='button' onclick='editProduct(this)' id='" + data[index]["index"] + "' class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-edit'></i> Edit</button>";
                    var btnClose = "<button type='button' onclick='removeProduct(this)' id='" + data[index]["index"] + "' class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>";

                    trHTML += "<tr id='" + data[index]["index"] + "'><td>" + data[index]["product"] + "</td><td>" + data[index]["qty"] + "</td><td>" + batch + "</td><td class='col-sm-2'>" + btnEdit + btnClose + "</td></tr>";
                });
                $('#tblGRNP').append(trHTML);
            }
        });
    }

    $("#cmbBatch").change(function () {
        var batch_id = $("#cmbBatch").val();
        if (batch_id === "0" || batch_id === "" || !batch_id) {
            loadBatchForm();
        } else {
            fillBatchForm(batch_id);
        }
    });

    function fillBatchForm(batch_id) {
        disableBatchForm(true);
        $.ajax({
            type: 'POST',
            url: "proccess/product_grn_proccess.php",
            data: {batch_request: true, batch_id: batch_id},
            dataType: 'json',
            async: false,
            success: function (data) {
                $("#txtBatchCode").val(data.code);
                $("#txtMfd").val(data.mfd);
                $("#txtExp").val(data.exp);
                $("#txtCostPrice").val(data.cost);
                $("#txtRetailPrice").val(data.retail_price);
                $("#txtWholesalePrice").val(data.wholesale_price);
            }
        });
    }

    function getBatchCode() {
        var code;
        $.ajax({
            type: 'POST',
            url: "proccess/product_grn_proccess.php",
            data: {batch_code_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                //                $("#txtBatchCode").val(data);
                code = data;
            }
        });
        return code;
    }

    function loadBatchForm() {
        disableBatchForm(false);
        $("#txtBatchCode").val(getBatchCode());
        $("#txtMfd").val(null);
        $("#txtExp").val(null);
        $("#txtCostPrice").val(null);
        $("#txtRetailPrice").val(null);
        $("#txtWholesalePrice").val(null);
    }

    function disableBatchForm(bool) {
        $("#txtMfd").prop("readonly", bool);
        $("#txtExp").prop("readonly", bool);
        $("#txtCostPrice").prop("readonly", bool);
        $("#txtRetailPrice").prop("readonly", bool);
        $("#txtWholesalePrice").prop("readonly", bool);

        $("#txtMfd").datepicker("option", "disabled", bool);
        $("#txtExp").datepicker("option", "disabled", bool);
    }

    function checkProduct(id) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/product_grn_proccess.php",
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
            if ($("#txtProduct").val() == element_value) {
                element.css({"border": "1px solid #ccc"});
            } else {
                if (checkProduct(element_value)) {
                    errors.push("Product - Already added");
                    element.css({"border": "1px solid red"});
                } else {
                    element.css({"border": "1px solid #ccc"});
                }
            }
        }

        element = $("#numQty");
        element_value = element.val();
        if (element_value === "" || !(new RegExp("^[0-9]+$").test(element_value))) {
            errors.push("Quantity - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtBatchCode");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Batch Code - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtMfd");
        element_value = element.val();
        //        if (element_value === "" || !(new RegExp("'/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/'").test(element_value)) ) {
        if (element_value === "") {
            errors.push("Manufacure Date - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtExp");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Expire Date - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtCostPrice");
        element_value = element.val();
        if (element_value === "" || !(new RegExp("^[0-9]+\.[0-9]{0,2}$").test(element_value))) {
            errors.push("Cost Price - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtRetailPrice");
        element_value = element.val();
        if (element_value === "" || !(new RegExp("^[0-9]+\.[0-9]{0,2}$").test(element_value))) {
            errors.push("Retail Price - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtWholesalePrice");
        element_value = element.val();
        if (element_value === "" || !(new RegExp("^[0-9]+\.[0-9]{0,2}$").test(element_value))) {
            errors.push("Whole-Sale Price - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }
        return errors;
    }

    $('#btnAdd').click(function (e) {
        e.preventDefault();
        addProduct();
    });

    function addProduct() {
        var errors = getProductErrors();
        if (errors === undefined || errors.length === 0) {

            var index = $("#txtIndex").val();
            var product_id = $("#cmbProduct").val();
            var qty = $("#numQty").val();
            var batch_id = $("#cmbBatch").val();
            var batch_code = $("#txtBatchCode").val();
            var mfd = $("#txtMfd").val();
            var exp = $("#txtExp").val();
            var cost = $("#txtCostPrice").val();
            var retail_price = $("#txtRetailPrice").val();
            var wholesale_price = $("#txtWholesalePrice").val();
            //
            $.ajax({
                type: "POST",
                url: "proccess/product_grn_proccess.php",
                data: {addGRNProduct: true, index: index, product_id: product_id, qty: qty, batch_id: batch_id, batch_code: batch_code, mfd: mfd, exp: exp, cost: cost, retail_price: retail_price, wholesale_price: wholesale_price},
                success: function (data) {
                    fillProductTable();
                    loadProductForm();
                    new PNotify({
                        title: 'Success',
                        text: 'Product successfully added to the table!',
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

    function removeProduct(element) {
        $.ajax({
            type: "POST",
            url: "proccess/product_grn_proccess.php",
            data: {remove_product: true, index: element.id},
            success: function (data) {
                fillProductTable();
                loadProductForm();
                new PNotify({
                    title: 'Success',
                    text: 'Product successfully removed from table!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function loadProductForm() {
        $("#txtIndex").val(null);
        $("#txtProduct").val(null);
        $('#cmbProduct').prop('selectedIndex', 0);
        $("#numQty").val(1);
        $('#cmbBatch').prop('selectedIndex', 0);

        loadBatchForm();

        $("#lblBtnAdd").text(" Add");
    }

    function editProduct(element) {
        $.ajax({
            type: 'POST',
            url: "proccess/product_grn_proccess.php",
            data: {product_request: true, index: element.id},
            dataType: 'json',
            async: false,
            success: function (data) {
                $("#lblBtnAdd").text(" Add (Update)");

                $("#txtIndex").val(data.index);
                $("#txtProduct").val(data.product_id);
                
                $('#cmbProduct').prop('selectedIndex', data.product_id);
                fillBatches(data.product_id);
                $("#numQty").val(data.qty);
                
                if (data.batch_id["id"]) {
                    disableBatchForm(true);
//                    $('#cmbBatch').prop('selectedIndex', data.batch_id["id"]);
                    $("#cmbBatch").val(data.batch_id["id"]);
                    $("#txtBatchCode").val(data.batch_id["code"]);
                } else {
//                    $('#cmbBatch').prop('selectedIndex', 0);
                    $("#cmbBatch").val(0);
                    loadBatchForm();
                    if (data.batch_id["code"]) {
                        $("#txtBatchCode").val(data.batch_id["code"]);
                    }

                }

                $("#txtMfd").val(data.batch_id["mfd"]);
                $("#txtExp").val(data.batch_id["exp"]);
                $("#txtCostPrice").val(data.batch_id["cost"]);
                $("#txtRetailPrice").val(data.batch_id["retail_price"]);
                $("#txtWholesalePrice").val(data.batch_id["wholesale_price"]);

                scrollTo("#divProduct");
            }
        });
//            $("#txtCode").val("asasasasasas");
    }

    function scrollTo(element_id) {
        $('html,body').animate({
            scrollTop: $(element_id).offset().top},
                'slow');
    }


////////////////////////////////////////////////////////////////////////////////
    function sessionCount() {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/product_grn_proccess.php",
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
        
        
        element = $("#cmbSupplier");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Supplier - Not Selected");
            element.css({"border": "1px solid red"});
        }

        var tbl_grnp = sessionCount();
        element = $("#tblGRNP");
        element_value = element.val();
        if (!tbl_grnp) {
            errors.push("Products - Not selected");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#tblGRNP");
        $.ajax({
            type: 'POST',
            url: "proccess/product_grn_proccess.php",
            data: {product_errors: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                if (data) {
                    element.css({"border": "1px solid red"});
                    var temp_errors = new Array();
                    $.each(data, function (index, value) {
                        temp_errors.push(value);
                    });
                    errors.push("Batch is invalid: " + temp_errors.join(", "));
                } else {
                    element.css({"border": "1px solid #ccc"});
                }
            }
        });

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
        var id = <?php echo ($grn->id) ? 1 : 0; ?>;
        FormOperations.confirmSave(validateForm(), "#formGRN", id, null);
    });

    $("#btnDelete").click(function () {
        FormOperations.confirmDelete("#formGRN");
    });

</script>
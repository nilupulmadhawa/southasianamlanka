<?php
require_once './../util/initialize.php';

unset($_SESSION["grn_materials"]);

if (isset($_POST["grn_id"]) && $grn = GRN::find_by_id($_POST["grn_id"])) {
    $validation = TRUE;
    if ($grn_products = GRNProduct::find_all_by_grn_id($grn->id)) {
        foreach ($grn_products as $index => $temp_grn_product) {
            $grn_product_qty = $temp_grn_product->qty;
            $inventory_qty = Inventory::find_all_by_grn_product_id($temp_grn_product->id)->qty;
            if ($grn_product_qty != $inventory_qty) {
                $validation = FALSE;
            }
        }
    }

    if ($validation) {
        $purchase_order = $grn->purchase_order_id();
        $grn_products = array();
        if ($db_grn_products = GRNProduct::find_all_by_grn_id($grn->id)) {
            foreach ($db_grn_products as $index => $temp_grn_product) {
                $grn_product = $temp_grn_product->to_array();
                $grn_product["batch_id"] = $temp_grn_product->batch_id()->to_array();
                $grn_products[] = $grn_product;
            }
        }
        $_SESSION["grn_products"] = $grn_products;
    } else {
        $_SESSION["error"] = "Can't edit GRN, Invoices already added to products related to the GRN you tried to edit.";
        Functions::redirect_to("./grn_management.php");
    }
    
} else {
    $grn = new GRN();
    if (isset($_POST["po_id"]) && $purchase_order = PurchaseOrder::find_by_id($_POST["po_id"])) {
        // :)
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
                <h3>Goods Revieved Note</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 id="title"><?php echo (empty($grn->id)) ? 'Add' : 'Edit'; ?>MMMMMMM GRN</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <form id="formGRN" action="proccess/grn_proccess.php" method="post" class="form-horizontal form-label-left" >
                                <input type="hidden" class="form-control" id="txtPOId" name="po_id" value="<?php echo $purchase_order->id; ?>"/>
                                <input type="hidden" class="form-control" id="txtGRNId" name="grn_id" value="<?php echo $grn->id; ?>"/>

                                <label>GRN Code</label>
                                <input type="text" id="txtGRNCode" name="grn_code" class="form-control" value="<?php echo (empty($grn->id)) ? GRN::getNextCode() : $grn->code; ?>" required="required" readonly=""/>
                            </form>
                        </div>
                    </div>

                    <!--<div class="x_panel">-->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_title">
                            <h2>Purchase Order Details</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Code : <?php echo $purchase_order->code ?></label>
                            </div>
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Date : <?php echo $purchase_order->date ?></label>
                            </div>
                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Supplier : <?php echo $purchase_order->supplier_id()->name ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="divProduct">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Product</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="x_content">
                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                                    <input type="hidden" class="form-control" id="txtIndex" name="index" value=""/>
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
                                    <label>Batch Details</label>
                                    <div class="container-fluid divBack">
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
                                <div class=" col-md-6 col-sm-6 col-xs-12" style="display: <?php echo (empty($product->id)) ? 'none' : 'initial'; ?>">
                                    <button id="btnClear" type="button" class="btn btn-block btn-default"><i class="fa fa-close"></i> Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>GRN Products</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-bordered table-responsive" id="tblGRNP">
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
                        <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($grn->id)) ? 'none' : 'initial'; ?>">
                            <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                        </div>
                        <div class=" col-md-4 col-sm-4 col-xs-12">
                            <a href="grn.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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

//    $("#cmbPO").change(function () {
//        loadForm();
//    });

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

    function loadForm() {
//        var po_id = $("#cmbPO").val();

        var grn_id = "<?php echo $grn->id; ?>";
        if (grn_id) {
            fillProductTable();
        } else {
            var po_id = "<?php echo $purchase_order->id; ?>";
            loadProductTable(po_id);
        }

        loadBatchForm();
    }

    function loadProductTable(po_id) {
        if (po_id) {
            $.ajax({
                type: 'POST',
                url: "proccess/grn_proccess.php",
                data: {reload_products: true, purchase_order_id: po_id},
                success: function (data) {
                    fillProductTable();
                }
            });
        }
    }

    function fillProductTable() {
        $('#tblGRNP tbody').remove();
        $.ajax({
            type: 'POST',
            url: "proccess/grn_proccess.php",
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
            url: "proccess/grn_proccess.php",
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
            url: "proccess/grn_proccess.php",
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
//            if(checkProduct(element_value)){
//                errors.push("Product - Already added");
//                element.css({"border": "1px solid red"});
//            }else{
//                element.css({"border": "1px solid #ccc"});
//            }
            element.css({"border": "1px solid #ccc"});
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
                url: "proccess/grn_proccess.php",
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
            url: "proccess/grn_proccess.php",
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
        $('#cmbProduct').prop('selectedIndex', 0);
        $("#numQty").val(1);
        $('#cmbBatch').prop('selectedIndex', 0);

        loadBatchForm();

        $("#lblBtnAdd").text(" Add");
    }

    function editProduct(element) {
        $.ajax({
            type: 'POST',
            url: "proccess/grn_proccess.php",
            data: {product_request: true, index: element.id},
            dataType: 'json',
            async: false,
            success: function (data) {
                $("#lblBtnAdd").text(" Add (Update)");

                $("#txtIndex").val(data.index);
                $('#cmbProduct').prop('selectedIndex', data.product_id);
                $("#numQty").val(data.qty);

                if (data.batch_id["id"]) {
                    disableBatchForm(true);
                    $('#cmbBatch').prop('selectedIndex', data.batch_id["id"]);
                    $("#txtBatchCode").val(data.batch_id["code"]);
                } else {
                    $('#cmbBatch').prop('selectedIndex', 0);
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

                scrollTo("divProduct");
            }
        });
        $("#txtCode").val("fuck you2");
    }

    function scrollTo(element_id) {
        $('html,body').animate({
            scrollTop: $("#" + element_id).offset().top},
                'slow');
    }


//////////////////////////////////////////////
    function getErrors() {
        var errors = new Array();
        var element;
        var element_value;



//        element = $("#cmbPO");
//        element_value = element.val();
//        if (!element_value) {
//            errors.push("Purchase Order - Not selected");
//            element.css({"border": "1px solid red"});
//        } else {
//            element.css({"border": "1px solid #ccc"});
//        }

        var po_id = "<?php echo $purchase_order->id; ?>";
        if (!po_id) {
            errors.push("Purchase Order - Not selected");
        }

        element = $("#tblGRNP");
        $.ajax({
            type: 'POST',
            url: "proccess/grn_proccess.php",
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
                    errors.push("Batch Errors in - " + temp_errors.join(", "));
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
        confirmSave();
    });

    $("#btnDelete").click(function () {
        confirmDelete();
    });


    function confirmSave() {
        if (validateForm()) {
            var grn_id = <?php echo ($grn->id) ? 1 : 0; ?>;

            if (grn_id) {
                $.confirm({
                    icon: 'fa fa-question-circle',
                    type: 'green',
                    title: 'Save(Update)',
                    content: 'Are you sure you want to proceed ?',
                    buttons: {
                        yes: {
                            text: 'Yes',
                            btnClass: 'btn-green',
                            keys: ['enter'],
                            action: function () {
                                $("#formGRN").append($('<input />').attr('type', 'hidden').attr('name', "update").attr('value', "true"));
                                $("#formGRN").submit();
                            }
                        },
                        cancel: function () {
                        }
                    }
                });
            } else {
                $.confirm({
                    icon: 'fa fa-question-circle',
                    type: 'green',
                    title: 'Save',
                    content: 'Are you sure you want to proceed ?',
                    buttons: {
                        yes: {
                            text: 'Yes',
                            btnClass: 'btn-green',
                            keys: ['enter'],
                            action: function () {
                                $("#formGRN").append($('<input />').attr('type', 'hidden').attr('name', "save").attr('value', "true"));
                                $("#formGRN").submit();
                            }
                        },
                        cancel: function () {
                        }
                    }
                });
            }
        }
    }

    function confirmDelete() {
        $.confirm({
            icon: 'fa fa-warning',
            type: 'orange',
            title: 'Delete',
            content: 'Are you sure you want to proceed ?',
            buttons: {
                yes: {
                    text: 'Yes',
                    btnClass: 'btn-orange',
                    keys: ['enter'],
                    action: function () {
                        $("#formGRN").append($('<input />').attr('type', 'hidden').attr('name', "delete").attr('value', "true"));
                        $("#formGRN").submit();
                    }
                },
                cancel: function () {
                }
            }
        });
    }
///////////////////////////////////////////////

</script>
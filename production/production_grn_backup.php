<?php
require_once './../util/initialize.php';


if (isset($_POST["production_id"]) && $production = Production::find_by_id($_POST["production_id"])) {
    
} else {
    Functions::redirect_to("production_management.php");
}

include './common/upper_content.php';
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Goods Revieved Note (Production)</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php Functions::output_result(); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 id="title">Production: <span style="color: red"> <?php echo $production->code . " (" . $production->date . ")" ?> </span> </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="form" action="proccess/production_grn_proccess.php" method="post" class="form-horizontal form-label-left" >
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" class="form-control" id="txtProductionId" name="production_id" value="<?php echo $production->id; ?>"/>
                            </div>

                            <div class="form-group col-md-8 col-sm-8 col-xs-12 ">
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

                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                <label>Quantity</label>
                                <input type="number" id="numQty" name="number" required="required" min="1" max="5000" class="form-control col-md-7 col-xs-12">
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
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



                            <br/>
                            <div class="clearfix"></div>
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="container-fluid divBackTopTable">
                                    <div class="x_title">
                                        <h2>Batch Details</h2>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12" >
                                        <div class="form-group">
                                            <label>Code</label>
                                            <input type="text" class="form-control" placeholder="Code" id="txtBatchCode" name="b_code" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Manufacure Date</label>
                                            <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtMfd" name="b_mfd">
                                        </div>
                                        <div class="form-group">
                                            <label>Expire Date</label>
                                            <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtExp" name="b_exp">
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12" >
                                        <div class="form-group">
                                            <label>Cost Price</label>
                                            <input type="text" class="form-control" placeholder="Cost Price" id="txtCostPrice" name="b_cost">
                                        </div>
                                        <div class="form-group">
                                            <label>Retail Price</label>
                                            <input type="text" class="form-control" placeholder="Retail Price" id="txtRetailPrice" name="b_retail_price">
                                        </div>
                                        <div class="form-group">
                                            <label>Whole-Sale Price</label>
                                            <input type="text" class="form-control" placeholder="Wholesale Price" id="txtWholesalePrice" name="b_wholesale_price">
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
                    <div class="x_content">
                        <div class="clearfix"></div>
                        <div class=" col-md-4 col-sm-4 col-xs-12">
                            <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                        </div>
<!--                            <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($grn->id)) ? 'none' : 'initial'; ?>">
                            <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                        </div>-->
                        <div class=" col-md-4 col-sm-4 col-xs-12">
                            <a href="production_grn.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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
                url: "proccess/production_grn_proccess.php",
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
            url: "proccess/production_grn_proccess.php",
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
            url: "proccess/production_grn_proccess.php",
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

    function loadProductForm() {
        $('#cmbProduct').prop('selectedIndex', 0);
        $("#numQty").val(null);
        $('#cmbBatch').prop('selectedIndex', 0);
        loadBatchForm();
    }

////////////////////////////////////////////////////////////////////////////////

    function getErrors() {
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
                element.css({"border": "1px solid #ccc"});
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
//        var id = <?php // echo ($production->id) ? 1 : 0;  ?>;
//        FormOperations.confirmSave(validateForm(), "#form", id, null);
        var arr = {"save": true};
        FormOperations.submitForm(validateForm(), "#form", arr);
    });

    $("#btnDelete").click(function () {
        FormOperations.confirmDelete("#form");
    });

</script>
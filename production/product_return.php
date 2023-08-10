<?php
require_once './../util/validate_login.php';
require_once './../util/initialize.php';
include 'common/upper_content.php';

//unset($_SESSION["invoice_return"]);
unset($_SESSION["product_return_batches"]);
unset($_SESSION["product_return"]);
unset($_SESSION["invoice"]);
$product_return = new ProductReturn();


if (isset($_POST["deliverer_id"])) {
    $deliverer = Deliverer::find_by_id($_POST["deliverer_id"]);
} else {
    Functions::redirect_to("invoice_return_by_deliverer.php");
}
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Product Return</h3>
            </div>
            <div class="title_right">
            </div>
        </div>

        <div class="clearfix"></div>

        <?php Functions::output_result(); ?>

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
                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                <div class="form-group">
                                    <label class="x_title washed" style="display: block;">Product</label>
                                    <label id="lblBatchProductPrev"></label>
                                </div>
                            </div>
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
                    <div class="x_title">
                        <h2>Return Details</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="form" action="proccess/product_return_proccess.php" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" >
                            <!--<h2>Invoice Products</h2>-->

                            <div class="form-group">
                                <label>Return Invoice Number: </label>
                                <textarea class="form-control" id="txtReturnInvoice" name="return_invoice" placeholder="Add Note" ></textarea>
                            </div>

                            <div class="form-group">
                                <label>Deliverer</label>
                                <input type="hidden" id="txtDeliverer" class="form-control" name="deliverer_id" value="<?php echo $deliverer->id ?>" />
                                <input type="text" class="form-control" value="<?php echo $deliverer->name . " (" . $deliverer->number . ")" ?>" required="required" readonly=""/>
                            </div>
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="cmbCustomer" name="customer_id">
                                    <option selected="" disabled="">Select Customer</option>
                                    <?php
                                    foreach (Customer::find_all() as $customer) {
                                        ?>
                                        <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                <label>Invoice</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="cmbInvoice" name="invoice_id">
                                        <option selected="" disabled="" >Select Invoice</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary" onclick="myFunctioninvoice()">View Invoice</button>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" id="txtNote" name="note" placeholder="Add Note" ><?php echo $product_return->note; ?></textarea>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Returning Batches (Products)</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="container-fluid divBackTopTable ">
                            <div class="form-group col-md-10 col-sm-10 col-xs-10 ">
                                <label>Batch (Product)</label>
                                <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="cmbBatch" name="batch_id">
                                    <option selected="" disabled="">Select Batch</option>
                                    <?php
                                    foreach (Batch::find_all_by_name_asc() as $batch) {
                                        ?>
                                        <option value="<?php echo $batch->id; ?>"><?php echo $batch->code . " | " . $batch->product_id()->brand . " | " . $batch->product_id()->name . " | " . $batch->product_id()->description  . ""; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2 col-sm-2 col-xs-2 ">
                                <label>Batch</label>
                                <button id="btnViewBatch" type="button" class=" form-control btn btn-primary"><i class="fa fa-eye"></i> View</button>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-6 ">
                                <label>Return Reason</label>
                                <select class="form-control" id="cmbReturnReason" name="return_reason_id">
                                    <option selected="" disabled="" >Select Reason</option>
                                    <?php
                                    foreach (ReturnReason::find_all() as $return_reason) {
                                        ?>
                                        <option value="<?php echo $return_reason->id; ?>"><?php echo $return_reason->name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-3 col-sm-3 col-xs-6">
                                <label>Returning Price</label>
                                <input type="text" id="txtReturningPrice" class="form-control" placeholder="Returning Price">
                            </div>

                            <div class="form-group col-md-3 col-sm-3 col-xs-6">
                                <label>Quantity</label>
                                <input type="number" id="numQty" min="1" max="5000" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="modal-footer">
                                <div class=" col-md-6 col-sm-6 col-xs-12">
                                    <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-down"></i> Add</button>
                                </div>
                                <div class=" col-md-6 col-sm-6 col-xs-12">
                                    <button id="btnClear" type="button" class="btn btn-block btn-primary"><i class="fa fa-close"></i> Clear</button>
                                </div>

                            </div>


                        </div>

                        <div class="x_content"></div>
                        <!--<div class="x_content">-->
                        <div>
                            <table id="tbl" class="table table-bordered table-condensed table-striped table-responsive customBorder">
                                <thead>
                                    <tr>
                                        <th >Batch</th>
                                        <th class="col-md-3 col-sm-3 col-xs-3">Product</th>
                                        <th class="col-md-2 col-sm-2 col-xs-2">Reason</th>
                                        <th >Return Unit Price</th>
                                        <th >Returning Qty</th>
                                        <th >Line Total</th>
                                        <th class="col-md-1 col-sm-1 col-xs-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div id="divNotification">

                            </div>
                        </div>

                        <!--</div>-->
                        <div class="modal-footer">
                            <div class="form-group">
                                <h4>Total(Rs.): <span id="lblTotal"></span></h4> 
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content" style="text-align: right;">
                        <!-- <button id="btnSave1" type="button" class="btn btn-warning">Next Without Invoice <i class="fa fa-chevron-circle-right"></i></button> -->
                        <button id="btnSave" type="button" class="btn btn-success">Next <i class="fa fa-chevron-circle-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/page content--> 

<?php include 'common/bottom_content.php'; ?>

<script>

    function myFunctioninvoice() {
        // cmbInvoice
        var datahref = document.getElementById("cmbInvoice").value;
        // alert(datahref);
        var loca = 'invoice_prev.php?invoice_id='+ datahref;
      window.open(loca,'_blank');
    }

    window.onload = function () {
        loadForm();
    };

    function loadForm() {
        fillTable();
    }

    $("#cmbCustomer").change(function () {
        var customer_id = $("#cmbCustomer").val();
        if (customer_id) {
            load_invoices(customer_id);
        }
    });

    function load_invoices(customer_id) {
        $('#cmbInvoice option').remove();
        var trHTML = "";
        trHTML += "<option disabled='' selected='' >Select Invoice</option>";
        if (customer_id) {
            $.ajax({
                type: 'POST',
                url: "proccess/product_return_proccess.php",
                data: {cusomer_invoice_request: true, customer_id: customer_id},
                dataType: 'json',
                async: false,
                success: function (data) {
                    $.each(data, function (index, value) {
                        trHTML += "<option value='" + value["id"] + "'> " + value["code"] + " (Inv. No.) | " + value["date_time"] + value["customer_id"] + " | Total:" + value["net_amount"] + " | Balance:" + value["balance"] + "</option>";
                    });
                },
                error: function (xhr) {
                    $.alert(xhr.responseText);
                }
            });
        }
        $('#cmbInvoice').append(trHTML);
    }

    $("#btnViewBatch").click(function () {
        var batch_id = $("#cmbBatch").val();
        if (batch_id) {
            showBatch(batch_id);
        }
    });

    function showBatch(element) {
        showBatch(element.id);
    }

    function showBatch(batch_id) {
        var batch = getBatch(batch_id);
        $("#lblBatchProductPrev").text(batch.product_id["name"]);
        $("#lblBatchCodePrev").text(batch.code);
        $("#lblBatchMFD").text(batch.mfd);
        $("#lblBatchEXP").text(batch.exp);
        $("#lblBatchCost").text(batch.cost);
        $("#lblBatchRetailPrice").text(batch.retail_price);
        $("#lblBatchWholesalePrice").text(batch.wholesale_price);
        $('#mdlBatch').modal('show');
    }

    function getBatch(batch_id) {
        var batch;
        $.ajax({
            type: 'POST',
            url: "proccess/product_return_proccess.php",
            data: {batch_request: true, batch_id: batch_id},
            dataType: 'json',
            async: false,
            success: function (data) {
                batch = data;
            }
        });
        return batch;
    }

//    $("#cmbBatch").change(function () {
//        var batch=getBatch(batch_id);
//        $("#txtReturningPrice").val(batch.mfd);
//    });

    function getBatchErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#cmbBatch");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Batch - Not Selected");
            element.css({"border": "1px solid red"});
        }

        element = $("#cmbReturnReason");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Return Reason - Not Selected");
            element.css({"border": "1px solid red"});
        }

        element = $("#txtReturningPrice");
        element_value = element.val();
        if (element_value !== "" && Validation.validatePrice(element_value)) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Return Price - Invalid");
            element.css({"border": "1px solid red"});
        }

        // element = $("#numQty");
        // element_value = element.val();
        // if (element_value !== "" && Validation.validateOnlyNumber(element_value)) {
        //     element.css({"border": "1px solid #ccc"});
        // } else {
        //     errors.push("Quantity - Invalid");
        //     element.css({"border": "1px solid red"});
        // }
        return errors;
    }


    function validateBatchForm() {
        var errors = getBatchErrors();
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




    $("#cmbReturnReason").change(function () {
        var cmbReturnReason = $("#cmbReturnReason");
        setReasonColor(cmbReturnReason.val());
    });

    function setReasonColor(reason_id) {
        var cmbReturnReason = $("#cmbReturnReason");
        if (reason_id) {
            if (reason_id == 1) {
                cmbReturnReason.css({"background": "#ccffcc"});
            } else if (reason_id == 2) {
                cmbReturnReason.css({"background": "#ccffcc"});
            } else if (reason_id == 3) {
                cmbReturnReason.css({"background": "#ffcccc"});
            } else if (reason_id == 4) {
                cmbReturnReason.css({"background": "#ffcccc"});
            }
        } else {
            cmbReturnReason.css({"background": "#fff"});
        }
    }

    $("#btnClear").click(function () {
        loadProductForm();
    });

    function loadProductForm() {
        $('#cmbBatch').prop('selectedIndex', false);
        $("#cmbReturnReason").prop("selectedIndex", false);
        setReasonColor();
        $("#numQty").val(null);
        $("#txtReturningPrice").val(null);
    }


    $("#btnAdd").click(function () {
        addBatch();
    });

    function addBatch() {
        if (validateBatchForm()) {
            var batch_id = $('#cmbBatch').val();
            var return_reason_id = $("#cmbReturnReason").val();
            var qty = $("#numQty").val();
            var unit_price = $("#txtReturningPrice").val();

            $.ajax({
                type: "POST",
                url: "proccess/product_return_proccess.php",
                data: {add_batch: true, batch_id: batch_id, return_reason_id: return_reason_id, qty: qty, unit_price: unit_price},
                success: function (data) {
                    set_final_total();
                    fillTable();
                    loadProductForm();
                    new PNotify({
                        title: 'Success',
                        text: 'Product added to the table!',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                }
            });
        }
    }

    function set_final_total() {
        $("#lblTotal").text(getTotal());
    }

    function getTotal() {
        var total;
        $.ajax({
            type: "POST",
            url: "proccess/product_return_proccess.php",
            data: {total_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                total = data;
            }
        });
        return total;
    }

    function fillTable() {
        $('#tbl tbody').remove();
        var trHTML = "";
        $.ajax({
            type: 'POST',
            url: "proccess/product_return_proccess.php",
            data: {return_batches_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                $.each(data, function (index, value) {
                    var batch = "<a style='cursor:pointer;' id='" + value["batch_id"]["id"] + "' onclick='showBatch(this)' > " + value["batch_id"]["code"] + " </a>";
                    var btnRemove = "<button title='Remove' style='float:left;' type='button' onclick='removeRow(this)' id='" + value["index"] + "' class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>";
                    var btnRemoveReload = "<button title='Remove and edit' type='button' onclick='removeReload(this)' id='" + value["index"] + "' class='btn btn-primary btn-xs'> <i class='fa fa-close'> </i> <i class='fa fa-edit'></i></button>";
                    trHTML += "<tr id='" + value["index"] + "'><td>" + batch + "</td><td>" + value["batch_id"]["product_id"]["name"] + "</td><td>" + value["return_reason_id"] + "</td><td>" + value["unit_price"] + "</td><td>" + value["qty"] + "</td><td>" + value["line_total"] + "</td><td class='col-sm-2'>" + btnRemove + btnRemoveReload + "</td></tr>";
                });
                
                // checkInventoriesQty();
            }

        });
        $('#tbl').append(trHTML);
    }

    function removeRow(element) {
        $.ajax({
            type: "POST",
            url: "proccess/product_return_proccess.php",
            data: {remove_row: true, index: element.id},
            success: function (data) {
                set_final_total();
                fillTable();
                loadProductForm();
                new PNotify({
                    title: 'Success',
                    text: 'Product removed from table!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function removeReload(element) {
        $.ajax({
            type: "POST",
            url: "proccess/product_return_proccess.php",
            data: {remove_reload: true, index: element.id},
            success: function (data) {
                set_final_total();
                fillTable();

                $("#cmbBatch").val(data.batch_id);
                $("#cmbReturnReason").val(data.return_reason_id);
                $("#numQty").val(data.qty);
                $('#txtReturningPrice').val(data.unit_price);
                setReasonColor(data.return_reason_id);
            }
        });
    }

//////////////////////////////////////////////////////////////////////

    function sessionCount() {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/product_return_proccess.php",
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

        element = $("#txtDeliverer");
        element_value = element.val();
        if (element_value !== "") {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Deliverer - Invalid");
            element.css({"border": "1px solid red"});
        }

        element = $("#cmbCustomer");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Customer - Not selected");
            element.css({"border": "1px solid red"});
        }

        element = $("#cmbInvoice");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Invoice - Not selected");
            element.css({"border": "1px solid red"});
        }

        var sess_count = sessionCount();
        element = $("#tbl");
        element_value = element.val();
        if (sess_count && sess_count > 0) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Batches(Products) - Not selected");
            element.css({"border": "1px solid red"});
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
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Return", "ins")) {
            confirmSave();
        }
    });

    function confirmSave() {
        if (validateForm()) {
            $.confirm({
                icon: 'fa fa-question-circle',
                type: 'green',
                title: 'Proceed?',
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
        var deliverer_id = $("#txtDeliverer").val();
        var customer_id = $("#cmbCustomer").val();
        var invoice_id = $("#cmbInvoice").val();
        var note = $("#txtNote").val();
        var return_invoice = $("#txtReturnInvoice").val();
        
        $.ajax({
            type: 'POST',
            url: "proccess/product_return_proccess.php",
            data: {save: true, deliverer_id: deliverer_id, note: note, customer_id:customer_id, invoice_id:invoice_id, return_invoice:return_invoice},
            dataType: 'json',
            async: false,
            success: function (data) {
                if (data) {
//                    $(location).attr('href', 'invoice.php');
                    FormOperations.postForm('invoice.php', {"returning_invoice": true});
                }else{
                    location.reload();
                }
                
            },
            error:function(xhr){
                alert(xhr.responseText);
            }
        });
    }


    // without invoice return
    $("#btnSave1").click(function () {
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Return", "ins")) {
            confirmSave1();
        }
    });

    function confirmSave1() {
        if (validateForm()) {
            $.confirm({
                icon: 'fa fa-question-circle',
                type: 'green',
                title: 'Proceed?',
                content: 'Are you sure you want to proceed ?',
                buttons: {
                    yes: {
                        text: 'Yes',
                        btnClass: 'btn-green',
                        keys: ['enter'],
                        action: function () {
                            submitData1();
                        }
                    },
                    cancel: function () {
                    }
                }
            });
        }
    }

    function submitData1() {
        var deliverer_id = $("#txtDeliverer").val();
        var customer_id = $("#cmbCustomer").val();
        var invoice_id = $("#cmbInvoice").val();
        var note = $("#txtNote").val();
        
        $.ajax({
            type: 'POST',
            url: "proccess/product_return_proccess.php",
            data: {save: true, deliverer_id: deliverer_id, note: note, customer_id:customer_id, invoice_id:invoice_id},
            dataType: 'json',
            async: false,
            success: function (data) {
                if (data) {
//                    $(location).attr('href', 'invoice.php');
                    FormOperations.postForm('invoice_return_final_prev1.php', {"new_invoice": true});
                }else{
                    location.reload();
                }
                
            },
            error:function(xhr){
                alert(xhr.responseText);
            }
        });
    }

</script>
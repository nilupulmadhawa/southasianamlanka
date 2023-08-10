<?php
require_once './../util/validate_login.php';
require_once './../util/initialize.php';
include 'common/upper_content.php';

/////////////////////////////////////////////////////
Functions::redirect_to("index.php");
/////////////////////////////////////////////////////


unset($_SESSION["invoice_return"]);
unset($_SESSION["invoice"]);
$invoice_return = new InvoiceReturn();


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
                <h3>Invoice Return</h3>
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
                        <form id="form" action="proccess/invoice_return_proccess.php" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" >
                            <!--<h2>Invoice Products</h2>-->
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Deliverer</label>
                                <input type="hidden" id="txtDeliverer" class="form-control" name="deliverer_id" value="<?php echo $deliverer->id ?>" />
                                <input type="text" class="form-control" value="<?php echo $deliverer->name . " (" . $deliverer->number . ")" ?>" required="required" readonly=""/>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="container-fluid divBackTopTable ">
                            <div class="form-group col-md-2 col-sm-2 col-xs-12 ">
                                <label>Filter Invoice</label>
                                <div class="ui-widget">
                                    <select class="form-control" id="cmbFilter" name="filter_id" required="">
                                        <option selected="" value="all">All Invoices</option>
                                        <option value="retail">Retail Invoices</option>
                                        <?php
                                        foreach (Customer::find_all() as $customer) {
                                            ?>
                                            <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-10 col-sm-10 col-xs-12 ">
                                <label>Invoice</label>
                                <div class="ui-widget">
                                    <select class="form-control" id="cmbInvoice" name="invoice_id" required="">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="x_content"></div>
                        <!--<div class="x_content">-->
                        <div>
                            <table id="tbl" class="table table-bordered table-condensed table-striped table-responsive customBorder">
                                <thead>
                                    <tr>
                                        <th class="col-md-4 col-sm-4 col-xs-4">Product</th>
                                        <th >Unit Discount</th>
                                        <th >Discounted Unit Price</th>
                                        <th >Quantity / (Return.Qty)</th>
                                        <!--<th >Gross Total</th>-->
                                        <!--<th >Net Total</th>-->
                                        <th class="col-md-2 col-sm-2 col-xs-2">Return Unit Price</th>
                                        <th class="col-md-2 col-sm-2 col-xs-2">Reason</th>
                                        <th class="col-md-2 col-sm-2 col-xs-2">Returning Quantity</th>
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
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" id="txtNote" name="note" placeholder="Add Note" ><?php echo $invoice_return->note; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
<!--                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <button id="btnSave" type="button" name="save" class="btn btn-block btn-success">Next <i class="fa fa-chevron-circle-right"></i></button>
                            </div>
                            <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo ($invoice_return->id) ? 'initial' : 'none'; ?>">
                                <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                            </div>
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <a href="invoice_return.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
                            </div>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
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
    window.onload = function () {
        loadForm();
    };

    function loadForm() {
        loadInvoices("all");
    }

    $("#cmbFilter").change(function () {
        var filter_id = $("#cmbFilter").val();
        loadInvoiceForm();
        loadInvoices(filter_id);
        fillTable();
    });

    function loadInvoiceForm() {
        $('#cmbInvoice').prop('selectedIndex', null);
    }

    function loadInvoices(filter_id) {
        $('#cmbInvoice').empty();
        var trHTML = "";
        trHTML += "<option selected='' disabled='' value=''>Select Invoice</option>";
        $.ajax({
            type: 'POST',
            url: "proccess/invoice_return_proccess.php",
            data: {invoice_request: true, filter_id: filter_id},
            dataType: 'json',
            async: false,
            success: function (data) {
                $.each(data, function (index, value) {
                    trHTML += "<option value='" + value["id"] + "'>" + value["code"] + " :: " + value["date_time"] + value["customer_id"] + " - Total:" + value["net_amount"] + " - Balance:" + value["balance"] + "</option>";
                });
            }
        });

        $('#cmbInvoice').append(trHTML);
    }

    $("#cmbInvoice").change(function () {
        var invoice_id = $("#cmbInvoice").val();
        fillTable(invoice_id);
    });

    var return_reasons;
    function returnReasons() {
        var return_reasons;
        $.ajax({
            type: 'POST',
            url: "proccess/invoice_return_proccess.php",
            data: {return_reasons_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                return_reasons = data;
            }
        });
        return return_reasons;
    }

    function fillTable(invoice_id) {
        $('#tbl tbody').remove();
        if (invoice_id) {
            $.ajax({
                type: 'POST',
                url: "proccess/invoice_return_proccess.php",
                data: {invoice_inventories_request: true, invoice_id: invoice_id},
                dataType: 'json',
                async: false,
                success: function (data) {
                    var trHTML = "";
                    return_reasons = returnReasons();
                    $.each(data, function (index, value) {
                        var batch = "<a style='cursor:pointer;' id='" + value["batch_id"]["id"] + "' onclick='showBatch(this)' >  Batch:" + value["batch_id"]["code"] + " </a>";

                        var inputNumber = "";
                        var returnReason = "";
                        if (value["avl_qty"] > 0) {
                            inputNumber = "<input onchange='validateChanges(this);'  type='number' value='" + 0 + "' min='0' max='" + value["qty"] + "' style='float:left;' > ";
                            returnReason = returnReasonCombobox();
                        }

                        var discounted_price = ((value["price"]) - (value["unit_discount"])).toFixed(2);
                        var returnUnitPrice = "<input onchange='validateChanges(this);'  type='text' value='" + discounted_price + "' min='0' max='" + discounted_price + "' style='float:left;' > ";

//                        trHTML += "<tr id='" + value["inventory_id"] + "'><td>" + value["product_id"] + " (" + batch + ")</td><td>" + value["price"] + "</td><td>" + value["unit_discount"] + "</td><td>" + value["qty"] + " (" + value["avl_qty"] + ")</td><td>" + value["gross_amount"] + "</td><td>" + value["net_amount"] + "</td><td>" + returnReason + "</td><td id='aaaaaaaaa'>" + inputNumber + "</td></tr>";
                        trHTML += "<tr id='" + value["inventory_id"] + "'><td>" + value["product_id"] + " (" + batch + ")</td><td>" + value["unit_discount"] + "</td><td>" + discounted_price + "</td><td>" + value["qty"] + " (" + value["avl_qty"] + ")</td><td>" + returnUnitPrice + "</td><td>" + returnReason + "</td><td id='aaaaaaaaa'>" + inputNumber + "</td></tr>";

                    });
                    $('#tbl').append(trHTML);
                }
            });
        }
        setTotal();
    }

    function returnReasonCombobox() {
        var html = "";
        html += "<select onchange='validateChanges(this);' class='form-control return_reason input-sm' name='return_reason_id' >";
        html += "<option disabled='' selected=''>Select Reason</option>";
        $.each(return_reasons, function (index, value) {
            html += "<option value='" + value["id"] + "'>" + value["name"] + "</option>";
        });
        html += "</select>";
        return html;
    }

    function aaa(element) {
        $(element).closest("div").css({"color": "red", "border": "2px solid red"});
    }

    function validateChanges(element) {
//        var element = $("#" + el.id);
//        if (!isNaN(element.val()) && element.val() > 0) {
//            element.css({"background": "#ccffcc"});
//            if (element.val() > invoice_inventory.qty) {
//                element.val(invoice_inventory.qty);
//            }
//        } else {
//            element.val(0);
//            element.css({"background": "#fff"});
//        }

//        $(this).parent().parent().attr('id');
//        $(this).closest('ul').attr('id');


        var tr = $(element).closest("tr");
        var inventory_id = tr.attr("id");
        var invoice_id = $("#cmbInvoice").val();
        var invoice_inventory = invoiceInventoryRequest(invoice_id, inventory_id);

        var reason = $(tr).find('td:eq(5)').find('select:eq(0)');
        var number = $(tr).find('td:eq(6)').find('input:eq(0)');

        var discounted_unit_price = (invoice_inventory.price) - (invoice_inventory.unit_discount);
        var return_unit_price = $(tr).find('td:eq(4)').find('input:eq(0)');

        var val_reason = (reason.val()) ? true : false;
        var val_number = false;
        var val_return_unit_price = false;

        if (!isNaN(number.val()) && number.val() > 0) {
            val_number = true;
            if (number.val() > invoice_inventory.avl_qty) {
                number.val(invoice_inventory.avl_qty);
            }
        } else {
            val_number = false;
            number.val(0);
        }

        if (Validation.validatePrice(return_unit_price.val()) && (return_unit_price.val() > -1) && (return_unit_price.val() <= discounted_unit_price)) {
            val_return_unit_price = true;
        }



        if (val_number && val_reason && val_return_unit_price) {
            var reason_id = reason.val();
            if (reason_id == 1) {
                tr.css({"background": "#ccffcc"});
            } else if (reason_id == 2) {
                tr.css({"background": "#ccffcc"});
            } else if (reason_id == 3) {
                tr.css({"background": "#ffcccc"});
            } else if (reason_id == 4) {
                tr.css({"background": "#ffcccc"});
            }
        } else {
            tr.css({"background": "#fff"});
        }


        setTotal();
    }

    function invoiceInventoryRequest(invoice_id, inventory_id) {
        var invoice_inventory;
        if (invoice_id && inventory_id) {
            $.ajax({
                type: 'POST',
                url: "proccess/invoice_return_proccess.php",
                data: {invoice_inventory_request: true, invoice_id: invoice_id, inventory_id: inventory_id},
                dataType: 'json',
                async: false,
                success: function (data) {
                    invoice_inventory = data;
                }
            });
        }
        return invoice_inventory;
    }

    function showBatch(element) {
        $.ajax({
            type: 'POST',
            url: "proccess/invoice_return_proccess.php",
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

    function getErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#cmbInvoice");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Invoice - Not Selected");
            element.css({"border": "1px solid red"});
        }


        var val_tblData = false;
        $('#tbl tr').each(function (row, tr) {
            var return_reason_id = $(tr).find('td:eq(5)').find('select:eq(0)');
            var qty = $(tr).find('td:eq(6)').find('input:eq(0)');
            var return_unit_price = $(tr).find('td:eq(4)').find('input:eq(0)');
            var unit_price = $(tr).find('td:eq(2)').text;

            if (return_reason_id.val() && qty.val() > 0 && return_unit_price <= unit_price) {
                val_tblData = true;
            }
        });

        element = $('#tbl');
        if (val_tblData) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Nothing selected for returning");
            element.css({"border": "1px solid red"});
        }

        return errors;
    }

    function setTotal() {
        $("#lblTotal").text(getTotal());
    }

    function getTotal() {
        var total = 0;
        $('#tbl tr').each(function (row, tr) {
            var return_unit_price = $(tr).find('td:eq(4)').find('input:eq(0)').val();
            var return_reason_id = $(tr).find('td:eq(6)').find('select:eq(0)').val();
            var qty = $(tr).find('td:eq(6)').find('input:eq(0)').val();

            if (return_reason_id != 0 && qty > 0) {
                var sub_total = return_unit_price * qty;
                total += sub_total;
            }
        });

        return total;
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

    function getTableContent() {
//        var tblData = new Array();
//        $('#tbl tr').each(function (row, tr) {
//            tblData[row] = {
//                "inventory_id": $(tr).attr("id")
//                , "return_reason_id": $(tr).find('td:eq(6)').find('select:eq(0)').val()
//                , "qty": $(tr).find('td:eq(7)').find('input:eq(0)').val()
//            };
//        });
//        tblData.shift(); 
//        return tblData;

//        var tblData = new Array();
//        $('#tbl tr').each(function (row, tr) {
//            var inventory_id = $(tr).attr("id");
//            var return_reason_id = $(tr).find('td:eq(6)').find('select:eq(0)').val();
//            var qty = $(tr).find('td:eq(7)').find('input:eq(0)').val();
//            if (return_reason_id && qty > 0) {
//                tblData.push({
//                    "inventory_id": inventory_id
//                    , "return_reason_id": return_reason_id
//                    , "qty": qty
//                });
//            }
//        });
//        tblData.shift(); 

        var tblData = new Array();
        $('#tbl tr').each(function (row, tr) {
            var inventory_id = $(tr).attr("id");
            var return_reason_id = $(tr).find('td:eq(5)').find('select:eq(0)').val();
            var qty = $(tr).find('td:eq(6)').find('input:eq(0)').val();
            var return_unit_price = $(tr).find('td:eq(4)').find('input:eq(0)').val();
            if (return_reason_id && qty > 0) {
                tblData[row] = {
                    "inventory_id": inventory_id
                    , "return_reason_id": return_reason_id
                    , "qty": qty
                    , "return_unit_price": return_unit_price
                };
            }
        });
        tblData.shift();

        return tblData;
    }

    $("#btnSave").click(function () {
        confirmSave();
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
        var invoice_id = $("#cmbInvoice").val();
        var note = $("#txtNote").val();
        var tblData = getTableContent();
        var deliverer_id = $("#txtDeliverer").val();

        $.ajax({
            type: 'POST',
            url: "proccess/invoice_return_proccess.php",
            data: {save: true, invoice_id: invoice_id, note: note, deliverer_id: deliverer_id, tblData: tblData},
            dataType: 'json',
            async: false,
            success: function (data) {
                if (data) {
//                    $(location).attr('href', 'invoice.php');
                    FormOperations.postForm('invoice.php', {"return_invoice": true});
                }
            }
        });
    }

</script>
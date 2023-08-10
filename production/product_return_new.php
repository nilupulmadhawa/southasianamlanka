<?php
require_once './../util/validate_login.php';
require_once './../util/initialize.php';
include 'common/upper_content.php';

if (isset($_POST["deliverer_id"])) {
    $deliverer = Deliverer::find_by_id($_POST["deliverer_id"]);
    $_SESSION['return_deliverer'] = $deliverer->id;
    $_SESSION['return_date_time'] = $_POST["date_time"];
    $_SESSION['return_return_note'] = $_POST["return_note"];
    $_SESSION['return_return_number'] = $_POST["return_number"];
    $_SESSION['return_approved_by'] = $_POST["approved_by"];

    unset($_SESSION["product_return_item"]);
} else {
    Functions::redirect_to("product_return_by_deliverer_new.php");
}

?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Product Return</h3>
            </div>
            <div class="title_right" style="text-align: right;">
                <a href="product_return_by_deliverer_new.php" class="btn btn-warning">BACK</a>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php Functions::output_result(); ?>

        <div class="row">


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Return Product Details</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form class="form-horizontal">

                            <div class="col-sm-12" style="padding:5px;">
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <select class="form-control selectpicker"  data-live-search="true" id="cmbFilter" >
                                        <option value="0" selected disabled> Select Item</option>
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


                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Return Reason</label> <br/>

                                    <select class="form-control" id="cmbReturnReason" name="invoice_id">
                                        <?php
                                        foreach(ReturnReason::find_all() as $data){
                                            echo "<option value='".$data->id."'>".$data->name."</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Batch</label> <br/>
                                    <select class="form-control" id="cmbBatch" name="invoice_id">
                                        <option value="0" selected disabled> Select Batch</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Price</label> <br/>
                                    <input class="form-control" type="text" id="cmbPrice" name="price">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Qty</label> <br/>
                                    <input class="form-control" type="text" id="cmbQty" name="qty">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Discount (%) </label> <br/>
                                    <input class="form-control" type="text" id="cmbDiscount" value="0" name="discount">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Invoice Discount (%) </label> <br/>
                                    <input class="form-control" type="text" id="cmbInvoiceDiscount" value="0" name="invoice_discount">
                                </div>
                            </div>

                            <div class="col-sm-12" style="padding:5px;">
                                <button id="btnAdd" type="button" class="btn btn-primary"><i class="fa fa-arrow-circle-down"></i> Add</button>
                            </div>

                        </form>
                        <button type="button" name="button" onclick="showHint(1)">Reload Table <i class="fa fa-arrow-refresh"></i> </button>
                        <div class="col-sm-12" id="txtHint">

                        </div>


                        <div class="clearfix"></div>


                    </div>

                </div>
            </div>


            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                    <div class="x_content">
                        <a class="btn btn-block btn-primary" href="product_return_new_second.php">NEXT</a>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!--/page content-->

<?php include 'common/bottom_content.php'; ?>

<script>

    // product table complete

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
            xmlhttp.open("GET", "proccess/LiveData/Return_item_table.php?q=" + str, true);
            xmlhttp.send();
        }
    }


    // first section errors start

    function getInvoiceErrors() {
        var errors = new Array();
        var element;
        var element_value;


        element = $("#cmbQty");
        element_value = element.val();
        if (element_value !== "") {
            var invoice_id = $("#cmbInvoice").val();

        } else {
            errors.push("Invoice Amount - Invalid");
            element.css({"border": "1px solid red"});
        }

        return errors;
    }

    // first section error ends


    $("#cmbFilter").change(function () {
        var filter_id = $("#cmbFilter").val();
        loadInvoices(filter_id);
    });

    function loadInvoices(filter_id) {
        $('#cmbBatch').empty();
        var trHTML = "";
        trHTML += "<option value=''>Select Bacth</option>";
        $.ajax({
            type: 'POST',
            url: "proccess/product_return_new_proccess.php",
            data: {invoice_request: true, filter_id: filter_id},
            dataType: 'json',
            async: false,
            success: function (data) {
                $.each(data, function (index, value) {
                    trHTML += "<option value='" + value["id"] + "'> Batch: " + value["code"] + " ( Retail: " + value["retail_price"] + ") ( Wholesale: " + value["wholesale_price"] + ") </option>";
                });
            }
        });
        $('#cmbBatch').append(trHTML);
    }


    $("#btnAdd").click(function (e) {
        // e.preventDefault;
        addInvoice();
    });

    function addInvoice() {
        var errors = getInvoiceErrors();
        if (errors === undefined || errors.length === 0) {

            var product_id = $("#cmbFilter").val();
            var batch_id = $("#cmbBatch").val();
            var price = $("#cmbPrice").val();
            var qty = $("#cmbQty").val();
            var return_reason = $("#cmbReturnReason").val();
            var discount = $("#cmbDiscount").val();
            var invoice_discount = $("#cmbInvoiceDiscount").val();

            $.ajax({
                type: "POST",
                url: "proccess/product_return_new_proccess.php",
                data: {add_invoice_payment: true, product_id: product_id, batch_id: batch_id, price: price, qty:qty, return_reason:return_reason, discount:discount, invoice_discount:invoice_discount },
                success: function (data) {
                    loadInvoiceForm();
                    new PNotify({
                        title: 'Success',
                        text: 'Product added to the table!',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                },
                error: function (xhr) {
                    $.alert(xhr.responseText);
                }
            });

            showHint(1);
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





    function loadInvoiceForm() {
        $("#cmbQty").val(null);
        $("#cmbPrice").val(null);
        $("#cmbBatch").val(0);
        $("#cmbFilter").val(0);
        $("#cmbDiscount").val(0);
    }


    function removeReload(element) {
        $.ajax({
            type: "POST",
            url: "proccess/product_return_new_proccess.php",
            data: {remove_reload: true, index: element.id},
            success: function (data) {

             showHint(1);

             // $("#cmbBatch").val(data.batch_id);
             // $("#cmbReturnReason").val(data.return_reason_id);
             // $("#numQty").val(data.qty);
             // $('#txtReturningPrice').val(data.unit_price);
             // setReasonColor(data.return_reason_id);
         }
     });
    }

</script>

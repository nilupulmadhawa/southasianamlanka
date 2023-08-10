<?php
require_once './../util/validate_login.php';
require_once './../util/initialize.php';
include 'common/upper_content.php';

?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Product Return</h3>
            </div>
            <div class="title_right" style="text-align: right;">
                <a href="product_return_new.php" class="btn btn-warning">BACK</a>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php Functions::output_result(); ?>

        <div class="row">


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Return Invoices</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="table-responsive">
                            <table id="tbl" class="table table-bordered table-condensed table-striped table-responsive customBorder">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th style='text-align:center;'>Return Reason</th>
                                        <th style='text-align:center;'>Batch Detail</th>
                                        <th style='text-align:right;'>Unit</th>
                                        <th style='text-align:right;'>Discount</th>
                                        <th style='text-align:center;'>Qty</th>
                                        <th style='text-align:right;'>Line Total</th>
                                        <th style='text-align:right;'>Invoice Discount</th>
                                        <th style='text-align:right;'>Discounted Line Total</th>
                                    </tr>
                                </thead>
                                <tbody >

                                    <?php
                                    $line_total = 0;
                                    $indx = 0;
                                    if(isset($_SESSION['product_return_item'])){


                                        foreach($_SESSION['product_return_item'] as $index => $data){
                                            $item = Product::find_by_id($data['product_id']);
                                            $batch = Batch::find_by_id($data['batch_id']);
                                            $return_reason = ReturnReason::find_by_id($data['return_reason']);
                                            $discount = $data['discount'];
                                            $qty = $data['qty'];

                                            if($data['price']){
                                                $retail_price = $data['price'];
                                            }else{
                                                $retail_price = $batch->retail_price;
                                            }

                                            $val = 0;
                                            $discountedtotal = 0;

                                            $val = 100 - $discount;
                                            $val = $val / 100;
                                            $discountedtotal = $retail_price*$qty*$val;

                                            $ad_dis = 0;
                                            $ad_dis = 100 - $data['invoice_discount'];
                                            $ad_dis = $ad_dis * $discountedtotal;
                                            $ad_dis = $ad_dis / 100;

                                            echo "<tr>";
                                            echo "<td>".$item->name."</td>";
                                            echo "<td style='text-align:center;'>".$return_reason->name."</td>";
                                            echo "<td style='text-align:center;'>".$batch->id."</td>";
                                            echo "<td style='text-align:right;'>".$retail_price."</td>";
                                            echo "<td style='text-align:right;'>".$discount."%</td>";
                                            echo "<td style='text-align:center;'>".$qty."</td>";
                                            echo "<td style='text-align:right;'>".number_format($discountedtotal,2)."</td>";
                                            echo "<td style='text-align:right;'>".$data['invoice_discount']."%</td>";
                                            echo "<td style='text-align:right;'>".number_format($ad_dis,2)."</td>";
                                            echo "</tr>";
                                            $line_total = $line_total + $ad_dis;
                                            $indx++;
                                        }



                                    }

                                    echo "<tr>";
                                    echo "<td colspan='8' style='text-align:right;'>TOTAL</td>";
                                    echo "<td style='text-align:right;'>".number_format($line_total,2)."</td>";
                                    echo "</tr>";

                                    ?>

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>

            </div>


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Return Invoices</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form class="form-horizontal">

                            <div class="col-sm-12" style="padding:5px;">
                                <div class="form-group">
                                    <label>Customer name</label>
                                    <select class="form-control selectpicker"  data-live-search="true" id="cmbInvoices" >
                                        <option value="0" selected disabled> Select Customer</option>
                                        <?php
                                        foreach (Customer::find_all() as $customer) {

                                            ?>
                                            <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?> ( <?php echo $customer->address; ?> ) </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Set off Invoice</label> <br/>
                                    <select class="form-control" id="cmbCusinv" name="invoice_id">
                                        <option value="0" selected disabled> Select Invoice</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Set Off Unpaid Invoice</label> <br/>
                                    <select class="form-control" id="cmbCusinvRight" name="invoice_id_right">
                                        <option value="0" selected disabled> Select Invoice</option>

                                    </select>
                                </div>
                            </div>



                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Return Amount</label> <br/>
                                    <input class="form-control" type="text" id="cmbReturnamount" name="Amount">
                                </div>
                            </div>

                            <div class="col-sm-12" style="padding:5px;">
                                <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-down"></i> Add</button>
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
                        <a class="btn btn-block btn-primary" href="proccess/product_return_new_proccess.php?save_return=1">FINALIZE</a>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
<!--/page content-->

<?php include 'common/bottom_content.php'; ?>

<script>

    $("#cmbInvoices").change(function () {
        var filter_id = $("#cmbInvoices").val();
        loadInvoices(filter_id);
    });

    function removeReload1(element) {
        $.ajax({
            type: "POST",
            url: "proccess/product_return_new_proccess.php",
            data: {remove_reload_invoice: true, index: element.id},
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
            xmlhttp.open("GET", "proccess/LiveData/Return_item_table_invoice.php?q=" + str, true);
            xmlhttp.send();
        }
    }


    function loadInvoices(filter_id) {


        $('#cmbCusinv').empty();
        $('#cmbCusinvRight').empty();
        var trHTML = "";
        trHTML += "<option value=''>Select Bacth</option>";
        $.ajax({
            type: 'POST',
            url: "proccess/product_return_new_proccess.php",
            data: {customer_request: true, filter_id: filter_id},
            dataType: 'json',
            async: false,
            success: function (data) {
                $.each(data, function (index, value) {
                    trHTML += "<option value='" + value["id"] + "'> Invoce: " + value["code"] + " || Balance: "+ value['balance'] +" </option>";
                });
            }
        });
        $('#cmbCusinv').append(trHTML);
        $('#cmbCusinvRight').append(trHTML);

    }


    $("#btnAdd").click(function (e) {
        e.preventDefault;
        addInvoice();

        // alert("done");
    });

    function addInvoice() {
        var errors = getInvoiceErrors();
        if (errors === undefined || errors.length === 0) {

            var invoice_id = $("#cmbCusinv").val();
            var invoice_id_right = $("#cmbCusinvRight").val();
            var amount = $("#cmbReturnamount").val();

            $.ajax({
                type: "POST",
                url: "proccess/product_return_new_proccess.php",
                data: {add_invoice_payment_invoice: true, invoice_id: invoice_id, amount: amount, invoice_id_right:invoice_id_right },
                success: function (data) {
                    // loadInvoiceForm();

                    $("#cmbReturnamount").val(0);
                    $("#cmbCusinv").val(0);
                    $("#cmbCusinvRight").val(0);

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

    function getInvoiceErrors() {
        var errors = new Array();
        var element;
        var element_value;


        element = $("#cmbReturnamount");
        element_value = element.val();
        if (element_value !== "") {
            var invoice_id = $("#cmbReturnamount").val();

        } else {
            errors.push("Invoice Amount - Invalid");
            element.css({"border": "1px solid red"});
        }


        element = $("#cmbCusinv");
        element_value = element.val();
        if (element_value !== "" && element_value > 0) {
            var amount = $("#cmbCusinv").val();

        } else {
            errors.push("Invoice Amount - Invalid");
            element.css({"border": "1px solid red"});
        }

        return errors;
    }




</script>

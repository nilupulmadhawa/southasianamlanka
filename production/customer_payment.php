<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Customer Payment</h3>
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
                        <h2 id="title"><?php echo (empty($payment->id)) ? 'Add' : 'Edit'; ?> Payment</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="form" action="proccess/customer_payment_proccess.php" method="post" class="form-horizontal form-label-left" >
                            <div class="container-fluid ">
                                <!--<input type="hidden" class="form-control" id="txtId" name="id" value="<?php // echo $payment->id;          ?>" />-->
                                <div class="form-group">
                                    <label>Payment Code</label>
                                    <input type="text" id="txtPaymentCode" name="code" class="form-control" value="<?php echo (empty($payment->id)) ? Payment::getNextCode() : $payment->code; ?>" required="required" readonly=""/>
                                </div>
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select class="form-control" id="cmbCustomer" name="customer_id" required="">
                                        <option disabled="" selected="">Select Customer</option>
                                        <?php
                                        foreach (Customer::find_all_has_balance() as $customer) {
//                                        foreach (Customer::find_all() as $customer) {
                                            ?>
                                            <option value="<?php echo $customer->id; ?>"><?php echo $customer->name . " (Bal:" . $customer->balance . ")"; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" placeholder="Amount" id="txtAmount" name="amount" required="">
                                </div>
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select class="form-control" id="cmbPaymentMethod" name="payment_method_id" required="">
                                        <option disabled="" selected="">Select Payment Method</option>
                                        <?php
                                        foreach (PaymentMethod::find_all() as $paymentmethod) {
                                            ?>
                                            <option value="<?php echo $paymentmethod->id; ?>"><?php echo $paymentmethod->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div id="divCheque" style="display: none;">
                                    <div class="form-group divBackTopTable col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="col-md-6 col-sm-6 col-xs-12" >
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <select class="form-control" id="cmbChequeBank" name="c_bank_id" required="">
                                                    <!--<option disabled="" selected="">Select Invoice</option>-->
                                                    <option disabled="" selected="" value="">Select Bank</option>
                                                    <?php
                                                    foreach (Bank::find_all() as $bank) {
                                                        ?>
                                                        <option value="<?php echo $bank->id; ?>"><?php echo $bank->name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Cheque Number</label>
                                                <input type="text" class="form-control" placeholder="Cheque Number" name="c_number" id="txtChequeNo">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12" >
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="text" class="form-control" placeholder="Date" name="c_date" id="dtpChequeDate">
                                            </div>
                                            <div class="form-group">
                                                <label>Cheque Value</label>
                                                <input type="text" class="form-control" placeholder="Cheque Value" name="c_amount" id="txtChequeAmount">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container-fluid ">
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                            </div>
<!--                            <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php // echo (empty($payment->id)) ? 'none' : 'initial';       ?>">
                                <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                            </div>-->
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <a href="customer_payment.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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

    };

//    $(function () {
//        $("#dtpDate").datepicker({
//            changeMonth: true,
//            changeYear: true,
//            dateFormat: 'yy-mm-dd'
//        });
//    });

    $(function () {
        $("#dtpChequeDate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });

    $("#cmbPaymentMethod").change(function () {
        var payment_method_id = $("#cmbPaymentMethod").val();
        loadPaymentMethod(payment_method_id);
    });

    function loadPaymentMethod(payment_method_id) {
        if (payment_method_id == 2) {
            $("#divCheque").css({"display": "initial"});
            $("#txtAmount").prop('disabled', true);
        } else {
            $("#divCheque").css({"display": "none"});
            $("#txtAmount").prop('disabled', false);
        }
    }
    
    $("#txtAmount").change(function () {
        var value = $("#txtAmount").val();
        $("#txtChequeAmount").val(value);
    });
    $("#txtAmount").keyup(function () {
        var value = $("#txtAmount").val();
        $("#txtChequeAmount").val(value);
    });
    $("#txtChequeAmount").change(function () {
        var value = $("#txtChequeAmount").val();
        $("#txtAmount").val(value);
    });
    $("#txtChequeAmount").keyup(function () {
        var value = $("#txtChequeAmount").val();
        $("#txtAmount").val(value);
    });

////////////////////////////////////////////////////    
    function getAvlBalance(customer_id) {
        var result;
        if (customer_id) {
            $.ajax({
                type: 'POST',
                url: "proccess/customer_payment_proccess.php",
                data: {customer_request: true, customer_id: customer_id},
                dataType: 'json',
                async: false,
                success: function (data) {
                    result = data.balance;
                }
            });
        }
        return result;
    }

    function getChequeErrors() {

        var errors = new Array();
        var element;
        var element_value;

        element = $("#cmbChequeBank");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Cheque Bank - Invalid");
            element.css({"border": "1px solid red"});
        }

        element = $("#txtChequeNo");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Cheque Number - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#dtpChequeDate");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Cheque Date - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtChequeAmount");
        element_value = element.val();
        if (element_value !== "" && Validation.validatePrice(element_value)) {
            var cheque_amount = parseInt(element_value);
            var amount = parseInt($("#txtAmount").val());

            if (amount != cheque_amount) {
                errors.push("Cheque Amount is different than the total Amount");
                element.css({"border": "1px solid red"});
            } else {
                element.css({"border": "1px solid #ccc"});
            }
        } else {
            errors.push("Cheque Amount - Invalid");
            element.css({"border": "1px solid red"});
        }

        return errors;
    }

    function getErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#txtPaymentCode");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Payment Code - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#cmbCustomer");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
            var avl_bal = getAvlBalance(element_value);
            if (avl_bal && avl_bal > 0) {
                element.css({"border": "1px solid #ccc"});
            } else {
                errors.push("Customer has no positive balance");
                element.css({"border": "1px solid red"});
            }
        } else {
            errors.push("Customer - Not selected");
            element.css({"border": "1px solid red"});
        }

        element = $("#txtAmount");
        element_value = element.val();
        if (element_value !== "" && Validation.validatePrice(element_value)) {
            if (element_value > 0) {
                var avl_bal = getAvlBalance($("#cmbPaymentMethod").val());
                if ($("#cmbCustomer").val() && avl_bal) {
                    if (element_value > avl_bal) {
                        errors.push("Amount is higher than total balance of the customer");
                        element.css({"border": "1px solid red"});
                    } else {
                        element.css({"border": "1px solid #ccc"});
                    }
                } else {
                    element.css({"border": "1px solid #ccc"});
                }
            } else {
                errors.push("Amount - Invalid");
                element.css({"border": "1px solid red"});
            }
        } else {
            errors.push("Amount - Invalid");
            element.css({"border": "1px solid red"});
        }

        element = $("#cmbPaymentMethod");
        element_value = element.val();
        if (element_value) {
            if (element_value == 2) {
                var cheque_errors = getChequeErrors();
                if (cheque_errors === undefined || cheque_errors.length === 0) {
                    element.css({"border": "1px solid #ccc"});
                } else {
                    for (error in cheque_errors) {
                        errors.push(cheque_errors[error]);
                    }
                    element.css({"border": "1px solid red"});
                }
            } else {
                element.css({"border": "1px solid #ccc"});
            }
        } else {
            errors.push("Payment Method - Not Selected");
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
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Payment", "ins")) {
            FormOperations.confirmSave(validateForm(), "#form");
        }
    });

    $("#btnDelete").click(function () {
//        FormOperations.confirmDelete("#form");
    });

</script>


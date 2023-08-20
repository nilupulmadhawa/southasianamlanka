<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cheque Management</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="cheque.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Bank</th>
                                    <th>Cheque No</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Cheque Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $total_records = Cheque::row_count();
                                $pagination = new Pagination($total_records);
                                $objects = Cheque::find_all_by_limit_offset($pagination->records_per_page, $pagination->offset());

                                foreach ($objects as $cheque) {
                                    ?>
                                    <tr id="<?php echo $cheque->id ?>">
                                        <td><?php echo $cheque->id ?></td>
                                        <td><?php

                                        $payment_cheque = PaymentCheque::find_by_payment_cheque_id($cheque->id);
                                        // echo $payment_cheque->payment_id;
                                        $payment_invoice = PaymentInvoice::find_by_payment_id($payment_cheque->payment_id);

                                        echo $payment_invoice->invoice_id()->customer_id()->name;

                                        ?></td>
                                        <td><?php echo $cheque->bank_id()->name ?></td>
                                        <td><?php echo $cheque->cheque_no ?></td>
                                        <td><?php echo $cheque->amount ?></td>
                                        <td><?php echo $cheque->date ?></td>
                                        <td><?php echo $cheque->cheque_status_id()->name ?></td>

                                        <td>
                                            <?php
                                            if ($cheque->cheque_status_id == 1) {
                                                ?>
                                                <select class="form-control input-sm" id="cmbChequeStatus" >
                                                    <option disabled="" selected="">Select Status</option>
                                                    <?php
                                                    foreach (ChequeStatus::find_all() as $cheque_status) {
                                                        if ($cheque_status->id == 2 || $cheque_status->id == 4) {
                                                            ?>
                                                            <option value="<?php echo $cheque_status->id; ?>"><?php echo $cheque_status->name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <button id="<?php echo $cheque->id ?>" type="button" name="view" class="btn btn-primary btn-xs btnCheque" ><i class="glyphicon glyphicon-edit"></i> Confirm</button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="x_panel">
                    <div onclick="window.location.href:''" class="x_content">
                        <?php
                        echo $pagination->get_pagination_links_html1("cheque_management.php");
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include 'common/bottom_content.php'; ?>

<script>
    // window.onfocus = function () {
    //     location.reload();
    // };

    $(".btnCheque").click(function () {
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Cheque", "upd")) {
            submitForm(this);
        }
    });

    function getErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#cmbChequeStatus");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Cheque status - Not Selected");
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

    function submit(element, element1) {
        var result = false;

        $.ajax({
            type: 'POST',
            url: "proccess/cheque_proccess.php",
            data: {confirm_cheque: true, cheque_id: element.id, cheque_status_id: element1.val()},
            dataType: 'json',
            async: false,
            success: function (data) {
                result = data;
                location.reload();
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
        return result;
    }

    function submitForm(element) {
        if (validateForm()) {
            $.confirm({
                title: 'Confirm save changes?',
                content: '' +
                        '<form action="" class="formName">' +
                        '<div class="form-group">' +
                        '<label>Enter login password to confirm cheque status change</label>' +
                        '<input type="password" placeholder="Password" class="name form-control" required />' +
                        '</div>' +
                        '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Confirm changes',
                        btnClass: 'btn-green',
                        action: function () {
                            var password = this.$content.find('.name').val();
                            if (authenticate(password)) {
                                var status = $("#cmbChequeStatus");
                                var result = submit(element, status);
//                                alert(JSON.stringify(result));
                                if (result) {
                                    $("#datatable-responsive").find('#' + element.id).find('td:eq(5)').text($("#cmbChequeStatus option:selected").text());
                                    $("#datatable-responsive").find('#' + element.id).find('td:eq(6)').empty();
                                    $.confirm({
                                        title: 'Successfully saved the changes!',
                                        content: '',
                                        type: 'green',
                                        typeAnimated: true,
                                        buttons: {
                                            close: function () {
                                            }
                                        }
                                    });
                                } else {
                                    $.confirm({
                                        title: 'Encountered an error!',
                                        content: 'Failed to save the details',
                                        type: 'red',
                                        typeAnimated: true,
                                        buttons: {
                                            close: function () {
                                            }
                                        }
                                    });
                                }
                            } else {
                                $.confirm({
                                    title: 'Password is incorrect!',
                                    content: 'Try again..',
                                    type: 'red',
                                    typeAnimated: true,
                                    buttons: {
                                        close: function () {
                                        }
                                    }
                                });
                            }
                        }
                    },
                    cancel: function () {
                        //close
                    }
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        }
    }

    function authenticate(password) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/cheque_proccess.php",
            data: {authenticate: true, password: password},
            dataType: 'json',
            async: false,
            success: function (data) {
                result = data;
            }
        });
        return result;
    }


</script>

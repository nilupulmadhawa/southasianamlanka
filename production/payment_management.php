<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

$search_query = isset($_GET['txtSearch']) ? $_GET['txtSearch'] : "";
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payment Management</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="payment.php" target="_blank" class="btn btn-round btn-primary">
                                    <i class="glyphicon glyphicon-plus"></i> Add New
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <form class="form-inline" method="GET">
                                    <div class="input-group" style="display: flex;width: 400px;float: right;">
                                        <input class="form-control" placeholder="Customer Name / Invoice" type="text" id="txtSearch" name="txtSearch" value="<?php echo $search_query ?? "" ?>">
                                        <div class="input-group-append" style="display: inline-block;">
                                            <button class="btn btn-primary" type="submit" style="vertical-align: top;">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class=" x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Payment</th>
                                    <th>Invoice</th>
                                    <th>Customer Name</th>
                                    <th>Paying Method</th>
                                    <th style='text-align:center;'>Cheque Number</th>
                                    <th style='text-align:center;'>Account Number</th>
                                    <th style='text-align:center;'>Bank Name</th>
                                    <th style='text-align:center;'>Branch</th>
                                    <th style='text-align:center;'>Cheque Date</th>
                                    <th style='text-align:center;'>Deposited Date</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $total_records = Payment::row_count();
                                $pagination = new Pagination($total_records);
                                $objects = Payment::find_all_by_limit_offset_test($pagination->records_per_page, $pagination->offset(), $search_query);

                                //                                foreach (Payment::find_all_by_payment_type_id(1) as $payment) {
                                foreach ($objects as $payment) {
                                ?>
                                    <tr id="<?php echo $payment->id; ?>">
                                        <td><?php echo $payment->code ?></td>
                                        <td>
                                            <?php
                                            $customer_Name = 'NULL';
                                            $invoices = array();
                                            foreach (PaymentInvoice::find_all_by_payment_id($payment->id) as $payment_invoice) {
                                                $invoices[] = $payment_invoice->invoice_id()->code;
                                                $customer_Name = $payment_invoice->invoice_id()->customer_id()->name;
                                            }
                                            echo join(", ", $invoices);
                                            ?>
                                    </td>
                                    <td><?php echo $customer_Name; ?></td>
                                    <td><?php echo $payment->payment_method_id()->name ?></td>

                                        <?php
                                        if ($payment->payment_method_id == 2) {
                                            $cheque_details = PaymentCheque::find_by_payment_id($payment->id);
                                        ?>
                                            <td style='text-align:center;'> <?php echo $cheque_details->cheque_id()->cheque_no; ?> </td>
                                            <td>--</td>
                                            <td style='text-align:center;'> <b><?php echo $cheque_details->cheque_id()->bank_id()->name; ?></b> </td>
                                            <td style='text-align:center;'> <b><?php echo $cheque_details->cheque_id()->branch; ?></b> </td>
                                            <td style='text-align:center;'> <?php echo $cheque_details->cheque_id()->date; ?> </td>
                                            <td>--</td>

                                        <?php
                                        } else {
                                        ?>
                                            <td>--</td>
                                            <td style='text-align:center;'> <?php echo $cheque_details->cheque_id()->cheque_no; ?> </td>
                                            <td style='text-align:center;'> <b><?php echo $cheque_details->cheque_id()->bank_id()->name; ?></b> </td>
                                            <td>--</td>
                                            <td>--</td>
                                            <td style='text-align:center;'> <?php echo $cheque_details->cheque_id()->date; ?> </td>
                                        <?php
                                        }
                                        ?>

                                        <td><?php echo $payment->date_time ?></td>
                                        <td><?php echo $payment->amount ?></td>
                                        <td><?php echo $payment->payment_status_id()->name ?></td>
                                        <td>
                                            <form action="payment_prev.php" method="post" target="_blank" style="float: left;">
                                                <input type="hidden" name="payment_id" value="<?php echo $payment->id ?>" />
                                                <button type="submit" name="view" class="btn btn-primary btn-xs"><i class="fa fa-external-link-square"></i> View</button>
                                                <a class="btn btn-primary btn-xs" href="./payment_edit.php?id=<?php echo $payment->id ?>"> Edit</a>
                                            </form>

                                        <?php
                                            if ($payment->payment_status_id != 3) {
                                            ?>
                                                <form id="form_cancel" action="proccess/payment_proccess.php" method="post" style="float: left;">
                                                    <input type="hidden" name="payment_id" value="<?php echo $payment->id ?>" />
                                                    <button id="<?php echo $payment->id ?>" type="submit" name="cancel" class="btn btn-danger btn-xs btnCancel"><i class="fa fa-close"></i> Cancel</button>
                                                </form>
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
                        echo $pagination->get_pagination_links_html1("payment_management.php");
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
    window.onfocus = function() {
        //        location.reload();
    };

    $(".btnCancel").click(function() {
        //        submitForm(true, "#form_cancel");
        //        submitForm("#form_cancel");

        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Payment", "upd")) {
            submitForm(this);
        }

    });

    function submit(element) {
        var result = false;
        $.ajax({
            type: 'POST',
            url: "proccess/payment_proccess.php",
            data: {
                cancel_payment: true,
                payment_id: element.id
            },
            dataType: 'json',
            async: false,
            success: function(data) {
                result = data;
            },
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
        return result;
    }

    function submitForm(element) {
        $.confirm({
            title: 'Cancel Payment ?',
            content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Enter login password to cancel payment</label>' +
                '<input type="password" placeholder="Password" class="name form-control" required />' +
                '</div>' +
                '</form>',
            buttons: {
                formSubmit: {
                    text: 'Cancel Payment',
                    btnClass: 'btn-red',
                    action: function() {
                        var password = this.$content.find('.name').val();
                        if (authenticate(password)) {
                            var result = submit(element);
                            if (result) {
                                $("#datatable-responsive").find('#' + element.id).find('td:eq(5)').text("Cancelled");
                                $("#datatable-responsive").find('#' + element.id).find('td:eq(6)').empty();

                                $.confirm({
                                    title: 'Successfully saved the changes!',
                                    content: '',
                                    type: 'green',
                                    typeAnimated: true,
                                    buttons: {
                                        close: function() {}
                                    }
                                });
                            } else {
                                $.confirm({
                                    title: 'Encountered an error!',
                                    content: 'Failed to save the details',
                                    type: 'red',
                                    typeAnimated: true,
                                    buttons: {
                                        close: function() {}
                                    }
                                });
                            }
                        } else {
                            $.confirm({
                                title: 'Encountered an error!',
                                content: 'Failed to save the details',
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    close: function() {}
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
                                close: function() {}
                            }
                        });
                    }
                },
                cancel: function() {
                    //close
                },
            },
            onContentReady: function() {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function(e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }


    function authenticate(password) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/payment_proccess.php",
            data: {
                authenticate: true,
                password: password
            },
            dataType: 'json',
            async: false,
            success: function(data) {
                result = data;
            }
        });
        return result;
    }
</script>
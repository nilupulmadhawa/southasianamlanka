<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Payment History Report</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="row" id="divInvoice">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2 id="title">Select Invoices</h2>
                            <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i
                                    class="glyphicon glyphicon-print"></i> Print</button>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="container-fluid  ">




                                <ul class="nav nav-tabs bar_tabs">
                                    <li class="active"><a data-toggle="tab" href="#div1">Customer Vise Filter</a></li>
                                    <li><a data-toggle="tab" href="#div2">Date Range Filter</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="div1" class="tab-pane fade in active">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                            <label>Filter Invoice</label>
                                            <div class="ui-widget">
                                                <select class="form-control selectpicker" data-show-subtext="true"
                                                    data-live-search="true" id="cmbFilter" name="filter_id" required="">
                                                    <option selected="" value="all">All Invoices</option>
                                                    <!-- <option value="retail">Retail Invoices</option> -->
                                                    <?php
                                                    foreach (Customer::find_all_asc() as $customer) {
                                                        ?>
                                                    <option value="<?php echo $customer->id; ?>">
                                                        <?php echo $customer->name; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                            <label>Invoice</label>
                                            <div class="ui-widget">
                                                <select class="form-control" id="cmbInvoice" name="invoice_id"
                                                    required="">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div2" class="tab-pane fade">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                            <label>From</label>
                                            <input type="text" class="form-control" placeholder="yyyy-mm-dd"
                                                id="dtpFrom" name="dtpFrom">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                            <label>To</label>
                                            <input type="text" class="form-control" placeholder="yyyy-mm-dd " id="dtpTo"
                                                name="dtpTo">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br />
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="table-responsive" id="table_body">
                                <label>Select invoice to continue..</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->

<?php include 'common/bottom_content.php'; ?>

<script>
window.onload = function() {
    loadForm();
};

$("#dtpFrom").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd'
});

$("#dtpTo").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd'
});

function loadForm() {
    loadInvoices("all");
}

$("#cmbFilter").change(function() {
    var filter_id = $("#cmbFilter").val();
    loadInvoiceForm();
    loadInvoices(filter_id);
});


function loadInvoiceForm() {
    $('#cmbInvoice').prop('selectedIndex', null);
    $("#txtInvoiceAmount").val(null);
}

function loadInvoices(filter_id) {
    $('#cmbInvoice').empty();
    loadTable();
    var trHTML = "";
    trHTML += "<option disabled='' selected='' value=''>Select Invoice</option>";
    $.ajax({
        type: 'POST',
        url: "proccess/payment_proccess.php",
        data: {
            invoice_request: true,
            filter_id: filter_id
        },
        dataType: 'json',
        async: false,
        success: function(data) {
            $.each(data, function(index, value) {
                trHTML += "<option value='" + value["id"] + "'>" + value["code"] + " ( " + value[
                        "date_time"] + value["customer_id"] + " - Total:" + value["net_amount"] +
                    " - Balance:" + value["balance"] + ")</option>";
            });
        }
    });
    $('#cmbInvoice').append(trHTML);
}

$('#cmbInvoice').change(function() {
    var invoice = $('#cmbInvoice').val();
    if (invoice !== null) {
        //            alert(invoice);
        loadPayments(invoice);
        //
    }
});

function loadTable() {
    $('#table_body').empty();
    $('#table_body').html("<label>Select invoice to continue..</label>");
}

function loadPayments(invoice) {
    if (invoice) {
        $.ajax({
            url: 'proccess/payment_history_process.php?filter_id=' + invoice
        }).done(function(data) { // data what is sent back by the php page
            $('#table_body').html(data); // display data
        });
    }
}


$('#btn_print').click(function() {
    PrintDiv();
});

function PrintDiv() {
    var divToPrint = document.getElementById('table_body');
    var popupWin = window.open('', '_blank', 'width=800,height=500');
    popupWin.document.open();
    popupWin.document.write(
        '<html><head><link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()"><br/><h3 style="text-align:center;">Payment History Report</h3><hr><br/><div>' +
        divToPrint.innerHTML + '</div></body></html>');
    popupWin.document.close();
}

$('#dtpTo').change(function() {
    var from = $('#dtpFrom').val();
    var to = $('#dtpTo').val();
    //        alert(from+" / "+to);
    loadPaymentsByDateRange(from, to);
});

function loadPaymentsByDateRange(from, to) {
    if (from && to) {
        $.ajax({
            url: 'proccess/payment_history_by_date_range_process.php?from=' + from + '&to=' + to +
                '&filter=true'
        }).done(function(data) { // data what is sent back by the php page
            $('#table_body').html(data);
            //                $('#table_body').empty();
            //                if(data){
            //                    // display data
            //                }else{
            //                    loadTable();
            //                }
            //
        });
    }
}
</script>
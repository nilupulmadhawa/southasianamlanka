<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

unset($_SESSION["invoice_payments"]);

if (!(isset($_POST["id"]) && $payment = Payment::find_by_id($_POST["id"]))) {
  $payment = new Payment();
}
?>

<!--page content-->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Payment</h3>
      </div>

      <div class="title_right">
      </div>
    </div>

    <div class="clearfix"></div>

    <?php Functions::output_result(); ?>

    <div class="row" id="divInvoice">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 id="title">Select Invoices</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container-fluid divBackTopTable ">
              <div class="form-group col-md-4 col-sm-4 col-xs-12 ">
                <label>Filter Invoice</label>
                <div class="ui-widget">
                  <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" id="cmbFilter" name="filter_id" required selected>
                    <!-- <option selected="" value="all">All Invoices</option> -->
                    <!-- <option value="retail">Retail Invoices</option> -->
                    <option selected disabled>SELECT CUSTOMER</option>
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
              <div class="form-group col-md-8 col-sm-8 col-xs-12 ">
                <label>Invoice</label>
                <div class="ui-widget">
                  <select class="form-control" id="cmbInvoice" name="invoice_id" required="">

                  </select>
                </div>
              </div>
              <div class="form-group col-md-8 col-sm-8 col-xs-12 ">
                <label>Amount</label>
                <input type="text" class="form-control" placeholder="Amount" id="txtInvoiceAmount">
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12 ">
                <label>Action</label>
                <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-down"></i> Add</button>
              </div>

            </div>
            <br/>
            <div class="table-responsive">
              <table id="tbl" class="table table-bordered table-condensed table-striped table-responsive customBorder">
                <thead>
                  <tr>
                    <th>Invoice</th>
                    <th>Date/Time</th>
                    <th>NetAmount</th>
                    <th>Balance</th>
                    <th>Payment</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 id="title"><?php echo (empty($payment->id)) ? 'Add' : 'Edit'; ?> Payment</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form id="form" action="proccess/payment_proccess.php" method="post" class="form-horizontal form-label-left" >
              <div class="container-fluid ">
                <input type="hidden" class="form-control" id="txtId" name="id" value="<?php echo $payment->id; ?>" />
                <div class="form-group">
                  <label>Payment Code</label>
                  <input type="text" id="txtPaymentCode" name="code" class="form-control" value="<?php echo (empty($payment->id)) ? Payment::getNextCode() : $payment->code; ?>" required="required" readonly=""/>
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
                      if ($paymentmethod->id == $payment->payment_method_id) {
                        ?>
                        <option selected="" value="<?php echo $paymentmethod->id; ?>"><?php echo $paymentmethod->name; ?></option>
                        <?php
                      } else {
                        ?>
                        <option value="<?php echo $paymentmethod->id; ?>"><?php echo $paymentmethod->name; ?></option>
                        <?php
                      }
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
                      <div id='branch' lass="form-group">
                        <label>Branch</label>
                        <input type="text" class="form-control" placeholder="Branch" name="c_branch" id="txtBranch">
                      </div>
                      <br>
                      <div class="form-group">
                        <label id='chq_no'>Cheque Number</label>
                        <input type="text" class="form-control" placeholder="Cheque Number" name="c_number" id="txtChequeNo">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12" >
                      <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control" placeholder="Date" name="c_date" id="dtpChequeDate">
                      </div>
                      <div id="chq_val" class="form-group">
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
              <!--<div class="modal-footer col-md-12 col-sm-12 col-xs-12">-->
              <div class=" col-md-4 col-sm-4 col-xs-12">
                <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
              </div>
              <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($payment->id)) ? 'none' : 'initial'; ?>">
                <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
              </div>
              <div class=" col-md-4 col-sm-4 col-xs-12">
                <a href="payment.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
              </div>
              <!--</div>-->
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
  loadForm();
};

function loadForm() {
  //        fillTable();
  // loadInvoices("all");
}

$(function () {
  //        $("#cmbInvoice").combobox();
});

$(function () {
  $("#dtpDate").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd'
  });
});

$(function () {
  $("#dtpChequeDate").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd'
  });
});

$("#cmbFilter").change(function () {
  var filter_id = $("#cmbFilter").val();
  loadInvoiceForm();
  loadInvoices(filter_id);
});

function loadInvoices(filter_id) {
  $('#cmbInvoice').empty();
  var trHTML = "";
  trHTML += "<option value=''>Select Invoice</option>";
  $.ajax({
    type: 'POST',
    url: "proccess/payment_proccess.php",
    data: {invoice_request: true, filter_id: filter_id},
    dataType: 'json',
    async: false,
    success: function (data) {
      $.each(data, function (index, value) {
        trHTML += "<option value='" + value["id"] + "'>" + value["code"] + " ( " + value["date_time"] + value["customer_id"] + " - Total:" + value["net_amount"] + " - Balance:" + value["balance"] + "</option>";
      });
    }
  });
  $('#cmbInvoice').append(trHTML);
}

$("#cmbPaymentMethod").change(function () {
  var payment_method_id = $("#cmbPaymentMethod").val();
  loadPaymentMethod(payment_method_id);
});

function loadPaymentMethod(payment_method_id) {
  if (payment_method_id == 2) {
    $("#divCheque").css({"display": "initial"});
    $("#txtAmount").prop('disabled', true);
    $("#chq_no").html("Cheque Number");
    $("#txtChequeNo").attr("placeholder", "Cheque Number");
    $("#chq_val").show();
    $("#branch").show();


  } else {

    $("#divCheque").css({"display": "initial"});
    $("#txtAmount").prop('disabled', false);
    $("#chq_no").html("Account Number");
    $("#txtChequeNo").attr("placeholder", "Account Number");
    $("#chq_val").hide();
    $("#branch").hide();


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



$("#cmbInvoice").change(function () {
  var invoice_id = $("#cmbInvoice").val();
  $("#txtInvoiceAmount").val(getBalance(invoice_id));
});

function getBalance(invoice_id) {
  var result;
  $.ajax({
    type: 'POST',
    url: "proccess/payment_proccess.php",
    data: {invoice_balance: true, invoice_id: invoice_id},
    dataType: 'json',
    async: false,
    success: function (data) {
      result = data;
    }
  });
  return result;
}

function loadInvoiceForm() {
  $('#cmbInvoice').prop('selectedIndex', null);
  $("#txtInvoiceAmount").val(null);
}

function checkSession(id) {
  var result;
  $.ajax({
    type: 'POST',
    url: "proccess/payment_proccess.php",
    data: {check_session: true, id: id},
    dataType: 'json',
    async: false,
    success: function (data) {
      result = data;
    }
  });
  return result;
}

function getInvoiceErrors() {
  var errors = new Array();
  var element;
  var element_value;

  element = $("#cmbInvoice");
  element_value = element.val();
  if (element_value) {
    if (checkSession(element_value)) {
      errors.push("Invoice - Already added to the table!");
      element.css({"border": "1px solid red"});
    } else {
      element.css({"border": "1px solid #ccc"});
    }
  } else {
    errors.push("Invoice - Not Selected");
    element.css({"border": "1px solid red"});
  }

  // element = $("#txtInvoiceAmount");
  // element_value = element.val();
  // if (element_value !== "" && (Validation.validatePrice(element_value))) {
  //     var invoice_id = $("#cmbInvoice").val();
  //     if (invoice_id && parseInt(getBalance(invoice_id)) >= element_value) {
  //         element.css({"border": "1px solid #ccc"});
  //     } else {
  //         errors.push("Amount is higher than the invoice balance ");
  //         element.css({"border": "1px solid red"});
  //     }
  // } else {
  //     errors.push("Invoice Amount - Invalid");
  //     element.css({"border": "1px solid red"});
  // }

  return errors;
}

$("#btnAdd").click(function (e) {
  e.preventDefault;
  addInvoice();
});

function addInvoice() {
  var errors = getInvoiceErrors();
  if (errors === undefined || errors.length === 0) {
    var invoice_id = $("#cmbInvoice").val();
    var amount = $("#txtInvoiceAmount").val();

    $.ajax({
      type: "POST",
      url: "proccess/payment_proccess.php",
      data: {add_invoice_payment: true, invoice_id: invoice_id, amount: amount},
      success: function (data) {
        //                    calculate_final_total();
        fillTable();
        loadInvoiceForm();
        new PNotify({
          title: 'Success',
          text: 'Invoice added to the table!',
          type: 'success',
          styling: 'bootstrap3'
        });
      },
      error: function (xhr) {
        $.alert(xhr.responseText);
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

function getTotal() {
  var result;
  $.ajax({
    type: 'POST',
    url: "proccess/payment_proccess.php",
    data: {total_request: true},
    dataType: 'json',
    async: false,
    success: function (data) {
      result = data.toFixed(2);
    }
  });
  return result;
}

function fillTable() {
  $('#tbl tbody').remove();
  $.ajax({
    type: 'POST',
    url: "proccess/payment_proccess.php",
    data: {invoice_payments_request: true},
    dataType: 'json',
    async: false,
    success: function (data) {
      var trHTML = "";
      $.each(data.invoice_payments, function (index, value) {
        var btnEdit = "<button type='button' onclick='editRow(this)' id='" + value["index"] + "' class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-edit'></i> Edit</button>";
        var btnClose = "<button type='button' onclick='removeRow(this)' id='" + value["index"] + "' class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>";

        trHTML += "<tr id='" + value["index"] + "'><td>" + value["invoice_id"]["code"] + "</td><td>" + value["invoice_id"]["date_time"] + "</td><td>" + value["invoice_id"]["net_amount"] + "</td><td>" + value["invoice_id"]["balance"] + "</td><td>" + value["amount"] + "</td><td class='col-sm-2'>" + btnEdit + btnClose + "</td></tr>";
      });

      $('#txtAmount').val(data.total.toFixed(2));
      $('#tbl').append(trHTML);
    }
  });
}

function removeRow(element) {
  $.ajax({
    type: "POST",
    url: "proccess/payment_proccess.php",
    data: {remove_item: true, index: element.id},
    success: function (data) {
      fillTable();
      loadInvoiceForm();
      new PNotify({
        title: 'Success',
        text: 'Product removed from table!',
        type: 'success',
        styling: 'bootstrap3'
      });
    }
  });
}

function removeRow(element) {
  $.ajax({
    type: "POST",
    url: "proccess/payment_proccess.php",
    data: {remove_item: true, index: element.id},
    success: function (data) {
      fillTable();
      loadInvoiceForm();
      new PNotify({
        title: 'Success',
        text: 'Product removed from table!',
        type: 'success',
        styling: 'bootstrap3'
      });
    }
  });
}

function editRow(element) {
  $.ajax({
    type: 'POST',
    url: "proccess/payment_proccess.php",
    data: {invoice_payment_request: true, index: element.id},
    dataType: 'json',
    async: false,
    success: function (data) {
      fillTable();

      //                $('#cmbFilter').prop('selectedIndex', 0);
      $('#cmbFilter').val("all");
      loadInvoices("all");

      //                $('#cmbInvoice').prop('selectedIndex', data.invoice_id);
      $('#cmbInvoice').val(data.invoice_id);
      $("#txtInvoiceAmount").val(data.amount);

      scrollTo("#divInvoice");

    }
  });
}

function scrollTo(element_id) {
  $('html,body').animate({scrollTop: $("#" + element_id).offset().top}, 'slow');
}



//////////////////////////////////////////////////
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


function sessionCount() {
  var result;
  $.ajax({
    type: 'POST',
    url: "proccess/payment_proccess.php",
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

  element = $("#txtPaymentCode");
  element_value = element.val();
  if (element_value === "") {
    errors.push("Payment Code - Invalid");
    element.css({"border": "1px solid red"});
  } else {
    element.css({"border": "1px solid #ccc"});
  }

  // element = $("#txtAmount");
  // element_value = element.val();
  // if (element_value !== "" && Validation.validatePrice(element_value)) {
  //     if (element_value > 0) {
  //         if (element_value == getTotal()) {
  //             element.css({"border": "1px solid #ccc"});
  //         } else {
  //             errors.push("Amount is different than total invoice payments");
  //             element.css({"border": "1px solid red"});
  //         }
  //     } else {
  //         errors.push("Amount - Invalid");
  //         element.css({"border": "1px solid red"});
  //     }
  // } else {
  //     errors.push("Amount - Invalid");
  //     element.css({"border": "1px solid red"});
  // }

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


  var sess_count = sessionCount();
  element = $("#tbl");
  element_value = element.val();
  if (sess_count) {
    element.css({"border": "1px solid #ccc"});
  } else {
    errors.push("Invoices - Not selected");
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
  //        var id = <?php // echo ($payment->id) ? 1 : 0;               ?>;

  if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Payment", "ins")) {
    FormOperations.confirmSave(validateForm(), "#form");
  }

});

//    $("#btnDelete").click(function () {
//        FormOperations.confirmDelete("#form");
//    });

</script>

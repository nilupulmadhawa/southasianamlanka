<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

//if (!(isset($_POST["id"]) && $cheque = Cheque::find_by_id($_POST["id"]))) {
//    $cheque = new Cheque();
//}
?>

<!--page content--> 
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Bin Card</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <?php Functions::output_result(); ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="form" action="proccess/bin_card_proccess.php" method="post" class="form-horizontal form-label-left" >
                            <div class="form-group col-md-3 col-sm-3 col-xs-12 ">
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
                            <div class="form-group col-md-3 col-sm-3 col-xs-12 ">
                                <label>From</label>
                                <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtFrom" name="from" required="">
                            </div>
                            <div class="form-group col-md-3 col-sm-3 col-xs-12 ">
                                <label>To</label>
                                <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtTo" name="to" required="">
                            </div>
                            <div class="form-group col-md-3 col-sm-3 col-xs-12 ">
                                <label>Action</label>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                        <button id="btnView" type="button" class="btn btn-block btn-primary"><i class="fa fa-search"></i> View</button>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                        <a href="bin_card.php"><button type="button" name="reset" class="btn btn-block btn-default"><i class="fa fa-history"></i> Reset</button></a>
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
                    <div class="x_title">
                        <h2 id="lblProduct">Select Product...</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="container-fluid">
                            <table id="tbl" class=" dt table table-striped dt-button-collection table-condensed table-hover"  width="100%">                                                <!--<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%">-->
                                <thead>
                                    <tr>
                                        <th>Date/Time</th>
                                        <!--<th colspan="3">GRN ID</th>-->
                                        <th>GRN ID</th>
                                        <th>Invoice ID</th>
                                        <th>Product Return ID</th>
                                        <th>Qty</th>
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
    </div>
</div>
<!--/page content--> 
<?php include 'common/bottom_content.php'; ?>

<script>
    window.onload = function () {
        loadForm();
    };
    function loadForm() {

    }

    $(function () {
//        $('.dt').DataTable();
    });
    $(function () {
        $("#txtFrom").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
    $(function () {
        $("#txtTo").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
    function getErrors() {
        var errors = new Array();
        var element;
        var element_value;
        
        element = $("#cmbProduct");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Product - Not Selected");
            element.css({"border": "1px solid red"});
        }

//        element = $("#txtFrom");
//        element_value = element.val();
//        if (element_value !== "") {
//            element.css({"border": "1px solid #ccc"});
//        } else {
//            errors.push("Form - Invalid");
//            element.css({"border": "1px solid red"});
//        }
//
//        element = $("#txtTo");
//        element_value = element.val();
//        if (element_value !== "") {
//            element.css({"border": "1px solid #ccc"});
//        } else {
//            errors.push("To - Invalid");
//            element.css({"border": "1px solid red"});
//        }

        return errors;
    }

    function validateForm() {
        var errors = getErrors();
        if (errors === undefined || errors.length === 0) {
            return true;
        } else {
//            $.alert({
//                icon: 'fa fa-exclamation-circle',
//                backgroundDismiss: true,
//                type: 'red',
//                title: 'Validation error!',
//                content: errors.join("</br>")
//            });
            return false;
        }
    }


    $('#btnView').click(function () {
        fillProductTable();
    });
    function fillProductTable() {
        $('#tbl tbody').remove();
//        $('#tbl tbody').clear();

        var product_id = $("#cmbProduct").val();
        var from = $("#txtFrom").val();
        var to = $("#txtTo").val();
        if (validateForm()) {
            $.ajax({
                type: 'POST',
                url: "proccess/bin_card_proccess.php",
                data: {bin_card_request: true, product_id: product_id, from: from, to: to},
                dataType: 'json',
                async: false,
                success: function (data) {
                    var trHTML = "";
//                    var count;
                    $.each(data, function (index, value) {
//                        ++count ;
                        var grn = "";
                        var invoice = "";
                        var product_return = "";
                        var background = "";

                        if (value["tbl"] == "grn") {
                            grn = value["id"];
                            background = "#ccffff";
                        } else if (value["tbl"] == "invoice") {
                            invoice = value["id"];
                            background = "#ccffcc";
                        } else if (value["tbl"] == "product_return") {
                            product_return = value["id"];
                            background = "#ffffcc";
//                            background = "#ffccff";
                        }

                        trHTML += "<tr style='background-color:" + background + "' id='" + value["id"] + "'><td>" + value["date_time"] + "</td><td>" + grn + "</td><td>" + invoice + "</td><td>" + product_return + "</td><td>" + value["qty"] + "</td></tr>";
                    });

                    $('#tbl').append(trHTML);
                    $('#lblProduct').text(data[0]["product"]);
//                    alert(count);
                },
                error: function (xhr) {
                    alert(xhr.responseText);
                }
            });
        }
    }

</script>

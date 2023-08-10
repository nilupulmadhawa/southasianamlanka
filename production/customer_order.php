<?php
require_once './../util/initialize.php';
require_once './../util/validate_login.php';


unset($_SESSION["customer_order_products"]);

//if (isset($_POST["id"]) && $customer_order = CustomerOrder::find_by_id($_POST["id"])) {
//    if ($db_customer_order_products = CustomerOrderProduct::find_all_by_customer_order_id($customer_order->id)) {
//        $customer_order_products = array();
//        foreach ($db_customer_order_products as $db_customer_order_product) {
//            $customer_order_product = array();
//            $customer_order_product["id"] = $db_customer_order_product->id;
//            $customer_order_product["order_id"] = $db_customer_order_product->customer_order_id;
//            $customer_order_product["product_id"] = $db_customer_order_product->product_id;
//            $customer_order_product["qty"] = $db_customer_order_product->qty;
//
//            $customer_order_products[] = $customer_order_product;
//        }
//
//        $_SESSION["customer_order_products"] = $customer_order_products;
//    }
//} else {
//    $customer_order = new CustomerOrder();
//}

if (isset($_GET["id"])) {
    $id = Functions::custom_crypt($_GET["id"], 'd');
    if ($customer_order = CustomerOrder::find_by_id($id)) {
        if ($db_customer_order_products = CustomerOrderProduct::find_all_by_customer_order_id($customer_order->id)) {
            $customer_order_products = array();
            foreach ($db_customer_order_products as $db_customer_order_product) {
                $customer_order_product = array();
                $customer_order_product["id"] = $db_customer_order_product->id;
                $customer_order_product["order_id"] = $db_customer_order_product->customer_order_id;
                $customer_order_product["product_id"] = $db_customer_order_product->product_id;
                $customer_order_product["qty"] = $db_customer_order_product->qty;

                $customer_order_products[] = $customer_order_product;
            }

            $_SESSION["customer_order_products"] = $customer_order_products;
        }
    } else {
        Session::set_error("Entry not available...");
        $customer_order = new CustomerOrder();
    }
} else {
    $customer_order = new CustomerOrder();
}

include 'common/upper_content.php';
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Customer Order</h3>
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
                        <h2 id="title"><?php echo (empty($customer_order->id)) ? 'Add' : 'Edit'; ?>Customer Order</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="frmOrder" action="proccess/customer_order_proccess.php" method="post" class="form-horizontal form-label-left" >
                            <input type="hidden" id="id" name="id" value="<?php echo $customer_order->id; ?>">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" id="code" name="code" value="<?php echo (empty($customer_order)) ? $customer_order->code : CustomerOrder::getNextCode(); ?>" readonly="" required="" class="form-control col-md-7 col-xs-12">
                                </div>

                                <div class="form-group">
                                    <label>Customer</label>
                                    <select class="form-control" id="cmbCustomer" name="customer_id" required="">
                                        <option disabled="" selected="">Select Customer</option>
                                        <?php
                                        foreach (Customer::find_all() as $customer) {
                                            if ($customer->id == $customer_order->customer_id) {
                                                ?>
                                                <option selected="" value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Order Products</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="container-fluid divBackTopTable">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
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
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" id="qty" name="number" value="1" required="required" min="1" max="5000" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Action</label>
                                    <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="glyphicon glyphicon-chevron-down"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="x_content">
                            <table id="tblOP" class="table table-bordered table-responsive customBorder">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th class="col-sm-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                            </div>
                            <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo ($customer_order->id) ? 'initial' : 'none'; ?>">
                                <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                            </div>
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <a href="product_purchase_order.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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
//        $.alert({
//            type: 'red',
//            title: 'Welcome!',
//            content: 'Mahesh!'
//        });
        fillProductTable();
    };

    function fillProductTable() {
        $('#tblOP tbody').remove();
        $.ajax({
            type: 'POST',
            url: "proccess/customer_order_proccess.php",
            data: {customer_order_product_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                var trHTML = "";
                $.each(data, function (index, value) {
                    var btnRemove = "<button type='button' onclick='removeProduct(this)' id='" + data[index]["index"] + "'class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>"
                    trHTML += "<tr id='" + data[index]["index"] + "'><td>" + data[index]["category"] + "</td><td>" + data[index]["product_id"] + "</td><td>" + data[index]["qty"] + "</td><td>" + btnRemove + "</td></tr>";
                });
                $('#tblOP').append(trHTML);
            }
        });
    }

    function checkProduct(id) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/customer_order_proccess.php",
            data: {check_customer_product: true, id: id},
            dataType: 'json',
            async: false,
            success: function (data) {
                result = data;
            }
        });
        return result;
    }

    function getProductErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#cmbProduct");
        element_value = element.val();
        if (!element_value) {
            errors.push("Product - Not Selected");
            element.css({"border": "1px solid red"});
        } else {
            if (checkProduct(element_value)) {
                errors.push("Product - Already added");
                element.css({"border": "1px solid red"});
            } else {
                element.css({"border": "1px solid #ccc"});
            }
//            element.css({"border": "1px solid #ccc"});
        }

        element = $("#qty");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Quantity - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }



        return errors;
    }

    function clearProductForm() {
        $('#cmbProduct').prop('selectedIndex', 0);
        $("#qty").val(1);
    }


    $('#btnAdd').click(function (e) {
        e.preventDefault();
        addProduct();
    });

    function addProduct() {
        var errors = getProductErrors();
        if (errors === undefined || errors.length === 0) {

            var product = $("#cmbProduct").val();
            var qty = $("#qty").val();
            $.ajax({
                type: "POST",
                url: "proccess/customer_order_proccess.php",
                data: {add_customer_product: true, product_id: product, qty: qty},
                success: function (data) {
                    fillProductTable();
                    clearProductForm();
                    new PNotify({
                        title: 'Success',
                        text: 'Product added to the table!',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
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

    function removeProduct(element) {
        $.ajax({
            type: "POST",
            url: "proccess/customer_order_proccess.php",
            data: {remove: true, index: element.id},
            success: function (data) {
                fillProductTable();
                new PNotify({
                    title: 'Success',
                    text: 'Product removed from temporary table!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function clearPOProducts() {
        $.ajax({
            type: "POST",
            url: "proccess/customer_order_proccess.php",
            data: {clear_customer_order_products: true},
            success: function (data) {

            }
        });
    }







    ///////////////////////////////////Common

    function getErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#code");
        element_value = element.val();
        if (element_value == "") {
            errors.push("Code - Not valid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#cmbCustomer");
        element_value = element.val();
        if (!element_value) {
            errors.push("Customer - Not selected");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
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
        var id = <?php echo ($customer_order->id) ? 1 : 0; ?>;
        FormOperations.confirmSave(validateForm(), "#frmOrder", id);
    });

    $("#btnDelete").click(function () {
        FormOperations.confirmDelete("#frmOrder");
    });

</script>
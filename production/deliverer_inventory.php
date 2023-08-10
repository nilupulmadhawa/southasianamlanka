<?php
require_once './../util/validate_login.php';
require_once './../util/initialize.php';
include 'common/upper_content.php';

unset($_SESSION["deliverer_inventorys"]);

//$deliverer;
//if (isset($_POST["deliverer_id"]) && $db_deliverer_inventorys = DelivererInventory::find_all_by_deliverer_id($_POST["deliverer_id"])) {
//    $deliverer = Deliverer::find_by_id($_POST["deliverer_id"]);
//    $deliverer_inventorys = array();
//    foreach ($db_deliverer_inventorys as $deliverer_inventory) {
//        $deliverer_inventorys[] = $deliverer_inventory->to_array();
//    }
//    $_SESSION["deliverer_inventorys"] = $deliverer_inventorys;
//} else {
//    $deliverer = new Deliverer();
//    unset($_SESSION["deliverer_inventorys"]);
//}

$deliverer;
if (isset($_GET["deliverer_id"])) {
    $id = Functions::custom_crypt($_GET["deliverer_id"], 'd');
    if ($db_deliverer_inventorys = DelivererInventory::find_by_id($id)) {
        $deliverer = Deliverer::find_by_id($_POST["deliverer_id"]);
        $deliverer_inventorys = array();
        foreach ($db_deliverer_inventorys as $deliverer_inventory) {
            $deliverer_inventorys[] = $deliverer_inventory->to_array();
        }
        $_SESSION["deliverer_inventorys"] = $deliverer_inventorys;
    } else {
        $deliverer = new Deliverer();
    }
} else {
    $deliverer = new Deliverer();
}
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Deliverer Products</h3>
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
                        <h2 id="title"><?php echo (empty($product->id)) ? 'Add' : 'Edit'; ?> Deliverer Products</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="x_content">
                            <form id="form" action="proccess/deliverer_inventory_proccess.php" method="post" class="form-horizontal form-label-left" >
                                <input type="hidden" id="id" name="id" value="<?php echo $purchase_order->id; ?>">
                                <div class="form-group">

                                    <div class="form-group">
                                        <label>Deliverer</label>
                                        <select class="form-control" id="cmbDeliverer" name="deliverer_id" required="">
                                            <option disabled="" selected="">Select Deliverer</option>
                                            <?php
                                            foreach (Deliverer::find_all() as $db_deliverer) {
                                                if ($db_deliverer->id == $deliverer->id) {
                                                    ?>
                                                    <option selected="" value="<?php echo $db_deliverer->id; ?>"><?php echo $db_deliverer->number; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $db_deliverer->id; ?>"><?php echo $db_deliverer->number; ?></option>
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
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Deliverer Products</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="container-fluid divBackTopTable">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Inventory Product</label>
                                    <select class="form-control" id="cmbInventory" name="inventory_id" required="">
                                        <option disabled="" selected="">Select Inventory Product</option>
                                        <?php
                                        foreach (Inventory::find_all_by_product_asc() as $inventory) {
                                            ?>
                                            <option value="<?php echo $inventory->id; ?>"><?php echo $inventory->batch_id()->product_id()->name." | Batch:".$inventory->batch_id()->code; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Quantity </label><label id="lblAvlQty"></label>
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
                        <div class="x_content"></div>
                        <div class="x_content">
                            <table id="tbl" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Batch</th>
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
                            <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo ($deliverer->id) ? 'initial' : 'none'; ?>">
                                <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                            </div>
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <a href="deliverer_inventory.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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
        fillTable();
    };

    function getAvailableQty(inventory_id) {
        var qty;
        $.ajax({
            type: 'POST',
            url: "proccess/deliverer_inventory_proccess.php",
            data: {available_qty: true, inventory_id: inventory_id},
            dataType: 'json',
            async: false,
            success: function (data) {
                qty = data;
            }
        });
        return qty;
    }

    $("#cmbInventory").change(function () {
        var inventory_id = $("#cmbInventory").val();
        $('#lblAvlQty').text("- (Available Quantity : " + getAvailableQty(inventory_id) + ")");
    });

    $("#cmbDeliverer").change(function () {
        var deliverer_id = $("#cmbDeliverer").val();
        reloadInventories(deliverer_id);
    });

    function reloadInventories(deliverer_id) {
        if (deliverer_id) {
            $.ajax({
                type: 'POST',
                url: "proccess/deliverer_inventory_proccess.php",
                data: {reload_deliverer_inventory: true, deliverer_id: deliverer_id},
                success: function (data) {
                    fillTable();
                }
            });
        }
    }

    function fillTable() {
        $('#tbl tbody').remove();
        $.ajax({
            type: 'POST',
            url: "proccess/deliverer_inventory_proccess.php",
            data: {inventory_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {                
                var trHTML = "";
                $.each(data, function (index, value) {
                    var btnRemove = "<button type='button' onclick='removeRow(this)' id='" + value["index"] + "'class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>";
                    trHTML += "<tr id='" + value["index"] + "'><td>" + value["inventory_id"] + "</td><td>" + value["batch_id"] + "</td><td>" + value["qty"] + "</td><td>" + btnRemove + "</td></tr>";
//                    trHTML += "<tr><td>" + JSON.stringify(value) +"</td></tr>";
                });
                $('#tbl').append(trHTML);
            }
        });
    }

    function checkProduct(id) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/deliverer_inventory_proccess.php",
            data: {check_inventory: true, id: id},
            dataType: 'json',
            async: false,
            success: function (data) {
                result = data;
            }
        });
        return result;
    }

    function getInventoryErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#cmbInventory");
        element_value = element.val();
        if (!element_value) {
            errors.push("Inventory - Not Selected");
            element.css({"border": "1px solid red"});
        } else {
//            if (checkProduct(element_value)) {
//                errors.push("Inventory - Already added");
//                element.css({"border": "1px solid red"});
//            } else {
//                element.css({"border": "1px solid #ccc"});
//            }
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#qty");
        element_value = element.val();
        if (element_value === "" || element_value == 0) {
            errors.push("Quantity - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            var inventory_id = $("#cmbInventory").val();
            var pmq = getAvailableQty(inventory_id);
            if (element_value > pmq) {
                errors.push("Quantity - Exceeds the actual inventrory");
                element.css({"border": "1px solid red"});
            } else {
                element.css({"border": "1px solid #ccc"});
            }
        }

        return errors;
    }

    function clearProductForm() {
        $('#lblAvlQty').text("");
        $('#cmbInventory').prop('selectedIndex', 0);
        $("#qty").val(1);
    }


    $('#btnAdd').click(function (e) {
        e.preventDefault();
        addInventory();
    });

    function addInventory() {
        var errors = getInventoryErrors();
        if (errors === undefined || errors.length === 0) {
            var inventory = $("#cmbInventory").val();
            var qty = $("#qty").val();

            $.ajax({
                type: "POST",
                url: "proccess/deliverer_inventory_proccess.php",
                data: {add_inventory: true, inventory_id: inventory, qty: qty},
                success: function (data) {
                    fillTable();
                    clearProductForm();
                    new PNotify({
                        title: 'Success',
                        text: 'Product added to the temporary table!',
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

    function removeRow(element) {
        $.ajax({
            type: "POST",
            url: "proccess/deliverer_inventory_proccess.php",
            data: {remove: true, index: element.id},
            success: function (data) {
                fillTable();
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
            url: "proccess/deliverer_inventory_proccess.php",
            data: {clearPOProducts: true},
            success: function (data) {

            }
        });
    }







    ///////////////////////////////////Common
    function sessionCount() {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/deliverer_inventory_proccess.php",
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

//        element = $("#code");
//        element_value = element.val();
//        if (element_value == "") {
//            errors.push("Code - Not valid");
//            element.css({"border": "1px solid red"});
//        } else {
//            element.css({"border": "1px solid #ccc"});
//        }

        element = $("#cmbDeliverer");
        element_value = element.val();
        if (!element_value) {
            errors.push("Deliverer - Not selected");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

//        var tbl_inventorys = sessionCount();
//        element = $("#tbl");
//        element_value = element.val();
//        if (!tbl_inventorys) {
//            errors.push("Inventory products - Not selected");
//            element.css({"border": "1px solid red"});
//        } else {
//            element.css({"border": "1px solid #ccc"});
//        }

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
//        confirmSave();

        if (id) {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "DelivererInventory", "upd")) {
                FormOperations.confirmSave(validateForm(), "#form");
            }
        } else {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "DelivererInventory", "ins")) {
                FormOperations.confirmSave(validateForm(), "#form");
            }
        }
    });

    $("#btnDelete").click(function () {
//        confirmDelete();
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "DelivererInventory", "del")) {
            FormOperations.confirmDelete("#form");
        }
    });


//    function confirmSave() {
//        if (validateForm()) {
////            var product_id = <?php // echo ($deliverer->id) ? 1 : 0;          ?>;

//            if (product_id) {
//                $.confirm({
//                    icon: 'fa fa-question-circle',
//                    type: 'green',
//                    title: 'Save(Update)',
//                    content: 'Are you sure you want to proceed ?',
//                    buttons: {
//                        yes: {
//                            text: 'Yes',
//                            btnClass: 'btn-green',
//                            keys: ['enter'],
//                            action: function () {
//                                $("#formPO").append($('<input />').attr('type', 'hidden').attr('name', "update").attr('value', "true"));
//                                $("#formPO").submit();
//                            }
//                        },
//                        cancel: function () {
//                        }
//                    }
//                });
//            } else {
//                $.confirm({
//                    icon: 'fa fa-question-circle',
//                    type: 'green',
//                    title: 'Save',
//                    content: 'Are you sure you want to proceed ?',
//                    buttons: {
//                        yes: {
//                            text: 'Yes',
//                            btnClass: 'btn-green',
//                            keys: ['enter'],
//                            action: function () {
//                                $("#form").append($('<input />').attr('type', 'hidden').attr('name', "save").attr('value', "true"));
//                                $("#form").submit();
//                            }
//                        },
//                        cancel: function () {
//                        }
//                    }
//                });
////            }
//        }
//    }
//
//    function confirmDelete() {
//        $.confirm({
//            icon: 'fa fa-warning',
//            type: 'orange',
//            title: 'Delete',
//            content: 'Are you sure you want to proceed ?',
//            buttons: {
//                yes: {
//                    text: 'Yes',
//                    btnClass: 'btn-orange',
//                    keys: ['enter'],
//                    action: function () {
//                        $("#formPO").append($('<input />').attr('type', 'hidden').attr('name', "delete").attr('value', "true"));
//                        $("#formPO").submit();
//                    }
//                },
//                cancel: function () {
//                }
//            }
//        });
//    }

</script>
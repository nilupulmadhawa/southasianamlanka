<?php
require_once './../util/initialize.php';
require_once './../util/validate_login.php';
include 'common/upper_content.php';

unset($_SESSION["po_materials"]);

if (isset($_POST["id"]) && $purchase_order = PurchaseOrder::find_by_id($_POST["id"])) {
    if ($purchase_order->purchase_order_type_id == 1 && ($po_material = PurchaseOrderMaterial::find_all_by_purchase_order_id($purchase_order->id))) {
        $temp_po_material = array();
        foreach ($po_materials as $po_material) {
            $temp_po_material = array();
            $temp_po_material["material_id"] = $po_material->material_id;
            $temp_po_material["volume"] = $po_material->volume;
            $temp_po_materials[] = $temp_po_material;
        }

        $_SESSION["po_materials"] = $temp_po_material;
    }
} else {
    $purchase_order = new PurchaseOrder();
    unset($_SESSION["po_materials"]);
}
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Purchase Order (Material)</h3>
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
                        <h2 id="title"><?php echo (empty($material->id)) ? 'Add' : 'Edit'; ?> Purchase Order</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="x_content">
                            <form id="formPO" action="proccess/material_purchase_order_proccess.php" method="post" class="form-horizontal form-label-left" >
                                <input type="hidden" id="id" name="id" value="<?php echo $purchase_order->id; ?>">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" id="code" name="code" value="<?php
                                    if (empty($purchase_order)) {
                                        echo $purchase_order->code;
                                    } else {
                                        echo PurchaseOrder::getNextCode();
                                    }
                                    ?>" readonly="" required="" class="form-control col-md-7 col-xs-12">
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="form-control" id="cmbSupplier" name="supplier_id" required="">
                                            <option disabled="" selected="">Select Supplier</option>
                                            <?php
                                            foreach (Supplier::find_all() as $supplier) {
                                                if ($supplier->id == $purchase_order->supplier_id) {
                                                    ?>
                                                    <option selected="" value="<?php echo $supplier->id; ?>"><?php echo $supplier->name; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $supplier->id; ?>"><?php echo $supplier->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!--</form>-->
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Purchase Order Materials</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="container-fluid divBackTopTable">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Material</label>
                                    <select class="form-control" id="cmbMaterial" name="material_id" required="">
                                        <option disabled="" selected="">Select Material</option>
                                        <?php
                                        foreach (Material::find_all() as $material) {
                                            ?>
                                            <option value="<?php echo $material->id; ?>"><?php echo $material->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Volume (Kg)</label>
                                    <input type="text" id="volume" name="volume" value="1" required="required" class="form-control col-md-7 col-xs-12"> 
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Action</label>
                                    <button id="btnAdd" type="button"  class="btn btn-block btn-primary"><i class="glyphicon glyphicon-chevron-down"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <table id="tblPOM" class="table table-bordered table-responsive customBorder">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Volume</th>
                                    <th class="col-sm-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
                            <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo ($purchase_order->id) ? 'initial' : 'none'; ?>">
                                <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                            </div>
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <a href="material_purchase_order.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/page content--> 

<?php include './common/bottom_content.php'; ?>

<script>
    window.onload = function () {
        //        $.alert({
        //            type: 'red',
        //            title: 'Welcome!',
        //            content: 'Mahesh!',
        //        });
        fillMaterialTable();
    };

    function fillMaterialTable() {
        $('#tblPOM tbody').remove();
        $.ajax({
            type: 'POST',
            url: "proccess/material_purchase_order_proccess.php",
            data: {po_material_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                var trHTML = "";
                $.each(data, function (index, value) {
                    var btnRemove = "<button type='button' onclick='removeMaterial(this)' id='" + data[index]["index"] + "'class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>";
                    trHTML += "<tr id='" + data[index]["index"] + "'>" + "<td>" + data[index]["material_id"] + "</td><td>" + data[index]["volume"] + "</td><td>" + btnRemove + "</td></tr>";
                });
                $('#tblPOM').append(trHTML);
            }
        });
    }

    function checkMaterial(id) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/material_purchase_order_proccess.php",
            data: {check_material: true, id: id},
            dataType: 'json',
            async: false,
            success: function (data) {
                result = data;
            }
        });
        return result;
    }

    function getMaterialErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#cmbMaterial");
        element_value = element.val();
        if (!element_value) {
            errors.push("Material - Not Selected");
            element.css({"border": "1px solid red"});
        } else {
            if (checkMaterial(element_value)) {
                errors.push("Material - Already added");
                element.css({"border": "1px solid red"});
            } else {
                element.css({"border": "1px solid #ccc"});
            }

            //   element.css({"border": "1px solid #ccc"});
        }

        element = $("#volume");
        element_value = element.val();

        if (element_value === "" && new RegExp("\d+\.\d{3}").test(element_value)) {
            errors.push("Volume - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }



        return errors;
    }

    function clearMaterialForm() {
        $('#cmbMaterial').prop('selectedIndex', 0);
        $("#volume").val(1);
    }


    $('#btnAdd').click(function (e) {
        e.preventDefault();
        addMaterial();
    });

    function addMaterial() {
        var errors = getMaterialErrors();
        if (errors === undefined || errors.length === 0) {

            var material = $("#cmbMaterial").val();
            var volume = $("#volume").val();

            $.ajax({
                type: "POST",
                url: "proccess/material_purchase_order_proccess.php",
                data: {addMaterial: true, material_id: material, volume: volume},
                success: function (data) {
                    fillMaterialTable();
                    clearMaterialForm();
                    new PNotify({
                        title: 'Success',
                        text: 'Material added to the table!',
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

    function removeMaterial(element) {
        $.ajax({
            type: "POST",
            url: "proccess/material_purchase_order_proccess.php",
            data: {remove: true, index: element.id},
            success: function (data) {
                fillMaterialTable();
                new PNotify({
                    title: 'Success',
                    text: 'Material removed from temporary table!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function clearPOMaterial() {
        $.ajax({
            type: "POST",
            url: "proccess/material_purchase_order_proccess.php",
            data: {clearPOMaterial: true},
            success: function (data) {

            }
        });
    }







    ///////////////////////////////////

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

        element = $("#cmbSupplier");
        element_value = element.val();
        if (!element_value) {
            errors.push("Supplier - Not selected");
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
        var id = <?php echo ($purchase_order->id) ? 1 : 0; ?>;


        if (id) {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "MaterialPO", "upd")) {
                FormOperations.confirmSave(validateForm(), "#formPO", id, null);
            }
        } else {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "MaterialPO", "ins")) {
                FormOperations.confirmSave(validateForm(), "#formPO", id, null);
            }
        }
    });

    $("#btnDelete").click(function () {

        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "MaterialPO", "del")) {
            FormOperations.confirmDelete("#formPO");
        }
    });

</script>
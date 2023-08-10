<?php
require_once './../util/initialize.php';

unset($_SESSION["material_grn_materials"]);

//if (isset($_POST["grn_id"]) && $grn = GRN::find_by_id($_POST["grn_id"])) {
//    $validation = TRUE;
//    if ($grn_materials = GRNMaterial::find_all_by_grn_id($grn->id)) {
//        foreach ($grn_materials as $temp_grn_material) {
//            $grn_material_volume = $temp_grn_material->volume;
//            $stock_volume = MaterialStock::find_by_grn_material_id($temp_grn_material->id)->volume;
//            if ($grn_material_volume != $stock_volume) {
//                $validation = FALSE;
//            }
//        }
//    }
//
//    if ($validation) {
//        $purchase_order = $grn->purchase_order_id();
//        $grn_materials = array();
//        if ($db_grn_materials = GRNMaterial::find_all_by_grn_id($grn->id)) {
//            foreach ($db_grn_materials as $index => $temp_grn_material) {
//                $grn_material = $temp_grn_material->to_array();
//                $grn_materials[] = $grn_material;
//            }
//        }
//        $_SESSION["material_grn_materials"] = $grn_materials;
//    } else {
//        $_SESSION["error"] = "Can't edit GRN, Productions already added to materials related to the GRN you tried to edit.";
//        Functions::redirect_to("./grn_management.php");
//    }
//} else {
//    $grn = new GRN();
//    if (isset($_POST["po_id"]) && $purchase_order = PurchaseOrder::find_by_id($_POST["po_id"])) {
//        // :)
//    } else {
//        $purchase_order = new PurchaseOrder();
////        Functions::redirect_to("./purchase_order_management.php");
//    }
//}

if (isset($_GET["id"])) {
    $id = Functions::custom_crypt($_GET["id"], 'd');
    if ($grn = GRN::find_by_id($id)) {
        $validation = TRUE;
        if ($grn_materials = GRNMaterial::find_all_by_grn_id($grn->id)) {
            foreach ($grn_materials as $temp_grn_material) {
                $grn_material_volume = $temp_grn_material->volume;
                $stock_volume = MaterialStock::find_by_grn_material_id($temp_grn_material->id)->volume;
                if ($grn_material_volume != $stock_volume) {
                    $validation = FALSE;
                }
            }
        }

        if ($validation) {
            $purchase_order = $grn->purchase_order_id();
            $grn_materials = array();
            if ($db_grn_materials = GRNMaterial::find_all_by_grn_id($grn->id)) {
                foreach ($db_grn_materials as $index => $temp_grn_material) {
                    $grn_material = $temp_grn_material->to_array();
                    $grn_materials[] = $grn_material;
                }
            }
            $_SESSION["material_grn_materials"] = $grn_materials;
        } else {
            $_SESSION["error"] = "Can't edit GRN, Productions already added to materials related to the GRN you tried to edit.";
            Functions::redirect_to("./grn_management.php");
        }
    } else {
        Session::set_error("Entry not available...");
        $grn = new GRN();
        if (isset($_POST["po_id"]) && $purchase_order = PurchaseOrder::find_by_id($_POST["po_id"])) {
            // :)
        } else {
            $purchase_order = new PurchaseOrder();
//        Functions::redirect_to("./purchase_order_management.php");
        }
    }
} else {
    $grn = new GRN();
    if (isset($_POST["po_id"]) && $purchase_order = PurchaseOrder::find_by_id($_POST["po_id"])) {
        
    } else {
        $purchase_order = new PurchaseOrder();
//        Functions::redirect_to("./purchase_order_management.php");
    }
}

include './common/upper_content.php';
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Goods Revieved Note (Materials)</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 id="title"><?php echo (empty($grn->id)) ? 'Add' : 'Edit'; ?> Material GRN</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="form" action="proccess/material_grn_proccess.php" method="post" class="form-horizontal form-label-left" >
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" class="form-control" id="txtGRNId" name="grn_id" value="<?php echo $grn->id; ?>"/>
                                <label>GRN Code</label>
                                <input type="text" id="txtGRNCode" name="grn_code" class="form-control" value="<?php echo (empty($grn->id)) ? GRN::getNextCode() : $grn->code; ?>" required="required" readonly=""/>
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Supplier</label>
                                <select class="form-control" id="cmbSupplier" name="supplier_id" required="">
                                    <option selected="" disabled="" >Select Supplier</option>
                                    <?php
                                    foreach (Supplier::find_all() as $db_supplier) {
                                        if ($grn->supplier_id == $db_supplier->id) {
                                            ?>
                                            <option value="<?php echo $db_supplier->id; ?>"><?php echo $db_supplier->name; ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $db_supplier->id; ?>"><?php echo $db_supplier->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>Purchase Order</label>
                                <select class="form-control" id="cmbPO" name="purchase_order_id" required="">
                                    <option selected="" value="0">Continue Without PO</option>
                                    <?php
                                    foreach (PurchaseOrder::find_all_by_purchase_order_type_id(2) as $db_purchase_order) {
                                        if ($purchase_order->id == $db_purchase_order->id) {
                                            ?>
                                            <option selected="" value="<?php echo $db_purchase_order->id; ?>"><?php echo $db_purchase_order->code; ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $db_purchase_order->id; ?>"><?php echo $db_purchase_order->code; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>


                                <div id="divPOPrev" class="x_content divBackDarck ">
                                    <div class="container-fluid ">                                    
                                        <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class=" washed" style="display: block;"><small>Code</small></label>
                                            <label id="lblPOCode"></label>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class=" washed" style="display: block;"><small>Date</small></label>
                                            <label id="lblPODate"></label>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label class=" washed" style="display: block;"><small>Supplier</small></label>
                                            <label id="lblPOSupplier"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="divProduct">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Select Materials</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="divBackTopTable">


                            <div class="container-fluid ">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="txtIndex" name="index" value=""/>
                                        <input type="hidden" class="form-control" id="txtMaterial" name="material" value=""/>
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
                                        <input type="text" id="volume" name="volume" placeholder="Enter Volume" required="required" class="form-control col-md-7 col-xs-12"> 
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Unit Price (Rs)</label>
                                        <input type="text" id="txtUnitPrice" name="unit_price" placeholder="Enter Unit Price" required="required" class="form-control col-md-7 col-xs-12"> 
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="modal-footer">
                                <div class=" col-md-6 col-sm-6 col-xs-12">
                                    <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-down"></i> <span id="lblBtnAdd"> Add</span></button>
                                </div>
                                <div class=" col-md-6 col-sm-6 col-xs-12">
                                    <button id="btnClear" type="button" class="btn btn-block btn-primary"><i class="fa fa-close"></i> Clear</button>
                                </div>
                            </div>

                        </div>
                        <br/>
                        <div class="x_content table-responsive">
                            <table class="table table-responsive table-bordered table-condensed table-striped table-responsive customBorder" id="tblGRNP">
                                <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Volume</th>
                                        <th>Unit Price</th>
                                        <th class="col-sm-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <div class="clearfix"></div>
                        <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                            </div>
<!--                            <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($grn->id)) ? 'none' : 'initial'; ?>">
                                <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                            </div>-->
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <a href="grn.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?php include './common/bottom_content.php'; ?><!-- bottom content -->
<script>
    window.onload = function () {
        loadForm();
    };

    function loadForm() {
        var po_id = $("#cmbPO").val();
        fillPOPrev(po_id);
        loadPOPrev();
    }

    $("#btnClear").click(function () {
        loadMaterialForm();
    });


    $("#cmbPO").change(function (e) {
        e.preventDefault;
        var po_id = $("#cmbPO").val();
        fillPOPrev(po_id);
    });

    function loadPOPrev() {
        $("#divPOPrev").css({"display": "none"});
        $("#lblPOCode").text();
        $("#lblPODate").text();
        $("#lblPOSupplier").text();
    }

    function fillPOPrev(po_id) {
        if (po_id == 0) {
            loadPOPrev();
        } else {
            $.ajax({
                type: 'POST',
                url: "proccess/material_grn_proccess.php",
                data: {purchase_order_request: true, purchase_order_id: po_id},
                dataType: 'json',
                async: false,
                success: function (data) {
                    $("#lblPOCode").text(data.code);
                    $("#lblPODate").text(data.date);
                    $("#lblPOSupplier").text(data.supplier_id);
                    $("#divPOPrev").css({"display": "initial"});
                    loadMaterialTable(po_id);
                }
            });
        }
        fillMaterialTable();
    }

    function loadMaterialTable(po_id) {
        if (po_id) {
            $.ajax({
                type: 'POST',
                url: "proccess/material_grn_proccess.php",
                data: {reload_materials: true, purchase_order_id: po_id},
                success: function (data) {
//                        fillMaterialTable();
                }
            });
        }
        fillMaterialTable();
    }

    function fillMaterialTable() {
        $('#tblGRNP tbody').remove();
        $.ajax({
            type: 'POST',
            url: "proccess/material_grn_proccess.php",
            data: {grn_material_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                var trHTML = "";
                $.each(data, function (index, value) {
                    var btnEdit2 = "<button type='button' onclick='editMaterial(this)' id='" + data[index]["index"] + "' class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-edit'></i> Assign Unit Price</button>";

                    var unit_price = (data[index]["unit_price"]) ? data[index]["unit_price"] : btnEdit2;

                    var btnEdit = "<button type='button' onclick='editMaterial(this)' id='" + data[index]["index"] + "' class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-edit'></i> Edit</button>";
                    var btnRemove = "<button type='button' onclick='removeMaterial(this)' id='" + data[index]["index"] + "' class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>";

                    trHTML += "<tr id='" + data[index]["index"] + "'><td>" + data[index]["material"] + "</td><td>" + data[index]["volume"] + "</td><td>" + unit_price + "</td><td class='col-sm-2'>" + btnEdit + btnRemove + "</td></tr>";
                });
                $('#tblGRNP').append(trHTML);
            }
        });
    }

    function checkMaterial(id) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/material_grn_proccess.php",
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
            if ($("#txtMaterial").val() === element_value) {
                element.css({"border": "1px solid #ccc"});
            } else {
                if (checkMaterial(element_value)) {
                    errors.push("Material - Already added");
                    element.css({"border": "1px solid red"});
                } else {
                    element.css({"border": "1px solid #ccc"});
                }
            }
        }

        element = $("#volume");
        element_value = element.val();
//        if (element_value === "" || !(new RegExp("^[0-9]+$").test(element_value))) {
        if (element_value === "" || !(Validation.validateKg(element_value))) {
            errors.push("Volume - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtUnitPrice");
        element_value = element.val();
        if (element_value === "" || !(Validation.validatePrice(element_value))) {
            errors.push("Unit Price - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        return errors;
    }

    $('#btnAdd').click(function (e) {
        e.preventDefault();
        addMaterial();
    });

    function addMaterial() {
        var errors = getMaterialErrors();
        if (errors === undefined || errors.length === 0) {

            var index = $("#txtIndex").val();
            var material_id = $("#cmbMaterial").val();
            var volume = $("#volume").val();
            var unit_price = $("#txtUnitPrice").val();

            $.ajax({
                type: "POST",
                url: "proccess/material_grn_proccess.php",
                data: {addGRNMaterial: true, index: index, material_id: material_id, volume: volume, unit_price: unit_price},
                success: function (data) {
                    fillMaterialTable();
                    loadMaterialForm();
                    new PNotify({
                        title: 'Success',
                        text: 'Material successfully added to the table!',
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
            url: "proccess/material_grn_proccess.php",
            data: {remove_material: true, index: element.id},
            success: function (data) {
                fillMaterialTable();
                loadMaterialForm();
                new PNotify({
                    title: 'Success',
                    text: 'Material successfully removed from table!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function loadMaterialForm() {
        $("#txtIndex").val(null);
        $("#txtMaterial").val(null);
        $('#cmbMaterial').prop('selectedIndex', 0);
        $("#volume").val(null);
        $('#txtUnitPrice').val(null);

        $("#lblBtnAdd").text(" Add");
    }

    function editMaterial(element) {
        $.ajax({
            type: 'POST',
            url: "proccess/material_grn_proccess.php",
            data: {material_request: true, index: element.id},
            dataType: 'json',
            async: false,
            success: function (data) {
                $("#lblBtnAdd").text(" Add (Update)");

                $("#txtIndex").val(data.index);
                $("#txtMaterial").val(data.material_id);

                $('#cmbMaterial').prop('selectedIndex', data.material_id);
                $("#volume").val(data.volume);
                $("#txtUnitPrice").val(data.unit_price);

                scrollTo("divProduct");
            }
        });
    }

    function scrollTo(element_id) {
        $('html,body').animate({
            scrollTop: $("#" + element_id).offset().top},
                'slow');
    }


////////////////////////////////////////////////////////////////////////////////
    function sessionCount() {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/material_grn_proccess.php",
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

        element = $("#cmbSupplier");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Supplier - Not Selected");
            element.css({"border": "1px solid red"});
        }

        var tbl_grnp = sessionCount();
        element = $("#tblGRNP");
        element_value = element.val();
        if (!tbl_grnp) {
            errors.push("Materials - Not selected");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#tblGRNP");
        $.ajax({
            type: 'POST',
            url: "proccess/material_grn_proccess.php",
            data: {material_errors: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                if (data) {
                    element.css({"border": "1px solid red"});
                    var temp_errors = new Array();
                    $.each(data, function (index, value) {
                        temp_errors.push(value);
                    });
                    errors.push("Price is invalid: " + temp_errors.join(", "));
                } else {
                    element.css({"border": "1px solid #ccc"});
                }
            }
        });

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
        var id = <?php echo ($grn->id) ? 1 : 0; ?>;
        if (id) {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "MaterialGRN", "upd")) {
                FormOperations.confirmSave(validateForm(), "#form", id, null);
            }
        } else {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "MaterialGRN", "ins")) {
                FormOperations.confirmSave(validateForm(), "#form", id, null);
            }
        }
    });

    $("#btnDelete").click(function () {
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "MaterialGRN", "del")) {
            FormOperations.confirmDelete("#form");
        }
    });

</script>
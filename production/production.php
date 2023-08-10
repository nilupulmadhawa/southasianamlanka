<?php
require_once './../util/initialize.php';
require_once './../util/validate_login.php';
include 'common/upper_content.php';

unset($_SESSION["production_materials"]);

//if (isset($_POST["id"]) && $production = Production::find_by_id($_POST["id"])) {
//    $production_materials = array();
//    foreach (ProductionMaterial::find_all_by_production_id($production->id) as $db_production_material) {
//        $production_materials[] = $db_production_material->to_array();
//    }
//
//    $_SESSION["production_materials"] = $production_materials;
//} else {
//    $production = new Production();
//}

if (isset($_GET["id"])) {
    $id = Functions::custom_crypt($_GET["id"], 'd');
    if ($production = Production::find_by_id($id)) {
        $production_materials = array();
        foreach (ProductionMaterial::find_all_by_production_id($production->id) as $db_production_material) {
            $production_materials[] = $db_production_material->to_array();
        }

        $_SESSION["production_materials"] = $production_materials;
    } else {
        Session::set_error("Entry not available...");
        $production = new Production();
    }
} else {
    $production = new Production();
}
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Production</h3>
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
                        <!--<h2 id="title"><?php // echo (empty($recipie->id)) ? 'Add' : 'Edit';     ?> Production Plan</h2>-->
                        <h2 id="title">Production</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="x_content">
                            <form id="form" action="proccess/production_proccess.php" method="post" class="form-horizontal form-label-left" >
                                <input type="hidden" class="form-control" id="txtId" name="production_id" value="<?php echo $production->id; ?>" />

                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" placeholder="Code" id="code" name="code" value="<?php echo (empty($production->id)) ? Production::getAutoIncrement() : $production->code; ?>" required="" readonly="">
                                </div>

                                <div class="form-group">
                                    <label>Production Date</label>
                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtDate" name="date" value="<?php echo $production->date; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" id="txaDescription" name="description" placeholder="Enter Recipie Description"><?php echo $production->description; ?></textarea> 
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Production Materials</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="container-fluid divBackTopTable">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Material</label>
                                    <select class="form-control" id="cmbMaterial" name="material_id" >
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
                                    <input type="text" id="volume" name="volume" value="1"  min="1" max="5000" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Wastage Volume (Kg)</label>
                                    <input type="text" id="wastage" name="wastage" value="0"  min="0" max="5000" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Action</label>
                                    <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="glyphicon glyphicon-chevron-down"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="x_content">
                            <table id="tblPOP" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Volume</th>
                                        <th>Wastage</th>
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
                            <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo ($production->id) ? 'initial' : 'none'; ?>">
                                <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                            </div>
                            <div class=" col-md-4 col-sm-4 col-xs-12">
                                <a href="productin_plan.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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
        fillProductTable();
    };

    $('#txtDate').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    function fillProductTable() {
        $('#tblPOP tbody').remove();
        $.ajax({
            type: 'POST',
            url: "proccess/production_proccess.php",
            data: {production_material_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                var trHTML = "";
                $.each(data, function (index, value) {
                    var btnRemove = "<button type='button' onclick='removeProduct(this)' id='" + value["index"] + "'class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>";
                    trHTML += "<tr id='" + value["index"] + "'><td>" + value["material_id"] + "</td><td>" + value["volume"] + "</td><td>" + value["wastage"] + "</td><td>" + btnRemove + "</td></tr>";
                });
                $('#tblPOP').append(trHTML);
            }
        });
    }

    function checkMaterial(id) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/production_proccess.php",
            data: {check_material: true, id: id},
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
//            element.css({"border": "1px solid #ccc"});
        }

        element = $("#volume");
        element_value = element.val();
        if (element_value === "" || !Validation.validateKg(element_value)) {
            errors.push("Volume - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#wastage");
        element_value = element.val();
        if (element_value !== "") {
            if (parseInt(element_value) <= 0 || !Validation.validateKg(element_value)) {
                errors.push("Wastage volume - Invalid");
                element.css({"border": "1px solid red"});
            } else {
                element.css({"border": "1px solid #ccc"});
            }
        } else {
            element.css({"border": "1px solid #ccc"});
            errors.push("Wastage - Invalid");
        }
        
        return errors;
    }



    function clearProductForm() {
        $('#cmbMaterial').prop('selectedIndex', 0);
        $("#volume").val(1);
        $("#wastage").val(0);
    }


    $('#btnAdd').click(function (e) {
        e.preventDefault();
        addProduct();
    });

    function addProduct() {
        var errors = getProductErrors();
        if (errors === undefined || errors.length === 0) {
            var material_id = $("#cmbMaterial").val();
            var volume = $("#volume").val();
            var wastage = $("#wastage").val();

            $.ajax({
                type: "POST",
                url: "proccess/production_proccess.php",
                data: {add_production_material: true, material_id: material_id, volume: volume, wastage: wastage},
                success: function (data) {
                    fillProductTable();
                    clearProductForm();
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

    function removeProduct(element) {
        $.ajax({
            type: "POST",
            url: "proccess/production_proccess.php",
            data: {remove: true, index: element.id},
            success: function (data) {
                fillProductTable();
                new PNotify({
                    title: 'Success',
                    text: 'Material successfully removed from temporary table!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function clearPOProducts() {
        $.ajax({
            type: "POST",
            url: "proccess/production_proccess.php",
            data: {clearProductionMaterial: true},
            success: function (data) {

            }
        });
    }

    ///////////////////////////////////
    function sessionCount() {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/production_proccess.php",
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

        element = $("#txtCode");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Code - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtDate");
        element_value = element.val();
        if (element_value !== "" && Validation.validateDate(element_value)) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Date - Not Selected");
            element.css({"border": "1px solid red"});
        }

        element = $("#txaDescription");
        element_value = element.val();
        if (element_value === "" || !(new RegExp("^(.|\s)*[a-zA-Z]+(.|\s)*$").test(element_value))) {
            errors.push("Description - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        var row_count = sessionCount();
        element = $("#tblPOP");
        element_value = element.val();
        if (!row_count) {
            errors.push("Materials - Not selected");
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
        var id = <?php echo (empty($recipie->id)) ? 0 : 1; ?>;

        if (id) {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Production", "upd")) {
                FormOperations.confirmSave(validateForm(), "#form", id, null);
            }
        } else {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Production", "ins")) {
                FormOperations.confirmSave(validateForm(), "#form", id, null);
            }
        }
    });

    $("#btnDelete").click(function () {

        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Production", "del")) {
            FormOperations.confirmDelete("#form");
        }
    });

</script>
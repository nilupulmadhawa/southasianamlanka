<?php
require_once './../util/initialize.php';


//if (!(isset($_POST["id"]) && $batch = Batch::find_by_id($_POST["id"]))) {
//    $batch = new Batch();
//}

if (isset($_GET["id"])) {
    $id= Functions::custom_crypt($_GET["id"], 'd');
    if($batch = Batch::find_by_id($id)){

    }else{
        Session::set_error("Entry not available...");
        $batch = new Batch();
    }
}else{
    $batch = new Batch();
}

include 'common/upper_content.php';
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Batch</h3>
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
                        <h2 id="title"><?php echo (empty($batch->id)) ? 'Add' : 'Edit'; ?> Batch</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="formBatch" action="proccess/batch_proccess.php" method="post" class="form-horizontal form-label-left" >
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" class="form-control" id="txtId" name="id" value="<?php echo $batch->id; ?>" />
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" placeholder="Code" id="txtCode" name="code" value="<?php echo (empty($batch->id)) ? Batch::getNextCode() : $batch->code; ?>" required="" readonly="">
                                </div>
<!--                                <div class="form-group">
                                    <label>Manufacture Date</label>
                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtMfd" name="mfd" value="<?php // echo $batch->mfd; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Expire Date</label>
                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="txtExp" name="exp" value="<?php // echo $batch->exp; ?>" required>
                                </div>-->
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" class="form-control" placeholder="Cost" id="txtCost" name="cost" value="<?php echo $batch->cost; ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label>Retail Price</label>
                                    <input type="text" class="form-control" placeholder="Retaill Price" id="txtRetaillPrice" name="retail_price" value="<?php echo $batch->retail_price; ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label>Whole sale Price</label>
                                    <input type="text" class="form-control" placeholder="Whole sale Price" id="txtWholeSalePrice" name="wholesale_price" value="<?php echo $batch->wholesale_price; ?>" required="">
                                </div>

                                <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                      <!-- <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button> -->
                                        <button type="submit" name="update" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Update</button>
                                    </div>

                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <a href="batch.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
                                    </div>
                                </div>
                            </div>
                        </form>
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
//            content: 'Mahesh!',
//        });
    };

    $(function () {
        $("#txtMfd").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });

    $(function () {
        $("#txtExp").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });

    function getErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#dtpMfd");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Manudacture Date - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#dtpExp");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Expire Date - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtCost");
        element_value = element.val();
        if (element_value === "" || !(new RegExp("^[0-9]+\.[0-9]{0,2}$").test(element_value))) {
            errors.push("Cost - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtRetaillPrice");
        element_value = element.val();
        if (element_value === "" || !(new RegExp("^[0-9]+\.[0-9]{0,2}$").test(element_value))) {
            errors.push("Retaill Price - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#txtWholeSalePrice");
        element_value = element.val();
        if (element_value === "" || !(new RegExp("^[0-9]+\.[0-9]{0,2}$").test(element_value))) {
            errors.push("Whole Sale Price - Invalid");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }


        if (!UserPrivileges.privilegeByModuleAction("proccess/user_privileges_authenticate.php", "Batch", "upd")) {
            errors.push("You have no Privileges for the operation.");
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
        var id = <?php echo ($batch->id) ? 1 : 0; ?>;
        if (id) {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Batch", "upd")) {
                FormOperations.confirmSave(validateForm(), "#formBatch", id);
            }
        } else {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Batch", "ins")) {
                FormOperations.confirmSave(validateForm(), "#formBatch", id);
            }
        }
    });

    $("#btnDelete").click(function () {
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Batch", "del")) {
            FormOperations.confirmDelete("#formBatch");
        }
    });



</script>

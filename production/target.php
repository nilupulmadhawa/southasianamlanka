<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

if (!(isset($_POST["id"]) && $target = Target::find_by_id($_POST["id"]))) {
    $target = new Target();
}
?>

<!--page content--> 
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Target</h3>
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
                        <h2 id="title"><?php echo (empty($target->id)) ? 'Add' : 'Edit'; ?> Target</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="formTarget" action="proccess/target_process.php" method="post" class="form-horizontal form-label-left" >
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" class="form-control" id="txtId" name="txtId" value="<?php echo $target->id; ?>" />
                                <div class="form-group">
                                    <label>Sales Rep</label>
                                    <select class="form-control" id="cmbRep" name="cmbRep"  <?php echo (empty($target->id)) ? '' : 'disabled'; ?>>
                                        <option disabled="" selected="" value="0">Select Rep</option>
                                         <?php
                                        foreach (User::find_all_by_designation_id(2) as $user) {
                                            if ($user->id == $target->user_id) {
                                                ?>
                                                <option selected="" value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    
                                    <select class="form-control" id="cmbRepp" name="cmbRepp" style="display: none;">
                                        <option disabled="" selected="" value="0">Select Rep</option>
                                         <?php
                                        foreach (User::find_all_by_designation_id(2) as $user) {
                                            if ($user->id == $target->user_id) {
                                                ?>
                                                <option selected="" value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Month</label>
                                    <select class="form-control" id="cmbMonth" name="cmbMonth"  <?php echo (empty($target->id)) ? '' : 'disabled'; ?>>
                                       <option disabled="" selected="" value="0">Select Month</option>
                                         <?php
                                        foreach (TargetMonth::find_all() as $month) {
                                            if ($month->id == $target->target_month_id) {
                                                ?>
                                                <option selected="" value="<?php echo $month->id; ?>"><?php echo $month->name; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $month->id; ?>"><?php echo $month->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="text" class="form-control" id="txtYear" name="txtYear" value ="<?php echo date('Y')?>" readonly=""/>
                                </div>

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Target Amount" id="txtAmount" name="txtAmount" value="<?php if(!empty($target->amount))echo $target->amount; ?>" required="">
                                </div>
                                <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <button id="btnSave" type="button" name="save" class="btn btn-block btn-success" ><i class="fa fa-floppy-o"></i> Save</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($target->id)) ? 'none' : 'initial'; ?>">
                                        <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" onclick="return confirmDelete(this);"><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <a href="target.php" ><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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
//     window.onload = function () {
//        var idfield = $('#txtId').val();
//        if(idfield!== ""){
//            $("#cmbRep").prop('selected',true);
//            $("#cmbMonth").prop('selected',true);
//            $("#cmbRep").prop('disabled',true);
//            $("#cmbMonth").prop('disabled',true);
//        }else{
//            $("#cmbRep").prop('disabled',false);
//            $("#cmbMonth").prop('disabled',false);
//            
//        }
//    };
// 
 
    function getErrors(){
        var errors = new Array();
        var element;
        var element_value;
        
        element=$("#cmbRep");
        element_value=element.val();
        if (!element_value) {
            errors.push("Sales Rep - Not Selected");
            element.css({"border": "1px solid red"});
        }else{
            element.css({"border": "1px solid #ccc"});
        }

        element=$("#cmbMonth");
        element_value=element.val();
        if (!element_value) {
            errors.push("Month - Not Selected");
            element.css({"border": "1px solid red"});
        }else{
            element.css({"border": "1px solid #ccc"});
        }
        
        element=$("#txtAmount");
        element_value=element.val();
        if (element_value === "" || !((/^[0-9]+$/).test(element_value))) {
            errors.push("Amount You Entered - Invalid");
            element.css({"border": "1px solid red"});
        }else{
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
        var id = <?php echo ($target->id) ? 1 : 0; ?>;
        
        
        if (id) {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Target", "upd")) {
                FormOperations.confirmSave(validateForm(), "#formTarget", id, null);
            }
        } else {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Target", "ins")) {
                FormOperations.confirmSave(validateForm(), "#formTarget", id, null);
            }
        }
    });

    $("#btnDelete").click(function () {
        
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Target", "del")) {
            FormOperations.confirmDelete("#formTarget");
        }
    });

    
    
</script>
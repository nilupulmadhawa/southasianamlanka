<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

if (!(isset($_POST["id"]) && $supplier = Supplier::find_by_id($_POST["id"]))) {
    $supplier = new Supplier();
}
?>

<!--page content--> 
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Supplier</h3>
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
                        <h2 id="title"><?php echo (empty($supplier->id)) ? 'Add' : 'Edit'; ?> Supplier</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="formSupplier" action="proccess/supplier_proccess.php" method="post" class="form-horizontal form-label-left" >
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" class="form-control" id="txtId" name="id" value="<?php echo $supplier->id; ?>" />
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name" id="txtName" name="name" value="<?php echo $supplier->name; ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="txaAddress" name="address" placeholder="Enter Supplier Address"><?php echo $supplier->address; ?></textarea> 
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="email" id="txtEmail" name="email" value="<?php echo $supplier->email; ?>" required="">
                                </div>
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="text" class="form-control" placeholder="Contact No" id="txtContactNo" name="contact_no" value="<?php echo $supplier->contact_no; ?>" required="">
                                </div>
                                <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <!--<button id="btnSave" type="submit" name="save" class="btn btn-block btn-success" onclick="return validateForm()"><i class="fa fa-floppy-o"></i> Save</button>-->
                                        <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($supplier->id)) ? 'none' : 'initial'; ?>">
                                        <!--<button id="btnDelete" type="submit" name="delete" class="btn btn-block btn-danger" onclick="return confirmDelete(this);"><i class="fa fa-trash"></i> Delete</button>-->
                                        <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <a href="supplier.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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
    
    function getErrors(){
        var errors = new Array();
        var element;
        var element_value;
        
        element=$("#txtName");
        element_value=element.val();
        if ( element_value === "") {
            errors.push("Name - Invalid");
            element.css({"border": "1px solid red"});
        }else{
            element.css({"border": "1px solid #ccc"});
        }

        element=$("#txaAddress");
        element_value=element.val();
        if (element_value === "" ) {
            errors.push("Address - Invalid");
            element.css({"border": "1px solid red"});
        }else{
            element.css({"border": "1px solid #ccc"});
        }
        
        element = $("#txtEmail");
        element_value = element.val();
        if (element_value !== "") {
            if(Validation.valEmail(element_value)){
                element.css({"border": "1px solid #ccc"});
            }else{
                errors.push("Email - Invalid");
                element.css({"border": "1px solid red"});
            }
        } else {
            element.css({"border": "1px solid #ccc"});
        }
        
        element=$("#txtContactNo");
        element_value=element.val();
        var regphone = new RegExp("[0][0-9]{9}$");
        var regphone1 = new RegExp("[+][0-9]{11}$");
        if (element_value === "" || !(regphone.test(element_value)||regphone1.test(element_value))) {
            errors.push("Contact No - Invalid");
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
        var id = <?php echo ($supplier->id) ? 1 : 0; ?>;
        
        if (id) {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Supplier", "upd")) {
                FormOperations.confirmSave(validateForm(), "#formSupplier", id, null);
            }
        } else {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Supplier", "ins")) {
                FormOperations.confirmSave(validateForm(), "#formSupplier", id, null);
            }
        }
    });

    $("#btnDelete").click(function () {
        
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Supplier", "del")) {
            FormOperations.confirmDelete("#formSupplier");
        }
    });

</script>
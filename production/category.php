<?php
require_once './../util/initialize.php';

//if (!(isset($_POST["id"]) && $category = Category::find_by_id($_POST["id"]))) {
//    $category = new Category();
//}

if (isset($_GET["id"])) {
    $id= Functions::custom_crypt($_GET["id"], 'd');
    if($category = Category::find_by_id($id)){
        
    }else{
        Session::set_error("Entry not available...");
        $category = new Category();
    }
}else{
    $category = new Category();
}

include 'common/upper_content.php';
?>

<!--page content--> 
<div class="right_col" role="main">
    <div class="">
        

        <div class="clearfix"></div>

        <?php Functions::output_result(); ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 id="title"><?php echo (empty($category->id)) ? 'Add' : 'Edit'; ?> Category</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="formCategory" action="proccess/category_process.php" method="post" class="form-horizontal form-label-left" >
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" class="form-control" id="txtId" name="id" value="<?php echo $category->id; ?>" />
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name" id="txtName" name="name" value="<?php echo $category->name; ?>" required="">
                                </div>

                                <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <!--<button id="btnSave" type="submit" name="save" class="btn btn-block btn-success" onclick="return validateForm()"><i class="fa fa-floppy-o"></i> Save</button>-->
                                        <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($category->id)) ? 'none' : 'initial'; ?>">
                                        <!--<button id="btnDelete" type="submit" name="delete" class="btn btn-block btn-danger" onclick="return confirmDelete(this);"><i class="fa fa-trash"></i> Delete</button>-->
                                        <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <a href="category.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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

    function getErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#txtName");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Name - Invalid");
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
        var id = <?php echo ($category->id) ? 1 : 0; ?>;

        if (id) {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Category", "upd")) {
                FormOperations.confirmSave(validateForm(), "#formCategory", id);
            }
        } else {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Category", "ins")) {
                FormOperations.confirmSave(validateForm(), "#formCategory", id);
            }
        }
    });

    $("#btnDelete").click(function () {
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Category", "del")) {
            FormOperations.confirmDelete("#formCategory");
        }
    });

</script>

<?php
require_once './../util/initialize.php';
require_once './../util/validate_login.php';


unset($_SESSION["deliverer_users"]);

//if (isset($_POST["deliverer_id"]) && $deliverer = Deliverer::find_by_id($_POST["deliverer_id"])) {
//    $temp_deliverer_users = array();
//    if ($db_deliverer_users = DelivererUser::find_all_by_deliverer_id($deliverer->id)) {
//        foreach ($db_deliverer_users as $deliverer_user) {
//            $temp_deliverer_user = array();
//            $temp_deliverer_user["user_id"] = $deliverer_user->user_id;
//            $temp_deliverer_users[] = $temp_deliverer_user;
//        }
//    }
//
//    $_SESSION["deliverer_users"] = $temp_deliverer_users;
//} else {
//    $deliverer = new Deliverer();
//    unset($_SESSION["deliverer_users"]);
//}

if (isset($_GET["id"])) {
    $id = Functions::custom_crypt($_GET["id"], 'd');
    if ($deliverer = Deliverer::find_by_id($id)) {
        $temp_deliverer_users = array();
        if ($db_deliverer_users = DelivererUser::find_all_by_deliverer_id($deliverer->id)) {
            foreach ($db_deliverer_users as $deliverer_user) {
                $temp_deliverer_user = array();
                $temp_deliverer_user["user_id"] = $deliverer_user->user_id;
                $temp_deliverer_users[] = $temp_deliverer_user;
            }
        }

        $_SESSION["deliverer_users"] = $temp_deliverer_users;
    } else {
        Session::set_error("Entry not available...");
        $deliverer = new Deliverer();
    }
} else {
    $deliverer = new Deliverer();
}

include 'common/upper_content.php';
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Deliverer</h3>
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
                        <h2 id="title"><?php echo (empty($product->id)) ? 'Add' : 'Edit'; ?> Deliverer</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="x_content">
                            <form id="form" action="proccess/deliverer_proccess.php" method="post" class="form-horizontal form-label-left" >
                                <input type="hidden" id="id" name="id" value="<?php echo $deliverer->id; ?>">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="txtName" name="name" placeholder="name" value="<?php echo $deliverer->name; ?>" required="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Vehicle Number</label>
                                        <input type="text" id="txtNumber" name="number" placeholder="Vehicle Number" value="<?php echo $deliverer->number; ?>" required="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Route</label>
                                        <select class="form-control" id="cmbRoute" name="route_id" required="">
                                            <option disabled="" selected="">Select Route</option>
<?php
foreach (Route::find_all() as $route) {
    if ($route->id == $deliverer->route_id) {
        ?>
                                                    <option selected="" value="<?php echo $route->id; ?>"><?php echo $route->name; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $route->id; ?>"><?php echo $route->name; ?></option>
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
                        <h2>Deliverer Users</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="container-fluid divBack">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>User</label>
                                    <select class="form-control" id="cmbUser" name="user_id" required="">
                                        <option disabled="" selected="">Select User</option>
<?php
foreach (User::find_all() as $user) {
    ?>
                                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Action</label>
                                    <button id="btnAdd" type="button" class="btn btn-block btn-primary"><i class="glyphicon glyphicon-chevron-down"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="x_content"></div>
                        <div class="x_content">
                            <table id="tblPOP" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>User</th>
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
                                <a href="deliverer.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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
        //            content: 'Mahesh!',
        //        });
        fillUserTable();
    };

    function fillUserTable() {
        $('#tblPOP tbody').remove();
        $.ajax({
            type: 'POST',
            url: "proccess/deliverer_proccess.php",
            data: {user_request: true},
            dataType: 'json',
            async: false,
            success: function (data) {
                var trHTML = "";
                $.each(data, function (index, value) {
                    var btnRemove = "<button type='button' onclick='remove(this)' id='" + data[index]["index"] + "'class='btn btn-danger btn-xs'><i class='fa fa-close'></i></button>"
                    trHTML += "<tr id='" + data[index]["index"] + "'><td>" + data[index]["user_id"] + "</td><td>" + btnRemove + "</td></tr>";
                });
                $('#tblPOP').append(trHTML);
            }
        });
    }

    function checkProduct(id) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/deliverer_proccess.php",
            data: {check_user: true, id: id},
            dataType: 'json',
            async: false,
            success: function (data) {
                result = data;
            }
        });
        return result;
    }

    function getUserErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#cmbUser");
        element_value = element.val();
        if (!element_value) {
            errors.push("User - Not Selected");
            element.css({"border": "1px solid red"});
        } else {
            if (checkProduct(element_value)) {
                errors.push("User - Already added");
                element.css({"border": "1px solid red"});
            } else {
                element.css({"border": "1px solid #ccc"});
            }
//            element.css({"border": "1px solid #ccc"});
        }
        return errors;
    }

    function clearUserForm() {
        $('#cmbUser').prop('selectedIndex', 0);
    }


    $('#btnAdd').click(function (e) {
        e.preventDefault();
        addUser();
    });

    function addUser() {
        var errors = getUserErrors();
        if (errors === undefined || errors.length === 0) {

            var user_id = $("#cmbUser").val();

            $.ajax({
                type: "POST",
                url: "proccess/deliverer_proccess.php",
                data: {add_user: true, user_id: user_id},
                success: function (data) {
                    fillUserTable();
                    clearUserForm();
                    new PNotify({
                        title: 'Success',
                        text: 'User successfully added to the table!',
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

    function remove(element) {
        $.ajax({
            type: "POST",
            url: "proccess/deliverer_proccess.php",
            data: {remove: true, index: element.id},
            success: function (data) {
                fillUserTable();
                new PNotify({
                    title: 'Success',
                    text: 'User successfully removed from the table!',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        });
    }

    function clearUsers() {
        $.ajax({
            type: "POST",
            url: "proccess/deliverer_proccess.php",
            data: {clear_users: true},
            success: function (data) {

            }
        });
    }







    ///////////////////////////////////Common

    function getErrors() {
        var errors = new Array();
        var element;
        var element_value;

        element = $("#txtName");
        element_value = element.val();
        if (element_value != "") {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Name - Not valid");
            element.css({"border": "1px solid red"});
        }

        element = $("#txtNumber");
        element_value = element.val();
        if (element_value != "") {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Vehicle Number - Not valid");
            element.css({"border": "1px solid red"});
        }

        element = $("#cmbRoute");
        element_value = element.val();
        if (element_value) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Route - Not selected");
            element.css({"border": "1px solid red"});
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
        if (id) {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Deliverer", "upd")) {
                FormOperations.confirmSave(validateForm(), "#form");
            }
        } else {
            if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Deliverer", "ins")) {
                FormOperations.confirmSave(validateForm(), "#form");
            }
        }
    });

    $("#btnDelete").click(function () {

        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Deliverer", "del")) {
            FormOperations.confirmDelete("#form");
        }
    });
</script>
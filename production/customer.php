<?php
require_once './../util/initialize.php';

if (isset($_GET["id"])) {
    $id = Functions::custom_crypt($_GET["id"], 'd');
    if ($customer = Customer::find_by_id($id)) {

    } else {
        Session::set_error("Entry not available...");
        $customer = new Customer();
    }
} else {
    $customer = new Customer();
}

include 'common/upper_content.php';
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Customer</h3>
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
                        <h2 id="title"><b>CUSTOMER REGISTRATION & CREDIT FACILITY FORM</b></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="formCustomer" action="proccess/customer_proccess.php" method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" class="form-control" id="txtId" name="id" value="<?php echo $customer->id; ?>" />

                                <div class="form-group">
                                    <label>Name Of Company :</label>
                                    <input type="text" class="form-control" placeholder="Name" id="txtName" name="name" value="<?php echo $customer->name; ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label>Business Registration No :</label>
                                    <input type="text" id="txtCode" name="code" class="form-control" placeholder="Business Registration No" value="<?php echo $customer->code; ?>" required="required" />
                                </div>

                                <div class="form-group">
                                    <label>Business Bank Account Number :</label>
                                    <input type="text" id="txtCode" name="account_number" class="form-control" placeholder="Business Bank Account Number" value="<?php echo $customer->account_number; ?>" required="required" />
                                </div>

                                <div class="form-group">
                                    <label>Business Registration No Document : </label>
                                    <input id="inpFile" type="file" name="files_to_upload_1" required />
                                </div>

                                <div class="form-group">
                                    <label>Stock Insurance Cover No:</label>
                                    <input type="text" id="txtCode" name="stock_insurance" placeholder="Stock Insurance Cover No" class="form-control" value="<?php echo $customer->stock_insurance; ?>" required="required" />
                                </div>

                                <div class="form-group">
                                    <label>Stock Insurance Cover Document : </label>
                                    <input id="inpFile" type="file" name="files_to_upload_2"  />
                                </div>


                                <div class="form-group">
                                    <label>Information On Stock Mortgaged to the bank : </label>
                                    <input type="text" id="txtCode" name="stock_mortgaged" class="form-control" placeholder="Information On Stock Mortgaged to the bank" value="<?php echo $customer->stock_mortgaged; ?>" required="required" />
                                </div>


                                <div class="form-group">
                                    <label>Value Of Bank Gurantee : </label>
                                    <input type="text" id="txtCode" name="bank_gurantee" class="form-control" placeholder="Value Of Bank Gurantee" value="<?php echo $customer->bank_gurantee; ?>" required="required" />
                                </div>

                                <div class="form-group">
                                    <label>Value Of Bank Gurantee Document : </label>
                                    <input id="inpFile" type="file" name="files_to_upload_3"  />
                                </div>

                                <div class="form-group">
                                    <label>Business Address : </label>
                                    <textarea class="form-control" id="txaAddress" name="address" placeholder="Business Address"><?php echo $customer->address; ?></textarea>
                                </div>


                                <div class="form-group">
                                    <label>Business Telephone No : </label>
                                    <input type="text" class="form-control" placeholder="Business Telephone No" id="txtPhone" name="phone" value="<?php echo $customer->phone; ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label>Fax No : </label>
                                    <input type="text" class="form-control" placeholder="Fax No" id="txtPhone" name="fax" value="<?php echo $customer->fax; ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label>E-mail Address : </label>
                                    <input type="text" class="form-control" placeholder="E-mail Address" id="txtEmail" name="email" value="<?php echo $customer->email; ?>" required="">
                                </div>


                                <div class="form-group">
                                    <label>Propriter's Name & Personal Address : </label>
                                    <input type="text" class="form-control" placeholder="Propriter's Name & Personal Address" name="prop_name_email" value="<?php echo $customer->prop_name_email; ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label>Propriter's ID Card No : </label>
                                    <input type="text" class="form-control" placeholder="Propriter's ID Card No" name="prop_id" value="<?php echo $customer->prop_id; ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label>Propriter's ID : </label>
                                    <input id="inpFile" type="file" name="files_to_upload_4"  />
                                </div>



                                <div class="form-group">
                                    <label>Personal Telephone No : </label>
                                    <input type="text" class="form-control" placeholder="Personal Telephone No" name="prop_tel" value="<?php echo $customer->prop_tel; ?>" required="">
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>Introduced By : </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>A : </label>
                                        <input type="text" class="form-control" placeholder="Introduced By A" name="intro_a" value="<?php echo $customer->intro_a; ?>" required="">

                                    </div>
                                    <div class="col-sm-6">
                                        <label>B : </label>
                                        <input type="text" class="form-control" placeholder="Introduced By B" name="intro_b" value="<?php echo $customer->intro_b; ?>" required="">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Name & Designation Of Authorized Person To Make Purchase Orders : </label>
                                    <input type="text" class="form-control" placeholder="Name & Designation Of Authorized Person To Make Purchase Orders" name="po_name_designation" value="<?php echo $customer->po_name_designation; ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label>Name Of The Bank : </label>
                                    <input type="text" class="form-control" placeholder="Name Of The Bank" name="bank_name" value="<?php echo $customer->bank_name; ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label>Cost Of Planned Purchase Per Month : </label>
                                    <input type="text" class="form-control" placeholder="Cost Of Planned Purchase Per Month" name="month_purchase" value="<?php echo $customer->month_purchase; ?>" required="">
                                </div>

                                <div class="form-group">
                                    <label>Requested Credit Limit</label>
                                    <input class="form-control" id="txtBalance" name="balance" placeholder="Requested Credit Limit" value="<?php echo $customer->balance; ?>"/>
                                </div>

                                <div class="form-group">
                                    <label>How Much Of Credit Limit To Be Increased In Future : </label>
                                    <input class="form-control" id="txtBalance" name="balance_increase" placeholder="How Much Of Credit Limit To Be Increased In Future" value="<?php echo $customer->balance_increase; ?>"/>
                                </div>

                                <div class="form-group">
                                    <label>Duration Of Payment (Days)</label>
                                    <input class="form-control" id="txtBalance" name="period" placeholder="Duration Of Payment" value="<?php echo $customer->period; ?>"/>
                                </div>

                                <div class="form-group">
                                    <label>Method Of Payment</label>
                                    <select class="form-control" name="payment_method">
                                        <option value="1">Cash</option>
                                        <option value="2">Cheque</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Town</label>
                                    <select class="form-control" id="cmbRoute" name="route_id" required="">
                                        <option disabled="" selected="">Select Town</option>
                                        <?php
                                        foreach (Route::find_all() as $route) {
                                            if ($route->id == $customer->route_id) {
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


                                <div class="form-group">
                                    <label>Birthday :</label>
                                    <input type="text" id="txtCode" name="birthday" class="form-control" placeholder="Client Birthday" value="<?php echo $customer->birthday; ?>" required="required" />
                                </div>

                                <div class="form-group">
                                    <label>Business Account Number :</label>
                                    <input type="text" id="txtAccountNum" name="account_number" class="form-control" placeholder="Account Number" value="<?php echo $customer->account_number; ?>" required="required" />
                                </div>


                                <div class="form-group">
                                    <label>Allocated Rep :</label>
                                    <select class="form-control" id="cmbAllocatedRep" name="allocated_rep" required="">
                                        <?php
                                        foreach (User::find_all() as $data) {
                                            if ($data->id == $customer->allocated_rep) {
                                                ?>
                                                <option selected="" value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>






                                <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <!--<button id="btnSave" type="submit" name="save" class="btn btn-block btn-success" onclick="return validateForm()"><i class="fa fa-floppy-o"></i> Save</button>-->
                                        <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($customer->id)) ? 'none' : 'initial'; ?>">
                                        <!--<button id="btnDelete" type="submit" name="delete" class="btn btn-block btn-danger" onclick="return confirmDelete(this);"><i class="fa fa-trash"></i> Delete</button>-->
                                        <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <a href="customer.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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

    element = $("#txtCode");
    element_value = element.val();
    if (element_value === "") {
        errors.push("Code - Invalid");
        element.css({"border": "1px solid red"});
    } else {
        element.css({"border": "1px solid #ccc"});
    }

    element = $("#txtName");
    element_value = element.val();
    if (element_value === "") {
        errors.push("Name - Invalid");
        element.css({"border": "1px solid red"});
    } else {
        element.css({"border": "1px solid #ccc"});
    }

    // element = $("#txtPhone");
    // element_value = element.val();
    // var regphone = new RegExp("[0][0-9]{9}$");
    // var regphone1 = new RegExp("[+][0-9]{11}$");
    // if (element_value === "" || !(regphone.test(element_value) || regphone1.test(element_value))) {
    //     errors.push("Phone - Invalid");
    //     element.css({"border": "1px solid red"});
    // } else {
    //     element.css({"border": "1px solid #ccc"});
    // }

    element = $("#txtEmail");
    element_value = element.val();
    if (element_value !== "") {
        if (Validation.valEmail(element_value)) {
            element.css({"border": "1px solid #ccc"});
        } else {
            errors.push("Email - Invalid");
            element.css({"border": "1px solid red"});
        }
    } else {
        element.css({"border": "1px solid #ccc"});
    }

    element = $("#txaAddress");
    element_value = element.val();
//        if (element_value === "" || !(new RegExp("^[a-zA-Z0-9\s,'-]*$").test(element_value))) {
    if (element_value === "") {
        errors.push("Address - Invalid");
        element.css({"border": "1px solid red"});
    } else {
        element.css({"border": "1px solid #ccc"});
    }

    element = $("#cmbRoute");
    element_value = element.val();
    if (!element_value) {
        errors.push("Route - Invalid");
        element.css({"border": "1px solid red"});
    } else {
        element.css({"border": "1px solid #ccc"});
    }

    if($("#txtBalance")){
        element = $("#txtBalance");
        element_value = element.val();
        if (element_value != "") {
            if (Validation.validatePrice(element_value)) {
                element.css({"border": "1px solid #ccc"});
            } else {
                errors.push("Outstanding - Invalid");
                element.css({"border": "1px solid red"});
            }
        } else {
            element.css({"border": "1px solid #ccc"});
        }
    }

    return errors;
}

//    function validate(element_id, regex, fail_message) {
//        var error = "";
//        var element = $("#" + element_id);
//        var element_value = element.val();
//        if (element_value) {
//            if (regex) {
//                if (element_value.test(regex)) {
//                    element.css({"border": "1px solid #ccc"});
//                    element.next().remove();
//                } else {
//                    element.after("<b style='color:red;'>" + fail_message + "</b>");
//                }
//            } else {
//                element.css({"border": "1px solid #ccc"});
//                element.next().remove();
//            }
//        } else {
//            element.css({"border": "1px solid red"});
//            element.after("<b style='color:red;'>The field is empty...</b>");
//        }
//        return error;
//    }

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
    var id = <?php echo ($customer->id) ? 1 : 0; ?>;

    if (id) {
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Customer", "upd")) {
            FormOperations.confirmSave(validateForm(), "#formCustomer", id);
        }
    } else {
        if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Customer", "ins")) {
            FormOperations.confirmSave(validateForm(), "#formCustomer", id);
        }
    }
});

$("#btnDelete").click(function () {
    if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Customer", "del")) {
        FormOperations.confirmDelete("#formCustomer");
    }
});

////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//    $("#btnSave").click(function () {
//        $.confirm({
//            icon: 'fa fa-question-circle',
//            type: 'green',
//            title: 'Save',
//            content: 'Are you sure you want to proceed ?',
//            buttons: {
//                yes: {
//                    text: 'Yes',
//                    btnClass: 'btn-green',
//                    keys: ['enter'],
//                    action: function () {
//                        var email=$("#txtEmail").val();
//                        var formData = Validatems.prepareData("#formCustomer",{ txtEmail:email });
//                        var result=Validatems.validateAndSubmit("proccess/customer_proccess.php","validateSave",formData);
//                        Validatems.displayResults(result);
//                    }
//                },
//                cancel: function () {
//                }
//            }
//        });
//    });



</script>

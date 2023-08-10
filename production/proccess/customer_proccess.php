<?php

require_once './../../util/initialize.php';

//function getValidation($dataArray) {
//    $result = array();
//    foreach ($dataArray as $key => $value) {
//        if ($key == "txtName" && ( $value == "" || !Validate::valName($value) )) {
//            $error= "Name invalid";
//            $result['validations'][$key] = $error;
//            $result['errors'][$key] = $error;
//        } else if ($key == "txtPhone" && ( $value == "" || !Validate::valName($value) )) {
//            $error = "Phone invalid";
//            $result['validations'][$key] = $error;
//            $result['errors'][$key] = $error;
//        } else {
//            $result['validations'][$key] = "";
//        }
//    }
//    return $result;
//}

if(isset($_POST['updatestat'])){
    $customer = Customer::find_by_id($_POST['cus_id']);
    $customer->status = trim($_POST['updatestat']);
    $customer->status_by = $_SESSION["user"]["id"];

    try {
        $customer->save();
        $_SESSION["message"] = "Successfully Updated Status.";
        Activity::log_action("Customer - status updated:" . $customer->name);
        Functions::redirect_to("./../customer_management.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to update status.";
        Functions::redirect_to("./../customer_management.php");
    }
}

function getValidation($dataArray) {
    $errors = array();
    foreach ($dataArray as $key => $value) {
        // if ($key == "txtName" && ( $value == "" || !Validate::valName($value) )) {
        //     $errors[$key] = "Name invalid";
        // } else if ($key == "txtPhone" && ( $value == "" || !Validate::valName($value) )) {
        //     $errors[$key] = "Phone invalid";
        // } else if ($key == "txtEmail" && ( $value == "" || !Validate::valName($value) )) {
        //     $errors[$key] = "Email";
        // } else {
        $errors[$key] = "";
        // }
    }
    return $errors;
}

function getErrors($dataArray) {
    $validations = getValidation($dataArray);
    $errors = array();
    foreach ($validations as $key => $value) {
        if ($value != "") {
            $errors[$key] = $value;
        }
    }
    return $errors;
}

if (isset($_POST['defaultElement']) && $_POST['defaultElement'] == "validateSave") {
    $dataArray = $_POST['dataArray'];

    $final_result = array();
    $final_result["validations"] = getValidation($dataArray);
    $final_result["errors"] = getErrors($dataArray);

//    $final_result=getValidation($dataArray);
    if (empty($final_result["errors"])) {
        $customer = new Customer();
        $customer->name = trim($dataArray['txtName']);
        $customer->code = trim($dataArray['txtCode']);
        $customer->phone = trim($dataArray['txtPhone']);
        $customer->email = trim($dataArray['txtEmail']);
        $customer->address = trim($dataArray['txaAddress']);
        $customer->route_id = trim($dataArray['cmbRoute']);

        try {
            $customer->save();
            Activity::log_action("Customer - saved:" . $customer->name);
            $final_result["message"] = "sucsess";
        } catch (Exception $exc) {
//            $final_result["message"] = "Error..! Failed to save.";
            $final_result["message"] = "error";
            $final_result["message"] = $exc;
        }
    } else {
        $final_result["message"] = "val_error";
    }
    echo json_encode($final_result);
}
//////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['save'])) {
    if (Functions::check_privilege_redirect("Customer", "ins", "./../index.php")) {
        $customer = new Customer();
        $customer->name = trim($_POST['name']);
        $customer->code = trim($_POST['code']);
        $customer->stock_insurance = trim($_POST['stock_insurance']);
        $customer->stock_mortgaged = trim($_POST['stock_mortgaged']);
        $customer->bank_gurantee = trim($_POST['bank_gurantee']);
        $customer->address = trim($_POST['address']);
        $customer->phone = trim($_POST['phone']);
        $customer->fax = trim($_POST['fax']);
        $customer->email = trim($_POST['email']);
        $customer->prop_name_email = trim($_POST['prop_name_email']);
        $customer->prop_id = trim($_POST['prop_id']);
        $customer->prop_tel = trim($_POST['prop_tel']);
        $customer->intro_a = trim($_POST['intro_a']);
        $customer->intro_b = trim($_POST['intro_b']);
        $customer->po_name_designation = trim($_POST['po_name_designation']);
        $customer->bank_name = trim($_POST['bank_name']);
        $customer->month_purchase = trim($_POST['month_purchase']);
        $customer->balance = trim($_POST['balance']);
        $customer->balance_increase = trim($_POST['balance_increase']);
        $customer->period = trim($_POST['period']);
        $customer->payment_method = trim($_POST['payment_method']);
        $customer->route_id = trim($_POST['route_id']);
        $customer->birthday = trim($_POST['birthday']);
        $customer->account_number = trim($_POST['account_number']);
        $customer->allocated_rep = trim($_POST['allocated_rep']);



        // $image_upload = new ImageUpload();
        // $image_name1 = $image_upload->upload_image($_FILES["files_to_upload_1"], "./../uploads/customers/");
        // $customer->code_image = $image_name1;
        

        
        // $image_upload = new ImageUpload();
        // $image_name2 = $image_upload->upload_image($_FILES["files_to_upload_2"], "./../uploads/customers/");
        // $customer->stock_insurance_image = $image_name2;


        
        // $image_upload = new ImageUpload();
        // $image_name3 = $image_upload->upload_image($_FILES["files_to_upload_3"], "./../uploads/customers/");
        // $customer->bank_gurantee_image = $image_name3;

        // global $database;
        // $database->start_transaction();


        
        if (isset($_FILES["files_to_upload_1"]["name"]) && !empty($_FILES["files_to_upload_1"]["name"])) {

            $image_upload = new ImageUpload();
            $image_name1 = $image_upload->upload_image($_FILES["files_to_upload_1"], "./../uploads/customers/");
            $customer->code_image = $image_name1;

        } else {
           $customer->code_image = NULL;
       }

       if (isset($_FILES["files_to_upload_2"]["name"]) && !empty($_FILES["files_to_upload_2"]["name"])) {

        $image_upload = new ImageUpload();
        $image_name2 = $image_upload->upload_image($_FILES["files_to_upload_2"], "./../uploads/customers/");
        $customer->stock_insurance_image = $image_name2;

        } else {
           $customer->stock_insurance_image = NULL;
       }

       if (isset($_FILES["files_to_upload_3"]["name"]) && !empty($_FILES["files_to_upload_3"]["name"])) {

        $image_upload = new ImageUpload();
        $image_name3 = $image_upload->upload_image($_FILES["files_to_upload_3"], "./../uploads/customers/");
        $customer->bank_gurantee_image = $image_name3;

        } else {
           $customer->bank_gurantee_image = NULL;
        }


        if (isset($_FILES["files_to_upload_4"]["name"]) && !empty($_FILES["files_to_upload_4"]["name"])) {

            $image_upload = new ImageUpload();
            $image_name4 = $image_upload->upload_image($_FILES["files_to_upload_4"], "./../uploads/customers/");
            $customer->id_image = $image_name4;

        } else {
           $customer->id_image = NULL;
        }


try {
    $customer->save();
    $_SESSION["message"] = "Successfully saved.";
    Activity::log_action("Customer - saved:" . $customer->name);
    Functions::redirect_to("./../customer_management.php");
} catch (Exception $exc) {
    $_SESSION["error"] = "Error..! Failed to save.";
    Functions::redirect_to("./../customer_management.php");
}
}
}

if (isset($_POST['update'])) {
    if (Functions::check_privilege_redirect("Customer", "upd", "./../index.php")) {
        $customer = Customer::find_by_id($_POST['id']);
        $customer->name = trim($_POST['name']);
        $customer->code = trim($_POST['code']);
        $customer->stock_insurance = trim($_POST['stock_insurance']);
        $customer->stock_mortgaged = trim($_POST['stock_mortgaged']);
        $customer->bank_gurantee = trim($_POST['bank_gurantee']);
        $customer->address = trim($_POST['address']);
        $customer->phone = trim($_POST['phone']);
        $customer->fax = trim($_POST['fax']);
        $customer->email = trim($_POST['email']);
        $customer->prop_name_email = trim($_POST['prop_name_email']);
        $customer->prop_id = trim($_POST['prop_id']);
        $customer->prop_tel = trim($_POST['prop_tel']);
        $customer->intro_a = trim($_POST['intro_a']);
        $customer->intro_b = trim($_POST['intro_b']);
        $customer->po_name_designation = trim($_POST['po_name_designation']);
        $customer->bank_name = trim($_POST['bank_name']);
        $customer->month_purchase = trim($_POST['month_purchase']);
        $customer->balance = trim($_POST['balance']);
        $customer->balance_increase = trim($_POST['balance_increase']);
        $customer->period = trim($_POST['period']);
        $customer->payment_method = trim($_POST['payment_method']);
        $customer->route_id = trim($_POST['route_id']);
        $customer->birthday = trim($_POST['birthday']);
        $customer->account_number = trim($_POST['account_number']);
        $customer->allocated_rep = trim($_POST['allocated_rep']);
        

        // echo $customer->route_id;

        // global $database;
        // $database->start_transaction();

        
        if (isset($_FILES["files_to_upload_1"]["name"]) && !empty($_FILES["files_to_upload_1"]["name"])) {

            $image_upload = new ImageUpload();
            $image_name1 = $image_upload->upload_image($_FILES["files_to_upload_1"], "./../uploads/customers/");
            $customer->code_image = $image_name1;

        } else {
           $customer->code_image = NULL;
       }

       if (isset($_FILES["files_to_upload_2"]["name"]) && !empty($_FILES["files_to_upload_2"]["name"])) {

        $image_upload = new ImageUpload();
        $image_name2 = $image_upload->upload_image($_FILES["files_to_upload_2"], "./../uploads/customers/");
        $customer->stock_insurance_image = $image_name2;

        } else {
           $customer->stock_insurance_image = NULL;
       }

       if (isset($_FILES["files_to_upload_3"]["name"]) && !empty($_FILES["files_to_upload_3"]["name"])) {

        $image_upload = new ImageUpload();
        $image_name3 = $image_upload->upload_image($_FILES["files_to_upload_3"], "./../uploads/customers/");
        $customer->bank_gurantee_image = $image_name3;

        } else {
           $customer->bank_gurantee_image = NULL;
        }


        if (isset($_FILES["files_to_upload_4"]["name"]) && !empty($_FILES["files_to_upload_4"]["name"])) {

            $image_upload = new ImageUpload();
            $image_name4 = $image_upload->upload_image($_FILES["files_to_upload_4"], "./../uploads/customers/");
            $customer->id_image = $image_name4;

        } else {
           $customer->id_image = NULL;
        }       

        
            try {
                $customer->save();
                $_SESSION["message"] = "Successfully updated.";
                Activity::log_action("Customer - updated:" . $customer->name);
                Functions::redirect_to("./../customer_management.php");
            } catch (Exception $exc) {
                $_SESSION["error"] = "Error..! Failed to update.";
                Functions::redirect_to("./../customer_management.php");
            }
        
    }
}


if (isset($_POST['delete'])) {
    if (Functions::check_privilege_redirect("Customer", "del", "./../index.php")) {
        $customer = Customer::find_by_id($_POST["id"]);

        try {
            $customer->delete();
            $_SESSION["message"] = "Successfully deleted.";
            Activity::log_action("Customer - deleted:" . $customer->name);
            Functions::redirect_to("./../customer_management.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to deleted.";
            Functions::redirect_to("./../customer_management.php");
        }
    }
}
?>


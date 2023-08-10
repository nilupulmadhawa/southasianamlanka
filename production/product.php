<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

if (isset($_GET["id"])) {
  $id= Functions::custom_crypt($_GET["id"], 'd');
  if($product = Product::find_by_id($id)){

  }else{
    Session::set_error("Entry not available...");
    $product = new Product();
  }
}else{
  $product = new Product();
}

?>

<!--page content-->
<div class="right_col" role="main">
  <div class="">


    <div class="clearfix"></div>

    <?php Functions::output_result(); ?>

    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 id="title"><?php echo (empty($product->id)) ? 'ADD' : 'EDIT'; ?> PRODUCT</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form id="formProduct" action="proccess/product_proccess.php" method="post" class="form-horizontal form-label-left" enctype="multipart/form-data" >
              <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="hidden" class="form-control" id="txtId" name="id" value="<?php echo $product->id; ?>" />
                <div class="form-group">
                  <label>Part Number</label>
                  <input type="text" class="form-control" placeholder="Part Number" id="txtName" name="name" value="<?php echo $product->name; ?>" required="">
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select class="form-control" id="cmbCategory" name="category_id" required="">
                    <option disabled="" selected="">Select Category</option>
                    <?php
                    foreach (Category::find_all() as $category) {
                      if ($category->id == $product->category_id) {
                        ?>
                        <option selected="" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                        <?php
                      } else {
                        ?>
                        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>

                <!-- new add satrt -->
                <div class="form-group">
                  <label>Brand</label>
                  <!-- <input type="text" class="form-control" placeholder="Brand" name="brand" value="<?php echo $product->brand; ?>" required=""> -->
                  <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="brand">
                    <?php
                    foreach (Brand::find_all() as $brand) {
                      if ($brand->name == $product->brand) {
                        ?>
                        <option selected="" value="<?php echo $brand->name; ?>"><?php echo $brand->name; ?></option>
                        <?php
                      } else {
                        ?>
                        <option value="<?php echo $brand->name; ?>"><?php echo $brand->name; ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>

                </div>

                <div class="form-group">
                  <label>Description</label>
                  <input type="text" class="form-control" placeholder="Description" name="description" value="<?php echo $product->description; ?>" required="">
                </div>

                <div class="form-group">
                  <label>Vehicle Application</label>
                  <input type="text" class="form-control" placeholder="Vehicle Application" name="vehicle_application" value="<?php echo $product->vehicle_application; ?>" required="">
                </div>

                <div class="form-group">
                  <label>Unit Model</label>
                  <!-- <input type="text" class="form-control" placeholder="Unit Model" name="unit_model" value="<?php echo $product->unit_model; ?>" required=""> -->

                  <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="unit_model">
                    <?php
                    foreach (Unit::find_all() as $unit) {
                      if ($unit->id == $product->brand) {
                        ?>
                        <option selected="" value="<?php echo $unit->id; ?>"><?php echo $unit->name; ?></option>
                        <?php
                      } else {
                        ?>
                        <option value="<?php echo $unit->id; ?>"><?php echo $unit->name; ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>

                </div>




                <!-- new add ends -->

                <div class="form-group">
                  <label>Re-Order Level</label>
                  <input type="text" class="form-control" placeholder="Re-Order Quantity" id="txtRoq" name="roq" value="<?php if($product->roq != NULL){echo $product->roq;}else{echo "0";} ?>" required="">
                </div>
                <div class="form-group">
                  <label>Max Quantity</label>
                  <input type="text" class="form-control" placeholder="Max Quantity" id="txtMaxQty" name="max_qty" value="<?php if($product->max_qty != NULL){echo $product->max_qty;}else{echo "0";} ?>" required="">
                </div>
                <div class="form-group">
                  <label>Min Quantity</label>
                  <input type="text" class="form-control" placeholder="Min Quantity" id="txtMinQty" name="min_qty" value="<?php if($product->roq != NULL){echo $product->min_qty;}else{echo "0";} ?>" required="">
                </div>

                <div class="form-group">
                  <div class="col-md-2">
                    <?php
                    $image = "uploads/products/dflt.png";
                    if ($product->image) {
                      $image = "uploads/products/" . $product->image;
                    }
                    ?>
                    <img id="imgImage" src="<?php echo $image; ?>" alt=":( image not found..!" class="image img-responsive img-thumbnail">
                  </div>
                  <div class="col-md-10">
                    <label>Image</label>
                    <input id="inpFile" type="file" name="files_to_upload" />
                  </div>
                </div>

                <div class="form-group">

                  <label>Discount Limit : </label>

                  <input type="text" class="form-control" placeholder="Discount Limit" name="discount_limit" value="<?php echo $product->discount_limit; ?>" required="">

                </div>






              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                  <div class=" col-md-4 col-sm-4 col-xs-12">
                    <!--<button id="btnSave" type="submit" name="save" class="btn btn-block btn-success" onclick="return validateForm()"><i class="fa fa-floppy-o"></i> Save</button>-->
                    <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                  </div>
                  <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($product->id)) ? 'none' : 'initial'; ?>">
                    <!--<button id="btnDelete" type="submit" name="delete" class="btn btn-block btn-danger" onclick="return confirmDelete(this);"><i class="fa fa-trash"></i> Delete</button>-->
                    <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                  </div>
                  <div class=" col-md-4 col-sm-4 col-xs-12">
                    <a href="product.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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

  element = $("#cmbCategory");
  element_value = element.val();
  if (!element_value) {
    errors.push("Category - Not selected");
    element.css({"border": "1px solid red"});
  } else {
    element.css({"border": "1px solid #ccc"});
  }

  element = $("#txtRoq");
  element_value = element.val();
  if (element_value === "" || !(new RegExp("^[0-9]+$").test(element_value))) {
    errors.push("ROQ - Invalid");
    element.css({"border": "1px solid red"});
  } else {
    element.css({"border": "1px solid #ccc"});
  }

  element = $("#txtMaxQty");
  element_value = element.val();
  if (element_value === "" || !(new RegExp("^[0-9]+$").test(element_value))) {
    errors.push("Max Quantity - Invalid");
    element.css({"border": "1px solid red"});
  } else {
    element.css({"border": "1px solid #ccc"});
  }

  element = $("#txtMinQty");
  element_value = element.val();
  if (element_value === "" || !(new RegExp("^[0-9]+$").test(element_value))) {
    errors.push("Min Quantity - Invalid");
    element.css({"border": "1px solid red"});
  } else {
    element.css({"border": "1px solid #ccc"});
  }

  //        element=$("#txtCost");
  //        element_value=element.val();
  //        if (element_value === "" || !(new RegExp("^[0-9]+\.[0-9]{0,2}$").test(element_value))) {
  //            errors.push("Cost - Invalid");
  //            element.css({"border": "1px solid red"});
  //        }else{
  //            element.css({"border": "1px solid #ccc"});
  //        }
  //
  //        element=$("#txtRetailPrice");
  //        element_value=element.val();
  //        if (element_value === "" || !(new RegExp("^[0-9]+\.[0-9]{0,2}$").test(element_value))) {
  //            errors.push("Retail Price - Invalid");
  //            element.css({"border": "1px solid red"});
  //        }else{
  //            element.css({"border": "1px solid #ccc"});
  //        }
  //
  //        element=$("#txtWholesalePrice");
  //        element_value=element.val();
  //        if (element_value === "" || !(new RegExp("^[0-9]+\.[0-9]{0,2}$").test(element_value))) {
  //            errors.push("Wholesale Price - Invalid");
  //            element.css({"border": "1px solid red"});
  //        }else{
  //            element.css({"border": "1px solid #ccc"});
  //        }

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
  var id = <?php echo ($product->id) ? 1 : 0; ?>;

  if (id) {
    if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Product", "upd")) {
      FormOperations.confirmSave(validateForm(), "#formProduct", id, null);
    }
  } else {
    if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Product", "ins")) {
      FormOperations.confirmSave(validateForm(), "#formProduct", id, null);
    }
  }
});

$("#btnDelete").click(function () {
  if (UserPrivileges.checkPrivilege("proccess/privileges_authenticate.php", "Product", "del")) {
    FormOperations.confirmDelete("#formProduct");
  }
});

</script>

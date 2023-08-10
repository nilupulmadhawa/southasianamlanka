<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

//if (!(isset($_POST["id"]) && $inventory = Inventory::find_by_id($_POST["id"]))) {
//    $inventory = new Inventory();
//}

if (isset($_GET["id"])) {
    $id= Functions::custom_crypt($_GET["id"], 'd');
    if($inventory = Inventory::find_by_id($id)){
        
    }else{
        Session::set_error("Entry not available...");
        $inventory = new Inventory();
    }
}else{
    $inventory = new Inventory();
}

?>

<!--page content--> 
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Inventory</h3>
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
                        <h2 id="title"><?php echo (empty($inventory->id)) ? 'Add' : 'Edit'; ?> Inventory</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="formInventory" action="proccess/inventory_proccess.php" method="post" class="form-horizontal form-label-left" >
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" class="form-control" id="txtId" name="id" value="<?php echo $inventory->id; ?>" />

                                <div class="form-group">
                                    <label>Product</label>
                                    <select class="form-control" id="cmbProduct" name="product_id" required="">
                                        <option disabled="" selected="">Select Product</option>
                                        <?php
                                        foreach (Product::find_all() as $product) {
                                            if ($product->id == $inventory->product_id) {
                                                ?>
                                                <option selected="" value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $product->id; ?>"><?php echo $product->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" placeholder="1" id="txtQty" name="qty" value="<?php echo $inventory->qty; ?>" required="">
                                </div>
                                <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <button id="btnSave" type="button" name="save" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12" style="display: <?php echo (empty($product->id)) ? 'none' : 'initial'; ?>">
                                        <button id="btnDelete" type="button" name="delete" class="btn btn-block btn-danger" ><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <a href="inventory.php"><button type="button" name="reset" class="btn btn-block btn-primary"><i class="fa fa-history"></i> Reset</button></a>
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

        element = $("#txtQty");
        element_value = element.val();
        if (element_value === "") {
            errors.push("Quantity  - Not selected");
            element.css({"border": "1px solid red"});
        } else {
            element.css({"border": "1px solid #ccc"});
        }

        element = $("#cmbProduct");
        element_value = element.val();
        if (element_value === "" || !(new RegExp("^[0-9]+$").test(element_value))) {
            errors.push("Product- Not selected");
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
        var id = <?php echo ($inventory->id) ? 1 : 0; ?>;
        FormOperations.confirmSave(validateForm(), "#formInventory", id);
    });

    $("#btnDelete").click(function () {
        FormOperations.confirmDelete("#formInventory");
    });

</script>
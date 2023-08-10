<?php
require_once './../util/initialize.php';

if (isset($_GET["id"])) {
    $id= Functions::custom_crypt($_GET["id"], 'd');
    if($customer_order = CustomerOrder::find_by_id($id)){

    }else{
        Session::set_error("Entry not available...");
        $customer_order = new CustomerOrder;
    }
}else{
    $customer_order = new CustomerOrder;
}

include 'common/upper_content.php';

$user=User::find_by_id($_SESSION["user"]["id"]);

?>

<!--page content--> 
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Invoice</h3>
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
                        <h2 id="title">Select Deliverer to Continue / Designation: <?php echo $user->designation_id()->name?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="form" action="invoice_1.php" method="post" class="form-horizontal form-label-left" >
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" class="form-control" id="txtId" name="customer_order_id" value="<?php echo $customer_order->id; ?>" />
                                <div class="form-group">
                                    <select class="form-control" id="cmbDeliverer" name="deliverer_id" required="">
                                        <option selected="" disabled="" value="0">Select Deliverer</option>

                                        <?php

                                        
                                        $deliverers=array();
                                       
                                            $deliverers=Deliverer::find_all();
                                        

                                        foreach ($deliverers as $deliverer) {
                                            ?>
                                            <option value="<?php echo $deliverer->id; ?>"><?php echo $deliverer->name." (".$deliverer->number.")"; ?></option>
                                            <?php
                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="modal-footer col-md-12 col-sm-12 col-xs-12">
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                    </div>
                                    <div class=" col-md-4 col-sm-4 col-xs-12">
                                        <button type="submit" name="reset" class="btn btn-block btn-primary"> Continue <i class="fa fa-arrow-circle-right"></i></button>
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
    };
    
    $("#cmbDeliverer").change(function (e) {
        e.preventDefault;
        var deliverer_id = $("#cmbDeliverer").val();
        if(deliverer_id){
            $("#form").submit();
        }
    });
</script>
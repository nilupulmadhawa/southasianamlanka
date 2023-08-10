<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';

if (isset($_GET["production_id_finalize"])) {
    $id = Functions::custom_crypt($_GET["production_id_finalize"], 'd');
    if ($production = Production::find_by_id($id)) {
        
    } else {
        $_SESSION["error"] = ("Entry not available...");
        Functions::redirect_to("production_management.php");
    }
} else {
    $_SESSION["error"] = ("Select a valid production...");
    Functions::redirect_to("production_management.php");
}
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Production Details</h3>
            </div>

            <div class="title_right">
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="container" >

            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                    <div class="x_title">
                        <button class="btn btn-default" id="btnPrint" style="float:right;"><i class="glyphicon glyphicon-print"></i> Print</button>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content" id="div_to_print">
                        <div class="x_title">
                            <h3 style="text-align: center;">Production Details Report</h3>
                        </div>
                        <div class="container">
                            <h4 class="title_left"><b>Production Details</b></h4>

                            <div class="table-responsive">
                                <div class="col-sm-6">
                                    <table class="table">
                                        <tr>
                                            <th>Product Code</th><td><?= $production->code ?></td>
                                        </tr>
                                        <tr>
                                            <!--<th>Recipie</th><td><?= Recipie::find_by_id($production->recipie_id)->name ?></td>-->
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table class="table">   
                                        <tr>
                                            <th>Date</th><td><?= $production->date ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th><td><?= ProductionStatus::find_by_id($production->production_status_id)->name ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <br/>
                            </div>
                        </div>
                        <div class="container">
                            <h4 class="title_left"><b>Product Details</b></h4>

                            <div class="x_content table-responsive">


                                <table class="table table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Batch Code</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $production_products = ProductionProduct::find_by_sql("SELECT * FROM production_product WHERE production_id =$production->id");
                                        foreach ($production_products as $production_product) {
                                            $batch = $production_product->batch_id();
                                            ?> 
                                            <tr>
                                                <td><?= $batch->product_id()->name ?></td>
                                                <td><?= $batch->code ?></td>
                                                <td><?= $production_product->qty ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <br/>
                            </div>

                        </div>


                    </div>
                    <!-- second table-->

                </div>
            </div>
        </div>

    </div>

</div>


<!--/page content--> 
<?php include 'common/bottom_content.php'; ?>
<script>
    $('#btnPrint').click(function () {
        PrintDiv();
    });

    function PrintDiv() {
        var divToPrint = document.getElementById('div_to_print');
        var popupWin = window.open('', '_blank', 'width=800,height=500');
        popupWin.document.open();
        popupWin.document.write('<html><head><link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>
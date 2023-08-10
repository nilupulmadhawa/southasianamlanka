<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
session_start();
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Material Stock Details</h3>
            </div>

            <div class="title_right">
                <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="row" id="divInvoice">

                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive" id="print_div">
                    <div class="x_panel">
                        <div class="x_title" style="background-color: #424242;color:white;border-radius: 5px 5px 0px 0px;"><h3><center>Material Stock Report</center></h3></div>
                        <div class="x_content">
                            <div class="table-responsive">

                                <table id="sata_table" class="table table-striped " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>Volume</th>
                                            <th>Unit Cost</th>
                                            <th>Line Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">
                                        <?php
//                                        
                                        $total =0;
                                        $line_total =0;
                                        
                                        foreach (MaterialStock::find_all() as $material_stock) {
                                            
                                            $grn_material = $material_stock->grn_material_id();
                                            $line_total += ($material_stock->volume)*($grn_material->unit_price);
                                            $total += $line_total; 
                                            ?>
                                            <tr>
                                                <td><?php echo $material_stock->material_id()->name ?></td>
                                                <td><?php echo $material_stock->volume ?></td>
                                                <td><?php echo number_format($grn_material->unit_price,2); ?></td>
                                                <td><?php echo number_format($line_total,2); ?></td>
                                                
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                            <tr style="background-color: gray;color: #fff;">
                                                <td><h4>Material Cost Total</h4></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td colspan="3" style="font-weight: bolder;"><h4><?php echo number_format($total,2)."LKR"; ?></h4></td>
                                            </tr>
                                    </tbody>
                                    <tfoot style="margin-top: 10px;">


                                        <tr style="background-color: #424242;color: white;">
                                            <td colspan="9" style="text-align: center;">Report Generated Report <?php  echo " on " . date("Y/m/d") . " at " . date("h:i:sa"); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include 'common/bottom_content.php'; ?>

<script>

    //print_div

    $('#btn_print').click(function () {
        PrintDiv();
    });

    function PrintDiv() {
        var divToPrint = document.getElementById('print_div');
        var popupWin = window.open('', '_blank', 'width=800,height=500');
        popupWin.document.open();
        popupWin.document.write('<html><head><link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>









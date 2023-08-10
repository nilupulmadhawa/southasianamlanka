<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Commision Report</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="row" id="divInvoice">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 id="title">Select Data</h2>
                            <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form action="commision_reports.php" method="post">
                                <div class="container-fluid divBackTopTable ">

                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                        <label>User :</label>
                                        <select class="form-control" name="cus_name">
                                            <?php 
                                            foreach(User::find_all() as $data){
                                                echo "<option value='".$data->id."'>".$data->name."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                        <label>From :</label>
                                        <input type="text" class="form-control" id="dtpFrom" name="dtpFrom" autocomplete="off" required />
                                    </div>

                                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                        <label>To :</label>
                                        <input type="text" class="form-control" id="dtpTo" name="dtpTo" autocomplete="off" required />
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label>&nbsp;</label>
                                        <div class="ui-widget">
                                            <button name="btnShow" class="btn btn-default btn-block">Show <i class="glyphicon glyphicon-arrow-down"></i></button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <br/>

                        </div>
                    </div>
                </div>


                <div class="col-md-12 col-sm-12 col-xs-12" id="print_div">
                    <div class="x_panel">
                        <div class="x_title" style="background-color: gray;color:white;border-radius: 5px 5px 0px 0px;"><h3><center>Sales Report</center></h3></div>
                        <div class="x_content">
                            <div class="col-sm-12">

                                <table id="sata_table" class="table-striped " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Bill No</th>
                                            <th style='text-align:right;'>Total</th>
                                            <th style='text-align:right;'>Discount</th>
                                            <th style='text-align:right;'>Net</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        $sales_total = 0;
                                        $discount_total = 0;

                                        if(isset($_POST['dtpFrom']) && isset($_POST['dtpTo'])){
                                            $dtpFrom = $_POST['dtpFrom'];
                                            $dtpTo = $_POST['dtpTo'];
                                            $cus_name = $_POST['cus_name'];

                                            foreach(Invoice::find_all_by_customer_id_user($dtpFrom, $dtpTo, $cus_name) as $data){
                                                echo "<tr>";
                                                echo "<td>".$data->date_time."</td>";
                                                echo "<td>".$data->code."</td>";
                                                echo "<td style='text-align:right;'>".number_format($data->gross_amount,2)."</td>";
                                                $discount = ($data->gross_amount-$data->net_amount);
                                                echo "<td style='text-align:right;'>".number_format($discount,2)."</td>";
                                                echo "<td style='text-align:right;'>".number_format($data->net_amount,2)."</td>";

                                                $sales_total = $sales_total + $data->net_amount;
                                                $discount_total = $discount_total + $discount;

                                                echo "</tr>";
                                            }

                                        }
                                        ?>

                                    </tbody>

                                </table>
                            </div>

                            <div class="col-sm-12" style="margin-top:20px;">
                                
                                <table class="table-bordered" style="width:50%;">                                    
                                    <tbody>
                                        <tr>
                                            <td style="padding:5px;">SALES TOTAL</td>
                                            <td style="padding:5px;text-align: right;font-weight: bold;"><?php echo number_format($sales_total,2); ?></td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px;">DISCOUNT TOTAL</td>
                                            <td style="padding:5px;text-align: right;font-weight: bold;"><?php echo number_format($discount_total,2); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Commision</td>
                                            <td style="padding:5px;text-align: right;font-weight: bold;">
                                                <?php 
                                                echo number_format(($discount_total*0.5),2); 
                                                ?>
                                                    
                                                </td>
                                        </tr>
                                    </tbody>
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

   $(function () {
    $("#dtpFrom").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
});

   $(function () {
    $("#dtpTo").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
});



    //print_div
    
    $('#btn_print').click(function (){
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







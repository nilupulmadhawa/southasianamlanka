<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>
<style>
    form::after{
        display: inline;
    }
</style>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Outstanding Invoices Report - Routes</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <!--                    <div class="x_title">
                                            <a href="user.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
                                            <div class="clearfix"></div>
                                        </div>-->
                    <form name="frm_route" action="outstanding_invoice_routes.php" method="post" style="display: inline">
                        <select autofocus="" required="" name="slct_route" class="form-control" style="width: auto; display: inline;">
                            <option value="0"  <?php if(isset($_POST["slct_route"]) and $_POST["slct_route"] == 0){ ?> selected="" <?php } ?>>All</option>
                            <?php
                                $routes = Route::find_all();
                                foreach ($routes as $route) {
                            ?>
                            <option value="<?php echo $route->id; ?>"  <?php if(isset($_POST["slct_route"]) and $_POST["slct_route"] == $route->id){ ?> selected="" <?php } ?>><?php echo $route->name; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <input type="submit" value="Submit" style="display: inline"/>
                    </form>

                    <button class="btn btn-default pull-right" id="btn_print" style="display: inline;"><i class="fa fa-print"></i>Print</button>

                    <div class="x_content" id="div_print">
                        <table id="datatable-responsive" class="" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <!--<th>ID</th>-->
                                    <th style="text-align: left;">Invoice Number</th>
                                    <th style="text-align: right;">Date</th>
                                    <th style="text-align:right;">0-14</th>
                                    <th style="text-align:right;">14-30</th>
                                    <th style="text-align:right;">30-60</th>
                                    <th style="text-align:right;"><60</th>
                                    <th style="text-align: right;">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!isset($_POST["slct_route"]) or $_POST["slct_route"] == 0){
                                        $routes = Route::find_all();
                                        $total_out = 0;
                                        foreach ($routes as $route){
                                            $route_invoices_count = 0;
                                            $customers_in_route = Customer::find_by_route_id($route->id);
                                            foreach ($customers_in_route as $customer){
                                                $customer_invoices = Invoice::customer_id_pending($customer->id);
                                                $customer_invoices_count = count($customer_invoices);
                                                $route_invoices_count += $customer_invoices_count;
                                            }
                                            if($route_invoices_count !=0){
                                ?>
                                             <tr>
                                                <td colspan="7" style="text-align: left; padding-top: 5px"><?php echo $route->name; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><hr style="margin: 0px 0px 5px;"/></td>
                                            </tr>
                                            <?php
                                                $one = 0;
                                                $two = 0;
                                                $three = 0;
                                                $four = 0;
                                                //$five = 0;

                                                foreach ($customers_in_route as $customer){
                                                    $customer_invoices = Invoice::customer_id_pending($customer->id);
                                                    foreach ($customer_invoices as $invoice){
                                                        $date_time= strtotime($invoice->date_time);
                                                        $date= date("Y-m-d", $date_time);
                                                        $today= date("Y-m-d");
                                                        $date1=date_create($date);
                                                        $date2=date_create($today);
                                                        $diff = date_diff($date1,$date2);
                                                        $diff = $diff->format("%a");
                                                        $diff = intval($diff);
                                            ?>
                                            <tr>
                                                <td style="text-align: left;"><?php echo $invoice->code; ?></td>
                                                <td style="text-align: right;"><?php echo $invoice->date_time; ?></td>
                                                <?php
                                                    if($diff <= 14){
                                                ?>
                                                <td style="text-align: right;"><?php echo $invoice->balance; $one += $invoice->balance ?></td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $invoice->balance; ?></td>
                                                <?php
                                                    }
                                                ?>

                                                <?php
                                                    if(14 < $diff && $diff <= 30){
                                                ?>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $invoice->balance; $two += $invoice->balance ?></td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $invoice->balance; ?></td>
                                                <?php
                                                    }
                                                ?>

                                                <?php
                                                    if(30 < $diff && $diff <= 60){
                                                ?>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $invoice->balance; $three += $invoice->balance ?></td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $invoice->balance; ?></td>
                                                <?php
                                                    }
                                                ?>

                                                <?php
                                                    if(60 < $diff){
                                                ?>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $invoice->balance; $four += $invoice->balance ?></td>
                                                <td style="text-align: right;"><?php echo $invoice->balance; ?></td>
                                                <?php
                                                    }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><hr style="margin: 0px 0px 5px;"/></td>
                                            </tr>
                                            <?php
                                            }}
                                                $five = $one + $two + $three + $four;
                                                $total_out += $five;
                                            ?>
                                            <tr style="background-color:gray; color:white;">
                                                <td colspan="2" style="text-align: left;">Sub Total</td>
                                                <td style="text-align: right;"><?php echo number_format($one, '2') ; ?></td>
                                                <td style="text-align: right;"><?php echo number_format($two, '2') ; ?></td>
                                                <td style="text-align: right;"><?php echo number_format($three, '2') ; ?></td>
                                                <td style="text-align: right;"><?php echo number_format($four, '2') ; ?></td>
                                                <td style="text-align: right;"><?php echo number_format($five, '2') ; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><hr style="margin: 5px 0px 0px;"/></td>
                                            </tr>
                                            <?php
                                        }}
                                            ?>
                                            <tr style='font-size:20px;'>
                                                <td style="text-align: left;">Total</td>
                                                <td colspan="6" style="text-align: right;"><?php echo number_format($total_out, '2'); ?> LKR</td>
                                            </tr>
                                            <?php
                                            ?>
                                <?php
                                    }else{
                                        $route_data = Route::find_by_id($_POST["slct_route"]);
                                        $custs_in_route = Customer::find_by_route_id($_POST["slct_route"]);
//                                        $user = User::find_by_id($_POST["slct_user"]);
//                                        $user_invs_pend = Invoice::user_invoices_pending($_POST["slct_user"]);
//                                        $user_invs_pend_count = count($user_invs_pend);
//                                        if($user_invs_pend_count != 0){
                                        $total_invoices = 0;
                                        foreach ($custs_in_route as $cust) {
                                        $invs = Invoice::invoices_pending_by_cust_id($cust->id);
                                        $invs_count = count($invs);
                                        $total_invoices += $invs_count;
                                        }

                                        if($total_invoices != 0){
                                ?>
                                <tr>
                                    <td colspan="7" style="text-align: left; padding-top: 5px"><?php echo $route_data->name ?></td>
                                </tr>
                                <?php
                                        //$total_out = 0;
                                        $one = 0;
                                        $two = 0;
                                        $three = 0;
                                        $four = 0;
                                        //$five = 0;
                                        foreach ($custs_in_route as $cust) {
                                        $invs = Invoice::invoices_pending_by_cust_id($cust->id);

                                        foreach ($invs as $inv){
                                ?>
                                            <tr>
                                                <td style="text-align: left;"><?php echo $inv->code; ?></td>
                                                <td style="text-align: right;"><?php echo $inv->date_time; ?></td>

                                                <?php
                                                $date_time = strtotime($inv->date_time);
                                                $date = date("Y-m-d", $date_time);
                                                $today = date("Y-m-d");
                                                $date1 = date_create($date);
                                                $date2 = date_create($today);
                                                $date_diff = date_diff($date1, $date2);
                                                $date_diff = $date_diff->format("%a");
                                                $date_diff = intval($date_diff);

                                                if($date_diff <= 14){
                                                ?>
                                                    <td style="text-align: right;"><?php echo $inv->balance; $one += $inv->balance; ?></td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; //$five += $inv->balance; ?></td>

                                                <?php
                                                }
                                                if(14 < $date_diff && $date_diff <=30){
                                                ?>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; $two += $inv->balance; ?></td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; //$five += $cc->balance; ?></td>

                                                <?php
                                                }
                                                if(30 < $date_diff && $date_diff <=60){
                                                ?>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; $three += $inv->balance; ?></td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; //$five += $cc->balance; ?></td>

                                                <?php
                                                }
                                                if(60 < $date_diff){
                                                ?>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; $four += $inv->balance; ?></td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; //$five += $cc->balance; ?></td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><hr style="margin: 0px 0px 5px;"/></td>
                                            </tr>
                                        <?php
                                        }
                                        }
                                ?>
                                    <tr style="background-color:gray; color:white;">
                                        <td colspan="2" style="text-align: left;">Total</td>
                                        <td style="text-align: right;"><?php echo number_format($one, '2'); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($two, '2'); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($three, '2'); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($four, '2'); ?></td>
                                        <td style='font-size:20px; text-align: right;'><?php echo number_format($one + $two + $three + $four, '2'); ?> LKR</td>
                                    </tr>
                                <?php
                                    }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/page content-->
<?php include 'common/bottom_content.php'; ?>

<script>
    $('#btn_print').click(function (){
        //window.print("reservation.php");
        PrintDiv();
    });
    function PrintDiv() {
       var divToPrint = document.getElementById('div_print');
       var popupWin = window.open('', '_blank', 'width=800,height=500');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
   }

    window.onfocus = function () {
        //location.reload();
    };
</script>

<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>
<style>
    .rightalign{
        text-align:right;
    }

    form::after{
        display: inline;
    }
</style>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Outstanding Invoices Report - Users</h3>
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
                    <form name="frm_user" action="outstanding_invoice_users.php" method="post" style="display: inline;">
                        <select autofocus="" required="" name="slct_user" class="form-control" style="width: auto; display: inline;">
                            <option value="0"  <?php if(isset($_POST["slct_user"]) and $_POST["slct_user"] == 0){ ?> selected="" <?php } ?>>All</option>
                            <?php
                                $users = User::find_all();
                                foreach ($users as $user) {
                            ?>
                            <option value="<?php echo $user->id; ?>" <?php if(isset($_POST["slct_user"]) and $_POST["slct_user"] == $user->id){ ?> selected="" <?php } ?>><?php echo $user->name; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <input type="submit" value="Submit" style="display: inline;"/>
                    </form>

                    <button class="btn btn-default pull-right" id="btn_print" style="display: inline;"><i class="fa fa-print"></i>Print</button>

                    <div class="x_content" id="div_print">
                        <table id="datatable-responsive" class="" cellspacing="0" width="100%">
                            <thead>
                                <tr>
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
                                    if(!isset($_POST["slct_user"]) or $_POST["slct_user"] == 0){
                                        $users = User::find_all();
                                        $total_out = 0;
                                        foreach ($users as $user){
                                                $user_invoices = Invoice::user_invoices_pending($user->id);
                                                $user_invoices_count = count($user_invoices);
                                                if($user_invoices_count !=0){
                                ?>
                                             <tr>
                                                <td colspan="7" style="text-align: left; padding-top: 5px"><?php echo $user->name . " - " . $user->contact_no; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><hr style="margin: 0px 0px 5px;"/></td>
                                            </tr>
                                            <?php
                                                $one = 0;
                                                $two = 0;
                                                $three = 0;
                                                $four = 0;
                                                $five = 0;

                                                foreach ($user_invoices as $user_invoice){
                                                    $date_time= strtotime($user_invoice->date_time);
                                                    $date= date("Y-m-d", $date_time);
                                                    $today= date("Y-m-d");
                                                    $date1=date_create($date);
                                                    $date2=date_create($today);
                                                    $diff = date_diff($date1,$date2);
                                                    $diff = $diff->format("%a");
                                                    $diff = intval($diff);
                                            ?>
                                            <tr>
                                                <td style="text-align: left;"><?php echo $user_invoice->code; ?></td>
                                                <td style="text-align: right;"><?php echo $user_invoice->date_time; ?></td>
                                                <?php
                                                    if($diff <= 14){
                                                ?>
                                                <td style="text-align: right;"><?php echo $user_invoice->balance; $one += $user_invoice->balance ?></td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $user_invoice->balance; ?></td>
                                                <?php
                                                    }
                                                ?>

                                                <?php
                                                    if(14 < $diff && $diff <= 30){
                                                ?>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $user_invoice->balance; $two += $user_invoice->balance ?></td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $user_invoice->balance; ?></td>
                                                <?php
                                                    }
                                                ?>

                                                <?php
                                                    if(30 < $diff && $diff <= 60){
                                                ?>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $user_invoice->balance; $three += $user_invoice->balance ?></td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $user_invoice->balance; ?></td>
                                                <?php
                                                    }
                                                ?>

                                                <?php
                                                    if(60 < $diff){
                                                ?>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;">0.00</td>
                                                <td style="text-align: right;"><?php echo $user_invoice->balance; $four += $user_invoice->balance ?></td>
                                                <td style="text-align: right;"><?php echo $user_invoice->balance; ?></td>
                                                <?php
                                                    }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><hr style="margin: 0px 0px 5px;"/></td>
                                            </tr>
                                            <?php
                                                }
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
                                            <tr>
                                                <td colspan="7"><hr style="margin: 0px 0px 5px;"/></td>
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
                                        $user = User::find_by_id($_POST["slct_user"]);
                                        $user_invs_pend = Invoice::user_invoices_pending($_POST["slct_user"]);
                                        $user_invs_pend_count = count($user_invs_pend);
                                        if($user_invs_pend_count != 0){
                                ?>
                                        <tr>
                                            <td colspan="7" style="text-align: left; padding-top: 5px"><?php echo $user->name . " - " . $user->contact_no; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7"><hr style="margin: 0px 0px 5px;"/></td>
                                        </tr>
                                        <?php
                                            $totalout = 0;
                                            $one = 0;
                                            $two = 0;
                                            $three = 0;
                                            $four = 0;
                                            //$five = 0;

                                            foreach ($user_invs_pend as $inv) {
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

                                                if($date_diff <= 30){
                                                ?>
                                                    <td style="text-align: right;"><?php echo $inv->balance; $one += $inv->balance; ?></td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; //$five += $inv->balance; ?></td>

                                                <?php
                                                }
                                                if(30 < $date_diff && $date_diff <=60){
                                                ?>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; $two += $inv->balance; ?></td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; //$five += $cc->balance; ?></td>

                                                <?php
                                                }
                                                if(60 < $date_diff && $date_diff <=90){
                                                ?>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; $three += $inv->balance; ?></td>
                                                    <td style="text-align: right;">0.00</td>
                                                    <td style="text-align: right;"><?php echo $inv->balance; //$five += $cc->balance; ?></td>

                                                <?php
                                                }
                                                if(90 < $date_diff){
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
                                              $totalout = $one + $two + $three + $four;
                                            }
                                            ?>
                                            <tr style="background-color:gray; color:white;">
                                                <td colspan="2" style="text-align: left;">Total</td>
                                                <td style="text-align: right;"><?php echo number_format($one, '2'); ?></td>
                                                <td style="text-align: right;"><?php echo number_format($two, '2'); ?></td>
                                                <td style="text-align: right;"><?php echo number_format($three, '2'); ?></td>
                                                <td style="text-align: right;"><?php echo number_format($four, '2'); ?></td>
                                                <td style='font-size:20px; text-align: right;'><?php echo number_format($totalout, '2'); ?> LKR</td>
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

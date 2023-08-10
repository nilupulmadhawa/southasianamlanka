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
                <h3>Debitor Aging Report - Customers</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">


                    <!-- <button class="btn btn-default pull-right" id="btn_print" style="display: inline;"><i class="fa fa-print"></i>Print</button> -->
                    <a class="btn btn-default pull-right" href="outstanding_invoice_customers_print.php" target='_blank'> <i class="fa fa-print"></i> PRINT </a>

                    <div class="x_content" id="div_print">
                        <table id="datatable-responsive" class="" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <!--<th>ID</th>-->
                                    <th style="text-align: left;">Invoice Number</th>
                                    <th style="text-align:right;">Date</th>
                                    <th style="text-align:right;">0-30</th>
                                    <th style="text-align:right;">31-60</th>
                                    <th style="text-align:right;">61-90</th>
                                    <th style="text-align:right;">91-120</th>
                                    <th style="text-align:right;">121-360</th>
                                    <th style="text-align:right;"> 360< </th>
                                    <th style="text-align:right;">Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;

                                $customers=array();
                                if (!isset($_POST["slct_cust"]) or $_POST["slct_cust"] == 0) {
                                    $customers = Customer::find_all();
                                }else{
                                    $customers[] = Customer::find_by_id($_POST["slct_cust"]);

                                }

                                $tone = 0;
                                $ttwo =0;
                                $tthree = 0;
                                $tfour = 0;
                                $tfive = 0;
                                $tsix = 0;
                                $ta = 0;


                                foreach ($customers as $customer) {
                                    $invoices = Invoice::customer_id_pending($customer->id);
                                    $inv_count = count($invoices);

                                    $outperiod = $customer->period;

                                    if ($inv_count != 0) {
                                        ?>
                                        <tr>
                                            <td colspan="8" style="text-align: left; padding-top: 5px;">
                                                <?php
                                                $balance = 0;
                                                $balance_str = "";

                                                echo $customer->name . " ( " . $customer->address . " ) " . $customer->phone;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9"><hr style="margin: 0px 0px 5px;"/></td>
                                        </tr>

                                        <?php
                                        $one = 0;
                                        $two = 0;
                                        $three = 0;
                                        $four = 0;
                                        $five = 0;
                                        $six = 0;
                                        $line_total = 0;
                                        foreach ($invoices as $invoice) {
                                            ?>
                                            <tr>
                                                <td style="text-align:left;"><?php echo $invoice->code; ?></td>
                                                <td style="text-align: right;"><?php echo $invoice->date_time; ?></td>
                                                <?php
                                                $date_time = strtotime($invoice->date_time);
                                                $date = date("Y-m-d", $date_time);
                                                $today = date("Y-m-d");
                                                $date1 = date_create($date);
                                                $date2 = date_create($today);
                                                $diff = date_diff($date1, $date2);
                                                $diff = $diff->format("%a");
                                                $diff = intval($diff);
                                                if ($diff <= 30) {
                                                    ?>

                                                    <?php if(1==1){ ?>
                                                        <td style="text-align: right;background-color: green;color:white;">
                                                        <?php }else{ ?>
                                                            <td style="text-align: right;">
                                                                <?php
                                                            }
                                                            echo $invoice->balance;
                                                            $one += $invoice->balance;
                                                            ?>
                                                        </td>
                                                        <!--<td>0.00</td>-->
                                                        <td style="text-align: right;">0.00</td>
                                                        <td style="text-align: right;">0.00</td>
                                                        <td style="text-align: right;">0.00</td>
                                                        <td style="text-align: right;">0.00</td>
                                                        <td style="text-align: right;">0.00</td>
                                                        <td style="text-align: right;">
                                                            <?php
                                                            echo $invoice->balance;
                                                            $line_total += $invoice->balance;
                                                            ?>
                                                        </td>
                                                        <?php
                                                    } if (30 < $diff && $diff <= 60) {
                                                        ?>
                                                        <!--<td>more 30</td>-->
                                                        <td style="text-align: right;">0.00</td>
                                                        <?php if(1==1){ ?>
                                                            <td style="text-align: right;background-color: orange;color:white;">
                                                            <?php }else{ ?>
                                                                <td style="text-align: right;">
                                                                    <?php
                                                                }
                                                                echo $invoice->balance;
                                                                $two += $invoice->balance;
                                                                ?>
                                                            </td>
                                                            <td style="text-align: right;">0.00</td>
                                                            <td style="text-align: right;">0.00</td>
                                                            <td style="text-align: right;">0.00</td>
                                                            <td style="text-align: right;">0.00</td>
                                                            <td style="text-align: right;">
                                                                <?php
                                                                echo $invoice->balance;
                                                                $line_total += $invoice->balance;
                                                                ?>
                                                            </td>
                                                            <?php
                                                        } if (60 < $diff && $diff <= 90) {
                                                            ?>
                                                            <!--<td>more 60</td>-->
                                                            <td style="text-align: right;">0.00</td>
                                                            <td style="text-align: right;">0.00</td>

                                                            <?php if(1==1){ ?>
                                                                <td style="text-align: right;background-color: red;color:white;">
                                                                <?php }else{ ?>
                                                                    <td style="text-align: right;">
                                                                        <?php
                                                                    }
                                                                    echo $invoice->balance;
                                                                    $three += $invoice->balance;
                                                                    ?>
                                                                </td>
                                                                <td style="text-align: right;">0.00</td>
                                                                <td style="text-align: right;">0.00</td>
                                                                <td style="text-align: right;">0.00</td>
                                                                <td style="text-align: right;">
                                                                    <?php
                                                                    echo $invoice->balance;
                                                                    $line_total += $invoice->balance;
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            } if (90 < $diff && $diff <= 120) {
                                                                ?>
                                                                <!--<td>more 90</td>-->
                                                                <td style="text-align: right;">0.00</td>
                                                                <td style="text-align: right;">0.00</td>
                                                                <td style="text-align: right;">0.00</td>

                                                                <?php if(1==1){ ?>
                                                                    <td style="text-align: right;background-color: red;color:white;">
                                                                    <?php }else{ ?>
                                                                        <td style="text-align: right;">
                                                                            <?php
                                                                        }
                                                                        echo $invoice->balance;
                                                                        $four += $invoice->balance;
                                                                        ?>
                                                                    </td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                    <td style="text-align: right;">0.00</td>

                                                                    <td style="text-align: right;">
                                                                        <?php
                                                                        echo $invoice->balance;
                                                                        $line_total += $invoice->balance;
                                                                        ?>
                                                                    </td>
                                                                    <?php
                                                                } if (120 < $diff && $diff <= 360) {
                                                                    ?>
                                                                    <!--<td>more 90</td>-->
                                                                    <td style="text-align: right;">0.00</td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                    <td style="text-align: right;">0.00</td>
                                                                    <td style="text-align: right;">0.00</td>

                                                                    <?php if(1==1){ ?>
                                                                        <td style="text-align: right;background-color: red;color:white;">
                                                                        <?php }else{ ?>
                                                                            <td style="text-align: right;">
                                                                                <?php
                                                                            }
                                                                            echo $invoice->balance;
                                                                            $five += $invoice->balance;
                                                                            ?>
                                                                        </td>
                                                                        <td style="text-align: right;">0.00</td>

                                                                        <td style="text-align: right;">
                                                                            <?php
                                                                            echo $invoice->balance;
                                                                            $line_total += $invoice->balance;
                                                                            ?>
                                                                        </td>
                                                                        <?php
                                                                    } if (360 < $diff) {
                                                                        ?>
                                                                        <!--<td>more 90</td>-->
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>
                                                                        <td style="text-align: right;">0.00</td>

                                                                        <?php if(1==1){ ?>
                                                                            <td style="text-align: right;background-color: red;color:white;">
                                                                            <?php }else{ ?>
                                                                                <td style="text-align: right;">
                                                                                    <?php
                                                                                }
                                                                                echo $invoice->balance;
                                                                                $six += $invoice->balance;
                                                                                ?>
                                                                            </td>


                                                                            <td style="text-align: right;">
                                                                                <?php
                                                                                echo $invoice->balance;
                                                                                $line_total += $invoice->balance;
                                                                                ?>
                                                                            </td>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="9"><hr style="margin: 0px 0px 5px;"/></td>
                                                                    </tr>
                                                                    <?php
//                                            $total += $line_total;
                                                                    $line_total += $balance;
                                                                    $total += $line_total;
                                                                }
                                                                ?>
                                                                <tr style="background-color:gray;color:white;">
                                                                    <td colspan="2" style="text-align: left;">Sub Total</td>
                                                                    <td style="text-align: right;"><?php echo number_format($one, '2'); ?></td>
                                                                    <td style="text-align: right;"><?php echo number_format($two, '2'); ?></td>
                                                                    <td style="text-align: right;"><?php echo number_format($three, '2'); ?></td>
                                                                    <td style="text-align: right;"><?php echo number_format($four, '2'); ?></td>
                                                                    <td style="text-align: right;"><?php echo number_format($five, '2'); ?></td>
                                                                    <td style="text-align: right;"><?php echo number_format($six, '2'); ?></td>
                                                                    <td style="text-align: right;"><?php echo number_format($one+$two+$three+$four+$five+$six, '2'); ?></td>
                                                                    <?php
                                                                    $tone = $tone + $one;
                                                                    $ttwo = $ttwo + $two;
                                                                    $tthree = $tthree + $three;
                                                                    $tfour = $tfour + $four;
                                                                    $tfive = $tfive + $five;
                                                                    $tsix = $tsix + $six;
                                                                    $ta = $ta + ($one+$two+$three+$four+$five+$six);

                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="7"><hr style="margin: 5px 0px 0px;"/></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <tr style="background-color:teal;color:white;">
                                                            <td colspan="2" style="text-align: left;">Total</td>
                                                            <td style="text-align: right;"><?php echo number_format($tone, '2'); ?></td>
                                                            <td style="text-align: right;"><?php echo number_format($ttwo, '2'); ?></td>
                                                            <td style="text-align: right;"><?php echo number_format($tthree, '2'); ?></td>
                                                            <td style="text-align: right;"><?php echo number_format($tfour, '2'); ?></td>
                                                            <td style="text-align: right;"><?php echo number_format($tfive, '2'); ?></td>
                                                            <td style="text-align: right;"><?php echo number_format($tsix, '2'); ?></td>
                                                            <td style="text-align: right;"><?php echo number_format($ta, '2'); ?></td>

                                                        </tr>
                                <!-- <tr style='font-size:20px;'>
                                    <td style="text-align: left;">Total</td>
                                    <td colspan="6" style="text-align: right;"><?php echo number_format($total, '2'); ?> LKR</td>
                                </tr> -->
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
    $('#btn_print').click(function () {
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

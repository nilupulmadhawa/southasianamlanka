<?php
require_once './../util/initialize.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>

  <style>
    td{
      font-size: 12px;
    }
    th{
      font-size: 13px;
    }
  </style>
</head>
<body>

  <table style="width:800px;">
    <tr>

      <td colspan="2" style="text-align:center;">
        <p style="font-size:15px;text-transform: uppercase;"><b style="font-size:20px;"><?php echo ProjectConfig::$project_name; ?></b> <br/> NO: 332/29, LESSLISS LAND, RATHNAPURA ROAD, MUNAGAMA, HOARANA. <br/>
          TEL: <?php echo ProjectConfig::$tel_html; ?> || FAX: 011 588 3813 || HOTLINE: 0777 191 784 / 0703 963 615</p>

          <p style="font-weight:900;"> DEBITOR AGING REPORT ( <?php echo date('d-m-Y')." @ ".date('h:s:m'); ?> ) </p>
        </td>

      </tr>



    </table>

    <div>

      <!-- table starts -->

      <table id="datatable-responsive" class="" cellspacing="0" width="800px">
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

                    <?php if($outperiod < $diff){ ?>
                      <td style="text-align: right;background-color: orange;">
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
                      <?php if($outperiod < $diff){ ?>
                        <td style="text-align: right;background-color: orange;">
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

                        <?php if($outperiod < $diff){ ?>
                          <td style="text-align: right;background-color: red;">
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

                          <?php if($outperiod < $diff){ ?>
                            <td style="text-align: right;background-color: red;">
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

                            <?php if($outperiod < $diff){ ?>
                              <td style="text-align: right;background-color: red;">
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

                              <?php if($outperiod < $diff){ ?>
                                <td style="text-align: right;background-color: red;">
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
                          <tr style="background-color:gray;color:black;">
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

                      <tr style="background-color:teal;color:black;">
                        <td colspan="2" style="text-align: left;border-top:1px solid;">Total</td>
                        <td style="text-align: right;border-top:1px solid;"><?php echo number_format($tone, '2'); ?></td>
                        <td style="text-align: right;border-top:1px solid;"><?php echo number_format($ttwo, '2'); ?></td>
                        <td style="text-align: right;border-top:1px solid;"><?php echo number_format($tthree, '2'); ?></td>
                        <td style="text-align: right;border-top:1px solid;"><?php echo number_format($tfour, '2'); ?></td>
                        <td style="text-align: right;border-top:1px solid;"><?php echo number_format($tfive, '2'); ?></td>
                        <td style="text-align: right;border-top:1px solid;"><?php echo number_format($tsix, '2'); ?></td>
                        <td style="text-align: right;border-top:1px solid;"><?php echo number_format($ta, '2'); ?></td>

                      </tr>
                      <!-- <tr style='font-size:20px;'>
                      <td style="text-align: left;">Total</td>
                      <td colspan="6" style="text-align: right;"><?php echo number_format($total, '2'); ?> LKR</td>
                    </tr> -->
                  </tbody>
                </table>

                <!-- table ends -->

              </div>



            </body>
            <script type="text/javascript">

            window.print();

            </script>
            </html>

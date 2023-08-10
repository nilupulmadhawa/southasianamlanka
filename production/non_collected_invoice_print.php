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

          <p style="font-weight:900;"> NON COLLECTED INVOICE REPORT ( <?php echo date('d-m-Y')." @ ".date('h:s:m'); ?> ) </p>
        </td>

      </tr>



    </table>

    <div>

      <!-- table starts -->

      <table id="sata_table" class="table table-striped " cellspacing="0" width="800px">
        <thead>
            <tr>
                <th></th>
                <th style='text-align: right;'>Date</th>
                <th style='text-align: right;'>Bill No</th>
                <th style='text-align: right;'>Total</th>
                <th style='text-align: right;'>Discount</th>
                <th style='text-align: right;'>Net</th>
            </tr>
        </thead>
        <tbody id="table_body">

            <?php
            $date = date("Y-m-d h:i:s");
            $date = strtotime($date.' -2 months');
            $two_months = date('Y-m-d h:i:s', $date);

            // echo $two_months;



            foreach (Customer::find_all() as $cus_data) {

                $gross_total = 0;
                $dis_total = 0;
                $net_total = 0;
                $rowcount = 0;
                foreach (Invoice::find_all_before_date($cus_data->id, $two_months) as $inv_data) {

                    if($rowcount == 0){
                        echo "<tr>";
                        echo "<td colspan='6'><b>".$cus_data->name."</b></td>";
                        echo "</tr>";
                        ++$rowcount;
                    }

                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td style='text-align: right;'>".$inv_data->date_time."</td>";
                    echo "<td style='text-align: right;'>".$inv_data->code."</td>";
                    echo "<td style='text-align: right;'>".$inv_data->gross_amount."</td>";
                    echo "<td style='text-align: right;'>".($inv_data->gross_amount - $inv_data->net_amount)."</td>";
                    echo "<td style='text-align: right;'>".$inv_data->net_amount."</td>";

                    echo "</tr>";
                    $gross_total = $gross_total + $inv_data->gross_amount;
                    $dis_total = $dis_total + ($inv_data->gross_amount - $inv_data->net_amount);
                    $net_total = $net_total + $inv_data->net_amount;
                }
                if($net_total > 0){
                  echo "<tr>";
                  echo "<td colspan='4' style='text-align:right;'><b>".number_format($gross_total,2)."</b></td>";
                  echo "<td style='text-align:right;'><b>".number_format($dis_total,2)."</b></td>";
                  echo "<td style='text-align:right;'><b>".number_format($net_total,2)."</b></td>";
                  echo "</tr>";
              }

          }


          ?>

      </tbody>

  </table>


      <!-- table ends -->

    </div>



  </body>
  <script type="text/javascript">

  window.print();

  </script>
  </html>

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

          <p style="font-weight:900;"> STOCK REPORT ( <?php echo date('d-m-Y')." @ ".date('h:s:m'); ?> ) By: <?php echo $_SESSION["user"]["name"]; ?> </p>
        </td>

      </tr>



    </table>

    <div>

      <!-- table starts -->

      <table id="sata_table" class="table table-striped " cellspacing="0" width="700px">
        <thead>
          <tr style='font-size:10px;'>
            <th style="width:100px;"></th>
            <th style='text-align:left;'>Part Number</th>
            <th style='text-align:left;'>Description</th>
            <th style='text-align:right;'>Stock Qty</th>
            <th style="text-align: right;">Cost</th>
            <th style="text-align: right;">Line Total</th>
          </tr>
        </thead>
        <tbody id="table_body">

          <?php

          function qty($product_id){
            $qty = 0;
            foreach (Inventory::find_all_by_product_id($product_id) as $data) {
              $qty = $qty + $data->qty;
            }
            return $qty;
          }

          function cost($product_id){
            $cost = 0;
            foreach (Inventory::find_all_by_product_id($product_id) as $data) {
              $cost = $data->batch_id()->cost;
            }
            return $cost;
          }

          if(isset($_GET['brand'])){
            $brand_name = $_GET['brand'];
            $total = 0;



            echo "<tr style='font-size:10px;font-weight:800;'>";
            echo "<td colspan='6'>".$brand_name."</td>";
            echo "</tr>";


            $rowcount = 0;

            $linetotal = 0;

            foreach(Product::find_all_by_brand($brand_name) as $product){

              $stockqty = qty($product->id);
              if($stockqty > 0){
                $cost_price = cost($product->id);
                if($rowcount == 0){
                  echo "<tr style='font-size:10px;'>";
                  echo "<td><i>Location</i></td>";
                  echo "<td colspan='5'><i>Store</i></td>";
                  echo "</tr>";
                }
                echo "<tr style='font-size:10px;'>";
                echo "<td style='padding-top:3px;'></td>";
                echo "<td style='text-align:left;border-bottom:1px solid;padding-top:3px;'>".$product->name."</td>";
                echo "<td style='text-align:left;border-bottom:1px solid;padding-top:3px;'>".$product->description."</td>";
                echo "<td style='text-align:right;padding-right:10px;border-bottom:1px solid;padding-top:3px;'>".$stockqty."</td>";
                echo "<td style='text-align:right;border-bottom:1px solid;padding-top:3px;'>".number_format($cost_price,2)."</td>";
                echo "<td style='text-align:right;border-bottom:1px solid;padding-top:3px;'>".number_format(($cost_price*$stockqty),2)."</td>";

                $total = $total + ($cost_price*$stockqty);

                $linetotal = $linetotal + ($cost_price*$stockqty);
                echo "</tr>";
                ++$rowcount;


              }
            }

            echo "<tr style='background-color:teal;color:black;'>";
            echo "<td colspan='5' style='text-align:right;'>Total: </td>";
            echo "<td style='text-align:right;'>".number_format($linetotal,2)."</td>";
            echo "</tr>";



            $rowcount = 0;

            foreach (ProductReturnBatch::find_all_damage() as $return) {

              if($return->batch_id()->product_id()->brand == $brand_name){

                if($rowcount == 0){
                  echo "<tr style='font-size:10px;'>";
                  echo "<td><i>location</i></td>";
                  echo "<td colspan='4'><i>damage</i></td>";
                  echo "</tr>";
                  ++$rowcount;
                }

                echo "<tr style='font-size:10px;'>";
                echo "<td></td>";
                echo "<td>".$return->batch_id()->product_id()->name."</td>";
                echo "<td>".$return->batch_id()->product_id()->description."</td>";
                echo "<td>".$return->qty."</td>";
                echo "<td style='text-align:right;'>".$return->batch_id()->cost."</td>";
                $total = $total + $return->batch_id()->cost;
                echo "</tr>";

              }
            }


          // echo "<tr style='font-size:15px;font-weight:bold;'>";
          //
          // echo "<td style='text-align:right;' colspan='5'>TOTAL</td>";
          // echo "<td style='text-align:right;'>".number_format($total)."</td>";
          // echo "</tr>";
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

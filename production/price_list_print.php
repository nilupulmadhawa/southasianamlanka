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

    <div style="padding-left:50px;padding-right:50px;">

      <!-- table starts -->

      <table id="sata_table" class="table table-striped " cellspacing="0" width="100%" style="font-size:14px;">
        <thead>
          <tr>
            <th style='text-align:left;font-size:14px;'>Part Number</th>
            <th style='text-align:left;font-size:14px;'>Brand</th>
            <th style='text-align:left;font-size:14px;'>Description</th>
            <th style='text-align:right;font-size:14px;'>Selling Price</th>
          </tr>
        </thead>
        <tbody id="table_body">
          <?php
          foreach(Product::find_all() as $product){
            foreach(Batch::find_all_by_product_id_last($product->id) as $batch){
              // $inventory = Inventory::find_by_product_id($product->id);
              $qty = 0;
                    // foreach($delivery_inventory as $inv_data){
                    //   $qty = $qty + $inv_data->qty;
                    // }

              //       foreach ( Inventory::find_all_by_product_id($product->id) as $inventory ) {
              //           $qty = $qty + $inventory->qty;
              //       }
              // if( $qty > 0){
                echo "<tr>";
                echo "<td style='text-align:left;font-size:13px;padding-top:3px;'>".$product->name."</td>";
                echo "<td style='text-align:left;font-size:13px;'>".$product->brand."</td>";
                echo "<td style='text-align:left;font-size:13px;'>".$product->description."</td>";
                echo "<td style='text-align:right;font-size:13px;'>".number_format($batch->retail_price,2)."</td>";
                echo "</tr>";
            // }
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

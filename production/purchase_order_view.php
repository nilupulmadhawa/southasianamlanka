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

      <?php
      $poid = $_GET['id'];
      $po = PurchaseOrder::find_by_id($poid);
      ?>

      <td style="width:400px;">
        <p style="font-size:11px;text-transform: uppercase;"><b style="font-size:19px;"><?php echo ProjectConfig::$project_name; ?></b> <br/> NO: 332/29, LESSLISS LAND, RATHNAPURA ROAD, MUNAGAMA, HOARANA. <br/>
          TEL: <?php echo ProjectConfig::$tel_html; ?> || FAX: +94 11 588 3813 <br/> HOTLINE: +94 777 191 784 / +94 703 963 615</p>
          <!-- <p style="font-weight:900;"> PURCHASE ORDER ( <?php echo date('d-m-Y')." @ ".date('h:s:m'); ?> ) </p> -->
        </td>

        <td style="width:400px;text-align:center;padding-top:15px;">
          <b style="font-size:20px;">PURCHASE ORDER</b>
          <p style="font-size:13px;">DATE : <?php echo $po->date; ?></p>
          <p style="font-size:13px;margin-top:-12px;">PO NUMBER : <?php echo sprintf('%05d', $po->id);; ?></p>
        </td>

      </tr>



    </table>

    <table style="width:800px;">
      <tr>
        <?php
        $poid = $_GET['id'];
        $po = PurchaseOrder::find_by_id($poid);
        ?>

        <td style="width:400px;">
          <p style="font-size:10px;text-transform: uppercase;"><b style="font-size:10px;">VENDOR</b> <br/> <b style='font-size:15px;'><?php echo $po->supplier_id()->name; ?></b> <br/> <?php echo $po->supplier_id()->address; ?> </p>
        </td>

      </tr>



    </table>

    <div>

      <!-- table starts -->
      <table id="sata_table" class="table table-striped " cellspacing="0" width="700px">
        <thead>
          <tr style='font-size:10px;'>

            <th style='text-align:left;border-top:1px solid;width:100px;'>CATEGORY</th>
            <th style='text-align:left;border-top:1px solid;'>PART NUMBER</th>
            <th style='text-align:center;border-top:1px solid;width:55px;'>BRAND</th>
            <th style='text-align:left;border-top:1px solid;'>DESCRIPTION</th>
            <th style='text-align:center;border-top:1px solid;'>QTY</th>
            <th style='text-align:right;border-top:1px solid;'>UNIT PRICE</th>
            <th style='text-align:right;border-top:1px solid;'>TOTAL USD</th>

          </tr>
        </thead>
        <tbody id="table_body">

          <?php
          $total  = 0;
          foreach(PurchaseOrderProduct::find_all_by_purchase_order_id($po->id) as $data){
            echo "<tr>";
            echo "<td style='padding:1px;'>".$data->product_id()->category_id()->name."</td>";
            echo "<td style='padding:1px;'>".$data->product_id()->name."</td>";
            echo "<td style='padding:1px;text-align:center;'>".$data->product_id()->brand."</td>";
            echo "<td style='padding:1px;'>".$data->product_id()->description."</td>";
            echo "<td style='text-align:center;'>".$data->qty."</td>";
            echo "<td style='text-align:right;'>".number_format($data->dollar_rate,2)."</td>";
            echo "<td style='text-align:right;'>".number_format($data->dollar_rate*$data->qty,2)."</td>";
            echo "</tr>";
            $total = $total + ($data->dollar_rate * $data->qty);
          }

          echo "<tr>";
          echo "<td style='padding:1px;text-align:right;' colspan='6'>TOTAL FOB:</td>";
          echo "<td style='text-align:right;'>".number_format($total,2)."</td>";
          echo "</tr>";
          ?>

        </tbody>

      </table>

      <!-- table ends -->

    </div>
    <div style="width:800px;margin-top:20px;">
      <div style="width:300px;border:1px solid;text-align:center;height:150px;">
        <p>Comments Or Special Instructions</p>
      </div>
    </div>

    <div style="width:800px;margin-top:20px;font-size:15px;text-align:center;">
      <p>This is a computer generated Purchase Order, If you have any questions about this<br/> Please contact Email: southasianam@gmail.com</p>
    </div>





  </body>
  <script type="text/javascript">

  window.print();

  </script>
  </html>

<?php 
session_start();
$company = $_SESSION['company'];
$issue = $_SESSION['issue'];
?>
<html>
<head>
  <title>Dinu Distributers Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
  <style>
body {
    font-family: Arial;
}
    </style>
</head>
<body>
  <div class="row">
    <?php 
    include 'connection.php';
    $result = mysqli_query($conn,"SELECT * FROM company WHERE ID = $company ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $company,$address,$contact,$fax,$email;
              $companyname = $row[1];
              $address = $row[2];
              $contact = $row[3];
              $fax = $row[4];
              $email = $row[5];

            }
    mysqli_close($conn);
    ?>
    <div style="width:700px;font-size:15px;text-align:center;margin-left:15px;margin-bottom:-3px;">ITEM REPLACEMENT NOTE</div>
    <div style="width:700px;font-size:20px;text-align:center;margin-left:15px;margin-bottom:-2px;"><?php echo $companyname; ?></div>
    <div style="width:700px;font-size:10px;text-align:center;margin-left:12px;"><?php echo "Address: ".$address.", Tel: ".$contact.", Fax:".$fax.", Email:".$email; ?></div>
  
  </div>
  <div class="row">
    <div style="width:750px;height:20px;border:1px solid;margin-left:20px;margin-bottom:5px;font-size:12px;">
      <div style="width:100px;float:left;margin-left:5px;">Item Code</div>
      <div style="width:400px;float:left;margin-left:5px;text-align:left;">Description</div>
      <div style="width:50px;float:left;margin-left:5px;text-align:center;">Qty</div>
      <div style="width:100px;float:right;margin-right:5px;text-align:right;">Amount</div>
    </div>
  </div>
  <div class="row" style="clear:both;">
    <div style="width:750px;height:480px;margin-left:20px;border:1px solid;font-size:12px;">
    <?php 
    function name($itemid){
      include 'connection.php';
      $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid ");
      while($row = mysqli_fetch_array($result)){
        GLOBAL $name;
        $name = $row[2];
      }
      return $name;
      mysqli_close($conn);
    }
    function code($itemid){
      include 'connection.php';
      $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid ");
      while($row = mysqli_fetch_array($result)){
        GLOBAL $code;
        $code = $row[1];
      }
      return $code;
      mysqli_close($conn);
    }
    $reID = $_SESSION['reID'];
    include 'connection.php';
      $result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE reID = $reID ");
      while($row = mysqli_fetch_array($result)){
      echo "<div style='width:100px;float:left;margin-left:5px;margin-bottom:1px;'>".code($row[1])."</div>";
      echo "<div style='width:400px;float:left;margin-left:5px;text-align:left;margin-bottom:1px;'>".name($row[1])."</div>";
      echo "<div style='width:50px;float:left;margin-left:5px;text-align:center;margin-bottom:1px;'>".$row[2]."</div>";
      echo "<div style='width:100px;float:right;margin-right:5px;text-align:right;margin-bottom:1px;'>0.00</div>";
      }
      mysqli_close($conn);
    ?>
  </div>
  </div>
</body>
</html>
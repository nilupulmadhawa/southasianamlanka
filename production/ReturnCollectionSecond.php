<?php 
session_start(); 
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'title.php'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
  <!--jquery related-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>

  $(function() {

    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});

  });

  </script>

  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      border-bottom: 2px solid;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
      margin-top: 10px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }

  </style>
</head>
<body>

<nav class="navbar">
  <?php include 'HeaderMaintain.php'; ?>
</nav>
  <!--model content for the login sectoin-->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--end of model content for the login sectoin-->
<div class="container-fluid text-center">    
  <div class="row content">
    
    <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
	
      <div class="row">
      <div class="col-sm-12 text-left">

        
      
         <!--start of the table--><div style="height:500px;overflow:auto;">
        <table class="table table-striped">
          <thead>
                        
			 <tr>
        <td>ItemCode / Item Name</td>
        <td>Type</td>
        <td style='text-align:center;'>Quantity</td>
        <td style='text-align:right;'>Unit Price</td>
        <td style='text-align:right;'>Amount</td>
       </tr>
          </thead>
          <tbody>
            <?php 
            function price($multiID,$company){
              include 'connection.php';
              $price = 0;
              $result = mysqli_query($conn, "SELECT  * FROM multiprice WHERE ID = $multiID");
              while($row = mysqli_fetch_array($result)){
              GLOBAL $price;
              if($company == 2 ){
                $price = $row[4];
              }
              else{
                $price = $row[4];
              }
              
              }
              return $price;
              mysqli_close($conn);
            }
            include 'connection.php';
            $returnID = $_GET['id'];
            //echo $returnID;
            $result1 = mysqli_query($conn,"SELECT * FROM return_invoice WHERE reID = $returnID ");
            $rowcount=mysqli_num_rows($result1);
            //echo $rowcount;
            $steps = 1;
            $subtotal = 0;
            while($steps <= $rowcount){
            $result1 = mysqli_query($conn,"SELECT * FROM return_invoice WHERE reID = $returnID LIMIT $steps ");
            while($row=mysqli_fetch_array($result1)) {
              GLOBAL $itemid,$qty,$type;
              $itemid = $row[1];
              $qty = $row[2];
              $multiID = $row[9];
              $type = $row[8];

            }
              echo "<tr>";
              
              
              $result1 = mysqli_query($conn, "SELECT * FROM item WHERE Item_ID = $itemid ");
              while($row1 = mysqli_fetch_array($result1)){
              GLOBAL $itemname;
              $itemname = "<b>".$row1[1]."</b>(".$row1[2].")";
              
              }
              echo "<td>".$itemname."</td>";
              if($type == 1){
                echo "<td>Expired Item Return</td>";
              }
              else if($type == 2){
                echo "<td>Damaged Item Return</td>";
              }
              else if($type == 3){
                echo "<td>Item Return</td>";
              }
              else if($type == 4){
                echo "<td>Free Issue</td>";
              }
              echo "<td style='text-align:center;'>".$qty."</td>";
              $price = 0;
              $price1 = 0;
              $price1 = price($multiID,$company);
              echo "<td style='text-align:right;'>".number_format($price1,2)."</td>";
              $subt = 0;
              $subt = $price1 * $qty;
              echo "<td style='text-align:right;'>".number_format($subt,2)."</td>";
              echo "</tr>";
              $subtotal = $subtotal + $subt;
            $steps = $steps + 1;
          }
          echo "<tr>";
          echo "<td></td>";
          echo "<td></td>";
          echo "<td></td>";
          echo "<td style='text-align:right;'><b>TOTAL</b></td>";
          echo "<td style='text-align:right;'>".number_format($subtotal,2)."</td>";
          echo "</tr>";
            mysqli_close($conn);
            ?>
          </tbody>
        </table>
        <!--end of the table--></div>

      </div> 

     
    </div>
    
    </div>
    <div class="col-sm-2 sidenav">
      <?php include 'RightNavBar.php'; ?>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <?php include 'footer.php'; ?>
</footer>

</body>
</html>

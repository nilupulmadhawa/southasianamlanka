<?php 
session_start(); 
if(!isset($_SESSION['company'])){
  header('location:logout.php');
}
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
if($_SESSION['check'] != 1 ){
header('location:PO.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dinu Distributers Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
 

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
  <script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getfree.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>


</head>
<body style="background-color:#e3e3e3;">

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
    <div class="col-sm-2 sidenav">
      <?php include 'SideBarMaintain.php'; ?>
    </div>
    <div class="col-sm-8 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
      <div class="row">
      <div class="col-sm-6 text-left">
        
      <!--start of the form-->
       <form role="form" method="post" action="ConnectionPOSecond.php">
        
        
        <div class="form-group">
          <label>Product Code:</label>
          <select class="form-control" name="product" autofocus="on" onchange="showUser(this.value)"  >
            <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM item WHERE  CompanyID = $company ORDER BY Name ASC");
            while($row = mysqli_fetch_array($result)){
              echo "<option value = '".$row[0]."'>".$row[2]."</option>";
              }
              mysql_close($conn);
             ?>
          </select>
        </div>
		<div  id="txtHint" style="height:100px;margin-bottom:10px;"></div>
        <div class="form-group">
          <label>Quantity:</label>
          <input type="text" class="form-control" placeholder="Quantity" name="qty"  autocomplete="off" >
        </div>
		<div  id="txtHint1"></div> 
        <button type="submit" class="btn btn-default">Add</button>
      </form>
      <!--end of the form-->
	  
      </div> 
      <div class="col-sm-6">
        <div style="margin-top:25px;">
          <p>Purchse Order ID: <b><?php  $ponumber = $_SESSION['ponumber']; $invoicenumber = $_SESSION['invoicenumber']; $invoicenumber = sprintf("%04d", $invoicenumber); echo $invoicenumber; ?></b></p>
          <p>Supplier Name: <b><?php 
          include 'connection.php';
          $result = mysqli_query($conn,"SELECT * FROM rep_po WHERE ID = $ponumber ");
          while($row = mysqli_fetch_array($result)){
            GLOBAL $supid;
            $supid = $row[1];
          }
          $result = mysqli_query($conn,"SELECT * FROM supplier WHERE Sup_ID = $supid ");
          while($row = mysqli_fetch_array($result)){
            GLOBAL $name;
            $name = $row[1];
          }
          echo $name;
          mysqli_close($conn);
          ?></b></p>
           
          
           
        </div>		
		<div class="col-sm-12" style="margin-top:5px;">
		<?php if(isset($_SESSION['error']) ){ ?>
		<div class="alert alert-danger">
		  <strong>Warning!</strong> Cannot Proceed With The Submitted Quantity.
		</div>
		<?php }?>
		</div>
		
      </div>  
    </div>
    <div class="row">
      <br/>
      <!--start of the tabele--><div style="height:150px;overflow:auto;">
        <table class="table table-striped" width="100%" style="font-size:12px;">
        <thead>
        <tr>
        <th class="tablecol1">Product Name</th>
        <th class="tablecol3">Qty</th>
                
        <th class="tablecol3">Cost Price</th>
        <th class="tablecol3"></th>
        
        </tr>
      </thead>
         <tbody>
           <?php 
           include 'connection.php';
           $ponumber = $_SESSION['ponumber'];
           //echo $ponumber."</br>";
           $result = mysqli_query($conn, "SELECT * FROM rep_po_sub WHERE poID = $ponumber");
           $rowcount=mysqli_num_rows($result);
           //echo $rowcount."</br>";

           $steps = 1;
           while($rowcount>=$steps){
            $result = mysqli_query($conn,"SELECT * FROM rep_po_sub WHERE poID = $ponumber LIMIT $steps");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $itemID,$qty,$multiID,$poid;
              $itemID = $row[2];
              $qty = $row[3];
              $multiID = $row[4];
              $poid = $row[0];
            }
            $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $itemID");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $cost;
              $cost = $row[3];             
            }
            $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemID");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $itemname,$itemcode;
              $itemname = $row[2];             
              $itemcode = $row[1];             
            }
           

            echo "<tr>";
            echo "<td>".$itemcode." (".$itemname.")</td>";
            echo "<td>".$qty."</td>";
            echo "<td>".$cost."</td>";
            echo "<td><a href='DeletePOSecond.php?id=".$poid."'>DELETE</a></td>";
            echo "</tr>";
            $steps = $steps + 1;
           }
           mysqli_close($conn);
           ?> 
          </tbody>
        </table>
      <!--end of the tabele-->

    </div>
    <button type="submit" class="btn btn-primary" onClick="document.location.href='ConnectionSumitPOSecond.php'">SUBMIT THE PURCHASE ORDER</button>
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

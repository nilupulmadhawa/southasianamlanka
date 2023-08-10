<?php 
session_start(); 
$id1 = $_SESSION['id']; 

if(isset($_GET['delete'])){
	
	$DeleteID = $_GET['delete'];
	include 'connection.php';
	
	if(isset($_SESSION['active'])){
$active = $_SESSION['active'];
if($active == "ACTIVE"){
	$sql = "DELETE FROM rep_po WHERE ID = $DeleteID ";
	mysqli_query($conn,$sql);
    $sql = "DELETE FROM rep_po_sub WHERE poID = $DeleteID ";
	mysqli_query($conn,$sql);
	
	}
	
	//log start
//date_default_timezone_set("Asia/Kolkata");
//$time =   date("h:i:s");
//$today = date("Y-m-d");
//
//$logcount = 0;
//$result = mysqli_query($conn,"SELECT * FROM log");
//while($row = mysqli_fetch_array($result)){
//	$logcount = $row[0];
//}
//	$logcount = $logcount + 1;
//$result = "INSERT INTO log (ID, Purpose, RefID, Date, time, User_id) 
//VALUES ($logcount, 'Purcsahe Order Deleted', '$DeleteID', '$today', '$time', $id1)";
//mysqli_query($conn,$result);
//log end
	
	unset($_SESSION['active']);
	}
	mysqli_close($conn);
}
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
        xmlhttp.open("GET","active.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
    
    <!--    pnotify-->
    <script type="text/javascript" src="pnotofy/pnotify.custom.min.js"></script>
    <link href="pnotofy/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" /> 
    
    
</head>
<body>
    
    
    <?php if(isset($_SESSION['error'])) { ?>
    <script type="text/javascript">
    $(function(){
        
    PNotify.prototype.options.styling = "bootstrap3";
        
     new PNotify({
            title: 'LOGING FAILED!',
            text: '<b><?php echo $_SESSION['error'] ?></b>',
            type: 'error'
        });
        
    });
    </script>
    <?php
        unset($_SESSION['error']); 
    } 
    if(isset($_SESSION['success'])) { ?>
    <script type="text/javascript">
    $(function(){
        
    PNotify.prototype.options.styling = "bootstrap3";
        
     new PNotify({
            title: 'Success!',
            text: '<?php echo $_SESSION['success']; ?>',
            type: 'success'
        });
        
    });
    </script>
    <?php
        unset($_SESSION['success']); 
    }
    
    ?>
    

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
        <div style="text-align:right;"><label>PURCHASE // PURCHSE ORDER DETAILED REPORT</label></div>
      <div class="row">
      <div class="col-sm-12 text-left">

        
		<div class="row">
		<div class="col-sm-12" style="margin-bottom:5px;"> 
		 <!--Activate Delete-->
			<form class="form-inline" role="form">
			  <div class="form-group">
				<label>DELETE OPTION STATUS: <div id="txtHint" style="background-color:#eee;float:right;width:200px;text-align:center;"><b><?php if(isset($_SESSION['active'])){echo $_SESSION['active'];} else{ echo "DEACTIVATED"; } ?></b></div></label>
				<select class="form-control" onchange="showUser(this.value)">
					<option value="DEACTIVE">Deactivate</option>
					<option value="ACTIVE">Activate</option>
					
				</select>
			  </div>
			  
			</form>
			
		 </div>
		</div>
      
         <!--start of the table--><div style="height:500px;overflow:auto;">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Purchase Order ID</th>
              <th>Supplier Name</th>
              
              <th>Date</th>
              <th>STATUS</th>
			  
			  <th class="text-center">GRN PROCEED</th>
			  <th class="text-center"></th>
			  <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include 'connection.php';
            $count = 0;
			function deliver($id){
				$stat = 0;
				include 'connection.php';
				$result = mysqli_query($conn,"SELECT * FROM purchase_emp WHERE PoID = $id ");
				while($row = mysqli_fetch_array($result)){
					GLOBAL $stat;
					$stat = $row[4];
				}
				return $stat;
				mysqli_close($conn);
			}
            $result = mysqli_query($conn,"SELECT * FROM rep_po ORDER BY ID DESC");
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
                if($row[3] == 11){
			  echo "<td>".$row[0]."</td>";
              }
			  else{
				 echo "<td><a href='PurchaseOrderDetailedExtend.php?id=".$row[0]."' target='_blank'>".$row[0]."</a></td>";  
			  }
              

              echo "<td>".$row[1]."</td>";
              echo "<td>".$row[2]."</td>";
			  
			  if(deliver($row[0]) == 1){
				echo "<td style='color:black;'>Purchased</td>";  
			  }
              else if($row[3] == 0){
                echo "<td style='color:red;'>New</td>";
              }
              else if($row[3] == 1){
                echo "<td style='color:orange;'>Submitted</td>";
              }
              else if($row[3] == 2){
                echo "<td style='color:orange;'>Rep Allocated</td>";
              }
			  else if($row[3] == 11){
                echo "<td style='color:green;'>Done</td>";
              }
			  
			  if($row[3] == 11){
			  echo "<td class='text-center'>DONE</td>";
                  echo "<td>PRINT</td>";
              }
			  else{
				 echo "<td class='text-center'><a href='GrnProceed.php?id=".$row[0]."'>PROCEED</a></td>";
                  
                  echo "<td><a href='Poprint.php?id=".$row[0]."' target='_blank'>PRINT</a></td>";
			  }
			  
			  echo "<td><a href='PurchaseOrderDetailed.php?delete=".$row[0]."'>DELETE</a></td>";
              echo "</tr>";
            }

              

            

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

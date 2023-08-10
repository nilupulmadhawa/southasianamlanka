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
        xmlhttp.open("GET","Lroute.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
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
        <!--form start-->
        <div class="col-sm-12">

          <form class="form-inline" role="form" method="post" action="OutPrint.php" style="margin-left:7px;">
            <div class="form-group">
              <label >Customer Name:</label>
              <select class="form-control" name="route" autofocus="on" onchange="showUser(this.value)">
            <?php 
              include 'connection.php';
			$result = mysqli_query($conn, "SELECT * FROM cus_profile ORDER BY Customer_Code ASC");
            while($row = mysqli_fetch_array($result)){
              echo "<option value = '".$row[0]."'>".$row[1]."</option>";
              }
            ?>
          </select>
           </div>
            
            
            
          </form>
          <hr/>

        </div>     
		<div class="col-sm-12">
		<div style="float:left;color:#66CC00;">Within 30 Days</div>
		<div style="float:left;margin-left:25px;color:#669900;"> Between 45 and 30 Days</div>
		<div style="float:left;margin-left:25px;color:#FFCC00;"> Between 55 and 45 Days</div>
		<div style="float:left;margin-left:25px;color:#FF9900;"> Between 60 and 55 Days</div>
		<div style="float:left;margin-left:25px;color:#FF0000;"> More than 60 Days</div>
				<hr/>
		</div>

         <!--form end-->
         <div class="col-sm-12" id="txtHint">

          <!--start of the tabele--><div style="height:450px;overflow:auto;">
        <table class="table table-striped" width="100%" style="font-size:15px;">
        <thead>
        <tr>
        <th class="tablecol1">Customer Name</th>
        <th class="tablecol1">Contact</th>
        <th class="tablecol1 text-center">Date</th>
        <th class="tablecol3 text-center">Invoice Number</th>
        <th class="tablecol3 text-right">Amount</th> 
        <th class="tablecol3 text-right">Balance</th>        
        
        </tr>
      </thead>
         <tbody>

          
          </tbody>
        </table>
      <!--end of the tabele--></div>
	 
         </div>

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

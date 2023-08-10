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
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "getsupplier.php?q=" + str, true);
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
    
    <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
      <div class="row">
        <div class="col-sm-6">
          <form> 
          Supplier Name: <input type="text" class="form-control" onkeyup="showHint(this.value)" autofocus="on">
          </form>
          <div class="col-sm-12" style="padding:5px;margin-top:5px;">
            <br/> 
              <div class="col-sm-12" style="height:350px;overflow:auto;margin-top:-20px;margin-bottum:5px;"><span id="txtHint"></span></p></div>
          </div>

          
         
      </div>
      <div class="col-sm-6" style="margin-top:20px;margin-bottum:5px;border:1px solid;border-radius:15px;">        
        <!--form starts-->
         <form method="post" action="ConnectionUpdateSupplier.php">
          <?php
          include 'connection.php';
          if(isset($_REQUEST['name'])){
          $name = $_REQUEST['name'];
          
          $result = mysqli_query($conn,"SELECT * FROM supplier WHERE Name = '$name' AND CompanyID = $company ");
          while($row = mysqli_fetch_array($result)){
            echo "<br/>";
          echo" <div style='width:100px;'><b>Name:</b></div><input type='text' class='form-control' value='".$row['Name']."' name='name' ><br/>";
          echo" <div style='width:100px;'><b>Address:</b></div><input type='text' class='form-control' value='".$row['Address']."' name='address' ><br/>";
          echo" <div style='width:100px;'><b>Contact Number:</b></div><input type='text' class='form-control'  value='".$row['TPNo']."' name='contact' ><br/>";
          echo" <div style='width:100px;'><b>Fax:</b></div><input type='text'  class='form-control' value='".$row['Fax']."' name='fax' ><br/>";
          echo" <div style='width:100px;'><b>Email:</b></div><input type='text'  class='form-control' value='".$row['Email']."' name='email' >";
		  echo" <div style='width:100px;'><b>Contact Person:</b></div><input type='text'  class='form-control' value='".$row['Contact_per']."' name='contactper' ><br/><br/>";
          }
          }
          ?>
          <button type="submit" class="btn btn-default">Update</button>
         </form>
      </div>
      </div>
    </div>
    <div class="col-sm-2 sidenav">
      <?php include 'RightNavBar.php' ?>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <?php include 'footer.php'; ?>
</footer>

</body>
</html>

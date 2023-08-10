<?php
  include 'connection.php';
  if(isset($_POST['name'])){
    $name = $_POST['name'];


  }
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
        xmlhttp.open("GET","nameupdate.php?q="+str,true);
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
    >
    <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;">
      <div class="row" style="padding:10px;">
        <div class="col-sm-5" style="padding-top:5px;">
          <!--add stock to inventory form-->

              <select class="form-control" onchange="showUser(this.value)" autofocus="on">
                <option selected disabled> SELECT THE PRODUCT</option>
                  <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM item WHERE CompanyID = $company ORDER BY Name ASC");
                  while($row = mysqli_fetch_array($result)){
                    echo "<option value = '".$row[0]."'> ".$row['ItemCode']." (".$row[2].")</option>";
                    }
                    mysql_close($conn);
                   ?>
                </select>



		  <div id="txtHint" style="padding-top:5px;"><b></b></div>


          <!--end of add stock to inventory form-->

      </div>
      <div class="col-sm-7" style="margin-top:5px;margin-bottum:5px;border:1px solid;border-radius:15px;padding-top:10px; ">

            <!--table-->
            <!--start of the table-->
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Product Name</th>

            </tr>
          </thead>
          <tbody>
            <?php include'connection.php';
            $count = 0;
              $result = mysqli_query($conn,"SELECT * FROM item");
              while($row = mysqli_fetch_array($result)){
                GLOBAL $count;
                $count = $count + 1;
              }
              $steps = 1;
              while($steps<=$count){

                $result = mysqli_query($conn,"SELECT Name FROM item WHERE CompanyID = $company ORDER BY Name ASC LIMIT $steps ");
                while($row = mysqli_fetch_array($result)){
                  GLOBAL $Name;

                  $Name = $row[0];

                }
                  echo "<tr><td>".$Name."</td>";

                $steps = $steps + 1;
              }
             mysqli_close($conn);?>

          </tbody>
        </table>
        <!--end of the table-->

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

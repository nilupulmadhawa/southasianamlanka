<?php
session_start();
include 'connection.php';
$id1 = $_SESSION['id'];
$company = $_SESSION['company'];
if(isset($_GET['delID'])){
  $delID = $_GET['delID'];
  $itemID = 0;
  $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $delID");
  while($row=mysqli_fetch_array($result)) {
    $itemID = $row['Item_ID'];
  }
  $sql = "DELETE FROM multiprice WHERE ID = $delID";
  mysqli_query($conn, $sql);

  $sql = "DELETE FROM tbl_ret_final WHERE ProductID = $itemID";
  mysqli_query($conn, $sql);

}

if(isset($_POST['UpdatemulID'])){
  // echo "ok<br/>";
  include 'connection.php';

  $mulIDUpdate = mysqli_real_escape_string($conn,$_POST['UpdatemulID']);
  $cost = mysqli_real_escape_string($conn,$_POST['cost']);
  $whole = mysqli_real_escape_string($conn,$_POST['whole']);
  $ret = mysqli_real_escape_string($conn,$_POST['ret']);
  $bat = mysqli_real_escape_string($conn,$_POST['bat']);

  // echo $mulIDUpdate."<br>";

  // echo $cost."<br>";
  // echo $whole."<br>";
  // echo $ret."<br>";

  $cost = "UPDATE multiprice SET CostPrice = $cost WHERE ID = $mulIDUpdate ";
  $whole = "UPDATE multiprice SET Wprice = $whole WHERE ID = $mulIDUpdate ";
  $ret = "UPDATE multiprice SET RetailPrice = $ret WHERE ID = $mulIDUpdate ";
  $bat = "UPDATE multiprice SET batchID = '$bat' WHERE ID = $mulIDUpdate ";

  mysqli_query($conn,$whole);
  mysqli_query($conn,$ret);
  mysqli_query($conn,$cost);
  mysqli_query($conn,$bat);

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
  function showUser() {
    var groupID = document.getElementById("RetGroup").value;
    var groupPrice = document.getElementById("RetPrice").value;
    var groupFreeQty = document.getElementById("FreeQty").value;
    var groupFreeIssue = document.getElementById("FreeIssue").value;
    var groupDiscount = document.getElementById("Discount").value;
    // alert('done');
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

        document.getElementById("RetGroup").value = " ";
        document.getElementById("RetPrice").value = " ";

        document.getElementById("FreeQty").value = " ";
        document.getElementById("FreeIssue").value = " ";
        document.getElementById("Discount").value = " ";

        document.getElementById("RetGroup").focus();
      }
    }
    xmlhttp.open("GET","SetRetail.php?q="+groupID+"&&r="+groupPrice+"&&s="+groupFreeQty+"&&t="+groupFreeIssue+"&&u="+groupDiscount,true);
    xmlhttp.send();

  }

  function changeFunction(str){
    // alert('done');

    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("txtHint3").innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","MultiDetails.php?q="+str,true);
    xmlhttp.send();
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
      <?php

      function insertRet($GroupID, $RetPrice, $Qty, $FreeIssue, $Discount){
        include 'connection.php';
        $sql = "INSERT INTO tbl_ret (GroupID, RetPrice, Qty, FreeIssue, Discount)
        VALUES ('$GroupID', $RetPrice, $Qty, $FreeIssue, $Discount)";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
      }

      if(isset($_GET['Edit'])){
        include 'connection.php';
        $EditID = $_GET['Edit'];
        $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $EditID ");
        while($row=mysqli_fetch_array($result)) {
          $Mul = $row['ID'];
          $ItemID = $row['Item_ID'];
          $costPrice = $row['CostPrice'];
        }

        $sql = "DELETE FROM tbl_ret";
        mysqli_query($conn, $sql);

        $result = mysqli_query($conn,"SELECT * FROM tbl_ret_final WHERE ProductID = $ItemID AND multiID = $Mul ");
        while($row=mysqli_fetch_array($result)) {
          insertRet($row['GroupID'], $row['RetPrice'], $row['Qty'], $row['FreeIssue'], $row['Discount']);
        }


        mysqli_close($conn);
      }
      ?>
      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;padding:10px;">
        <div class="col-sm-12">
          <div class="col-sm-12 text-left" style="border:1px solid;padding:5px;">
            <!--start of the form-->
            <form role="form" method="post" action="ConnectionOldPrice.php">
              <div class="col-sm-6" style="margin-bottom:10px;">
                <div class="form-group">
                  <label>Item Name:</label>
                  <select class="form-control" name="product" onchange="changeFunction(this.value)" autofocus="on"  >
                    <option disabled selected>SELECT THE PRODUCT</option>
                    <?php
                    include'connection.php';
                    $result = mysqli_query($conn, "SELECT * FROM item WHERE  CompanyID = $company ORDER BY Name ASC");
                    while($row = mysqli_fetch_array($result)){
                      if($row[0] == $ItemID){
                        echo "<option value = '".$row[0]."' selected> ".$row[1]." / ".$row[2]."</option>";
                      }
                      else{
                        echo "<option value = '".$row[0]."'> ".$row[1]." / ".$row[2]."</option>";
                      }
                    }
                    mysql_close($conn);
                    ?>
                  </select>
                </div>



                <div class="form-group">
                  <label>Cost Price:</label>
                  <input type="text" class="form-control" name="cost" value='<?php echo $costPrice; ?>' autocomplete="off">
                </div>

                <div class="form-group">
                  <!-- <label>Wholesale Price:</label> -->
                  <input type="hidden" class="form-control" name="wp" value="0" autocomplete="off">
                </div>





              </div>

              <div class="col-sm-6" style="border:1px solid;box-shadow: 10px 5px 10px #888888;margin-bottom:20px;">


                <div class="col-sm-12">
                  <div class="col-sm-6" style="margin-bottom:10px;">
                    <label>Group ID:</label>
                    <input type="text" id="RetGroup" class="form-control" autocomplete="off">
                  </div>
                  <div class="col-sm-6">
                    <label>Price Range:</label>
                    <input type="text" id="RetPrice" class="form-control" autocomplete="off">
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="col-sm-4" style="margin-bottom:10px;">
                    <label>Qty:</label>
                    <input type="text" id="FreeQty" class="form-control" autocomplete="off">
                  </div>
                  <div class="col-sm-4">
                    <label>Free Issue:</label>
                    <input type="text" id="FreeIssue" class="form-control" autocomplete="off">
                  </div>
                  <div class="col-sm-4">
                    <label>Discount (%):</label>
                    <input type="text" id="Discount" class="form-control" placeholder="%" autocomplete="off">
                  </div>
                </div>

                <div class="col-sm-12">
                  <button type="button" onclick="showUser()" class="btn btn-warning btn-block">SET</button>
                  <!-- <p id="demo" >Click me to change my text color.</p> -->
                </div>

                <div class="col-sm-12" style="height:200px;overflow:auto;">
                  <?php
                  if(isset($_GET['delRet'])){
                    include 'connection.php';
                    $delID = $_GET['delRet'];
                    $sql = "DELETE FROM tbl_ret WHERE ID = $delID ";
                    mysqli_query($conn, $sql);
                  }
                  if(isset($_GET['clearall'])){
                    include 'connection.php';

                    $sql = "DELETE FROM tbl_ret";
                    mysqli_query($conn, $sql);
                  }
                  ?>
                  <div id="txtHint"></div>
                </div>

              </div>
              <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
            </form>
            <!--end of the form-->
          </div>
          <div class="col-sm-12" style="min-height:300px;margin-top:10px;background-color:white;border:1px solid;">
            <div  id="txtHint3"></div>
          </div>
        </div>

      </div>
      <div class="col-sm-2 sidenav">
        <?php include 'RightNavBar.php'; ?>
      </div>
    </div>
  </div>

  <script>
  checkData();
  function checkData(){
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
    xmlhttp.open("GET","SetRetailCheck.php",true);
    xmlhttp.send();

  }


  </script>

  <footer class="container-fluid text-center">
    <?php include 'footer.php'; ?>
  </footer>

</body>
</html>

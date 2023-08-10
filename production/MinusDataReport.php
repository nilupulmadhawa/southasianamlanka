<?php
session_start();
$id1 = $_SESSION['id'];
$prev = $_SESSION['prev'];
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
        <div style="text-align:right;"><label>INVENTORY MANAGEMENT // MINUS STOCK REPORT</label></div>
        <div class="row">


          <div class="col-sm-12 text-left">
            <table class="table">
              <thead>
                <tr>
                  <th>Item Code</th>
                  <th>Item Name</th>
                  <th>Customer</th>
                  <th>Qty</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  include 'connection.php';
                  function ItemCode($itemID){
                    $t = 0;
                    include 'connection.php';
                    $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemID ");
                    while($row = mysqli_fetch_array($result)){
                      $itemName = $row['ItemCode'];
                    }
                    mysqli_close($conn);
                    return $itemName;
                  }
                  function ItemName($itemID){
                    $t = 0;
                    include 'connection.php';
                    $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemID ");
                    while($row = mysqli_fetch_array($result)){
                      $itemName = $row['Name'];
                    }
                    mysqli_close($conn);
                    return $itemName;
                  }
                  function CusName($cusID){
                    include 'connection.php';
                    $result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = $cusID ");
                    while($row = mysqli_fetch_array($result)){
                      $itemName = $row['Name'];
                    }
                    mysqli_close($conn);
                    return $itemName;
                  }
                  $result = mysqli_query($conn,"SELECT * FROM multiprice_minus ");
                  while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>".ItemCode($row['Item_ID'])."</td>";
                    echo "<td>".ItemName($row['Item_ID'])."</td>";
                    echo "<td>".CusName($row['Cus_ID'])."</td>";
                    echo "<td>".$row['Qty']."</td>";
                    echo "</tr>";
                  }
                  mysqli_close($conn);
                  ?>
                </tr>

              </tbody>
            </table>
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

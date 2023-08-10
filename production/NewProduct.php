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

      <div class="col-sm-12 text-left" style="margin-top:10px;background-color: #F8F8F8;">
        <div class="row">
          <div class="col-sm-4 text-left">
            <!--start of the form-->
            <form role="form" method="post" action="ConnectionNewProduct.php">


              <div class="form-group">
                <label>Bar Code:</label>
                <input type="text" class="form-control" name="pcode" onkeyup="showHint2(this.value)" autofocus="on" autocomplete="off" required>
              </div>

              <p><span id="txtHint2"></span></p>

              <div class="form-group">
                <label>Product Name:</label>
                <input type="text" class="form-control" name="name" onkeyup="showHint(this.value)" autocomplete="off" required>
              </div>

              <p><span id="txtHint"></span></p>


              <div class="form-group">
                <label>Catagory:</label>
                <select class="form-control" name="cat" required>
                  <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM category ORDER BY Category ASC ");
                  while($row = mysqli_fetch_array($result)){
                    echo "<option value = '".$row[0]."'>".$row[1]."</option>";
                  }
                  mysql_close($conn);
                  ?>
                </select>
              </div>


              <div class="form-group">
                <label>Supplier:</label>
                <select class="form-control" name="supplier" required>
                  <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM supplier ORDER BY Name ASC");
                  while($row = mysqli_fetch_array($result)){
                    echo "<option value = '".$row[0]."'>".$row[1]."</option>";
                  }
                  mysql_close($conn);
                  ?>
                </select>
              </div>

              <!--
              <div class="form-group">
              <label>Pack Size:</label>
              <input type="text" class="form-control" name="psize" autocomplete="off">
            </div>
          -->


          <div class="form-group">
            <label>Retail Price:</label>
            <input type="text" class="form-control" name="price" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>Whole-Sale Price:</label>
            <input type="text" class="form-control" name="wprice" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>Cost Price:</label>
            <input type="text" class="form-control" name="cprice" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label>Re-order Level:</label>
            <input type="text" class="form-control" name="rlvl" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" rows="5" id="comment" name="des"></textarea>
          </div>



          <button type="submit" class="btn btn-default">Add</button>
        </form>
        <!--end of the form-->
      </div>

      <div class="col-sm-8">
        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for products.." style="margin-top:10px;border-color: teal;">
        <br/>
        <!--start of the tabele--><div style="height:500px;overflow:auto;">
        <table id="myTable" class="table table-striped" width="100%" style="font-size:12px;">
          <thead>
            <tr>

              <th class="tablecol1">Bar Code</th>
              <th class="tablecol1">Name</th>
              <th class="tablecol3">Catagory</th>
              <th class="tablecol3">Retail Price</th>
              <th class="tablecol3">Wholesale Price</th>
              <th class="tablecol3">Reorder Level</th>

            </tr>
          </thead>
          <tbody>
            <?php $company = $_SESSION['company']; include 'connection.php'; include 'functions/catname.php'; $result = mysqli_query($conn,"SELECT * FROM item ORDER BY Name DESC");
            while($row=mysqli_fetch_array($result)) {
              $id = $row[10];
              echo "<tr>";
              echo "<td>".$row[1]."</td><td>".$row[2]."</td><td>";
              //                echo "<td>".$row[1]."</td>";
              catname($id);
              echo "</td><td>".$row[3]."</td><td>".$row[5]."</td><td>".$row[6]."</td></tr>";
            }
            ?>
          </tbody>
        </table>
        <!--end of the tabele--></div>
      </div>
    </div>
  </div>

</div>
</div>

<!--    script start -->

<script>
//        table search function
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
//        live suggestion function
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "NewProductHint.php?q=" + str, true);
    xmlhttp.send();
  }
}

function showHint2(str) {
  if (str.length == 0) {
    document.getElementById("txtHint2").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint2").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "NewProductHintCode.php?q=" + str, true);
    xmlhttp.send();
  }
}

</script>




<!--    script end-->

<footer class="container-fluid text-center">
  <?php include 'footer.php'; ?>
</footer>

</body>
</html>

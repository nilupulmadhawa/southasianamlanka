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

  <!--    pnotify-->
  <script type="text/javascript" src="pnotofy/pnotify.custom.min.js"></script>
  <link href="pnotofy/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />


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

  <?php if(isset($_SESSION['success'])) { ?>
    <script type="text/javascript">
    $(function(){

      PNotify.prototype.options.styling = "bootstrap3";

      new PNotify({
        title: 'SUCCESS!',
        text: '<b><?php echo $_SESSION['success'] ?></b>',
        type: 'success'
      });

    });
    </script>
    <?php
    unset($_SESSION['success']);
  } ?>

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
            <form role="form" method="post" action="CommisionConnection.php">


              <div class="form-group">
                <label>Product Code:</label>
                <select class="form-control" name="pro" autofocus>
                  <option>SELECT PRODUCT</option>
                  <?php
                  include 'connection.php';
                  $result = mysqli_query($conn,"SELECT * FROM item ORDER BY Name ASC");
                  while($row=mysqli_fetch_array($result)) {
                    echo "<option value='".$row[0]."'> ".$row[1]." ( ".$row[2]." )</option>";
                  }
                  mysqli_close($conn);
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label>Rep Name:</label>
                <select class="form-control" name="repID">
                  <?php
                  include 'connection.php';
                  $result = mysqli_query($conn," SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3 ");
                  while($row=mysqli_fetch_array($result)) {
                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                  }
                  mysqli_close($conn);
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label>Qty:</label>
                <input type="text" class="form-control" name="Qty" autocomplete="off" value="0" required>
              </div>

              <div class="form-group">
                <label>Commision (%):</label>
                <input type="text" class="form-control" name="comm" autocomplete="off" value="0" required>
              </div>




              <button type="submit" class="btn btn-primary">SET</button>
            </form>
            <!--end of the form-->
          </div>
          <?php
          if(isset($_GET['del'])){
            include 'connection.php';
            $del = mysqli_real_escape_string($conn,$_GET['del']);
            $sql = "DELETE FROM item_commisiion WHERE ID = $del ";
            if (mysqli_query($conn, $sql)) {
              $_SESSION['success'] = "Record deleted successfully";
            } else {
              echo "Error deleting record: " . mysqli_error($conn);
            }
            mysqli_close($conn);

          }
          function RepName($repID){
            include 'connection.php';
            $repName = "NULL";
            $result = mysqli_query($conn," SELECT * FROM user_profile WHERE Prof_ID = $repID ");
            while($row=mysqli_fetch_array($result)) {
              $repName = $row['Name'];
            }
            return $repName;
            mysqli_close($conn);
          }
          ?>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search Products.." style="margin-top:10px;border-color: teal;">
            <br/>
            <!--start of the tabele--><div style="height:500px;overflow:auto;">
            <table id="myTable" class="table table-striped" width="100%" style="font-size:12px;">
              <thead>
                <tr>

                  <th class="tablecol1">Item Name</th>
                  <th class="tablecol1">RepName</th>
                  <th class="tablecol1">Qty</th>
                  <th class="tablecol1" style='text-align:center;'>Commision (%)</th>


                </tr>
              </thead>
              <tbody>
                <?php
                $company = $_SESSION['company'];
                include 'connection.php';
                include 'functions/catname.php';
                $result = mysqli_query($conn,"SELECT * FROM item_commisiion ORDER BY ItemName ASC");
                while($row=mysqli_fetch_array($result)) {
                  //                $id = $row[10];
                  echo "<tr>";
                  echo "<td>".$row["ItemName"]."</td>";
                  echo "<td>".RepName($row["RepID"])."</td>";
                  echo "<td>".$row["Qty"]."</td>";
                  echo "<td style='text-align:center;'>".$row["Commision"]."</td>";
                  echo "<td><a href='Commision.php?del=".$row[0]."'>DELETE</a></td>";
                  echo "</tr>";

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

  </script>




  <!--    script end-->

  <footer class="container-fluid text-center">
    <?php include 'footer.php'; ?>
  </footer>

</body>
</html>

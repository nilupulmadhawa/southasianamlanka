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
  .row.content {height: 450px;}

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
      <?php
      include 'connection.php';

      // if(isset($_GET['AddRep'])){
      //   $repAllocationID = $_SESSION['RepAllocation'];
      //   $AddRep = mysqli_real_escape_string($conn , $_GET['AddRep']);
      //   $sql = "UPDATE multiprice SET RepID= $repAllocationID WHERE ID = $AddRep ";
      //   mysqli_query($conn, $sql);
      // }

      if(isset($_GET['RemoveRep'])){
        $RemoveRep = mysqli_real_escape_string($conn , $_GET['RemoveRep']);
        $sql = "UPDATE multiprice SET RepID= NULL WHERE ID = $RemoveRep ";
        mysqli_query($conn, $sql);
      }

      if(isset($_POST['RepName']) && isset($_POST['RefID'])){
        echo "ok";
        $_SESSION['RepAllocation']  = $_POST['RepName'];
        $repID  = $_POST['RepName'];
        $RefID  = $_POST['RefID'];
        $sql = "UPDATE multiprice SET RepID = $repID WHERE batchID = $RefID";
        mysqli_query($conn, $sql);
      }
      if(isset($_GET['Clear'])){
        unset($_SESSION['RepAllocation']);
      }
      function repname($repID){
        include 'connection.php';
        $repName = NULL;
        $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Prof_ID = $repID ");
        while($row=mysqli_fetch_array($result)) {
          $repName = $row['Name'];
        }
        mysqli_close($conn);
        echo $repName;
      }
      function ProductName($productID){
        include 'connection.php';
        $productName = NULL;
        $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $productID ");
        while($row=mysqli_fetch_array($result)) {
          $productName = $row['Name'];
        }
        mysqli_close($conn);
        return $productName;
      }
      ?>
      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;">

        <div class="col-sm-6 text-left">
          <!--start of the form-->

          <form role="form" method="post" action="RepAllocationConnection.php">
            <div class="form-group">
              <label>Rep Name:</label>
              <!-- <input type="text" class="form-control" name="name" autofocus="on" autocomplete="off"> -->
              <select class="form-control" name="RepName" autofocus required>
                <?php if(!isset($_SESSION['RepAllocation'])){ ?>
                <option disabled selected>SELECT THE REP</option>
                <?php
              }
                include 'connection.php';
                if(isset($_SESSION['RepAllocation'])){
                  $repIDCheck = $_SESSION['RepAllocation'];
                  $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3 ");
                  while($row=mysqli_fetch_array($result)) {
                    if($repIDCheck == $row[0]){
                      echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
                    }else{
                      echo "<option value='".$row[0]."'>".$row[1]."</option>";
                    }

                  }

                }else{

                  $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3 ");
                  while($row=mysqli_fetch_array($result)) {
                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                  }

                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Reference ID:</label>
              <!-- <input type="text" class="form-control" name="name" autofocus="on" autocomplete="off"> -->
              <select class="form-control" name="RefID" required>
                <option disabled selected>SELECT THE REF. ID</option>
                <?php
                include 'connection.php';
                $result = mysqli_query($conn,"SELECT DISTINCT GroupID FROM  tbl_ret_final ");
                while($row=mysqli_fetch_array($result)) {
                  echo "<option value='".$row['GroupID']."'>".$row['GroupID']."</option>";
                }
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">SELECT</button>
          </form>
          <div class="row" style="padding-top:30px;">
            <div class="col-sm-6">
              <?php
              if(isset($_SESSION['RepAllocation'])){
                $repID = $_SESSION['RepAllocation'];
                ?>
                <form role="form" method="post" action="RepAllocationConnection.php">

                  <div class="form-group">
                    <label>Reference ID:</label>
                    <!-- <input type="text" class="form-control" name="name" autofocus="on" autocomplete="off"> -->
                    <select class="form-control" name="clean" required>
                      <?php
                      include 'connection.php';
                      $result = mysqli_query($conn,"SELECT DISTINCT GroupID FROM tbl_ret_final WHERE RepID = $repID ");
                      while($row=mysqli_fetch_array($result)) {
                        echo "<option value='".$row['GroupID']."'>".$row['GroupID']."</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-warning">CLEAR FROM THE REP</button>
                </form>
                <?php
              }
              ?>

            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <br/>
          <!--start of the tabele--><div style="height:550px;overflow:auto;">
          <?php
          if(isset($_SESSION['RepAllocation'])){
            ?>
            <table class="table table-striped" width="100%" style="font-size:12px;">
              <thead>
                <tr>

                  <th>Product Name</th>
                  <th>Reference ID</th>

                  <th>Retail</th>
                  <th></th>

                </tr>
              </thead>
              <tbody>

                <?php

                $repAllocation = $_SESSION['RepAllocation'];
                include 'connection.php';
                $result = mysqli_query($conn,"SELECT * FROM tbl_ret_final WHERE RepID = $repAllocation ");
                while($row=mysqli_fetch_array($result)) {
                  echo "<tr>";
                  echo "<td>".ProductName($row['ProductID'])."</td>";

                  echo "<td>".$row['GroupID']."</td>";
                  echo "<td>".$row['RetPrice']."</td>";
                  echo "<td><a href='RepAllocation.php?RemoveRep=".$row[0]."' class='btn btn-primary' role='button'>CLEAR</a></td>";
                  echo "</tr>";
                }

                ?>
              </tbody>
            </table>
            <?php
          }
          ?>
          <!--end of the tabele--></div>
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

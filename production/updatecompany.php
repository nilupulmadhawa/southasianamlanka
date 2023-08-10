<?php
include 'connection.php';
if(isset($_POST['name'])){
  $name = $_POST['name'];

}
session_start();
$id1 = $_SESSION['id'];
$company = $_SESSION['company'];
?>
<?php
if(isset($_POST['name'])){
  include 'connection.php';
  $name = $_POST['name'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];
  $fax = $_POST['fax'];
  $email = $_POST['email'];
  $id = $_POST['id'];
  $refname = $_POST['refname'];
  //update data into table
  $sql2 = "UPDATE company SET CompanyName = '$name' WHERE ID = $id ";
  mysqli_query($conn,$sql2);
  $sql2 = "UPDATE company SET Address = '$address' WHERE ID = $id ";
  mysqli_query($conn,$sql2);
  $sql2 = "UPDATE company SET Contact = '$contact' WHERE ID = $id ";
  mysqli_query($conn,$sql2);
  $sql2 = "UPDATE company SET Fax = '$fax' WHERE ID = $id ";
  mysqli_query($conn,$sql2);
  $sql2 = "UPDATE company SET Email = '$email' WHERE ID = $id ";
  mysqli_query($conn,$sql2);
  $sql2 = "UPDATE company SET RefName = '$refname' WHERE ID = $id ";
  mysqli_query($conn,$sql2);
  mysqli_close($conn);

  // log process
  include 'functions/activity.php';
  activity($_SESSION['id'],"Company Details Updated");
  // end of log process

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
      xmlhttp.open("GET", "getcompany.php?q=" + str, true);
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
        <!--        section label-->
        <div style="text-align:center;background-color:teal;color:white;margin-bottom:10px;">
          <label style="font-size:20px;">UDPATE BRANCH DETAILS</label>
        </div>

        <div class="row">

          <div class="col-sm-5">

            <form>
              Branch Name:
              <select class="form-control" onchange="showHint(this.value)" autofocus="on">
                <option disabled selected>SELECT BRANCH</option>
                <?php
                include 'connection.php';
                $result = mysqli_query($conn,"SELECT * FROM company");
                while($row = mysqli_fetch_array($result)){
                  echo "<option value='".$row[0]."'>".$row[1]."</option>";
                }
                mysqli_close($conn);
                ?>
              </select>
            </form>

          </div>
          <div class="col-sm-12" style="padding:5px;margin-top:5px;">
            <br/>
            <div class="col-sm-12" id="txtHint" style="min-height:300px;"></div>
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

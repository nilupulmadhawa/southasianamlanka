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

  <script type="text/javascript">
  function noNumbers(e) {

    keynum = e.which;

    if (keynum == 13){
      document.getElementById("Text2").focus();
      event.preventDefault();}
    }
    </script>

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
        xmlhttp.open("GET", "getproduct.php?q=" + str, true);
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
            <div class="col-sm-5">
              <!-- <form>
              Product: <input type="text" class="form-control" onkeyup="showHint(this.value)" autofocus="on">
            </form> -->

            <form method="post" action="UpdateProduct.php">
              <div class="form-group">
                <label for="email">Product:</label>
                <input type="text" class="form-control" name="name" onkeyup="showHint(this.value)" autofocus="on">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>


            <div class="col-sm-12" style="padding:5px;margin-top:5px;">
              <br/>
              <div class="col-sm-12" style="height:350px;overflow:auto;margin-top:-20px;margin-bottum:5px;"><span id="txtHint"></span></p></div>
            </div>



          </div>
          <div class="col-sm-7" style="margin-top:20px;margin-bottum:5px;border:1px solid;border-radius:15px;padding-bottom:5px;">
            <p>Current Values:</p>
            <!--table-->
            <!--start of the table-->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Item Code</th>
                  <!--
                  <th>Retail Price</th>
                  <th>Cost Price</th>
                  <th>Wholesale Price</th>
                -->
                <th>Re-order Level</th>

              </tr>
            </thead>
            <tbody>
              <?php
              include'connection.php';



              if(isset($_POST['name'])){
                $name = $_POST['name'];
                $result = mysqli_query($conn,"SELECT * FROM item WHERE ItemCode = '$name' AND CompanyID = $company");
                while($row = mysqli_fetch_array($result)){
                  echo "<tr><td>".$row['Name']."</td><td>".$row['ItemCode']."</td><td>".$row['Reorder_lvl']."</td></tr>";
                }
              }else{
                if(isset($_REQUEST['name'])){
                  $name = $_REQUEST['name'];
                  $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $name AND CompanyID = $company");
                  while($row = mysqli_fetch_array($result)){
                    echo "<tr><td>".$row['Name']."</td><td>".$row['ItemCode']."</td><td>".$row['Reorder_lvl']."</td></tr>";
                  }
                }
              }

              mysqli_close($conn);?>

            </tbody>
          </table>
          <!--end of the table-->
          <hr/>
          <!--form starts-->
          <form method="post" action="productupdate.php">
            <?php
            include 'connection.php';


            if(isset($_POST['name'])){
              $name = $_POST['name'];
              $result = mysqli_query($conn,"SELECT * FROM item WHERE ItemCode = '$name' AND CompanyID = $company");
              while($row = mysqli_fetch_array($result)){
                echo "<br/>";
                echo" <div style='width:100px;'><b>Name:</b></div><input type='text' class='form-control' value='".$row['Name']."' name='name' ><br/>";
                echo" <div style='width:100px;'><b>Item Code:</b></div><input type='text' class='form-control' onkeydown='return noNumbers(event)' value='".$row['ItemCode']."' name='itemcode' ><br/>";
                echo" <div style='width:100px;'><b> </b></div><input type='hidden' class='form-control' value='".$row['RetPrice']."' name='rprice' value='0' ><br/>";
                echo" <div style='width:100px;'><b> </b></div><input type='hidden' class='form-control'   value='".$row['CostPrice']."' name='cprice' value='0' ><br/>";
                echo" <div style='width:100px;'><b> </b></div><input type='hidden' class='form-control'   value='".$row['Wprice']."' name='wprice' value='0' ><br/>";
                echo" <div style='width:100px;'><b>Reorder lvl:</b></div><input type='text' class='form-control' id='Text2'  value='".$row['Reorder_lvl']."'  name='reorder' ><br/>";
                echo" <div style='width:100px;'><b>Comments:</b></div><textarea name='des' rows='4' cols='50'>".$row[15]."</textarea><br/>";


              }
            }else{
              if(isset($_REQUEST['name'])){
                $name = $_REQUEST['name'];
                $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $name AND CompanyID = $company");
                while($row = mysqli_fetch_array($result)){
                  echo "<br/>";
                  echo" <div style='width:100px;'><b>Name:</b></div><input type='text' class='form-control' value='".$row['Name']."' name='name' ><br/>";
                  echo" <div style='width:100px;'><b>Item Code:</b></div><input type='text' class='form-control' onkeydown='return noNumbers(event)' value='".$row['ItemCode']."' name='itemcode' ><br/>";
                  echo" <div style='width:100px;'><b> </b></div><input type='hidden' class='form-control' value='".$row['RetPrice']."' name='rprice' value='0' ><br/>";
                  echo" <div style='width:100px;'><b> </b></div><input type='hidden' class='form-control'   value='".$row['CostPrice']."' name='cprice' value='0' ><br/>";
                  echo" <div style='width:100px;'><b> </b></div><input type='hidden' class='form-control'   value='".$row['Wprice']."' name='wprice' value='0' ><br/>";
                  echo" <div style='width:100px;'><b>Reorder lvl:</b></div><input type='text' class='form-control' id='Text2'  value='".$row['Reorder_lvl']."'  name='reorder' ><br/>";
                  echo" <div style='width:100px;'><b>Comments:</b></div><textarea name='des' rows='4' cols='50'>".$row[15]."</textarea><br/>";


                }
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

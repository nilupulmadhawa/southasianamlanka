<?php
session_start();

$id1 = $_SESSION['id'];


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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>

  $(function() {

    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});

  });

  </script>
  <script>

  $(function() {

    $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'});

  });

  </script>
  <!--product ajax-->
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
      xmlhttp.open("GET", "CustomerName.php?q=" + str, true);
      xmlhttp.send();
    }
  }
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
        <div style="text-align:right;"><label>PAYMENT // NEW SUPPLIER PAYMENT</label></div>
        <!--content-->
        <!--start of the form-->
        <div class="col-sm-12" style="padding:10px;border:1px solid;">
          <div class="col-sm-9">
            <?php if(isset($_POST['sup'])){
              $_SESSION['sup'] = $_POST['sup'];
               ?>
              <h2>CUSTOMER NAME: <?php echo $_POST['sup']; ?></h2>
            <?php } else{?>
              <form class="form-inline" method="post" action="NewCollectionSup.php">
                <div class="form-group">
                  <label>ROUTE:</label>
                  <div>
                    <select class="form-control" name="sup" autofocus>
                      <option selected disabled> SELECT THE ROUTE</option>
                      <?php
                      include 'connection.php';
                      // $cusname = $_SESSION['cusname'];
                      $result = mysqli_query($conn,"SELECT * FROM supplier");
                      while($row = mysqli_fetch_array($result)){
                        echo "<option>".$row['Name']."</option>";
                      }
                      mysqli_close($conn);
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group"><br/>
                  <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
              </form>
            <?php }?>

          </div>
          <div class="col-sm-3">
            <br/>
            <a href="NewCollection.php" class="btn btn-primary" role="button">CLEAR DATA</a>
          </div>
        </div>
        <div class="col-sm-6">
          <?php if(isset($_POST['sup'])){ ?>
            <form role="form" method="post" action="ConnectionNewCollection.php" enctype="multipart/form-data">


              <div class="form-group">
                <label>Invoice Number:</label>
                <select class="form-control" name="invoice" autofocus="on">
                  <?php
                  include 'connection.php';
                  if(isset($_POST['sup'])){
                    $cusname = $_POST['sup'];
                    $result = mysqli_query($conn,"SELECT * FROM supplier WHERE Name = '$cusname'");
                    while($row = mysqli_fetch_array($result)){
                      // GLOBAL $cusid;
                      $cusid = $row[0];
                    }


                    $result = mysqli_query($conn,"SELECT * FROM po WHERE SupplierID = '$cusid' AND status = 0 ORDER BY PoID ASC ");
                    while($row = mysqli_fetch_array($result)){
                      echo "<option value='".$row[0]."'>".$row[2]."</option>";
                    }
                  }
                  mysqli_close($conn);
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Date:</label>
                <input type="text" class="form-control" id="datepicker" name="invdate" value="<?php echo date("Y-m-d"); ?>" placeholder="Date" autocomplete="off" >
              </div>
              <div class="form-group">
                <label>Type:</label>
                <select class="form-control" name="type">
                  <option value="1">Cash</option>
                  <option value="2">Cheque</option>
                </select>
              </div>
              <div class="form-group">
                <label>Ammount:</label>
                <input type="text" class="form-control"  name="ammount" placeholder="Ammount" autocomplete="off">
              </div>
              <div>-------------------------------------------------------------Cheque Section-------------------------------------------------------------------------------------------</div>

              <div class="form-group">
                <label>Cheque Number:</label>
                <input type="text" class="form-control"  name="cnumber" placeholder="Checque Number" autocomplete="off">
              </div>

              <div class="form-group">
                <label>Cheque Image:</label>
                <input type="file" class="form-control" name="files_to_upload" id="fileToUpload">
              </div>


              <div class="form-group">
                <label>Cheque Date:</label>
                <input type="text" class="form-control" id="datepicker1" name="cdate" placeholder="Cheque Date" autocomplete="off" >
              </div>
              <div class="form-group">
                <label>Type:</label>
                <select class="form-control" name="bank">
                  <option value="Commercial Bank">Commercial Bank</option>
                  <option value="Sampath Bank">Sampath Bank</option>
                  <option value="HNB">HNB</option>
                  <option value="Peoples Bank">Peoples Bank</option>
                  <option value="Bank Of Ceylone">Bank Of Ceylone</option>
                  <option value="Standard Charted Bank">Standard Charted Bank</option>
                  <option value="NDB">NDB</option>
                  <option value="HSBC">HSBC</option>
                  <option value="Seylan Bank">Seylan Bank</option>
                  <option value="Nation Trust Bank">Nation Trust Bank</option>
                  <option value="Sampath Bank">Sampath Bank</option>
                  <option value="NSB">NSB</option>
                  <option value=">Pan Asia Bank">Pan Asia Bank</option>
                  <option value="Wardhana Bank">Wardhana Bank</option>
                  <option value="DFCC Bank">DFCC Bank</option>
                  <option value="Dutch Bank">Dutch Bank</option>
                  <option value="Amana Bank">Amana Bank</option>
                </select>
              </div>

              <button type="submit" class="btn btn-primary">Proceed</button>
            </form>
          <?php } ?>
        </div>
        <!--end of the form-->
        <!--end of content-->
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

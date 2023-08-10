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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
      xmlhttp.open("GET","EmpUpdate.php?q="+str,true);
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

      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;padding-top:10px;">

        <!--        section label-->
        <div style="text-align:center;background-color:teal;color:white;margin-bottom:10px;">
          <label style="font-size:20px;">USER DETAILS MANAGEMENT</label>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <!--start of the form-->
            <form class="form-horizontal" role="form" action="Connection_EmployeeDetail.php" method="post" enctype="multipart/form-data">


              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Role:</label>
                <div class="col-sm-10">
                  <select class="form-control" id="sel1" name="priv" autofocus="on">
                    <option value="1">Administratior</option>
                    <option value="2">Maintainer</option>
                    <option value="3">Representative</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Branch:</label>
                <div class="col-sm-10">
                  <select class="form-control" name="branch">
                    <?php
                    include 'connection.php';
                    $result = mysqli_query($conn,"SELECT * FROM company");
                    while($row = mysqli_fetch_array($result)){
                      echo "<option value='".$row[0]."'>".$row[1]." (".$row[2].") </option>";
                    }
                    mysqli_close($conn);
                    ?>
                  </select>
                </div>
              </div>

              <!-- <input type="hidden" class="form-control" value="1" name="priv"> -->

              <div class="form-group">
                <label class="control-label col-sm-2">Full Name:</label>
                <div class="col-sm-10">

                  <input type="text" class="form-control" placeholder="Full Name" name="fname">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">User Name:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="User Name" name="username">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Address:</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="5" name="address"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Contact Number:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Contact Number" name="contact">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">NIC:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="NIC" name="nic">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Email:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Email" name="email">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Picture:</label>
                <div class="col-sm-10">
                  <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Register</button>
                </div>
              </div>
            </form>
            <!--end of the form-->
          </div>
          <div class="col-sm-6">
            <div class="col-sm-12" >

              <!--model for Edit employee Details-->
              <!-- Trigger the modal with a button -->
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#EmployeeUpdate">Update Employee Details</button>

              <!-- Modal -->
              <div id="EmployeeUpdate" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Update Emloyee Details</h4>
                    </div>
                    <div class="modal-body">
                      <!--employee registration model body-->


                      <form class="form-horizontal" role="form" action="Connection_EmployeeDetail.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="email" >User:</label>
                          <div class="col-sm-10">
                            <select class="form-control" id="sel1" onchange="showUser(this.value)">
                              <option disabled selected>SELECT THE USER</option>
                              <?php
                              include 'connection.php';
                              $result = mysqli_query($conn,"SELECT * FROM user_profile");
                              while($row = mysqli_fetch_array($result)){
                                echo "<option value='".$row[0]."'>".$row[1]."</option>";
                              }
                              mysqli_close($conn);
                              ?>
                            </select>
                          </div>
                        </div>

                      </form>
                      <hr/>
                      <div id="txtHint" style=""><b></b></div>
                      <!--end of employee registration model body-->
                    </div>

                  </div>

                </div>
              </div>
              <!--end of model for Edit employee Details-->

              <!--model for Detailed Report Of Employees-->
              <!-- Trigger the modal with a button -->
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#DetailedReport">Detailed Report</button>

              <!-- Modal -->
              <div id="DetailedReport" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Detailed Report Of Employees</h4>
                    </div>
                    <div class="modal-body">
                      <!--employee registration model body-->
                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Administrators <span class="label label-default"</span></a></li>
                          <li><a data-toggle="tab" href="#menu1">Representators <span class="label label-default"></span></a></li>
                          <li><a data-toggle="tab" href="#menu2">Maintainers <span class="label label-default"></span></a></li>

                        </ul>

                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">
                            <h3>Administrators</h3>

                            <?php include 'connection.php';
                            $count = 0;
                            $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 1");
                            while($row = mysqli_fetch_array($result)){
                              GLOBAL $count;
                              $count = $count + 1;
                            }
                            $steps = 1;
                            while($steps<=$count){

                              $full_name = " ";
                              $address = " ";
                              $contact = " ";
                              $nic = " ";
                              $email = " ";
                              $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 1 LIMIT $steps ");
                              while($row = mysqli_fetch_array($result)){
                                GLOBAL $full_name,$address,$contact,$nic,$email;
                                $full_name = $row[1];
                                $address = $row[2];
                                $contact = $row[3];
                                $nic = $row[4];
                                $email = $row[5];
                                $image = $row[6];
                              }
                              $steps = $steps+1;
                              echo "<div class='row'><div class='col-sm-3'><img src='images/".$image."' class='img-circle' alt='Image' width='100' height='100'></div><div class='col-sm-7'><b>Full Name:</b><br/>".$full_name."<br/><b>NIC:</b></br>".$nic."<br/><b>Address:</br></b>".$address."<br/><b>Email:</b></br>".$email."<br/><b>Contact Number:</b></br>".$contact."<br/></div><div class='col-sm-2'><i style='color:green;'>Active User</i></div></div><hr>";

                            }
                            ?>


                          </div>
                          <div id="menu1" class="tab-pane fade">
                            <h3>Representative</h3>
                            <?php include 'connection.php';
                            $count = 0;
                            $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3");
                            while($row = mysqli_fetch_array($result)){
                              GLOBAL $count;
                              $count = $count + 1;
                            }
                            $steps = 1;
                            while($steps<=$count){

                              $full_name = " ";
                              $address = " ";
                              $contact = " ";
                              $nic = " ";
                              $email = " ";
                              $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3 LIMIT $steps ");
                              while($row = mysqli_fetch_array($result)){
                                GLOBAL $full_name,$address,$contact,$nic,$email;
                                $full_name = $row[1];
                                $address = $row[2];
                                $contact = $row[3];
                                $nic = $row[4];
                                $email = $row[5];
                                $image = $row[6];
                              }
                              $steps = $steps+1;
                              echo "<div class='row'><div class='col-sm-3'><img src='images/".$image."' class='img-circle' alt='Image' width='100' height='100'></div><div class='col-sm-7'><b>Full Name:</b><br/>".$full_name."<br/><b>NIC:</b></br>".$nic."<br/><b>Address:</br></b>".$address."<br/><b>Email:</b></br>".$email."<br/><b>Contact Number:</b></br>".$contact."<br/></div><div class='col-sm-2'><i style='color:green;'>ONLINE</i></br><i style='color:green;'>Active User</i></div></div><hr>";

                            }
                            ?>
                          </div>
                          <div id="menu2" class="tab-pane fade">
                            <h3>Maintainer</h3>
                            <?php include 'connection.php';
                            $count = 0;
                            $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 2");
                            while($row = mysqli_fetch_array($result)){
                              GLOBAL $count;
                              $count = $count + 1;
                            }
                            $steps = 1;
                            while($steps<=$count){

                              $full_name = " ";
                              $address = " ";
                              $contact = " ";
                              $nic = " ";
                              $email = " ";
                              $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 2 LIMIT $steps ");
                              while($row = mysqli_fetch_array($result)){
                                GLOBAL $full_name,$address,$contact,$nic,$email;
                                $full_name = $row[1];
                                $address = $row[2];
                                $contact = $row[3];
                                $nic = $row[4];
                                $email = $row[5];
                                $image = $row[6];
                              }
                              $steps = $steps+1;
                              echo "<div class='row'><div class='col-sm-3'><img src='images/".$image."' class='img-circle' alt='Image' width='100' height='100'></div><div class='col-sm-7'><b>Full Name:</b><br/>".$full_name."<br/><b>NIC:</b></br>".$nic."<br/><b>Address:</br></b>".$address."<br/><b>Email:</b></br>".$email."<br/><b>Contact Number:</b></br>".$contact."<br/></div><div class='col-sm-2'><i style='color:green;'>ONLINE</i></br><i style='color:green;'>Active User</i></div></div><hr>";

                            }
                            ?>
                          </div>

                        </div>

                        <!--end of employee registration model body-->
                      </div>

                    </div>

                  </div>
                </div>
                <!--end of Detailed Report Of Employees-->



              </div>

            </div>
          </div>








        </div>
        <div class="col-sm-2 sidenav">
          <?php include 'RightNavBar.php'; ?>
        </div>
      </div>
    </div>
  </div>

  <footer class="container-fluid text-center">
    <?php include 'footer.php'; ?>
  </footer>

</body>
</html>

<?php 
session_start(); 
$id1 = $_SESSION['id']; 
$id = intval($id1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DHN Vetmedicare Admin Panel|Employee Details</title>
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
<body>

<nav class="navbar navbar-default">
  <?php include 'HeaderMaintain.php'; ?>
</nav>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
      <div class="row">
        <hr>
           
    </div>
    <div class="row">
      <div class="col-sm-6">
        <!--start of the form-->
        <form class="form-horizontal" role="form" action="Connection_EmployeeDetail.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Role:</label>
                      <div class="col-sm-10">                         
                          <select class="form-control" id="sel1" name="priv">
                            <option value="1">Administratior</option>
                            <option value="2">Maintainer</option>
                            <option value="3">Representative</option>
                          </select>                        
                      </div>
                    </div>
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
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    
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
                <h4 class="modal-title">Register a new employee</h4>
              </div>
              <div class="modal-body">
                <!--employee registration model body-->
                 UPDATE
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
                 <h2>Dynamic Tabs</h2>
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home">Administrators <span class="label label-default"><?php 
                  $count = 0;
                          $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 1");
                          while($row = mysqli_fetch_array($result)){
                           GLOBAL $count;
                           $count = $count + 1; 
                          }
                          echo $count;
                  ?></span></a></li>
                  <li><a data-toggle="tab" href="#menu1">Representators <span class="label label-default"><?php 
                  $count = 0;
                          $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3");
                          while($row = mysqli_fetch_array($result)){
                           GLOBAL $count;
                           $count = $count + 1; 
                          }
                          echo $count;
                  ?></span></a></li>
                  <li><a data-toggle="tab" href="#menu2">Maintainers <span class="label label-default"><?php 
                  $count = 0;
                          $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 2");
                          while($row = mysqli_fetch_array($result)){
                           GLOBAL $count;
                           $count = $count + 1; 
                          }
                          echo $count;
                  ?></span></a></li>
                  
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
                            echo "<div class='row'><div class='col-sm-3'><img src='images/".$image."' class='img-circle' alt='Image' width='100' height='100'></div><div class='col-sm-7'><b>Full Name:</b><br/>".$full_name."<br/><b>NIC:</b></br>".$nic."<br/><b>Address:</br></b>".$address."<br/><b>Email:</b></br>".$email."<br/><b>Contact Number:</b></br>".$contact."<br/></div><div class='col-sm-2'><i style='color:green;'>ONLINE</i></br><i style='color:green;'>Active User</i></div></div><hr>";

                          }
                           ?>
                      
                    
                  </div>
                  <div id="menu1" class="tab-pane fade">
                    <h3>Menu 1</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
    <div class="row">

        <div class="col-sm-12">
          <h3><b>Administrators</b></h3>
        <hr>
        <table class="table table-striped" >
          <thead>
            <tr>
              <th>Full Name</th>
              
              <th>Address</th>
              <th>Contact Number</th>
              <th>NIC</th>
              <th>Email</th>
              <th>Image</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php include 'connection.php';  
            $count = 0;          
              $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 1 ");
              while($row = mysqli_fetch_array($result)){
                GLOBAL $count;
                $count = $count + 1;
              }
              $step = 1;
              while ($step<= $count){
              $full_name = " ";
              $address = " ";
              $contact = " ";
              $nic = " ";
              $email = " ";
              $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 1  limit $step");
              while($row = mysqli_fetch_array($result)){
                GLOBAL $full_name,$address,$contact,$nic,$email,$id;
                $id = $row[0];
                $full_name = $row[1];
                $address = $row[2];
                $contact = $row[3];
                $nic = $row[4];
                $email = $row[5];
                $image = $row[6];
              }
              $steps = $steps+1;
              echo "<tr><td>".$full_name."</td><td>".$address."</td><td>".$contact."</td><td>".$nic."</td><td>".$email."</td></td><td><img src='images/".$image."' class='img-circle' alt='Image' width='50' height='50'></td><td><a href='empolyee_delete.php?id=".$id."'' class='btn btn-primary'>Delete</a></td></tr>";

            $step = $step + 1;
            }
             ?>
          </tbody>
        </table>
      </div>
      <hr>
      <div class="col-sm-12">
        <h3><b>Employees</b></h3>
        <hr>
        <table class="table table-striped" >
          <thead>
            <tr>
              <th>Full Name</th>
              <th>Address</th>
              <th>Contact Number</th>
              <th>NIC</th>
              <th>Email</th>
              <th>Image</th>
            </tr>
          </thead>
          <tbody>
              <?php include 'connection.php';  
            $count = 0;          
              $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 2 ");
              while($row = mysqli_fetch_array($result)){
                GLOBAL $count;
                $count = $count + 1;
              }
              $step = 1;
              while ($step<= $count){
              $full_name = " ";
              $address = " ";
              $contact = " ";
              $nic = " ";
              $email = " ";
              $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 2  limit $step");
              while($row = mysqli_fetch_array($result)){
                GLOBAL $full_name,$address,$contact,$nic,$email,$id;
                $id = $row[0];
                $full_name = $row[1];
                $address = $row[2];
                $contact = $row[3];
                $nic = $row[4];
                $email = $row[5];
                $image1 = $row[6];
              }
              $steps = $steps+1;
              if(isset($image1)){
              echo "<tr><td>".$full_name."</td><td>".$address."</td><td>".$contact."</td><td>".$nic."</td><td>".$email."</td></td><td><img src='images/".$image1."' class='img-circle' alt='Image' width='50' height='50'></td><td><a href='empolyee_delete.php?id=".$id."'' class='btn btn-primary'>Delete</a></td></tr>";
            }
            $step = $step + 1;
            }
             ?>
          </tbody>
        </table>
      </div>
      <div class="col-sm-12">
        <h3><b>Representative</b></h3>
        <hr>
        <table class="table table-striped" >
          <thead>
            <tr>
              <th>Full Name</th>
              <th>User Name</th>
              <th>Address</th>
              <th>Contact Number</th>
              <th>NIC</th>
              <th>Email</th>
              <th>Image</th>
            </tr>
          </thead>
          <tbody>
              <?php include 'connection.php';  
            $count = 0;          
              $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3 ");
              while($row = mysqli_fetch_array($result)){
                GLOBAL $count;
                $count = $count + 1;
              }
              $step = 1;
              while ($step<= $count){
              $full_name = " ";
              $address = " ";
              $contact = " ";
              $nic = " ";
              $email = " ";
              $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3  limit $step");
              while($row = mysqli_fetch_array($result)){
                GLOBAL $full_name,$address,$contact,$nic,$email,$id;
                $id = $row[0];
                $full_name = $row[1];
                $address = $row[2];
                $contact = $row[3];
                $nic = $row[4];
                $email = $row[5];
                $image2 = $row[6];
              }
              $steps = $steps+1;
              if(isset($image2)){
              echo "<tr><td>".$full_name."</td><td>".$address."</td><td>".$contact."</td><td>".$nic."</td><td>".$email."</td></td><td><img src='images/".$image2."' class='img-circle' alt='Image' width='50' height='50'></td><td><a href='empolyee_delete.php?id=".$id."'' class='btn btn-primary'>Delete</a></td></tr>";
            }
            $step = $step + 1;
            }
             ?>
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
</div>

<footer class="container-fluid text-center">
  <?php include 'footer.php'; ?>
</footer>

</body>
</html>
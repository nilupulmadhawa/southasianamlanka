<?php 
session_start(); 
$id1 = $_SESSION['id'];
$prev = $_SESSION['prev']; 
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
        xmlhttp.open("GET","month.php?q="+str,true);
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
    <div class="col-sm-2 sidenav">
      <?php include 'SideBarMaintain.php'; ?>
    </div>
    <div class="col-sm-8 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
      <div class="row">
       <div class="col-sm-12">
      <div class="col-sm-12 text-left" style="margin-top:10px;">
     <form class="form-inline" role="form" method="post" action="FreeIssueReport.php"> 
      <div class="form-group">
        <label for="email">Month:</label>
         <select name="month" class="form-control" name="month" autofocus = "on">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">Septmber</option>
        <option value="10">Octomber</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
      </div>
      <div class="form-group">
        <label for="pwd">Group:</label>
        <select name="group" class="form-control">
        <?php
        include 'connection.php';
        $result = mysqli_query($conn,"SELECT * FROM grouping ORDER BY Grouping ASC ");
                while($row = mysqli_fetch_array($result)){
                  echo "<option value='".$row[0]."'>".$row[1]."</option>";
                }
        mysqli_close($conn);
         ?>
       </select>
      </div>
      
      <button type="submit" class="btn btn-default">View</button>
    </form>
    </div>
    
      </div> 
      <div class="col-sm-12" style="height:550px;margin-top:10px;">
        <div style="height:500px;overflow:auto;">
        <?php if(isset($_POST['month'])){ ?>
    <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Date</th>
        <th>Customer</th>
        <th>Inv No.</th>
        <?php
        $gr = $_POST['group'];
        include 'connection.php';
        $result = mysqli_query($conn,"SELECT * FROM item WHERE grouping = '$gr'");
        while($row = mysqli_fetch_array($result)){
         echo "<th>".$row[1]."</th>";
        }
        mysqli_close($conn);
        ?>
        
      </tr>
    </thead>
    <tbody>
      <?php 
      function cusname($cusid){
        include 'connection.php';
        $result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = $cusid ");
        while($row = mysqli_fetch_array($result)){
         GLOBAL $cusname;
         $cusname = $row[1];
        }
        return $cusname;
        mysqli_close($conn);
      }
      $year = date("Y");
      $month = $_POST['month'];
      //echo $year;
      include 'connection.php';
      $count = 0;
      $result = mysqli_query($conn,"SELECT * FROM invoice WHERE CompanyID = $company AND deliver = 0 AND $month = date_format(InvDate,'%m') AND $year = date_format(InvDate,'%Y')");
        while($row = mysqli_fetch_array($result)){
          $count = $count + 1;
        }
        $steps = 1;
        $num = 1;
        while($steps <= $count){
      
      $result = mysqli_query($conn,"SELECT * FROM invoice WHERE CompanyID = $company AND deliver = 0 AND $month = date_format(InvDate,'%m') AND $year = date_format(InvDate,'%Y') LIMIT $steps");
        while($row = mysqli_fetch_array($result)){
          GLOBAL  $invdate,$invID,$invCus;
          $invdate = $row[1];
          $invID = $row[0];
          $invCus = $row[4];
          $iID = $row[11];
        }
        $groupcount = 0;
         $result = mysqli_query($conn,"SELECT * FROM item WHERE grouping = '$gr'");
        while($row = mysqli_fetch_array($result)){
         GLOBAL $groupcount;
         $groupcount = $groupcount + 1;
        }
        $groupsteps = 1;
        echo "<tr>";
          
          
          $incount = 0;
        while($groupsteps <= $groupcount){
        $result = mysqli_query($conn,"SELECT * FROM item WHERE grouping = '$gr' LIMIT $groupsteps");
        while($row = mysqli_fetch_array($result)){
          GLOBAL $itid;
          $itid = $row[0];
        }
        $freecount = 0;
        $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invID");
        while($row = mysqli_fetch_array($result)){
          if($itid == $row[8] && $row[6] == 100){
            $freecount = $freecount + $row[1];
           
          }
        }
        if($incount == 0 && $freecount > 0 ){
        echo "<td>".$num."</td>";
          echo "<td>".$invdate."</td>";
          echo "<td>". cusname($invCus)."</td>";
          $invoice = sprintf("%04d", $iID);
          echo "<td>".$invoice."</td>";
          $incount = $incount + 1;}
        
        if($freecount > 0){
        echo "<td>".$freecount."</td>";}
          $groupsteps = $groupsteps + 1;
        }

          
          $num = $num + 1;
        echo "</tr>";
        $steps = $steps + 1;
      }
      mysqli_close($conn);
      ?>
    </tbody>
  </table>
  <?php } ?>
</div>
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

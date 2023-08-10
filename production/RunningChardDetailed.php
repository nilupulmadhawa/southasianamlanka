<?php 
session_start(); 
$id1 = $_SESSION['id']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DHN Vetmedicare Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
    <!--jquery related-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
      <!--product ajax-->
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
        xmlhttp.open("GET","RunningChart.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
    
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
    <div class="col-sm-2 sidenav">
      <?php include 'SideBarMaintain.php'; ?>
    </div>
    <div class="col-sm-8 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
        <div class="row">
            <div class="col-sm-10">
                
            <form class="form-inline" role="form" method="post" action="RunningChart.php" >                
              <div class="form-group">
                  <label>Date:</label>
                  <input type="text" class="form-control" id="datepicker" name="repdate" placeholder="Date" autocomplete="off" autofocus="on" required>
                </div>
              <div class="form-group">
                <label>Rep Name:</label>
                <select name="rep" class="form-control" required>
                    <?php 
                    include 'connection.php';
                    $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3 ");
                     while($row = mysqli_fetch_array($result)){
                       echo "<option value='".$row[0]."'>".$row[1]."</option>";
                    }
                    ?>
                  </select>
              </div>
              
              <button type="submit" class="btn btn-default">Submit</button>
                
            </form>
                
            </div>
            <div class="col-sm-2" style="padding-left:20px;">
            <button id="myButton" class="btn btn-primary" >PRINT</button>
        <script type="text/javascript">
            document.getElementById("myButton").onclick = function () {
                location.href = "RunningPrint.php";
            };
        </script>
            </div>
            
        </div>
        
        <div class="row">
            
       
            <table class="table table-striped">
          <thead>
            <tr>
              <th>Time</th>
              <th>Meter</th>
              <th>Place</th>
              <th>Order</th>
              <th>Cash</th>
              <th>Cheque</th>
              <th>Delivery</th>
              <th>Purchase</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include 'connection.php';
            $todaydate = date("Y-m-d");
            $torder = 0;
            $tcash = 0;
            $tcheque = 0;
            $tdelivery = 0;
            $tpurchase = 0;
            $count = 0;
             if(isset($_SESSION['check']) && $_SESSION['check'] = 1){
                $repID = $_SESSION['repdate'];    
                $repDate = $_SESSION['repid']; 
            $result = mysqli_query($conn,"SELECT * FROM running_chart WHERE meterdate = '$repID' && rep_id = $repDate ");
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              echo "<td>".$row[4]."</td>";
              echo "<td>".$row[1]."</td>";
              echo "<td>".$row[2]."</td>";
              echo "<td class='text-right'>".number_format($row[6],2)."</td>";
              echo "<td class='text-right'>".number_format($row[7],2)."</td>";
              echo "<td class='text-right'>".number_format($row[8],2)."</td>";
              echo "<td class='text-right'>".number_format($row[9],2)."</td>";
              echo "<td class='text-right'>".number_format($row[10],2)."</td>";
              echo "<td class='text-right'>".number_format($row[11],2)."</td>";              
              echo "</td>";
              $torder  = $torder + $row[6];
              $tcash  = $tcash + $row[7];
              $tcheque  = $tcheque + $row[8];
              $tdelivery  = $tdelivery + $row[9];
              $tpurchase  = $tpurchase + $row[10];
              $fuel = $fuel + $row[11];

            }    }
            mysqli_close($conn);
            ?>
          </tbody>
          <tr><td></td><td></td><td><b>Total:</b><b></td><td class='text-right'><b><?php echo  number_format($torder,2); ?></b></td><td class='text-right'><b><?php echo  number_format($tcash,2); ?></b></td><td class='text-right'><b><?php echo  number_format($tcheque,2); ?></b></td><td class='text-right'><b><?php echo  number_format($tdelivery,2); ?></b></td><td class='text-right'><b><?php echo  number_format($tpurchase,2); ?></b></td><td class='text-right'><b><?php echo  number_format($fuel,2); ?></b></td></b></tr>
        </table>
            
     
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

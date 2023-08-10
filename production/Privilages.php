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
    <style>
        .edited{
            padding-left: 30px;
            padding-bottom: 10px;
        }
        .borderstyle{
            border: 1px solid;
            margin: 10px;
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
    
    <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;padding-top:10px;"> 

        <!--        section label-->
        <div style="text-align:center;background-color:teal;color:white;margin-bottom:10px;">
            <label style="font-size:20px;">USER PRIVILAGE MANAGEMENT</label>
        </div>

      <div class="row">
      <div class="col-sm-4" style="margin-left:10px;">
        <!--start of the form-->
        <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                    
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">User Name:</label>
                <div class="col-sm-10">                         
                    <select class="form-control" id="sel1" name="priv">
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
            
            <div class="form-group">      
                <button type="submit" class="btn btn-primary btn-block">SET</button> 
            </div> 
            
            
        </form>
        <!--end of the form-->
      </div>
          
          <div class="col-sm-12" style="margin-left:10px;">
            <hr/>
              
              <?php if(isset($_POST['priv'])){ 
                $userid = $_POST['priv'];
              ?>
            <div class="row" style="font-size: 25px;text-align: center;">PRIVILAGE SETTINGS FOR <b>"<?php 
              include 'connection.php';
                          $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Prof_ID = $userid ");
                                          while($row = mysqli_fetch_array($result)){
                                              echo $row[1];
                                          }
                          mysqli_close($conn);
            ?>"</b> </div>
            <form class="form-horizontal" role="form" action="PrivilagesConnection.php" method="post">
                <div class="form-group">
                     <input type="hidden" name="userID" value="<?php echo $userid; ?>" class="form-control">
                    <div class="row borderstyle">
                    <div class="col-sm-6">   
                        <div class="col-sm-12" style="text-align:center;font-size:25px;">Administration</div>
                          <label class="edited"><input type="checkbox" name="1" <?php if(privCheck(1,$userid)>0){ echo "checked"; }?> > Update Company Details</label>                     
                          <label class="edited"><input type="checkbox" name="2" <?php if(privCheck(2,$userid)>0){ echo "checked"; }?> > User Registration</label>                     
                          <label class="edited"><input type="checkbox" name="3" <?php if(privCheck(3,$userid)>0){ echo "checked"; }?> > Privilage Management</label>                     
                          
                    </div>
                    
                    <div class="col-sm-6">    
                        <div class="col-sm-12" style="text-align:center;font-size:25px;">Business Registration</div>
                          <label class="edited"><input name="4" <?php if(privCheck(4,$userid)>0){ echo "checked"; }?> type="checkbox"> Add New Customer Category</label>                     
                          <label class="edited"><input name="5" <?php if(privCheck(5,$userid)>0){ echo "checked"; }?> type="checkbox"> Add New Custome</label>                     
                          <label class="edited"><input name="6" <?php if(privCheck(6,$userid)>0){ echo "checked"; }?> type="checkbox"> Change The Name Of A Customer</label>                     
                          <label class="edited"><input name="7" <?php if(privCheck(7,$userid)>0){ echo "checked"; }?> type="checkbox"> Update Customer Details</label>                     
                          <label class="edited"><input name="8" <?php if(privCheck(8,$userid)>0){ echo "checked"; }?> type="checkbox"> Detailed Report Of Customers</label> 
                        <hr/>
                        <label class="edited"><input name="9" <?php if(privCheck(9,$userid)>0){ echo "checked"; }?> type="checkbox"> Add New Supplier</label> 
                        <label class="edited"><input name="10" <?php if(privCheck(10,$userid)>0){ echo "checked"; }?> type="checkbox"> Change The Name Of A Supplier</label> 
                        <label class="edited"><input name="11" <?php if(privCheck(11,$userid)>0){ echo "checked"; }?> type="checkbox"> Update Supplier Details</label> 
                    </div>
                    </div>
                    
                    <hr/>
                    
                    <div class="row borderstyle">
                    <div class="col-sm-6">   
                        <div class="col-sm-12" style="text-align:center;font-size:25px;">Inventory Management</div>
                          <label class="edited"><input name="12" <?php if(privCheck(12,$userid)>0){ echo "checked"; }?> type="checkbox"> Initial Inventory Balance</label>                     
                          <label class="edited"><input name="13" <?php if(privCheck(13,$userid)>0){ echo "checked"; }?> type="checkbox"> Add New Category</label>                     
                          <label class="edited"><input name="14" <?php if(privCheck(14,$userid)>0){ echo "checked"; }?> type="checkbox"> Add New Products</label>                     
                          <label class="edited"><input name="15" <?php if(privCheck(15,$userid)>0){ echo "checked"; }?> type="checkbox"> ADD Price Details</label> 
                          <label class="edited"><input name="16" <?php if(privCheck(16,$userid)>0){ echo "checked"; }?> type="checkbox"> Update Free Issues</label>
                          <label class="edited"><input name="17" <?php if(privCheck(17,$userid)>0){ echo "checked"; }?> type="checkbox"> Change The Name Of A Product</label>                 
                          <label class="edited"><input name="18" <?php if(privCheck(18,$userid)>0){ echo "checked"; }?> type="checkbox"> Update Existing Product Details</label>                  
                          <label class="edited"><input name="19" <?php if(privCheck(19,$userid)>0){ echo "checked"; }?> type="checkbox"> Update Category For A Product</label>                  
                          <label class="edited"><input name="20" <?php if(privCheck(20,$userid)>0){ echo "checked"; }?> type="checkbox"> Update Supplier For A Product</label>                  
                          <label class="edited"><input name="21" <?php if(privCheck(21,$userid)>0){ echo "checked"; }?> type="checkbox"> Product List</label>  
                        <hr/>
                           <label class="edited"><input name="22" <?php if(privCheck(22,$userid)>0){ echo "checked"; }?> type="checkbox"> Set Commision Scheme</label> 
                          
                    </div>
                    
                    <div class="col-sm-6">    
                        <div class="col-sm-12" style="text-align:center;font-size:25px;">GRN,Sales And Payment</div>
                          <label class="edited"><input name="23" <?php if(privCheck(23,$userid)>0){ echo "checked"; }?> type="checkbox"> New Purchase Order</label>                     
                          <label class="edited"><input name="24" <?php if(privCheck(24,$userid)>0){ echo "checked"; }?> type="checkbox"> New GRN</label>                     
                          <label class="edited"><input name="25" <?php if(privCheck(25,$userid)>0){ echo "checked"; }?> type="checkbox"> Purchase Order Detailed Report</label>                     
                          <label class="edited"><input name="26" <?php if(privCheck(26,$userid)>0){ echo "checked"; }?> type="checkbox"> GRN Detailed Report</label>                     
                          
                        <hr/>
                        <label class="edited"><input name="27" <?php if(privCheck(27,$userid)>0){ echo "checked"; }?> type="checkbox"> New Invoice</label> 
                        <label class="edited"><input name="28" <?php if(privCheck(28,$userid)>0){ echo "checked"; }?> type="checkbox"> New Return</label> 
                        <label class="edited"><input name="29" <?php if(privCheck(29,$userid)>0){ echo "checked"; }?> type="checkbox"> Invoice Detailed Report</label>
                        
                        <hr/>
                        <label class="edited"><input name="30" <?php if(privCheck(30,$userid)>0){ echo "checked"; }?> type="checkbox"> New Payment</label> 
                        <label class="edited"><input name="31" <?php if(privCheck(31,$userid)>0){ echo "checked"; }?> type="checkbox"> Cheque</label> 
                        
                    </div>
                    </div>
                    
                    <hr/>
                    
                    <div class="row borderstyle">
                    <div class="col-sm-12">   
                        <div class="col-sm-12" style="text-align:center;font-size:25px;">Reports</div>
                          <label class="edited"><input name="32" <?php if(privCheck(32,$userid)>0){ echo "checked"; }?> type="checkbox"> Customer Profile</label>                     
                          <label class="edited"><input name="33" <?php if(privCheck(33,$userid)>0){ echo "checked"; }?> type="checkbox"> Product Reorder Level Report</label>                     
                          <label class="edited"><input name="34" <?php if(privCheck(34,$userid)>0){ echo "checked"; }?> type="checkbox"> Outstanding Report</label>  
                          <label class="edited"><input name="35" <?php if(privCheck(35,$userid)>0){ echo "checked"; }?> type="checkbox"> Inventory Detailed Report</label>
                          <label class="edited"><input name="36" <?php if(privCheck(36,$userid)>0){ echo "checked"; }?> type="checkbox"> Customer Wise Sales Report</label>                     
                          <label class="edited"><input name="37" <?php if(privCheck(37,$userid)>0){ echo "checked"; }?> type="checkbox"> Total GRN Detailed Report</label>                  
                          <label class="edited"><input name="38" <?php if(privCheck(38,$userid)>0){ echo "checked"; }?> type="checkbox"> Product Wise Sales Report</label>                  
                          <label class="edited"><input name="39" <?php if(privCheck(39,$userid)>0){ echo "checked"; }?> type="checkbox"> Total Product Sales Report</label>                  
                          <label class="edited"><input name="40" <?php if(privCheck(40,$userid)>0){ echo "checked"; }?> type="checkbox"> Inventory Balance Detailed Report</label>                  
                          <label class="edited"><input name="41" <?php if(privCheck(41,$userid)>0){ echo "checked"; }?> type="checkbox"> Invoice Detailed Report</label> 
                        
                          <label class="edited"><input name="42" <?php if(privCheck(42,$userid)>0){ echo "checked"; }?> type="checkbox"> GRN Detailed Report</label>                  
                          <label class="edited"><input name="43" <?php if(privCheck(43,$userid)>0){ echo "checked"; }?> type="checkbox"> Return Note Detailed Report</label>                  
                          <label class="edited"><input name="44" <?php if(privCheck(44,$userid)>0){ echo "checked"; }?> type="checkbox"> Bin Card</label>                  
                          <label class="edited"><input name="45" <?php if(privCheck(45,$userid)>0){ echo "checked"; }?> type="checkbox"> Customer Wise Outstanding Report</label>                  
                          <label class="edited"><input name="46" <?php if(privCheck(46,$userid)>0){ echo "checked"; }?> type="checkbox"> Area Wise Outstanding Report</label>                  
                          <label class="edited"><input name="47" <?php if(privCheck(47,$userid)>0){ echo "checked"; }?> type="checkbox"> Returned cheque outstanding</label>                  
                          
                    </div>                    
                    
                    </div>
                    
                    </div> 
                <div class="form-group">      
                    <button type="submit" class="btn btn-primary">SET</button> 
                </div>
            </form>
              <?php } ?>
              
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

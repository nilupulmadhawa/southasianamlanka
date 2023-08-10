<?php
// include('class/mysql_crud.php');
$company = $_SESSION['company'];
$prev = $_SESSION['prev'];
$id1 = $_SESSION['id'];

function privCheck($module,$userID){
  include 'connection.php';
  $rowcount = 0;
  $sql = "SELECT * FROM tbl_role WHERE user_id = $userID AND module_id = $module ";
  $result = mysqli_query($conn, $sql);
  $rowcount = mysqli_num_rows($result);
  return $rowcount;
  mysqli_close($conn);
}

?>
<style>
.label1{
  padding-left:5px;
  background-color:teal;
  width:100%;
  color:white;
}
</style>
<nav class="navbar navbar-inverse" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="Maintain.php"><b>WAYAMBA TRADE CENTER</b></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">

      <?php
      if($company == 2 && $prev == 1){
        ?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration <b class="caret"></b></a>
          <ul class="dropdown-menu">

            <!--            company details-->
            <label class="label1">COMPANY <?php echo $company; ?></label>

            <li><a href="addcompany.php" style="color:blue;">New Branches</a></li>
            <li><a href="updatecompany.php" style="color:blue;">Update Branch Details</a></li>


            <li class="divider"></li>

            <!--            user details-->
            <label class="label1">USERS</label>

            <li><a href="UserRegistration.php" style="color:blue;">User Registration</a></li>

            <li><a href="Privilages.php" style="color:blue;">Privilage Management</a></li>

          </ul>
        </li>

        <?php
      }
      ?>


      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Business Registration <b class="caret"></b></a>
        <ul class="dropdown-menu">

          <!--            customer details-->
          <label class="label1">CUSTOMERS</label>
          <?php if(privCheck(4,$id1)>0) { ?>
            <li><a href='NewRoute.php' style="color:blue;">Add New Route</a></li>
            <li><a href='NewCustomerCat.php' style="color:blue;">Add New Customer Category</a></li>
          <?php } ?>
          <?php if(privCheck(5,$id1)>0) { ?>
            <li><a href='NewCustomer.php' style="color:blue;">Add New Customer</a></li>
          <?php } ?>
          <?php if(privCheck(6,$id1)>0) { ?>
            <li><a href='ChageCustomerName.php' style="color:blue;">Change The Name Of A Customer</a></li>
          <?php } ?>
          <?php if(privCheck(7,$id1)>0) { ?>
            <li><a href='UpdateCustomers.php' style="color:blue;">Update Customer Details</a></li>
          <?php } ?>
          <?php if(privCheck(8,$id1)>0) { ?>
            <li><a href='CustomerList.php' style="color:blue;">Detailed Report Of Customers</a></li>
          <?php } ?>

          <li><a href='CustomerListRoute.php' style="color:blue;">Detailed Report Of Customers Route Wise</a></li>

          <li class="divider"></li>

          <!--            supplier details-->
          <label class="label1">SUPPLIERS</label>
          <?php if(privCheck(9,$id1)>0) { ?>
            <li><a href="NewSupplier.php" style="color:blue;">Add New Supplier</a></li>
          <?php } ?>
          <?php if(privCheck(10,$id1)>0) { ?>
            <li><a href="ChangeSupplierName.php" style="color:blue;">Change The Name Of A Supplier</a></li>
          <?php } ?>
          <?php if(privCheck(11,$id1)>0) { ?>
            <li><a href="UpdateSupplier.php" style="color:blue;">Update Supplier Details</a></li>
          <?php } ?>
        </ul>
      </li>


      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventory Management<b class="caret"></b></a>
        <ul class="dropdown-menu">

          <!--            inventory details-->
          <label class="label1">INVENTORY</label>
          <?php if(privCheck(12,$id1)>0) { ?>
            <!-- <li><a href='InitialInventory.php' style="color:blue;">Initial Inventory Balance</a></li> -->
          <?php } ?>

          <!--<li><a href='InventoryBalance.php' style="color:blue;">Fill The Inventory Gap</a></li>-->
          <?php if(privCheck(13,$id1)>0) { ?>
            <li><a href="NewCategory.php" style="color:blue;">Add New Category</a></li>
          <?php } ?>
          <?php if(privCheck(14,$id1)>0) { ?>
            <li><a href="NewProduct.php" style="color:blue;">Add New Products</a></li>
          <?php } ?>
          <?php if(privCheck(15,$id1)>0) { ?>
            <li><a href="OldPrice.php" style="color:blue;">ADD Batch Details</a></li>
          <?php } ?>
          <?php if(privCheck(16,$id1)>0) { ?>
            <li><a href="FreeIssue.php" style="color:blue;">Update Free Issues</a></li>
          <?php } ?>
          <?php if(privCheck(17,$id1)>0) { ?>
            <li><a href="ChaneProductName.php" style="color:blue;">Change The Name Of A Product</a></li>
          <?php } ?>
          <?php if(privCheck(18,$id1)>0) { ?>
            <li><a href="UpdateProduct.php" style="color:blue;">Update Existing Product Details</a></li>
          <?php } ?>
          <?php if(privCheck(19,$id1)>0) { ?>
            <li><a href="UpdateCategory.php" style="color:blue;">Update Category For A Product</a></li>
          <?php } ?>
          <?php if(privCheck(20,$id1)>0) { ?>
            <li><a href="UpdateProductSupplier.php" style="color:blue;">Update Supplier For A Product</a></li>
          <?php } ?>
          <?php if(privCheck(21,$id1)>0) { ?>
            <li><a href='ProductList.php'style='color:blue;'>Product List</a></li>
          <?php } ?>

          <hr/>
          <label class="label1">COMMISION</label>
          <?php if(privCheck(22,$id1)>0) { ?>
            <li><a href='Commision.php'style='color:blue;'>Set Commision Scheme</a></li>
          <?php } ?>

        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Accounts (Expences)<b class="caret"></b></a>
        <ul class="dropdown-menu">

          <!-- company details -->
          <label class="label1">Company Expences</label>
          <li><a href="expences.php" style="color:blue;">Accounts</a></li>
          <li class="divider"></li>

        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">GRN, Sales And Payment<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <?php if($company == 2){ ?>
            <!--            purchase details-->
            <label class="label1">MAIN STOCK MANAGEMENT</label>
            <?php if(privCheck(23,$id1)>0) { ?>
              <!-- <li><a href="NewPurchase.php" style="color:blue;">New Purchase Order</a></li> -->
            <?php } ?>
            <?php if(privCheck(24,$id1)>0) { ?>
              <li><a href="NewPurchaseOrder.php" style="color:blue;">Main Stock GRN</a></li>
            <?php } ?>
            <?php if(privCheck(25,$id1)>0) { ?>
              <!-- <li><a href="PurchaseOrderDetailed.php" style="color:blue;">Purchase Order Detailed Report</a></li> -->
            <?php } ?>
            <?php if(privCheck(26,$id1)>0) { ?>
              <li><a href="DetailedReportPO.php" style="color:blue;">GRN Detailed Report</a></li>
            <?php } ?>
            <li class="divider"></li>



            <label class="label1">SUB STOCK MANAGEMENT</label>

            <?php if(privCheck(24,$id1)>0) { ?>
              <li><a href="NewPurchaseOrder_sub.php" style="color:blue;">Sub Stock GRN</a></li>
            <?php } ?>

            <?php if(privCheck(26,$id1)>0) { ?>
              <li><a href="DetailedReportPO_sub.php" style="color:blue;">Sub GRN Detailed Report</a></li>
            <?php } ?>
            <li class="divider"></li>
          <?php } ?>

          <label class="label1">REP STOCK MANAGEMENT</label>

          <?php if(privCheck(24,$id1)>0) { ?>
            <li><a href="NewPurchaseOrder_rep.php" style="color:blue;">Rep Stock GRN</a></li>
          <?php } ?>

          <?php if(privCheck(26,$id1)>0) { ?>
            <li><a href="DetailedReportPO_rep.php" style="color:blue;">Rep GRN Detailed Report</a></li>
          <?php } ?>

          <li><a href="Return_rep.php" style="color:blue;">Rep Stock Return</a></li>

          <li class="divider"></li>


          <!--            sales and return details-->
          <label class="label1">SALES AND RETURN</label>
          <?php if(privCheck(27,$id1)>0) { ?>
            <li><a href="NewInvoicePrimary.php" style="color:blue;">New Invoice</a></li>
          <?php } ?>
          <?php if(privCheck(28,$id1)>0) { ?>
            <li><a href="Return.php" style="color:blue;">New Return</a></li>
          <?php } ?>
          <li><a href="InvCancle.php" style="color:blue;">Cancle Invoice</a></li>
          <?php if(privCheck(29,$id1)>0) { ?>
            <li><a href="DetailedReportInvoice.php" style="color:blue;">Invoice Detailed Report</a></li>
          <?php } ?>
          <li class="divider"></li>


          <!--            purchase details-->
          <label class="label1">PAYMENT</label>
          <?php if(privCheck(30,$id1)>0) { ?>
            <li><a href="NewCollection.php" style="color:blue;">New Payment</a></li>
          <?php } ?>
          <?php if(privCheck(31,$id1)>0) { ?>
            <li><a href="cheque.php" style="color:blue;">Cheque</a></li>
          <?php } ?>
          <li class="divider"></li>

          <!--            purchase details-->
          <label class="label1">SUPPLIER PAYMENT</label>
          <?php if(privCheck(30,$id1)>0) { ?>
            <li><a href="NewCollectionSup.php" style="color:blue;">New Supplier Payment</a></li>
          <?php } ?>
          <?php if(privCheck(31,$id1)>0) { ?>
            <li><a href="chequeSup.php" style="color:blue;">Supplier Cheque</a></li>
          <?php } ?>
          <li class="divider"></li>



        </ul>
      </li>


      <li class="dropdown">
        <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports<b class="caret"></b></a> -->
        <ul class="dropdown-menu">

          <!--            reports details-->
          <label class="label1">REPORTS</label>
          <?php if(privCheck(32,$id1)>0) { ?>
            <li><a href='CustomerProfile.php' style='color:blue;'>Customer Profile</a></li>
          <?php } ?>
          <?php if(privCheck(33,$id1)>0) { ?>
            <li><a href='reorderlvl.php' style='color:blue;'>Product Reorder Level Report</a></li>
          <?php } ?>
          <?php if(privCheck(34,$id1)>0) { ?>
            <li><a href='Outstanding.php' style='color:blue;'>Outstanding Report</a></li>
          <?php } ?>
          <?php if(privCheck(35,$id1)>0) { ?>
            <li><a href='stock.php' style='color:blue;'>Main Inventory Detailed Report</a></li>
            <li><a href='stockSub.php' style='color:blue;'>Sub Inventory Detailed Report</a></li>
          <?php } ?>

          <?php if(privCheck(36,$id1)>0) { ?>
            <li><a href="CusWiseSale.php" style="color:blue;">Customer Wise Sales Report</a></li>
          <?php } ?>
          <?php if(privCheck(37,$id1)>0) { ?>
            <!-- <li><a href="DetailedReportPO.php" style="color:blue;">Total GRN Detailed Report</a></li> -->
          <?php } ?>
          <?php if(privCheck(38,$id1)>0) { ?>
            <li><a href="ReportProductSale.php" style="color:blue;">Product Wise Sales Report</a></li>
          <?php } ?>
          <?php if(privCheck(39,$id1)>0) { ?>
            <li><a href="ReportTotalProduct.php" style="color:blue;">Total Product Sales Report</a></li>
          <?php } ?>
          <?php if(privCheck(40,$id1)>0) { ?>
            <!-- <li><a href="ReportInventoryBalance.php" style="color:blue;">Inventory Balance Detailed Report</a></li> -->
          <?php } ?>
          <?php if(privCheck(41,$id1)>0) { ?>
            <li><a href="RportInvoices.php" style="color:blue;">Invoice Detailed Report</a></li>
          <?php } ?>
          <?php if(privCheck(42,$id1)>0) { ?>
            <!-- <li><a href="RportGrn.php" style="color:blue;">GRN Detailed Report</a></li> -->
          <?php } ?>
          <?php if(privCheck(43,$id1)>0) { ?>
            <li><a href="ReturnCollection.php" style="color:blue;">Return Note Detailed Report</a></li>
          <?php } ?>
          <?php if(privCheck(44,$id1)>0) { ?>
            <!-- <li><a href="BillCard.php" style="color:blue;">Bin Card</a></li> -->
          <?php } ?>
          <?php if(privCheck(45,$id1)>0) { ?>
            <li><a href="OutPrint.php" style="color:blue;">Customer Wise Outstanding Report</a></li>
          <?php } ?>
          <?php if(privCheck(46,$id1)>0) { ?>
            <li><a href="OutPrintArea.php" style="color:blue;">Area Wise Outstanding Report</a></li>
          <?php } ?>
          <?php if(privCheck(47,$id1)>0) { ?>
            <li><a href="ReturnedCheque.php" style="color:blue;">Returned cheque outstanding</a></li>
          <?php } ?>

          <!-- <li><a href="freeissuerange.php" style="color:blue;">Free Issue Report</a></li> -->
          <li class="divider"></li>


          <!--            reports details-->
          <label class="label1">HEAD OFFICE COMMON REPORTS</label>
          <?php if(privCheck(32,$id1)>0) { ?>
            <li><a href='CustomerProfile.php' style='color:blue;'>Customer Profile <b>(*common)</b></a></li>
          <?php } ?>

          <?php if(privCheck(34,$id1)>0) { ?>
            <li><a href='Outstanding.php' style='color:blue;'>Outstanding Report <b>(*common)</b></a></li>
          <?php } ?>
          <?php if(privCheck(35,$id1)>0) { ?>
            <li><a href='stock.php' style='color:blue;'>Inventory Detailed Report <b>(*common)</b></a></li>
          <?php } ?>

          <?php if(privCheck(36,$id1)>0) { ?>
            <li><a href="CusWiseSale.php" style="color:blue;">Customer Wise Sales Report <b>(*common)</b></a></li>
          <?php } ?>

          <?php if(privCheck(38,$id1)>0) { ?>
            <li><a href="ReportProductSale.php" style="color:blue;">Product Wise Sales Report <b>(*common)</b></a></li>
          <?php } ?>
          <?php if(privCheck(39,$id1)>0) { ?>
            <li><a href="ReportTotalProduct.php" style="color:blue;">Total Product Sales Report <b>(*common)</b></a></li>
          <?php } ?>

          <?php if(privCheck(41,$id1)>0) { ?>
            <li><a href="RportInvoices.php" style="color:blue;">Invoice Detailed Report <b>(*common)</b></a></li>
          <?php } ?>

          <?php if(privCheck(43,$id1)>0) { ?>
            <li><a href="ReturnCollection.php" style="color:blue;">Return Note Detailed Report <b>(*common)</b></a></li>
          <?php } ?>

          <?php if(privCheck(45,$id1)>0) { ?>
            <li><a href="OutPrint.php" style="color:blue;">Customer Wise Outstanding Report <b>(*common)</b></a></li>
          <?php } ?>
          <?php if(privCheck(46,$id1)>0) { ?>
            <li><a href="OutPrintArea.php" style="color:blue;">Area Wise Outstanding Report <b>(*common)</b></a></li>
          <?php } ?>

          <li class="divider"></li>



        </ul>
      </li>

    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> logout</a></li>

    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

<div class="alert alert-info">
  <b><strong>NEW UPDATES !</strong> UDPATES IN PROGRESS.... PLEASE WAIT UTILL IT COMPLETES.<b/>
  </div>

<?php
require_once __DIR__ . '/../../util/initialize.php';

$user = User::find_by_id($_SESSION["user"]["id"]);
?>
<div class="col-md-3 left_col ">
  <div class="left_col scroll-view">

    <div class="navbar nav_title" style="border: 0;">
      <a href="index.php" class="site_title"><i class="fa fa-home "></i> <span><?php echo ProjectConfig::$project_name; ?></span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic" >
        <?php
        $image = "images/user.png";
        if ($user->image) {
          $image = "uploads/users/" . $user->image;
        }
        ?>
        <img src="<?php echo $image; ?>" alt="..." class="img-circle profile_img">
        <!--<figure style="height: 3em; width: 3em;">
        <img style="border-radius: 100%" class="img-responsive image_fit " src="<?php // echo 'uploads/users/'.$user->image;               ?>"  alt="Image not found" onerror="this.src='images/user.png';">
      </figure>-->
    </div>

    <div class="profile_info">
      <span>Welcome,</span>
      <h2><?php echo $user->name; ?></h2>
    </div>
    <div class="clearfix"></div>
  </div>

  <!-- /menu profile quick info -->
  <br />

  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <!--<h3>General</h3>-->
      <ul class="nav side-menu">

        <li><a><i class="fa fa-shopping-cart"></i> Product Management <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <div class="menu_heading"><label >EDIT</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Category","ins")){
              echo '<li><a href="category.php">Add Category</a></li>';
              echo '<li><a href="brand.php">Add Brand</a></li>';
              echo '<li><a href="unit.php">Add Unit</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Product","ins")){
              echo '<li><a href="product.php">Add Product</a></li>';
            }
            ?>
            <!--<li><a href="batch.php">Batch</a></li>-->

            <div class="menu_heading"><label>REPORTS</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Category","view")){
              echo '<li><a href="category_management.php">Category Detailed Report</a></li>';
              echo '<li><a href="brand_management.php">Brand Detailed Report</a></li>';
              echo '<li><a href="unit_management.php">Unit Detailed Report</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Product","view")){
              echo '<li><a href="product_management.php">Product Detailed Report</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Batch","view")){
              echo '<li><a href="batch_management.php">Batch Management</a></li>';
            }
            ?>



          </ul>
        </li>

        <li>
          <!-- <a><i class="fa fa-cart-plus"></i> Production <span class="fa fa-chevron-down"></span></a> -->
          <ul class="nav child_menu">
            <div class="menu_heading"><label >EDIT</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Material","ins")){
              echo '<li><a href="material.php">Add Material</a></li>';
            }
            //                                if(Functions::check_privilege_by_module_action("ProductionPlan","ins")){
            //                                    echo '<li><a href="production_plan.php">Production Plan</a></li>';
            //                                }
            if(Functions::check_privilege_by_module_action("Production","ins")){
              echo '<li><a href="production.php">Add Production</a></li>';
            }
            ?>
            <!--<li><a href="recipie.php">Add Recepie</a></li>-->

            <div class="menu_heading"><label>REPORTS</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Material","view")){
              echo '<li><a href="material_management.php">Material Management</a></li>';
            }
            //                                if(Functions::check_privilege_by_module_action("ProductionPlan","view")){
            //                                    echo '<li><a href="production_plan_management.php">Production Plan Detailed Report</a></li>';
            //                                }
            if(Functions::check_privilege_by_module_action("Production","view")){
              echo '<li><a href="production_management.php">Production Detailed Report</a></li>';
            }
            if(Functions::check_privilege_by_module_action("MaterialStock","view")){
              echo '<li><a href="material_stock_management.php">Material Stock Detailed Report</a></li>';
            }
            ?>
            <!--<li><a href="recipie_management.php">Recipie Detailed Report</a></li>-->
            <!--<li><a href="recipe_material_management.php">Recipe Material Detailed Report</a></li>-->
          </ul>
        </li>
        <li><a><i class="fa fa-user-circle"></i> Supplier Management <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <!--<i class="fa fa-table"></i>-->
            <div class="menu_heading"><label>EDIT</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Supplier","ins")){
              echo '<li><a href="supplier.php">Add Supplier</a></li>';
            }
            ?>

            <div class="menu_heading"><label>REPORTS</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Supplier","view")){
              echo '<li><a href="supplier_management.php">Supplier Management</a></li>';
            }
            ?>
          </ul>
        </li>

        <li><a><i class="fa fa-group"></i> Customer Management<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <div class="menu_heading"><label >EDIT</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Route","view")){
              echo "<li><a href='route.php'>Add Town</a></li>";
            }

            if(Functions::check_privilege_by_module_action("Customer","view")){
              echo "<li><a href='customer.php'>Add Customer</a></li>";
            }

            ?>
            <!--<li><a href="customer_order.php">Add Customer Order</a></li>-->
            <div class="menu_heading"><label>REPORTS</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Customer","view")){
              echo "<li><a href='route_management.php'>Town Detailed Report</a></li>";
            }

            if(Functions::check_privilege_by_module_action("Customer","view")){
              echo "<li><a href='customer_management.php'>Customer Detailed Report</a></li>";
            }

            ?>
            <!--<li><a href="customer_order_management.php">Customer Order Detailed Report</a></li>-->
          </ul>
        </li>

        <li><a><i class="fa fa-archive"></i> Inventory Management <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <div class="menu_heading"><label >EDIT</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("ProductPO","view")){
              // echo '<li><a href="product_purchase_order.php">Add Product Purchase Order</a></li>';
            }
            if(Functions::check_privilege_by_module_action("MaterialPO","view")){
              // echo '<li><a href="material_purchase_order.php">Add Material Purchase Order</a></li>';
            }
            if(Functions::check_privilege_by_module_action("ProductGRN","view")){
              echo '<li><a href="product_grn.php">Add Product GRN</a></li> ';
              echo '<li><a href="stock_adjustment.php">Inventory Adjestement</a></li>';

            }
            if(Functions::check_privilege_by_module_action("MaterialGRN","view")){
              // echo '<li><a href="material_grn.php">Add Material GRN</a></li>';
            }
            ?>
            <!--<li><a href="inventory.php">Add Inventory</a></li>-->

            <div class="menu_heading"><label>REPORTS</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("ProductPO","view") || Functions::check_privilege_by_module_action("MaterialPO","view")){
              // echo '<li><a href="purchase_order_management.php">Purchase Order Management</a></li>';
            }
            if(Functions::check_privilege_by_module_action("ProductGRN","view") || Functions::check_privilege_by_module_action("MaterialGRN","view")){
              echo '<li><a href="grn_management.php">GRN Detailed Report</a></li>';
            }

            //                                if(Functions::check_privilege_by_module_action("Inventory","view")){
            //                                    echo '<li><a href="inventory_report.php">All Inventory Report</a></li>';
            //                                }

            if(Functions::check_privilege_by_module_action("Inventory","view")){
              echo '<li><a href="inventory_management.php">Inventory Management</a></li>';
              echo '<li><a href="stock_adjustment_detailed.php">Inventory Adjestement Detailed Report </a></li>';

            }


            ?>
          </ul>
        </li>

        <li><a><i class="fa fa-dollar"></i> Sales And Payment <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <div class="menu_heading"><label >EDIT</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Invoice","ins")){
              echo '<li><a href="invoice_by_deliverer.php">Add Invoice</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Payment","ins")){
              echo '<li><a href="payment.php">Add Payment</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Payment","ins")){
              // echo '<li><a href="customer_payment.php">Add Customer Payment</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Return","ins")){
              echo '<li><a href="product_return_by_deliverer_new.php">Product Return</a></li>';
            }
            ?>
            <!--<li><a href="cheque.php">Add Cheque</a></li>-->
            <!--<li><a href="Return.php">Sales Return</a></li>-->
            <!--<li><a href="invoice_return_by_deliverer.php">Invoice Return</a></li>-->

            <div class="menu_heading"><label>REPORTS</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Invoice","view")){
              echo '<li><a href="invoice_management.php">Invoice Management (Not Printed)</a></li>';
              echo '<li><a href="invoice_management_printed.php">Invoice Management (Printed)</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Payment","view")){
              echo '<li><a href="payment_management.php">Payment Management</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Cheque","view")){
              echo '<li><a href="cheque_management.php">Cheque Management</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Return","view")){
              echo '<li><a href="product_return_management.php">Product Return Detailed Report</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Payment","view")){
              echo '<li><a href="payment_history.php">Payment History</a></li>';
              echo '<li><a href="over_payments.php">Over Payments</a></li>';
              echo '<li><a href="partial_payments.php">Partial Payments</a></li>';
            }
            ?>
          </ul>
        </li>
        <li><a><i class="fa fa-truck"></i>Deliverer Management <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <div class="menu_heading"><label >EDIT</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Deliverer","ins")){
              echo '<li><a href="deliverer.php">Add Deliverer</a></li>';
            }
            if(Functions::check_privilege_by_module_action("DelivererInventory","ins")){
              // echo '<li><a href="deliverer_inventory.php">Add Deliverer Inventory</a></li>';
            }
            ?>
            <div class="menu_heading"><label>REPORTS</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Deliverer","view")){
              echo '<li><a href="deliverer_management.php">Deliverer Management</a></li>';
            }
            if(Functions::check_privilege_by_module_action("DelivererInventory","view")){
              // echo '<li><a href="deliverer_inventory_management.php">Deliverer Inventory Detailed Report</a></li>';
            }
            ?>
          </ul>
        </li>
        <li><a><i class="fa fa-user-secret"></i>User Administration <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <div class="menu_heading"><label >EDIT</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Role","ins")){
              echo '<li><a href="role.php">Add Role</a></li>';
            }

            if(Functions::check_privilege_by_module_action("Designation","ins")){
              echo '<li><a href="designation.php">Add Designation</a></li>';
            }

            if(Functions::check_privilege_by_module_action("User","ins")){
              echo '<li><a href="user.php">Add User</a></li>';
            }


            //                                if(Functions::check_privilege_by_module_action("Privilege","ins")){
            if(true){
              echo '<li><a href="privilege_management.php">Privilege Management</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Target","ins")){
              // echo '<li><a href="target.php">Target Add</a></li>';
            }
            ?>

            <div class="menu_heading"><label>REPORTS</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("User","view")){
              echo '<li><a href="user_management.php">User Management</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Role","view")){
              echo '<li><a href="role_management.php">Role Management</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Designation","view")){
              echo '<li><a href="designation_management.php">Designation Management</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Target","view")){
              // echo '<li><a href="target_management.php">Target Management</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Target","view")){
              echo '<li><a href="target_report.php">Target Report</a></li>';
            }
            ?>
          </ul>
        </li>


        <!-- report start -->

        <li><a><i class="fa fa-paperclip"></i>Reports<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">

            <div class="menu_heading"><label>OUTSTANDINGS</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Invoice","view")){
              echo '<li><a href="outstanding_invoice_customers.php">Debitor Aging Report</a></li>';
            }

            ?>
            <div class="menu_heading"><label>SALES</label></div>
            <?php
            if(Functions::check_privilege_by_module_action("Invoice","view")){
              echo '<li><a href="sales_report_customer.php">Customer Wise Sales Report</a></li>';
              echo '<li><a href="sales_report.php">Sales Report</a></li>';
            }

            if(Functions::check_privilege_by_module_action("Invoice","view")){
              echo '<li><a href="sales_report_summary.php">Sales Summary</a></li>';
            }

            if(Functions::check_privilege_by_module_action("Invoice","view")){
              echo '<li><a href="invoice_detail_report.php">Invoice Detail Report</a></li>';
              echo '<li><a href="non_collected_invoice.php">Non Collected Invoice Report</a></li>';
            }

            ?>
            <div class="menu_heading"><label>INVENTORYS</label></div>
            <?php

            if(Functions::check_privilege_by_module_action("Inventory","view")){
              echo '<li><a href="item_wise_detailed_report.php">Item Wise Detailed Report</a></li>';
              echo '<li><a href="item_wise_detailed_report_new.php">Item Wise Detailed Report New</a></li>';
            }

            if(Functions::check_privilege_by_module_action("Inventory","view")){
              // echo '<li><a href="stock_report.php">Stock Report</a></li>';
              echo '<li><a href="stock_report_new.php">Stock Report</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Inventory","view")){
              echo '<li><a href="inventory_report.php">All Stock Report</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Inventory","view")){
              // echo '<li><a href="main_inventory_report.php">Main Inventory Report</a></li>';
            }

            if(Functions::check_privilege_by_module_action("DelivererInventory","view")){
              // echo '<li><a href="deliverer_inventory_management.php">Deliverer Inventory Detailed Report</a></li>';
            }
            if(Functions::check_privilege_by_module_action("Inventory","view")){
              echo '<li><a href="re_order_report.php">Re-Order Report</a></li>';
              
            }


            ?>
          </ul>
        </li>

        <!-- report ends -->



      </ul>
    </div>
  </div>
  <div class="sidebar-footer hidden-small">
    <small style="color:white;">aitsoft© 2018 Software Production</small>
  </div>
  <!-- /menu footer buttons -->
</div>
</div>

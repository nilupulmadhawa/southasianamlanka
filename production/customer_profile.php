<?php
require_once './../util/initialize.php';

if (isset($_GET["id"])) {
  $id= Functions::custom_crypt($_GET["id"], 'd');
  if($customer = Customer::find_by_id($id)){

  }else{
    Session::set_error("Entry not available...");
    Functions::redirect_to("index.php");
  }
}else{
  Functions::redirect_to("index.php");
}

include './common/upper_content.php';

?>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Customer Profile</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>CUSTOMER NAME: <b><?php echo $customer->name; ?></b> <span class="badge" style="color:black;background-color:#dfe6e9;"> <?php if($customer->status == 0){ echo "PENDING"; }elseif($customer->status == 1){ echo "APPROVED"; }elseif($customer->status == 2){ echo "REJECTED"; } ?> <?php if($customer->status_by!=0){ echo " (By: ".$customer->status_by()->name.")";}else{ echo " ( By: System Initial )"; } ?></span> </h2>
              <div class="clearfix"></div>
              <a class="btn btn-danger" style="font-weight:800;" href="proccess/customer_proccess.php?blacklist=<?php echo $customer->id; ?>">ADD TO BLACKLIST <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> </a>
            </div>
            <div class="x_content">

              <div class="col-md-12 col-sm-12 col-xs-12 profile_left">


                <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
                  <div class="tile-stats" style="padding: 10px 10px;">

                    <!-- form start -->

                    <form class="form-inline" action="proccess/customer_proccess.php" method="post">
                      <input type="hidden" name="cus_id" value="<?php echo $customer->id; ?>">
                      <div class="form-group">
                        <label for="email">STATUS: </label>
                        <select class="form-control" name="updatestat">

                          <option value='0' <?php if($customer->status == 0){ echo "SELECTED"; } ?> >PENDING</option>
                          <option value='1' <?php if($customer->status == 1){ echo "SELECTED"; } ?> >APPROVED</option>
                          <option value='2' <?php if($customer->status == 2){ echo "SELECTED"; } ?> >REJECTED</option>

                        </select>
                      </div>

                      <button type="submit" class="btn btn-primary">SET</button>

                    </form>

                    <!-- form ends -->

                  </div>
                </div>


                <div class="col-md-6 col-sm-6 col-xs-6 profile_left">
                  <div class="tile-stats" style="padding: 0px 10px;">
                    <ul class="list-unstyled user_data">
                      <li><i class="fa fa-bars"></i> Name Of Company : <b style="color:blue;"><?php echo $customer->name ?></b> </li>
                      <li><i class="fa fa-bars"></i> Business Registration No : <b style="color:blue;"><?php echo $customer->code ?></b> </li>
                      <li><i class="fa fa-bars"></i> Business Bank Account Number : <b style="color:blue;"><?php echo $customer->account_number ?></b> </li>
                      <li><i class="fa fa-bars"></i> Stock Insurance Cover No: <b style="color:blue;"><?php echo $customer->stock_insurance ?></b> </li>
                      <li><i class="fa fa-bars"></i>Information On Stock Mortgaged to the bank : <b style="color:blue;"><?php echo $customer->stock_mortgaged ?></b> </li>
                      <li><i class="fa fa-bars"></i> Value Of Bank Gurantee : <b style="color:blue;"><?php echo $customer->bank_gurantee ?></b> </li>
                      <li><i class="fa fa-bars"></i> Business Address : <b style="color:blue;"><?php echo $customer->address ?></b> </li>
                      <li><i class="fa fa-bars"></i> Business Telephone No : <b style="color:blue;"><?php echo $customer->phone ?></b> </li>
                      <li><i class="fa fa-bars"></i> Fax No : <b style="color:blue;"><?php echo $customer->fax ?></b> </li>
                      <li><i class="fa fa-bars"></i> E-mail Address : <b style="color:blue;"><?php echo $customer->email ?></b> </li>
                      <li><i class="fa fa-bars"></i> Propriter's Name & Personal Address : <b style="color:blue;"><?php echo $customer->prop_name_email ?></b> </li>
                      <li><i class="fa fa-bars"></i> Propriter's ID Card No : <b style="color:blue;"><?php echo $customer->prop_id ?></b> </li>

                    </ul>
                  </div>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6 profile_left">
                  <div class="tile-stats" style="padding: 0px 10px;">
                    <ul class="list-unstyled user_data">
                      <li><i class="fa fa-bars"></i> Personal Telephone No : <b style="color:blue;"><?php echo $customer->prop_tel ?></b> </li>
                      <li><i class="fa fa-bars"></i> Introduced By A : <b style="color:blue;"><?php echo $customer->intro_a ?></b> </li>
                      <li><i class="fa fa-bars"></i> Introduced By B : <b style="color:blue;"><?php echo $customer->intro_b ?></b> </li>
                      <li><i class="fa fa-bars"></i> Name & Designation Of Authorized Person To Make Purchase Orders : <b style="color:blue;"><?php echo $customer->po_name_designation ?></b> </li>
                      <li><i class="fa fa-bars"></i> Name Of The Bank : <b style="color:blue;"><?php echo $customer->bank_name ?></b> </li>
                      <li><i class="fa fa-bars"></i> Cost Of Planned Purchase Per Month : <b style="color:blue;"><?php echo number_format($customer->month_purchase,2); ?></b> </li>
                      <li><i class="fa fa-bars"></i> Requested Credit Limit : <b style="color:blue;"><?php echo number_format($customer->balance,2); ?></b> </li>
                      <li><i class="fa fa-bars"></i> How Much Of Credit Limit To Be Increased In Future : <b style="color:blue;"><?php echo number_format($customer->balance_increase,2); ?></b> </li>
                      <li><i class="fa fa-bars"></i> Duration Of Payment : <b style="color:blue;"><?php echo $customer->period ?> DAYS</b> </li>
                      <li><i class="fa fa-bars"></i> Method Of Payment : <b style="color:blue;"><?php if( $customer->payment_method == 1 ){ echo "CASH"; }else{ echo "CHEQUE"; } ?></b> </li>
                      <li><i class="fa fa-bars"></i> Town : <b style="color:blue;"><?php echo $customer->route_id()->name ?></b> </li>
                      <li><i class="fa fa-bars"></i> Client Birthday : <b style="color:blue;"><?php echo $customer->birthday ?></b> </li>
                      <li><i class="fa fa-bars"></i> Allocated Rep : <b style="color:blue;"><?php
                        $user_id = $customer->allocated_rep;
                        $data = User::find_by_id($user_id);
                        echo $data->name;
                      ?></b> </li>

                    </ul>
                  </div>
                </div>


              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">

                    <li role="presentation" class="active">
                      <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Invoices</a>
                    </li>
                    <li role="presentation" class="">
                      <a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Payments</a>
                    </li>
                    <!-- <li role="presentation" class="">
                      <a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Cheques</a>
                    </li> -->

                    <li role="presentation" class="">
                      <a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Customer Documents</a>
                    </li>

                  </ul>
                  <div id="myTabContent" class="tab-content">

                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content2" aria-labelledby="profile-tab">
                      <div class="container-fluid">
                        <a href="customer_invoice_detail.php?id=<?php echo $id; ?>" target="_blank" style="font-weight:800;" class="btn btn-primary"> VIEW INVOICE DETAILS </a>

                        <hr/>


                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                      <div class="container-fluid">
                        <a href="customer_payment_detail_new.php?id=<?php echo $id; ?>" target="_blank" style="font-weight:800;" class="btn btn-primary"> VIEW PAYMENT DETAILS </a>


                      </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                      <div class="container-fluid">
                        <table class="dt table table-striped dt-button-collection table-condensed"  width="100%">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Bank</th>
                              <th>Cheque No</th>
                              <th>Amount</th>
                              <th>Date</th>
                              <th>Cheque Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            // cheque body start

                            // cheque body ends
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>


                    <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                      <div class="container-fluid">

                        <div class="col-sm-4">
                          <label><b>Business Registration No Document :</b></label>
                          <img src="uploads/customers/<?php echo $customer->code_image; ?>" style='width: 100%;'>
                        </div>
                        <div class="col-sm-4">
                          <label><b>Stock Insurance Cover Document :</b></label>
                          <img src="uploads/customers/<?php echo $customer->stock_insurance_image; ?>" style='width: 100%;'>
                        </div>
                        <div class="col-sm-4">
                          <label><b>Value Of Bank Gurantee Document :</b></label>
                          <img src="uploads/customers/<?php echo $customer->bank_gurantee_image; ?>" style='width: 100%;'>
                        </div>

                        <div class="col-sm-4">
                          <label><b>Propriter's ID Copy :</b></label>
                          <img src="uploads/customers/<?php echo $customer->id_image; ?>" style='width: 100%;'>
                        </div>


                      </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->
  <?php include './common/bottom_content.php'; ?><!-- bottom content -->
  <script>

  $(document).ready(function () {
    $('.dt').DataTable();
  });
  $(document).ready(function () {
    $('.dt').DataTable();
  });
  $(document).ready(function () {
    $('.dt').DataTable();
  });

  if ($('#graph_bar1').length) {
    Morris.Bar({
      element: 'graph_bar1',
      data: [
        {device: 'iPhone 4', geekbench: 380},
        {device: 'iPhone 4S', geekbench: 655},
        {device: 'iPhone 3GS', geekbench: 275},
        {device: 'iPhone 5', geekbench: 1571},
        {device: 'iPhone 5S', geekbench: 655},
        {device: 'iPhone 6', geekbench: 2154},
        {device: 'iPhone 6 Plus', geekbench: 1144},
        {device: 'iPhone 6S', geekbench: 2371},
        {device: 'iPhone 6S Plus', geekbench: 1471},
        {device: 'Other', geekbench: 1371}
      ],
      xkey: 'device',
      ykeys: ['geekbench'],
      labels: ['Geekbench'],
      barRatio: 0.4,
      barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
      xLabelAngle: 35,
      hideHover: 'auto',
      resize: true
    });

    if ($('#graph_line1').length) {

      Morris.Line({
        element: 'graph_line1',
        xkey: 'year',
        ykeys: ['value'],
        labels: ['Value'],
        hideHover: 'auto',
        lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        data: [
          {year: '2012', value: 20},
          {year: '2013', value: 10},
          {year: '2014', value: 5},
          {year: '2015', value: 5},
          {year: '2016', value: 20}
        ],
        resize: true
      });

      $MENU_TOGGLE.on('click', function () {
        $(window).resize();
      });

    }
  }
</script>

<?php
require_once './../util/initialize.php';

//if (!(isset($_POST["id"]) && $category = Category::find_by_id($_POST["id"]))) {
//    $category = new Category();
//}

if (isset($_GET["id"])) {
  $id= Functions::custom_crypt($_GET["id"], 'd');
  if($category = Category::find_by_id($id)){

  }else{
    Session::set_error("Entry not available...");
    $category = new Category();
  }
}else{
  $category = new Category();
}

include 'common/upper_content.php';
?>

<!--page content-->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Category</h3>
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <?php Functions::output_result(); ?>

    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 id="title">Salary Payments</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="proccess/salary_payment_process.php" method="post">

              <div class="form-group">
                <label for="pwd">Employee Name:</label>
                <select class="form-control" name="emp_id" autofocus required>
                  <?php

                  foreach(User::find_all() as $userdata){
                    echo "<option value='".$userdata->id."'>".$userdata->name."</option>";
                  }

                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="email">Salay Type:</label>
                <select class="form-control" name="salary_type" required>
                  <option value="Salary Payment">Salary Payment</option>
                  <option value="Salary Advance">Salary Advance</option>
                </select>
              </div>

              <div class="form-group">
                <label for="pwd">Amount:</label>
                <input type="text" class="form-control" name="amount" required>
              </div>

              <div class="form-group">
                <label for="pwd">Reason:</label>
                <input type="text" class="form-control" name="description">
              </div>

              <div class="form-group">
                <label for="pwd">Salary Date:</label>
                <input type="text" class="form-control" placeholder="Date" name="salary_date" id="dtpChequeDate" value="<?php echo date("Y-m-d"); ?>" required>
              </div>



              <button type="submit" name="save" class="btn btn-primary btn-block">SAVE</button>
            </form>

          </div>
        </div>
      </div>

      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 id="title">Salary Payment Manegement</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <table id="tblMain" class="table table-striped">
              <thead>
                <tr>
                  <th>Salary Date</th>
                  <th>Employee Name</th>
                  <th>Amount</th>
                  <th>Reason</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach(SalaryPayment::find_all_desc() as $salarypaymentdata){
                  echo "<tr>";
                  echo "<td>".$salarypaymentdata->salary_date."</td>";
                  echo "<td>".$salarypaymentdata->emp_id()->name."</td>";
                  echo "<td>".number_format($salarypaymentdata->amount,2)."</td>";
                  echo "<td>".$salarypaymentdata->description."</td>";


                  echo '<td><a href="proccess/salary_payment_process.php?del='.Functions::custom_crypt($salarypaymentdata->id).'" class="btn btn-danger btn-xs" role="button">Delete</a></td>';
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!--/page content-->
<?php include 'common/bottom_content.php'; ?>

<script>

$(function () {
  $("#dtpChequeDate").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd'
  });
});

$(document).ready(function () {
  $('#tblMain').DataTable({
    "paging": false,
    // "ordering": false,
    "order": [[ 0, 'desc' ]],
    "info": false
  });
});

</script>

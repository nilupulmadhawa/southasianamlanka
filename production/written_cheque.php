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
            <h2 id="title">Written Cheque</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="proccess/written_cheque_process.php" method="post">

              <div class="form-group">
                <label for="email">Cheque Number:</label>
                <input type="text" class="form-control" name="cheque_number" required >
              </div>

              <div class="form-group">
                <label for="pwd">Amount:</label>
                <input type="text" class="form-control" name="amount" required>
              </div>

              <div class="form-group">
                <label for="pwd">Bank Name:</label>
                <select class="form-control" name="bank" required>
                  <?php

                  foreach(Bank::find_all() as $banks){
                    echo "<option value='".$banks->name."'>".$banks->name."</option>";
                  }

                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="pwd">Cheque Date:</label>
                <input type="text" class="form-control" placeholder="Date" name="c_date" id="dtpChequeDate" required>
              </div>

              <button type="submit" name="save" class="btn btn-primary btn-block">SAVE</button>
            </form>

          </div>
        </div>
      </div>

      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 id="title">Written Manegement</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <table id="tblMain" class="table table-striped">
              <thead>
                <tr>
                  <th>Cheque Date</th>
                  <th>Cheque Number</th>
                  <th>Amount</th>
                  <th>Bank</th>
                  <th>Enterd At</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach(WrittenCheque::find_all_desc() as $chequedata){
                  echo "<tr>";
                  echo "<td>".$chequedata->cheque_date."</td>";
                  echo "<td>".$chequedata->cheque_number."</td>";
                  echo "<td>".$chequedata->amount."</td>";
                  echo "<td>".$chequedata->bank_name."</td>";
                  echo "<td>".$chequedata->feed_date."</td>";
                  echo '<td><a href="proccess/written_cheque_process.php?del='.Functions::custom_crypt($chequedata->id).'" class="btn btn-danger btn-xs" role="button">Delete</a></td>';
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

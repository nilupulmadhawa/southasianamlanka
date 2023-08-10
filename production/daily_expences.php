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
            <h2 id="title">Daily Expences</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form action="proccess/daily_expence_process.php" method="post">

              <div class="form-group">
                <label for="pwd">Expence Category:</label>
                <select class="form-control" name="expence_cat" required>
                  <?php

                  foreach(ExpenceCat::find_all() as $expencecat){
                    echo "<option value='".$expencecat->id."'>".$expencecat->cat_name."</option>";
                  }

                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="pwd">Amount:</label>
                <input type="text" class="form-control" name="amount" required>
              </div>

              <div class="form-group">
                <label for="pwd">Expence Date:</label>
                <input type="text" class="form-control" placeholder="Date" value="<?php echo date("Y-m-d"); ?>" name="exp_date" id="dtpChequeDate" required>
              </div>

              <div class="form-group">
                <label for="pwd">Special Note:</label>
                <textarea class="form-control" name="Note"></textarea>
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
                  <th>Expence Date</th>
                  <th>Expence Cat</th>
                  <th>Amount</th>
                  <th>Expence Note</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach(DailyExpences::find_all_desc() as $expencedata){
                  echo "<tr>";
                  echo "<td>".$expencedata->exp_date."</td>";
                  echo "<td>".$expencedata->expence_cat()->cat_name."</td>";
                  echo "<td>".$expencedata->amount."</td>";
                  echo "<td>".$expencedata->Note."</td>";
                  echo '<td><a href="proccess/daily_expence_process.php?del='.Functions::custom_crypt($expencedata->id).'" class="btn btn-danger btn-xs" role="button">Delete</a></td>';
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

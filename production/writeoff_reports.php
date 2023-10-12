<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Write Off Invoice Detailed Report</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <?php Functions::output_result(); ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <form class="form-inline" action="customer_wise_writeoff_reports_print.php" method="get" target="_blank">

                        <div class="form-group">
                            <label for="email">Customer Name:</label>
                            <select class="form-control" name="cus">
                                <option value='0'>All</option>
                                <?php
                                foreach (Customer::find_all() as $data) {
                                    echo "<option value='" . $data->id . "'>" . $data->name . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">PRINT</button>
                    </form>
                    <div class="x_title">

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Invoice</th>
                                    <th style='text-align:right;'>Amount</th>
                                    <th style='text-align:center;'>Writeoff Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach (WriteOff::find_all() as $write_off_data) {
                                ?>
                                    <tr>
                                        <td class="col-md-1"><?php echo $write_off_data->invoice_id()->customer_id()->name  ?></td>
                                        <td class="col-md-1"><?php echo $write_off_data->invoice_id()->code ?></td>
                                        <td class="col-md-1"><?php echo $write_off_data->amount ?></td>
                                        <td class="col-md-1"><?php echo $write_off_data->write_off_date ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="x_panel">

                </div>
            </div>
        </div>
    </div>
</div>

<!--/page content-->
<?php include './common/bottom_content.php'; ?>

<script>
    window.onfocus = function() {
        //        location.reload();
    };
</script>
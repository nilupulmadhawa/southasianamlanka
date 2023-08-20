<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content-->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 style="font-weight:800;">Invoice Write-Off Management</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
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
                                    echo "<tr>";
                                    echo "<td>" . $write_off_data->invoice_id()->customer_id()->name . "</td>";
                                    echo "<td>" . $write_off_data->invoice_id()->code . "</td>";
                                    echo "<td style='text-align:right;'>" . $write_off_data->amount . "</td>";
                                    echo "<td style='text-align:center;'>" . $write_off_data->write_off_date . "</td>";
                                    echo "<tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="x_panel">
                    <div onclick="window.location.href:''" class="x_content">
                        <?php
                        // echo $pagination->get_pagination_links_html1("cheque_management.php");
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php include 'common/bottom_content.php'; ?>

<script>

</script>
<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Production Management</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <?php Functions::output_result(); ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="production.php" target="_blank"><button id="btnNew" type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i> Add New</button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Production Date</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Production Status</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $total_records = Production::row_count();
                                $pagination = new Pagination($total_records);
                                $objects = Production::find_all_by_limit_offset($pagination->records_per_page, $pagination->offset());

                                foreach ($objects as $production) {
                                    ?>
                                    <tr>
                                        <td><?php echo $production->date ?></td>
                                        <td><?php echo $production->code ?></td>
                                        <td><?php echo $production->description ?></td>
                                        <td><?php echo $production->production_status_id()->name ?></td>

                                        <td>
                                            <?php
                                            if ($production->production_status_id == 1) {
                                                ?>
                                                <a href="production_grn.php?production_id=<?php echo Functions::custom_crypt($production->id); ?>">
                                                    <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-edit"></i> Finalize</button>
                                                </a>
                                                <button id="<?php echo $production->id; ?>" onclick="cancel_production(this)" type="button" name="cancel" class="btn btn-danger btn-xs btnCancel" ><i class="fa fa-close"></i> Cancel</button>
                                                <?php
                                            } else if ($production->production_status_id == 2) {
                                                ?>
                                                <a href="production_preview.php?production_id_finalize=<?php echo Functions::custom_crypt($production->id); ?>">
                                                    <button class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-new-window"></i> View</button>
                                                </a>
                                                <?php
                                            }
                                            ?>

                                        </td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="x_panel">
                    <div onclick="window.location.href:''" class="x_content">
                        <?php
                        echo $pagination->get_pagination_links_html1("production_management.php");
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
    window.onfocus = function () {
        location.reload();
    };

    function submit(element) {
        var result = false;
        $.ajax({
            type: 'POST',
            url: "proccess/production_management_proccess.php",
            data: {cancel_production: true, production_id: element.id},
            dataType: 'json',
            async: false,
            success: function (data) {
                result = data;
            }
        });
        return result;
    }

    function cancel_production(element) {
        $.confirm({
            title: 'Cancel Production ?',
            content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Enter login password to cancel Production</label>' +
                    '<input type="password" placeholder="Password" class="name form-control" required />' +
                    '</div>' +
                    '</form>',
            buttons: {
                formSubmit: {
                    text: 'Cancel Production',
                    btnClass: 'btn-red',
                    action: function () {
                        var password = this.$content.find('.name').val();
                        if (authenticate(password)) {
                            var result = submit(element);
                            if (result) {
                                var tr = $(element).closest('tr');
                                $(tr).find('td:eq(3)').text("Cancelled");
                                $(tr).find('td:eq(4)').empty();
                                
                                $.confirm({
                                    title: 'Successfully saved the changes!',
                                    content: '',
                                    type: 'green',
                                    typeAnimated: true,
                                    buttons: {
                                        close: function () {
                                        }
                                    }
                                });
                            } else {
                                $.confirm({
                                    title: 'Encountered an error!',
                                    content: 'Failed to save the details',
                                    type: 'red',
                                    typeAnimated: true,
                                    buttons: {
                                        close: function () {
                                        }
                                    }
                                });
                            }
                        } else {
                            $.confirm({
                                title: 'Password is incorrect!',
                                content: 'Try again..',
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    close: function () {
                                    }
                                }
                            });
                        }
                    }
                },
                cancel: function () {
                    //close
                }
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }


    function authenticate(password) {
        var result;
        $.ajax({
            type: 'POST',
            url: "proccess/production_management_proccess.php",
            data: {authenticate: true, password: password},
            dataType: 'json',
            async: false,
            success: function (data) {
                result = data;
            }
        });
        return result;
    }
</script>


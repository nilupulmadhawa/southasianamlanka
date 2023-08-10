<?php
require_once './../util/initialize.php';
include 'common/upper_content.php';
?>

<!--page content--> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Sales Achievements By Sales Rep</h3>
            </div>

            <div class="title_right">

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="row" id="divInvoice">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 id="title">Select Year & Month</h2>
                            <button type="button" id="btn_print" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-print"></i>  Print</button>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="container-fluid divBackTopTable ">
                                <div class="form-group col-md-5 col-sm-5 col-xs-5">
                                    <label>Year</label>
                                    <select class="form-control" id="cmbYear" name="cmbYear"  <?php echo (empty($target->id)) ? '' : 'disabled'; ?>>
                                        <option  selected="" value="0">Select Year</option>
                                        <?php
                                            $already_selected_value = 2017;
                                            $earliest_year = 2030;
                                        if(empty($target->id)){
                                           foreach (range(date('Y'), $earliest_year) as $x) {
                                              echo '<option value="'.$x.'">'.$x.'</option>';
                                            }                  
                                        }else{
                                        ?>
                                        <option selected="" value="<?php echo $target->year; ?>"><?php echo $target->year; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-5 col-sm-5 col-xs-5">
                                    <label>Month</label>
                                    <select class="form-control" id="cmbMonth" name="cmbMonth"  <?php echo (empty($target->id)) ? '' : 'disabled'; ?>>
                                       <option disabled="" selected="" value="0">Select Month</option>
                                         <?php
                                        foreach (TargetMonth::find_all() as $month) {
                                            if ($month->id == $target->target_month_id) {
                                                ?>
                                                <option selected="" value="<?php echo $month->id; ?>"><?php echo $month->name; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $month->id; ?>"><?php echo $month->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-2 col-sm-2 col-xs-2 ">
                                    <label>&nbsp;</label>
                                    <div class="ui-widget">
                                        <button id="btnShow" name="btnShow" class="btn btn-default">Show <i class="glyphicon glyphicon-arrow-down"></i></button>
                                    </div>
                                </div>

                            </div>
                            <br/>

                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" id="print_div">
                    <div class="x_panel">
                        <div class="x_title" style="background-color: gray;color:white;border-radius: 5px 5px 0px 0px;"><h3><center>Target Achievement Report</center></h3></div>
                        <div class="x_content">
                            <div class="table-responsive">
                               
                                <table id="sata_table" class="table table-striped " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sales Rep</th>
                                            <th>Target</th>
                                            <th>Invoice Total</th>
                                            <th>Achieved %</th>
                                            <th>Cash Sales</th>
                                            <th>Credit Sales</th>
                                            <th>Comp. Cheqs</th>
                                            <th>Pend. Cheqs</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
 /page content 

<?php include 'common/bottom_content.php'; ?>

<script>
   
    $('#btnShow').click(function () {
        
        submitData();
    });

    function submitData() {
        var year = $("#cmbYear").val();
        var month = $("#cmbMonth").val();
        
        $.ajax({
            type: 'POST',
            url: "proccess/target_report_process.php",
            data: {target_report: true, year: year, month: month},
            dataType: 'json',
            async: false,
            success: function (data) {
               $('#table_body').empty();
//               var res = JSON.stringify(data);
//               alert(res);
                   var trHTML = "";
                   
                    $.each(data, function (index, value) {
                        
//                        var achievement  = ((value["monthly_target"])/value["payments"][achieved]))*100);
//                        alert(achievement);
                        trHTML += "<tr ><td>" + value["username"] +"</td><td>" + value["monthly_target"] + "</td><td>" + value["payments"]["achieved"] + "</td><td>" + value["persentage"] +"</td><td>" + value["payments"]["cash"] + "</td><td>" + value["payments"]["all_cheques"] + "</td><td>" + value["payments"]["completed_cheques"] + "</td><td>" + value["payments"]["pending_cheques"] + "</td></tr>";

                    });
                    $('#table_body').append(trHTML);
               
                
            },
            error: function (xhr){
                alert(xhr.responseText);
            }
        });
    }
    
    //print_div
    
     $('#btn_print').click(function (){
              PrintDiv();
        });
        
        
        
        function PrintDiv() {    
            var divToPrint = document.getElementById('print_div');
            var popupWin = window.open('', '_blank', 'width=800,height=500');
            popupWin.document.open();
            popupWin.document.write('<html><head><link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
        }
</script>





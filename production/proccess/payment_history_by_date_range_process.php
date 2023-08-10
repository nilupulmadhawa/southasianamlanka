<?php

require_once './../../util/initialize.php';

if (!empty($_GET['filter'])) {
    $from = trim($_GET['from']);
    $to = trim($_GET['to']);

    $payments = Payment::find_by_sql("SELECT * FROM payment WHERE date_time BETWEEN '$from' AND '$to' ");
    $output = '';
    $output .= '<br/><h4 id="title" style="color:#737373;">Payment Details</h4><br/>';
    $output .= '<table id="tbl" class="table table-striped dt-responsive nowrap">
                                <thead>
                                    <tr style="background-color:gray;color:white;">
                                        <th>Payment No</th>
                                        <th>Invoice No</th>
                                        <th>Date/Time</th>
                                        <th>Pay. Method</th>
                                        <th>Pay. Status</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody >';
    $amount_total = 0.00;
    $amount_balance = 0.00;

    foreach ($payments as $payinv) {
        $payment_invoice=PaymentInvoice::find_by_payment_id($payinv->id);

        $amount_total += $payinv->amount;
        $output .= '<tr style="background-color:whitesmoke;">'
                . '<td> <a href="payment_prev.php?payment_id='.$payinv->id.'" target="_blank" >  ' . sprintf('%05d', $payinv->code) . '</a></td>
                   <td>' . $payment_invoice->invoice_id()->code . '</td>
                   <td>' . $payinv->date_time . '</td>
                   <td>' . $payinv->payment_method_id()->name . '</td>
                   <td>' . $payinv->payment_status_id()->name . '</td>
                   <td>' . $payinv->amount . '</td>
                   </tr>';

    }
    $output .= '<tr style="background-color:gray;color:white;" >'
            . '<td>' . "" . '</td>
                <td>' . "" . '</td>
                <td>' . "" . '</td>
                <td>' . "" . '</td>
                <td>' . "" . '</td>
                <td>' . "Total Paid Amount(LKR)" . '</td>
                </tr><tr style="border-bottom:1px solid gray;">'
            . '<td>' . "" . '</td>'
            . '<td>' . "" . '</td>'
            . '<td>' . "" . '</td>'
            . '<td>' . "" . '</td>'
            . '<td>' . "" . '</td>'
            . '<td>' . number_format($amount_total, 2) . '</td>'
            . '</tr>';
    $output .= '</tbody></table><br/>';
//echo $from." / ".$to;
    echo $output;
} else {
    echo "There is no payment history for this Date Range";
}
?>

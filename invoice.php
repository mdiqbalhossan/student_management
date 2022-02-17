<?php

use Dompdf\Dompdf;
require_once 'lib/vendor/autoload.php';
require_once 'lib/Auth.php';

$auth =new Auth();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $value = $auth->fetchFessById($id);
    if($value){
        $html = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Invoice</title>
            <style type="text/css">
                h2{
                    font-family: Verdana, Ceneva, Tahoma, sans-serif;
                    text-align: center;
                }
                table{
                    font-family: Arial, Helvetica, sans-serif;
                    border-collapse: collapse;
                    width: 100%;
                }
                td,th{
                    border: 1px solid #444;
                    padding: 8px;
                    text-align: left;
                }
                .my-table{
                    text-align: right;
                }
                #sign{
                    padding-top: 50px;
                    text-align: right;
                }
            </style>
        </head>
        <body>
            <h2>Invoice</h2>
            <strong style="text-align:left; padding: 0 10; margin:0 auto;">Date: '.date('d M Y').'</strong>
            <strong style="text-align:right; padding: 0 10" margin:0 auto;>Invoice Number: '.random_int(1000,100000).'</strong>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Paid Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Date</th>
                        <th>Tr. ID</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';
        
            $html .= '<tr>
                        <td>'.$value['title'].'</td>
                        <td>'.number_format($value['paid_amount'],2).'</td>
                        <td>'.$value['payment_method'].'</td>
                        <td>'.$value['payment_date'].'</td>
                        <td>'.$value['transaction_id'].'</td>
                        <td>'.$value['status'].'</td>
                    </tr>';
        
        $html .= '</tbody>
                <tr>
                    <th colspan="6" id="sign">Signiture</th>
                </tr>
            </table>
        </body>
        </html>';
        
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html);
        $dompdf->setPaper("A4","portrait");
        $dompdf->render();
        $dompdf->stream('invoice-'.random_int(10,1000).'.pdf');
        
    }else{
        header('location: fees.php');
        exit();
    }
}else{
    header('location: fees.php');
    exit();
}

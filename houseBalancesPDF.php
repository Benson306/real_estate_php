<?php
session_start();
require('connection.php'); 
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \mPDF();


$listID = $_SESSION['listID'];

$sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
            $run3 = mysqli_query($conn, $sql3);
            $rows3= mysqli_fetch_assoc($run3);
            $name = $rows3['name'];
            $shortcode = $rows3['shortCode'];


        $sql4="SELECT
        *,SUM(rent) AS allRent, SUM(water) AS allWater, SUM(garbage) as allGarbage 
        FROM
        billing 
        JOIN(
                SELECT
                    *, SUM(TransAmount) as Amt
                FROM
                    mpesa
                WHERE BusinessShortCode = '$shortcode' 
                GROUP BY BillRefNumber
            ) AS payment
        ON billing.house=payment.BillRefNumber
        WHERE apartment = '$name' 
        GROUP BY house";

            $run4 = mysqli_query($conn,$sql4);
            $date = date('d/m/y h:i:s');
            $data = "";
            while($rows4=mysqli_fetch_assoc($run4)){

                $total = $rows4['allRent']+$rows4['allWater']+$rows4['allGarbage'];
                $balance = $rows4['Amt']-$total;

                if($balance>0){
                    $data .= "";
                }else if($balance<0){
                    $data.= "
                    <tr>
                        <td>$rows4[house]</td>
                        <td>$rows4[phone]</td>
                        <td>$rows4[allRent]</td>
                        <td>$rows4[allWater]</td>
                        <td>$rows4[allGarbage]</td>
                        <td>$total</td>
                        <td>$rows4[Amt]</td>
                        <td>$balance</td>
                    </tr>
                
                
                ";
                }else{
                    $data .= "";
                }

                
            };
        


$footer = "
<div class='footer'>
<hr>
    Designed By: KIMTech Solutions ~ Tel: 0707357072 ~ Email: bnkimtai@gmail.com
</div>
";


$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML("
                <style>

                    td{
                        color: black;
                        padding-left: 15px;
                        border-bottom: 1px solid #ddd;
                        width:20%
                    }
                    tr:nth-child(even) {background-color: #f2f2f2;}
                    </style>

                    <link rel='stylesheet' media='print' href='style8.css' />
                    <div class='pdftitle'>
                    <h2 style='text-transform: uppercase;'><u>$name Apartment</u></h2>
                    <h3><u>List Of Houses with Balances:</u></h3>
                </div>
                <br>
                <div style='margin-left: 60%;'><b>Generated on: </b>$date</div>
                <HR>
                <table>
                    <tr>
                        <td><b>House Number</b></td>
                        <td><b>Tenant Phone Number</b></td>
                        <td><b>Total Rent Billed</b></td>
                        <td><b>Total Water Billed</b></td>
                        <td><b>Total Garbage Billed</b></td>
                        <td><b>Total Billed</b></td>
                        <td><b>Total Paid</b></td>
                        <td><b>Balance</b></td>
                    </tr>
                    $data
                </table>
                <br>
                --------------------------------------------------------------------------END-----------------------------------------------------------------------
                <br>
                <br>
");

$mpdf->Output();


<?php
session_start();
require('connection.php'); 
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \mPDF();


$listID = $_SESSION['listID'];
$monthID =$_SESSION['monthID'];

$sql3 = "SELECT * FROM property WHERE property_id = '$listID'";
            $run3 = mysqli_query($conn, $sql3);
            $rows3= mysqli_fetch_assoc($run3);
            $name = $rows3['name'];
            $shortcode = $rows3['shortCode'];


        $sql4="SELECT *,SUM(rent) AS allRent, SUM(water) AS allWater, SUM(garbage) as allGarbage FROM billing WHERE apartment = '$name' ";

        $sql5 = "SELECT *, SUM(TransAmount) as Amt FROM mpesa WHERE BusinessShortCode = '$shortcode'";        
        

        $run4 = mysqli_query($conn,$sql4);
        $rows4=mysqli_fetch_assoc($run4);

        $run5 = mysqli_query($conn,$sql5);
        $rows5=mysqli_fetch_assoc($run5);


        $date = date('d/m/y h:i:s');

        $total = $rows4['allRent']+$rows4['allWater']+$rows4['allGarbage'];

        $balance = $rows5['Amt']-$total;

                if($balance>0){
                    $comment = "(Tenants have paid an Excess)";
                }else if($balance<0){
                    $comment = "(Tenants Have a Balance Totalling to this Amount)";
                }else{
                    $comment = "(Tenants have Cleared Completely)";
                }

                $data.= "
                <div class='pdftitle'>
                    <h3 style='text-transform: uppercase;'><u>$rows4[apartment] APARTMENT REPORT</u></h3>
                </div>
                <div style='margin-left: 60%;'><b>Generated on: </b>$date</div>
                <HR>

                <table>
                    <tr>
                        <td><b>Apartment:</b></td>
                        <td>$rows4[apartment] Apartment</td>
                    </tr>
                    <tr>
                        <td><b>Total Rent Billed:</b></td>
                        <td>$rows4[allRent]</td>
                    </tr>
                    <tr>
                        <td><b>Total Water Billed:</b></td>
                        <td>$rows4[allWater]</td>
                    </tr>
                    <tr>
                        <td><b>Total Garbage Billed:</b></td>
                        <td>$rows4[allGarbage]</td>
                    </tr>
                    <tr>
                        <td><b>Overall Total Billed:</b></td>
                        <td>$total</td>
                    </tr>
                    <tr>
                        <td><b>Total Paid:</b></td>
                        <td>$rows5[Amt]</td>
                    </tr>
                    <tr>
                        <td><b>Balance:</b></td>
                        <td>$balance $comment</td>
                    </tr>
                </table>
                --------------------------------------------------------------------------END-----------------------------------------------------------------------
                <br><br>
                
                ";

        


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
                    
$data");

$mpdf->Output();


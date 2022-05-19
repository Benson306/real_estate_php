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
        $shortCode = $rows3['shortCode'];

        $house = $_SESSION['house'];

        $phone = $_SESSION['phone'];

        $billed = $_SESSION['billed'];
        $paid = $_SESSION['paid'];
        $balance = $_SESSION['balance'];



        $sql1 = "SELECT * FROM billing WHERE apartment = '$name' AND house = '$house' ORDER BY time ";
$run1 = mysqli_query($conn, $sql1);

while($rows1=mysqli_fetch_assoc($run1)){
    $data .= '<tr>'
		  .'<td>'.$rows1['month'].'</td>'
		  .'<td>'.$rows1['rent'].'</td>'
          .'<td>'.$rows1['water'].'</td>'
          .'<td>'.$rows1['garbage'].'</td>'
		  .'<td>'.$rows1['time'].'</td></tr>';
}


$sql2 = "SELECT * FROM mpesa WHERE BusinessShortCode = '$shortCode' AND BillRefNumber = '$house' ORDER BY TransTime ";
$run2 = mysqli_query($conn, $sql2);

while($rows2=mysqli_fetch_assoc($run2)){
    $no = $rows2['MSISDN'];
  
    // Or we can write ltrim($str, $str[0]);
    $no = ltrim($no, '254');

    $time = $rows2['TransTime'];
    $time= (string)$time;
    $full = $time[0].$time[1].$time[2].$time[3]."-".$time[4].$time[5]."-".$time[6].$time[7]." ".$time[8].$time[9].":".$time[10].$time[11].":".$time[12].$time[13];

    $data1 .= '<tr>'
		  .'<td>'.$full.'</td>'
		  .'<td>'.$rows2['TransID'].'</td>'
          .'<td>'.$rows2['TransAmount'].'</td>'
          .'<td>0'.$no.'</td>'
		  .'<td>'.$rows2['FirstName']." ".$rows2['MiddleName']." ".$rows2['LastName'].'</td></tr>';
}

$date = date('d/m/y h:i:s');
$footer = "
<div class='footer'>
<hr>
    Designed By: KIMTech Solutions ~ Tel: 0707357072 ~ Email: bnkimtai@gmail.com
</div>
";
if($balance>0){
    $comment = "(You have paid Excess)";
}else if($balance<0){
    $comment = "(Clear Outstanding Balance)";
}else{
    $comment = "(You have Cleared)";
}

//$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML("
<style>

td{
    color: black;
    padding: 2px;
    border-bottom: 1px solid #ddd;
  }
  tr:nth-child(even) {background-color: #c3d4cd;}
</style>

<link rel='stylesheet' media='print' href='style8.css' />
<div class='pdftitle'>
    <h2><u>REAL ESTATE MANAGEMENT SYSTEM</u></h2>
    <h3><center>Rent Billing and Payement Statement</center></h3>
</div>
<HR>
<table style='color: black; margin-left:2%; width:60%;'>
    <tr>
        <td><u>Apartment:</u></td>
        <td>$name</td>
    </tr>
    <tr>
        <td><u>House Number:</u></th>
        <td>$house</th>   
    </tr>
    <tr>
        <td><u>Tenant Phone Number:</u></td>
        <td>$phone</td>
    </tr>
    <tr>
        <td><u>Time/Date Processing:</u></td>
        <td>$date</td>
    </tr>
    
</table>
<HR>
<br>

<div class='pdftabs'>
    <div class='pdftabs1'>
        <h3>BILLINGS</h3>
        <br>
        <table style='width: 100%;'>
            <tr>
                <td>Month</td>
                <hr>
                <td>Rent</td>
                <hr>
                <td>Water</td>
                <hr>
                <td>Garbage</td>
                <hr>
                <td>Date and Time of Billing</td>
                <hr>
            </tr>
            $data
        </table>
        <br>
        <div style='background-color: maroon; padding: 5px; color: white;'>Total Billed: $billed</div>
    </div>
    <br>
    <div class='pdftabs2'>
        <h3>PAYMENTS</h3>
        <br>
        <table style='width: 100%;'>
            <tr>
                <td>Date/Time of Payement</td>
                <hr>
                <td>Transaction ID</td>
                <hr>
                <td>Amount</td>
                <hr>
                <td>Number Paying:</td>
                <hr>
                <td>Name</td>
                <hr>
            </tr>
            $data1
        </table>
        <br>
        <div style='background-color: maroon; padding: 5px; color: white;'>Total Paid: $paid</div>
    </div>

    <br>
    <br>
        <div style='background-color: maroon; padding: 5px; color: cornsilk;'>Outstanding Balance: $balance $comment</div>

       
</div>
");

$mpdf->Output();


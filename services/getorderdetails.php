<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$status="";
$dateofvisit="";
$packagename="";
$quantity="";
$adultstickets="";
$childqty="";
$childtickets="";
$kidsmealqty="";
$kidmealsprice="";
$servicetax="";
$taxes="";
$total="";

include 'connectDB.php';
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
	$tktno = $request->ticketnumber;
    //echo "Server returns: " . $tktno;
    
    
    $sql = "SELECT * FROM tblbookings b left join tblpayments p on p.ticketnumber=b.ticketnumber left join tblpackages pk on pk.packageid=b.packageid where b.ticketnumber='$tktno' and b.booking_status='booked' and b.payment_status='paid'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
           
           $dateofvisit=$row['dateofvisit'];
           $packagename=$row['packagename'];
           $quantity = $row['numberofadults'];
           $childqty = $row['numberofchildren'];
           $adultpriceperticket = $row['adultpriceperticket'];
           $childpriceperticket = $row['childpriceperticket'];
           $adultstickets = $quantity*$adultpriceperticket;
           $childtickets = $childqty*$childpriceperticket;
           $kidsmealqty = $row['noofkidsmeal'];
           $kidsmealprice = $row['kidsmealprice'];
           $kidmealsprice = $kidsmealqty*$kidsmealprice;
           $packageid = $row['packageid'];
           $gettax = "SELECT * FROM tblpackages where packageid='$packageid'";
           $result1 = mysqli_query($conn, $gettax);
            if (mysqli_num_rows($result1) > 0) {
                while($rows = mysqli_fetch_assoc($result1)) {
                   $servicetax = $row['servicetax'];
                }
            }
            $subtotal = $adultstickets+$childtickets+$kidmealsprice;
            $calculatedInternetCharges = $row['internetcharges'];
            $calculatedServiceTax = $row['servicetax'];
            $calculatedSwachhBharath = $row['swachhbharath'];
            $calculatedKkCess = $row['krishkalyancess'];
            $taxes = ceil($calculatedInternetCharges+$calculatedServiceTax+$calculatedSwachhBharath+$calculatedKkCess);

            $total = ceil($subtotal+$calculatedServiceTax+$calculatedInternetCharges+$calculatedSwachhBharath+$calculatedKkCess);

        }
        $status=true;
        //echo "Server returns: " . $username.",".$useremail.",".$usermobile; 
    } else {
        $status=false;
    }
    
}else {
	$status=false;
}

$statusArray = array(
'statusone'=>$status,
'ticketnumber'=>$tktno,
'dateofvisit'=>$dateofvisit,
'quantity'=>$quantity,
'childqty'=>$childqty,
'childtickets'=>$childtickets,
'adultstickets'=>$adultstickets,
'kidsmealqty'=>$kidsmealqty,
'kidmealsprice'=>$kidmealsprice,
'packagename'=>$packagename,
'taxes'=>$taxes,
'total'=>$total
    );

echo json_encode($statusArray,true);

?>

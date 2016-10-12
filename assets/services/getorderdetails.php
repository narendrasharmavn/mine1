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
    
    
    $sql = "select p.ticketnumber as ticketnumber, p.adultpriceperticket as adultpriceperticket, p.childpriceperticket as childpriceperticket, p.numberofadults as quantity, p.numberofchildren as childqty, p.noofkidsmeal as noofkidsmeal, p.kidsmealprice as kidsmealprice, ROUND((p.servicetax + p.internetcharges + p.swachhbharath + p.krishkalyancess),2) as taxes, p.amount as amount, p.totalcost as totalcost, DATE_FORMAT(b.dateofvisit,'%d-%m-%Y') as dateofvisit from tblpayments p, tblbookings b where p.ticketnumber=b.ticketnumber and p.status = 'paid' and p.ticketnumber =  '$tktno'";
	//echo $sql;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
           
          $orderdetails[]=$row;
        }
        $status=true;
        //echo "Server returns: " . $username.",".$useremail.",".$usermobile; 
    } else {
        $status=false;
    }
    
}else {
	$status=false;
}

echo json_encode($orderdetails,true);

?>

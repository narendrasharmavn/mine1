<?php

$status="";
$orders=[];


include 'connectDB.php';
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
	$email = $request->email;
    //echo "Server returns: " . $email;

    $sql1 = "SELECT * FROM tblcustomers WHERE regtype='registration' AND (username='$email')";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)) {  
            $userid = $row['customer_id'];
        }
        
        //echo "Server returns: " . $userid; 
    } 
    
    $sql = "SELECT * from tblbookings b left join tblpayments pay ON b.ticketnumber=pay.ticketnumber LEFT JOIN tblpackages p ON b.packageid=p.packageid LEFT join tblcustomers c ON b.userid=c.customer_id WHERE b.userid='$userid' and b.booking_status='booked' and b.payment_status='paid' ORDER BY b.date DESC";

    //echo $sql;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

           $orders[]=utf8ize($row);

        }
        //$status=true;
        //echo "Server returns: " . $username.",".$useremail.",".$usermobile; 
//print_r($orders);
    } else {
        //$status=false;
    }
}else {
	//$status=false;
}


$statusArray = array(
'statusone'=>$status,

    );

echo json_encode($orders,true);

function utf8ize($mixed) {
if (is_array($mixed)) {
    foreach ($mixed as $key => $value) {
        $mixed[$key] = utf8ize($value);
    }
} else if (is_string ($mixed)) {
    return utf8_encode($mixed);
}
return $mixed;
}

//echo json_last_error_msg();
//print_r($eventsData);

mysqli_close($conn);

?>

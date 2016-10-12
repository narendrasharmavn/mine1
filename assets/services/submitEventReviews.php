<?php

include 'connectDB.php';
$status="";
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
        $object= $request->obj;
//print_r($request);
	$subject = $object->subject;
	$review = $object->review;
	$rating = $object->rating;
	$customerid = $object->customerid;
	$eventid = $request->eventid;
	
	//echo "Server returns: " . $username.",".$password.",".$convertedpassword; 
    
    if ($customerid!=0) {

    	$sql = "insert into eventreviews (pricereview, subject, review, customerid, reviewgivendate, resortoreventname,status) values ('$rating','$subject','$review', '$customerid', now(),'$eventid',1 ) ";

if (mysqli_query($conn, $sql)) {
    //echo "New record created successfully";
     $status=true;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    $status=false;
}
    	
    }





}

$statusArray = array(
'statusone'=>$status

    );

echo json_encode($statusArray,true);

?>

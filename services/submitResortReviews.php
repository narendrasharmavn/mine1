<?php

include 'connectDB.php';
$status="";
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
        $object= $request->obj;
//print_r($object);
	$subject = $object->subject;
	$review = $object->review;
	$rating = $object->rating;
	$customerid = $object->customerid;
	$resortid = $request->resortid;
	
	//echo "Server returns: " . $username.",".$password.",".$convertedpassword; 
    
    
    //$sql = "";
    $result = mysqli_query($conn, "insert into resortreviews (pricereview, subject, review, customerid, reviewgivendate, resortname,status) 
	values ('$rating','$subject','$review', '$customerid', now(),'$resortid',1 )");

    if (mysqli_query($conn, $sql)) {
				    $status=true;
				} else {
				     $status=false;
				    //echo "false";
				}

}

$statusArray = array(
'statusone'=>$status

    );

echo json_encode($statusArray,true);

?>

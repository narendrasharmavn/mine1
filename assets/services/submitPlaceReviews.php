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
	$resortid = $request->placeid;
	
	//echo "Server returns: " . $username.",".$password.",".$convertedpassword; 
    
    
   if ($customerid!='') {

   	$sql = "insert into placereviews (pricereview, subject, review, customerid, reviewgivendate, placeid,status) values ('$rating','$subject','$review', '$customerid', now(),'$resortid',1 )";

					if (mysqli_query($conn, $sql)) {
					    //echo "New record created successfully";
					    $status=true;
					} else {
					     $status=false;
					}
   	
   }

				


}

$statusArray = array(
'statusone'=>$status

    );

echo json_encode($statusArray,true);

?>

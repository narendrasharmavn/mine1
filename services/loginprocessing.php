<?php

$status="";
$customername="";
$mobile="";
$customerid="";
include 'connectDB.php';
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
	$username = $request->username;
	$password = $request->password;
	$convertedpassword = hash('sha512', $password);
	//echo "Server returns: " . $username.",".$password.",".$convertedpassword; 
    
    
    $sql = "SELECT * FROM tblcustomers WHERE regtype='registration' AND (username='$username' AND password='$convertedpassword')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $rows = mysqli_fetch_assoc($result);
      
      $mobile = $rows["number"];
      $customerid = $rows["customer_id"];
      $customername = $rows["name"];
      $status=true;
    } else {
        $status=false;
    }

}

$statusArray = array(
'statusone'=>$status,
'customername'=>$customername,
'mobile'=>$mobile,
'customerid'=>$customerid,
'convertedpassword'=>$convertedpassword
    );

echo json_encode($statusArray,true);

?>

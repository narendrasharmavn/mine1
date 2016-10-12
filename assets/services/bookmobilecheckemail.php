<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$status="";
include 'connectDB.php';
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
	$email = $request->email;
    $mobile = $request->phone;
	//echo "Server returns: " . $email.",".$mobile; 

    $sql = "SELECT * FROM tblcustomers WHERE regtype='registration' AND (username='$email' OR number='$mobile')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      //echo 'true';
        $status=true;
    } else {
        $status=false;
    }
}else {
	$status=false;
}

$statusArray = array(
'statusone'=>$status
    );

echo json_encode($statusArray,true);

?>

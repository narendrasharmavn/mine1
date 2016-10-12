<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$status="";
$mobile="";

include 'connectDB.php';
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
	$email = $request->email;
    $sql = "SELECT * FROM tblcustomers WHERE regtype='registration' AND (username='$email')";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $mobile = $row["number"];
      }
      $status=true;
    } else {
        $status=false;
    }

}else {
	$status=false;
}



$statusArray = array(
'statusone'=>$status,
'mobile'=>$mobile
    );

echo json_encode($statusArray,true);

?>

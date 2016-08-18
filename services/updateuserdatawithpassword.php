<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$status="";

include 'connectDB.php';
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
    $username = $request->username;
	$email = $request->email;
    $mobile = $request->mobile;
    $password = $request->password;
    $convertedpassword = hash('sha512', $password);
    //echo "Server returns: " . $username.",".$email.",".$mobile.",".$password.",".$convertedpassword; 
    
    $sql = "UPDATE tblcustomers SET name='$username', number='$mobile', password='$convertedpassword' WHERE regtype='registration' AND (username='$email')";
    if (mysqli_query($conn, $sql)) {

        $status=true;
       //echo "updated record successfully : name,email,mobile and password";
    } else {

        $status=false;
        //echo "Error updating record: " . mysqli_error($conn);
    }

}else {
	$status=false;
}





$statusArray = array(
'statusone'=>$status,

    );

echo json_encode($statusArray,true);

?>

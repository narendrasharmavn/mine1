<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$status="";
$username="";
$useremail="";
$userpassword="";
$usermobile="";
include 'connectDB.php';
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
	$email = $request->email;

    $sql = "SELECT * FROM tblcustomers WHERE regtype='registration' AND (username='$email')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            
            $username = utf8ize($row['name']);
            $useremail = utf8ize($row['username']);
            $usermobile = utf8ize($row['number']);
        }
        $status=true;
        //echo "Server returns: " . $username.",".$useremail.",".$usermobile; 
    } else {
        $status=false;
    }
}else {
	$status=false;
}


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


$statusArray = array(
'statusone'=>$status,
'username'=>$username,
'useremail'=>$useremail,
'usermobile'=>$usermobile
    );

echo json_encode($statusArray,true);

?>

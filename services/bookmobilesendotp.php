<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$status="";


include 'connectDB.php';

$postdata = file_get_contents("php://input");
if (isset($postdata)) {
    $smsurl="";
    $smsusername="";
    $smspassword="";
    $smssenderid="";
    $request = json_decode($postdata);
    $randNumber = rand(9999,99999);
    $mobile = $request->phone;
    
    $sql = "SELECT * FROM smssettings";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            
            $smsurl = utf8ize($row['url']);
            $smsusername = utf8ize($row['username']);
            $smspassword = utf8ize($row['password']);
            $smssenderid = utf8ize($row['senderid']);
        }
    } 
    //echo "Server returns: " . $mobile.",".$randNumber.",".$smsurl.",".$smsusername.",".$smspassword.",".$smssenderid; 

    // SMS REQUEST SENT START //
    
    $text1=$randNumber.' is OTP for transaction at Book4Holiday. This OTP is valid for only 10 mins. Please do not share with anyone.';
    $text=str_replace(" ","%20",$text1);
    $qry_str = $smsurl.$smsusername."&password=".$smspassword."&to=".$mobile."&from=".$smssenderid."&message=".$text;
    //echo $qry_str;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$qry_str);
    //echo $ch."<br>"; 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, '5');
    $content = trim(curl_exec($ch));
    curl_close($ch);
    $status=true;
   
    // SMS REQUEST SENT END //
    
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
'otp'=>$randNumber 
    );

echo json_encode($statusArray,true);

?>

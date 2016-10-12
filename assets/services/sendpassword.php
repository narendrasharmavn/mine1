<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$status="";
$mobile="";
$smsurl="";
$smsusername="";
$smspassword="";
$smssenderid="";
include 'connectDB.php';
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
	$email = $request->email;
  $phone = $request->phone;
  echo "Server returns: " . $email.",".$phone;   
  
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

  $resetpassword =  rand(9999,999999);
  $convertedpassword = hash('sha512', $resetpassword);

  $sql = "UPDATE tblcustomers SET password='$convertedpassword' WHERE username='$email' AND number='$phone'";

  if (mysqli_query($conn, $sql)) {
    // SMS REQUEST SENT START //
    
    $text1='Your password is: '.$resetpassword;
    $text=str_replace(" ","%20",$text1);
    $qry_str = $smsurl.$smsusername."&password=".$smspassword."&to=".$phone."&from=".$smssenderid."&message=".$text;
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
  } else {
    $status=false;
    //echo "Error updating record: " . mysqli_error($conn);
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
'password'=>$resetpassword
    );

echo json_encode($statusArray,true);

?>

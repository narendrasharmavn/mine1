<?php
include 'connectDB.php';



$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$c = $request->obj;
//print_r($request);
$name = test_input($c->name);
$email = test_input($c->email);
$mobile = test_input($c->mobile);
$last_id="";

$randNumber="";
$dt = date('Y-m-d');

if($email!='')
{
        $sql = "INSERT INTO tblcustomers (name, username, number,regtype,dateofcreation) VALUES ('$name', '$email', '$mobile','Guest','$dt')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $randNumber =  rand(99999,999999);
        	$text1= $randNumber.'  is OTP for transaction at Book4Holiday. This OTP is valid for only 10 mins. Please do not share with anyone.';
        	sendSMS($text1,$mobile,$conn);

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}


$otpdata = array(
    "otp"  => $randNumber,
    "customerid" => $last_id
    
);

echo json_encode($otpdata,true);


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function sendSMS($text1,$mobile,$conn){

	$smsurl="";
    $smsusername="";
    $smspassword="";
    $smssenderid="";

	$sql2 = "SELECT * FROM smssettings";
    $resulttt = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($resulttt) > 0) {
        // output data of each row
        while($row2 = mysqli_fetch_assoc($resulttt)) {
            
            $smsurl = utf8ize($row2['url']);
            $smsusername = utf8ize($row2['username']);
            $smspassword = utf8ize($row2['password']);
            $smssenderid = utf8ize($row2['senderid']);
        }
    } 


// SMS REQUEST SENT START //
    
    
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



mysqli_close($conn);
?>
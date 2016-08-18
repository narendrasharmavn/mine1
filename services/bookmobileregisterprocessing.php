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
		$mobile = $request->phone;
		$password = $request->password;
		$convertedpassword = hash('sha512', $password);
        $doc = date('Y-m-d h:i:s');
        //echo "Server returns: " . $username.",".$email.",".$mobile.",".$password; 

        
		if ($email != "" && $mobile!= "") {
           
			$sql = "INSERT INTO tblcustomers (name, username, password, number, dateofcreation, otp, regtype)
				VALUES ('$username', '$email', '$convertedpassword', '$mobile', '$doc', '', 'registration')";

				if (mysqli_query($conn, $sql)) {
				    $status=true;
				} else {
				     $status=false;
				    //echo "false";
				}

			//echo "Server returns: " . $username.",".$email.",".$mobile.",".$password;
		}else{
			 $status=false;
		}
		
	}
	else {
		 $status=false;
	}

?>

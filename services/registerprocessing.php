<?php

    $status="";
    $qrystr="";
    $smsurl= "";
    $smsusername="";
    $smspassword="";
    $smssenderid="";

    include 'connectDB.php';
    
    $sql = "SELECT * FROM smssettings where id='1'";
	$result = mysqli_query($conn, $sql);

    // output data of each row
    $row = mysqli_fetch_array($result);
    $smsurl= $row["url"];
    $smsusername = $row["username"];
    $smspassword = $row["password"];
    $smssenderid = $row["senderid"];



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
				    sendSMS($mobile,$smsurl,$smsusername,$smspassword,$smssenderid);
                    sendEmail($email);

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




function sendSMS($mobile,$smsurl,$smsusername,$smspassword,$smssenderid)
{
    // SMS REQUEST SENT START //
    
    $text1='Thank you for the Registration. From Book4Holiday';
    $text=str_replace(" ","%20",$text1);
    $qry_str = $smsurl.$smsusername."&password=".$smspassword."&to=".$mobile."&from=".$smssenderid."&message=".$text;
    //echo "Server returns: " .$qry_str;
    $qrystr = $qry_str;
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




function sendEmail($email)
{
	// send mail to user //

    $to=$email;
    $subject = "Registration Success";
    $headers = "MIME-Version: 1.0"."\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
    $headers .= 'From: Book4Holiday Support <info@book4holiday.com>'."\r\n";
    $message='<!doctype html>
			<html>
			<head>
			<meta charset="utf-8">

			</head>

			<body>


			    <table width="700" height="500" style="background: #006400;" align="center">
			      <tr>
			        <td>
			              <table cellpadding="0" cellspacing="0" style="width:600px;margin:0 auto;padding:0px;font-family:Arial,Helvetica,sans-serif;font-size:12px">
			<tbody>
			<tr>
			<td style="width:600px">
			<div style="width:600px;float:left">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="font-size:12px;background-color: #006400;;padding:15px 15px">
			<tbody>
			<tr>
			<td style="width:300px;padding:8px 0 0 0;text-align:left"><a href="#" style="text-decoration:none;color:#010101" target="_blank" data-saferedirecturl="#"><!--<img alt="BookMyShow" height="70" border="0" width="200" style="margin:0px auto" src="book4.png" class="CToWUd">--><h3 style="color:#FFEB3B; font-family:Arial Black; font-size:18px;">Book <span style="color:#fff;">4</span> Holiday</h3>
			</a></td>
			<td style="width:30px;padding-top:8px;text-align:left"><img alt="helpline phone" height="20" border="0" width="18" src="https://ci3.googleusercontent.com/proxy/ox1pr8SuruzQrAsTBgtdjSlHhf0BodFY1HY033BSEDpQQx41C7mSyS3nVKhXYKB2WK98ymYskV6_gH0967w5847IDkg85kno18hz0PjzvlWj2HI=s0-d-e1-ft#http://cnt.in.bookmyshow.com/webin/emailer/helpline-phone.png" class="CToWUd">
			</td>
			<td style="width:80px;text-align:left;color:#FFEB3B;padding-top:5px;line-height:14px">
			<span style="font-size:11px">Helpline:</span> <br>
			<span style="letter-spacing:1px;font-weight:bold"><a href="tel:+912261445050" style="text-decoration:none;color:#FFEB3B" target="_blank">6144 5050</a>
			</span></td>
			<td style="width:10px;text-align:left;color:gray;padding-top:10px;line-height:14px;font-size:18px">
			|</td>
			<td style="width:180px;font-size:12px;color:#FFEB3B;font-weight:bold;padding-top:17px">
			<a href="mailto:info@Book4Holiday.com" style="text-decoration:none;color:#FFEB3B" target="_blank">info@book4holiday.com</a>
			</td>
			</tr>
			</tbody>
			</table>
			<table cellpadding="0" cellspacing="0" style="width:600px;margin:0;padding:0px;float:left;background:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#565656">
			<tbody>
			<tr>
			<td style="width:600px;vertical-align:top">
			<table cellpadding="0" cellspacing="0" style="width:600px;margin:0;padding:15px 10px;float:left;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#565656">
			<tbody>
			<tr>
			<td colspan="2">Dear <strong>Customer </strong>, <br>
			<br>
			below are your account details </td>
			</tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="2">Username : <strong><a href="#" style="text-decoration:none;" target="_blank">'.$email.'</a></strong></td>
			</tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="2">So now buy all holiday tickets with the best offers on book4holiday</td>
			</tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="2" style="font-size:16px"><a href="#" style="font-weight:bold;text-decoration:underline;color:#49ba8e" target="_blank" data-saferedirecturl="#">www.book4holiday.com</a>
			</td>
			</tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="2" style="color:#d6181f;font-size:20px;font-weight:bold;font-family:Arial,Helvetica,sans-serif">
			Enjoy the Holiday!</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			</div>
			</td>
			</tr>

			  <!--3rd line start-->

			<tr>
			<td align="center" style="width:600px">
			<table cellpadding="0" cellspacing="0" align="center" style="width:600px;background:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:11px;color:#7c7c7c">
			<tbody>
			<tr>
			<td colspan="2" align="center" style="width:180px;padding:10px 10px 0 20px;vertical-align:top;background:#f2f2f2">
			<table align="center" cellpadding="0" cellspacing="0" style="padding:0;font-size:11px;width:180px;float:left;font-family:Arial,Helvetica,sans-serif;color:#7c7c7c">
			<tbody>
			<tr>
			<td colspan="2" style="padding:5px 0 0 10px;width:170px;font-size:13px;font-weight:bold;color:#7c7c7c">
			Mobile Application</td>
			</tr>
			<tr>
			<td style="width:76px;padding-top:10px"><a href="#" style="text-decoration:none;color:#60abe4" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://mandrillapp.com/track/click/13389779/in.bookmyshow.com?p%3DeyJzIjoiRXJjRWwzZW1DTmlUV2xRY0hWRmt1Zkw4QlpRIiwidiI6MSwicCI6IntcInVcIjoxMzM4OTc3OSxcInZcIjoxLFwidXJsXCI6XCJodHRwOlxcXC9cXFwvaW4uYm9va215c2hvdy5jb21cXFwvbW9iaWxlXFxcL1wiLFwiaWRcIjpcImVlYmU0MzRmZjZmYjRkMGNiZmJhYmE2ODk0NDIzZjYzXCIsXCJ1cmxfaWRzXCI6W1wiOWJiZDYxN2UxNGZiNTQ2NzQzMmEwMmNmMDRlNmNkODIyZWY0NTQwYVwiXX0ifQ&amp;source=gmail&amp;ust=1465902897173000&amp;usg=AFQjCNG0HPjm_qxrPFJ6D8pD9NpvxSFs7w"><img alt="" src="http://book4holiday.com/images/android_app_store.png" class="CToWUd">
			</a>
			<a href="#" style="text-decoration:none;color:#60abe4" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://mandrillapp.com/track/click/13389779/in.bookmyshow.com?p%3DeyJzIjoiRXJjRWwzZW1DTmlUV2xRY0hWRmt1Zkw4QlpRIiwidiI6MSwicCI6IntcInVcIjoxMzM4OTc3OSxcInZcIjoxLFwidXJsXCI6XCJodHRwOlxcXC9cXFwvaW4uYm9va215c2hvdy5jb21cXFwvbW9iaWxlXFxcL1wiLFwiaWRcIjpcImVlYmU0MzRmZjZmYjRkMGNiZmJhYmE2ODk0NDIzZjYzXCIsXCJ1cmxfaWRzXCI6W1wiOWJiZDYxN2UxNGZiNTQ2NzQzMmEwMmNmMDRlNmNkODIyZWY0NTQwYVwiXX0ifQ&amp;source=gmail&amp;ust=1465902897173000&amp;usg=AFQjCNG0HPjm_qxrPFJ6D8pD9NpvxSFs7w"><img alt="" src="http://book4holiday.com/images/apple_store_icon.png" class="CToWUd">
			</a>
			<a href="#" style="text-decoration:none;color:#60abe4" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://mandrillapp.com/track/click/13389779/in.bookmyshow.com?p%3DeyJzIjoiRXJjRWwzZW1DTmlUV2xRY0hWRmt1Zkw4QlpRIiwidiI6MSwicCI6IntcInVcIjoxMzM4OTc3OSxcInZcIjoxLFwidXJsXCI6XCJodHRwOlxcXC9cXFwvaW4uYm9va215c2hvdy5jb21cXFwvbW9iaWxlXFxcL1wiLFwiaWRcIjpcImVlYmU0MzRmZjZmYjRkMGNiZmJhYmE2ODk0NDIzZjYzXCIsXCJ1cmxfaWRzXCI6W1wiOWJiZDYxN2UxNGZiNTQ2NzQzMmEwMmNmMDRlNmNkODIyZWY0NTQwYVwiXX0ifQ&amp;source=gmail&amp;ust=1465902897173000&amp;usg=AFQjCNG0HPjm_qxrPFJ6D8pD9NpvxSFs7w"><img alt="" src="http://book4holiday.com/images/windows_app_store.png" class="CToWUd">
			</a></td>
			<td valign="top" style="width:86px;padding:15px 0 15px 10px;font-size:11px;line-height:14px">
			Holiday<br>
			tickets on the go<br>
			<a href="#" style="text-decoration:none;color:#60abe4" target="_blank" data-saferedirecturl="#">DOWNLOAD APP</a><br>(Coming Soon)</td>
			</tr>
			</tbody>
			</table>
			</td>

			<td align="center" style="width:180px;padding:10px 10px 0 0;vertical-align:top;background:#f2f2f2">
			<table align="center" cellpadding="0" cellspacing="0" style="padding:0 0 0 10px;width:170px;float:left;font-size:11px;font-family:Arial,Helvetica,sans-serif;color:#7c7c7c">
			<tbody>
			<tr>
			<td colspan="2">
			<a href="#" style="text-decoration:none;">
			<p style="color:#49ba8e; font-family:Arial Black; font-size:18px;">Book <span style="color:#000;">4</span> Holiday</p>
			</a></td>
			</tr>
			<tr>
			<td>Your holiday ends here <br>
			<a href="#" style="text-decoration:none;color:#60abe4" target="_new" data-saferedirecturl="#">Know
			 more</a></td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			  <!--footer start-->
			<tr>
			   
			    
			    <td style="padding-left:35px;float:left">
			      <a href="#" style="text-decoration:none;"><a href="#" style="text-decoration:none;">
			<p style="color:#000; font-family:Arial,Helvetica,sans-serif; font-size:12px; line-height:20px;">Terms & Conditions <br> Cancelation Policy <br> Privacy Policy</p></a>
			</a>
			    </td>
			    
			    <td style="padding-left:0px;float:right">
			      <a href="#" style="text-decoration:none;"><a href="#" style="text-decoration:none;">
			<p style="color:#000; font-family:Arial,Helvetica,sans-serif; font-size:12px; line-height:20px;"><span style="color:#49ba8e; font-weight:500;">Address:</span> <br> Plot No.21/3, Jay Enclave, 
			<br> Images Garden Road, Madhapur, <br> Hyderabad, TS </p></a>
			</a>
			    </td>
			    
			    
			    
			</tr>
			  <!--footer end-->
			</tbody>
			</table>
			</td>

			</tr>

			  <!--3rd line end-->
			    <!--footer start-->

			    
			</tbody>
			</table>
			            </td>    
			        </tr>
			    </table>
			    

			</body>
			</html>
				';
                            
    mail($to, $subject, $message, $headers);

    //user email ends here //
}


$statusArray = array(
'statusone'=>$status,
'query' => $qrystr

    );

echo json_encode($statusArray,true);


?>

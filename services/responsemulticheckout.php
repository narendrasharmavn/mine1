<?php
include 'connectDB.php';

//echo '<pre>';

//print_r($_POST);
//echo '</pre>';
session_start();

$sql = "SELECT * FROM smssettings where id=1";
$result = mysqli_query($conn, $sql);

// output data of each row
$row = mysqli_fetch_array($result);
$smsurl= $row["url"];
$smsusername = $row["username"];
$smspassword = $row["password"];
$smssenderid = $row["senderid"];



$ticketnumber = $_SESSION['ticketnumber'];



$vendorid = "";
$servicetax;
$kidsmealprice;
$dateofvisit;
$totalcost;
$adultpriceperticket;
$childpriceperticket;
$numberofadults;
$numberofchildren;
$noofkidsmeal;
$internetcharges;
$swachhbharath;
$krishkalyancess;
$customerid;
$packageid;
$transactiontime;

$mobile;
$name;
$email;

$vendorname;
$address;
$city;

$packagename;
$resortid;
$eventid;

$resortname;
$location;

$eventname;
$description;
$eventotime;
$eventfromtime;

$tblbookingsgetdata = "SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.ticketnumber=p.ticketnumber WHERE b.ticketnumber='$ticketnumber' ORDER BY b.bookingid DESC LIMIT 1";
$tblbookingsgetdataresult = mysqli_query($conn, $tblbookingsgetdata);

if (mysqli_num_rows($tblbookingsgetdataresult) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($tblbookingsgetdataresult);
    $vendorid = $row["vendorid"];
    $servicetax = $row["servicetax"];
    $kidsmealprice = $row["kidsmealprice"];
    $dateofvisit = $row["dateofvisit"];
    $totalcost = $row["totalcost"];
    $adultpriceperticket = $row["adultpriceperticket"];
    $childpriceperticket = $row["childpriceperticket"];
    $numberofadults = $row["numberofadults"];
    $numberofchildren = $row["numberofchildren"];
    $noofkidsmeal = $row["noofkidsmeal"];
    $internetcharges = $row["internetcharges"];
    $swachhbharath = $row["swachhbharath"];
    $krishkalyancess = $row["krishkalyancess"];
    $customerid = $row["customerid"];
    $packageid = $row["packageid"];
    $transactiontime = $row["transactiontime"];
}

	// get customer details //

    $getcustomerdetails = "SELECT * FROM tblcustomers WHERE customer_id='$customerid'";
    
	$results = mysqli_query($conn, $getcustomerdetails);

	// output data of each row
	$rows = mysqli_fetch_array($results);
	$mobile= $rows["number"];
	$name = $rows["name"];
	$email = $rows["username"];

	// get customer details //	

	 // get Vendor details //

    $getvendordetails = "SELECT * FROM  tblvendors WHERE vendorid='$vendorid'";
	$result2 = mysqli_query($conn, $getvendordetails);

	// output data of each row
	$row2 = mysqli_fetch_array($result2);
	$vendorname= $row2["vendorname"];
	$address = $row2["address1"];
	$city = $row2["city"];

	// get Vendor details //	

	// get package details //

    $getpackagedetails = "SELECT * FROM  tblpackages WHERE packageid='$packageid' AND vendorid='$vendorid'";
	$result3 = mysqli_query($conn, $getpackagedetails);

	// output data of each row
	$row3 = mysqli_fetch_array($result3);
	$packagename= $row3["vendorname"];
	$resortid = $row3["resortid"];
	$eventid = $row3["eventid"];
	
	// get package details //

	// get resort details //

	$getresortdetails = "SELECT * FROM  tblresorts WHERE resortid='$resortid' AND vendorid='$vendorid'";
	$result4 = mysqli_query($conn, $getresortdetails);

	// output data of each row
	$row4 = mysqli_fetch_array($result4);
	$resortname= $row4["resortname"];
	$location = $row4["location"];

	// get resort details //


	// get event details //

	$geteventdetails = "SELECT * FROM  tblevents WHERE vendorid='$vendorid' AND eventid='$eventid'";
	$result5 = mysqli_query($conn, $geteventdetails);

	// output data of each row
	$row5 = mysqli_fetch_array($result5);
	$eventname= $row5["eventname"];
	$description = $row5["description"];
	$eventotime = $row5["totime"];
	$eventfromtime = $row5["fromtime"];

	// get event details //



if ($_POST['f_code']=='Ok') {
	echo "Transaction Success!!";

    

	$tblbookings = "UPDATE tblbookings SET booking_status='booked',payment_status='paid' WHERE ticketnumber='$ticketnumber'";

		if (mysqli_query($conn, $tblbookings)) {
		    //echo "Table bookings updated"."<br>";
		}else{
		    echo "Error updating record: " . mysqli_error($conn);
		}



	$sql = "UPDATE tblpayments SET mmp_txn='$_POST[mmp_txn]',mer_txn='$_POST[mer_txn]',amount='$_POST[amt]',transdate='$_POST[date]',banktransaction='$_POST[bank_txn]',authorizationcode='$_POST[auth_code]',discriminator='$_POST[discriminator]',cardnumber='$_POST[CardNumber]',billingemail='$_POST[udf2]',billingphone='$_POST[udf3]',status='paid',responsestatus='$_POST[f_code]' WHERE ticketnumber='$ticketnumber'";

		if (mysqli_query($conn, $sql)) {
		    //echo "Table payments updated"."<br>";
		} else {
		    echo "Error updating record: " . mysqli_error($conn);
		}

		 $amountreceived = ($_POST['amt'])-($servicetax);
	$tbltransactionsselect = "SELECT * FROM tbltransactions WHERE vendorid='$vendorid' ORDER BY tid DESC LIMIT 0,1";
	$balance=0;
$tbltransactionsresult = mysqli_query($conn, $tbltransactionsselect);

if (mysqli_num_rows($tbltransactionsresult) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($tbltransactionsresult);
    $balance = $row["balance"];

        $balance+= $amountreceived;
      }else{
       $balance+= $amountreceived;
      }
    




		$inserttbltransactions = "INSERT INTO tbltransactions (vendorid, amountreceived, servicecharges,balance,kidsmealamountrecieved) VALUES ('$vendorid', '$amountreceived', '$servicetax','$balance','$kidsmealprice')";

		if (mysqli_query($conn, $inserttbltransactions)) {
		    //echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}




	// send sms //

    $text1 =  'Your booking is confirmed via Book4Holiday at Nehru Zoo for:'.$dateofvisit.'. Your Booking Id is: '.$ticketnumber;

	sendSMS($mobile,$smsurl,$smsusername,$smspassword,$smssenderid,$text1);

    // send sms //

   


    // send email //
   sendEmail($email,$totalcost,$adultpriceperticket,$childpriceperticket,$kidsmealprice,$numberofadults,$numberofchildren,$noofkidsmeal,$servicetax,$internetcharges,$swachhbharath,$krishkalyancess,$ticketnumber,$resortname,$eventname,$eventotime,$eventfromtime,$location,$description,$dateofvisit,$transactiontime);
    // send email // 

}else{

	$tblbookings = "UPDATE tblbookings SET booking_status='failed',payment_status='failed' WHERE ticketnumber=".$ticketnumber;

		if (mysqli_query($conn, $tblbookings)) {
		    //echo "Table b"."<br>";
		} else {
		    echo "Error updating record tblbookings: " . mysqli_error($conn);
		}



		$sql = "UPDATE tblpayments SET mmp_txn='".$_POST['mmp_txn']."',mer_txn='".$_POST['mer_txn']."',amount='".$_POST['amt']."',transdate='".$_POST['date']."',banktransaction='".$_POST['bank_txn']."',authorizationcode='".$_POST['auth_code']."',discriminator='".$_POST['discriminator']."',cardnumber='".$_POST['CardNumber']."',billingemail='".$_POST['udf2']."',billingphone='".$_POST['udf3']."',status='paid',responsestatus='".$_POST['f_code']."' WHERE ticketnumber=".$ticketnumber;

		if (mysqli_query($conn, $sql)) {
		    //echo "Table payments updated"."<br>";
		} else {
		    echo "Error updating record tblpayments: " . mysqli_error($conn);
		}


    // send sms //
    
    $text1 =  "We are sorry, looks like something went wrong. Your transaction at Book4Holiday failed! Transaction Id for your reference is:    ".$ticketnumber;

	sendSMS($mobile,$smsurl,$smsusername,$smspassword,$smssenderid,$text1);

    // send sms //

    // send email //
    
    sendFailureEmail($email,$ticketnumber);

    // send email //
   
	echo "Transaction Failed";
}




function sendSMS($mobile,$smsurl,$smsusername,$smspassword,$smssenderid,$text1)
{
    // SMS REQUEST SENT START //
    
    
    $text=str_replace(" ","%20",$text1);
    $qry_str = $smsurl.$smsusername."&password=".$smspassword."&to=".$mobile."&from=".$smssenderid."&message=".$text;
    echo "Server returns: " .$qry_str;
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


function sendEmail($email,$totalcost,$adultpriceperticket,$childpriceperticket,$kidsmealprice,$numberofadults,$numberofchildren,$noofkidsmeal,$servicetax,$internetcharges,$swachhbharath,$krishkalyancess,$ticketnumber,$resortname,$eventname,$eventotime,$eventfromtime,$location,$description,$dateofvisit,$transactiontime)
{
	$to=$email;
    $subject = "Transaction Success";
    $headers = "MIME-Version: 1.0"."\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
    $headers .= 'From: Book4Holiday Support <info@book4holiday.com>'."\r\n";
    $message='<!doctype html>
			<html>
			<head>
			<meta charset="utf-8">
			<title>Book4Holiday</title>
			</head>

			<body>

			<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" style="padding:25px 0 15px 0">
			      <tbody><tr>
			        <td width="100%" valign="top">
			          <table cellpadding="0" cellspacing="0" width="600" border="0" align="center" bgcolor="f2f2f2">
			            <tbody>
			              <tr>
			                <td valign="top">
			                  <table cellpadding="0" cellspacing="0" width="600" border="0" align="center">
			                    <tbody><tr>
			                      <td valign="top" width="300" style="background-color:#1f2533;padding-top:10px">
			                        <a href="#" style="text-decoration:none;color:#010101" target="_blank" data-saferedirecturl="#"><!--<img alt="" height="70" border="0" width="200" style="margin:0px auto" src="" class="CToWUd">--><h3 style="color:#FFF; font-family:Arial Black, Gadget, sans-serif; font-size:18px; padding-left:30px;">Book <span style="color:#49ba8e;">4</span> Holiday</h3>
			                        </a>
			                      </td>
			                      
			                    </tr>
			                  </tbody></table>
			                </td>
			              </tr>
			              <tr>
			                <td valign="top">
			                  <table cellpadding="0" cellspacing="0" width="600" border="0" align="center">
			                    <tbody><tr>
			                      <td valign="top" width="500" style="background-color:#ffffff;color:#666666;font-size:15px;font-family:Arial,sans-serif;text-align:left;padding:30px 10px 20px 30px;line-height:20px">Dear <span>Customer</span>, <br>Your ticket(s) are <b>Confirmed</b>! </td>
			                      <td valign="top" width="100" style="background-color:#ffffff;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:30px 20px 20px 10px;line-height:20px">BOOKING ID <br><span style="font-size:20px;font-weight:bold">'.$ticketnumber.'</span></td>
			                    </tr>
			                  </tbody></table>
			                </td>
			              </tr>
			              <tr>
			                <td valign="top" style="background-color:#f2f2f2;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:10px 40px 20px 40px;line-height:20px">
			                  
			                  <p style="font-size:14px;float:left;width:70%;padding-top:20px">Please find your holiday tickets attached to this mail or to download your ticket, <a href="#" style="text-decoration:none;color:#4073cf;font-weight:bold" target="_blank" data-saferedirecturl="#">click here</a></p>
			                </td>
			              </tr>
			              <tr>
			                <td valign="top">
			                  <table cellpadding="0" cellspacing="0" width="540" border="0" align="center" bgcolor="#1f2533">
			                    <tbody><tr>
			                      <td width="15">
			                      </td><td width="370" valign="top" style="color:#ffffff;font-size:15px;font-family:Arial,sans-serif;text-align:left;padding:25px 10px 25px 15px;line-height:24px;border-right:1px dotted #ffffff">';
								  
			                        if($resortid!=0)
			                        {
			                           $message.= '<span style="font-size:20px;color:#ffffff;font-weight:bold">'.$resortname.'</span>';
			                        }else {
									  $message.= '<span style="font-size:20px;color:#ffffff;font-weight:bold">'.$eventname.'</span>';
			                        } 
									$message.='<br>
			                        <span>
			                        <span>Your Ticket no: '.$ticketnumber.', </span>';
			                        if ($resortid!=0) {
									$message.='<span><span>'.$location.'</span><span></span></span><br><span class="aBn" data-term="goog_1116116412" tabindex="0"><span class="aQJ">'.$dateofvisit.'</span>';
			                        }else{
                                      $message.=  '<span><span>'.$description.'</span><span></span></span><br><span class="aBn" data-term="goog_1116116412" tabindex="0"><span class="aQJ">'.$eventfromtime.'</span></span> | <span style="overflow:hidden;float:left;line-height:0px">'.$transactiontime.'</span>'.$dateofvisit.'</span>';
			                        }
			                        
			                       $message.= '</td>
			                      
			                      </tr>
			                  </tbody></table>
			                </td>
			              </tr>
			              <tr>
			                <td valign="top">
			                  <table cellpadding="0" cellspacing="0" width="540" border="0" align="center" bgcolor="#ffffff" style="border:1px solid #e1e5e8;margin-bottom:15px">
			                    <tbody>
			                      <tr>
			                        <td width="538" valign="top">
			                          <table cellpadding="0" cellspacing="0" width="488" border="0" align="center">
			                            <tbody>
			                              <tr>
			                                <td width="488" valign="top" style="background-color:#ffffff;color:#666666;font-size:12px;font-weight:bold;font-family:Arial,sans-serif;text-align:left;padding:15px 10px 5px 0px;line-height:20px;
			                                border-bottom:1px solid #efefef;letter-spacing:3px">OTHER ITEMS
																				</td>
			                              </tr>
			                            </tbody>
			                          </table>
			                        </td>
			                      </tr>
			                      <tr>
			                        <td valign="top" style="width:478px;padding:0 30px">
			                          <table cellpadding="0" cellspacing="0" border="0" align="left" style="width:478px;border-bottom:1px dotted #e1e5e8;padding:10px 0">
			                            <tbody>
			                              <tr>
			                                <td valign="top" style="background-color:#ffffff;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:5px 0;line-height:20px;width:100%">
			                                  <strong style="color:#0e1422;font-size:13px">Book 4 Holiday </strong>
			                                  <br>Booking Confirmation Number - '.$ticketnumber.'</td>
			                              </tr>
			                            </tbody>
			                          </table>
			                        </td>
			                      </tr>
			                    </tbody>
			                  </table>
			                </td>
			              </tr>
			              <tr>
			                <td valign="top">
			                  <table cellpadding="0" cellspacing="0" width="538" border="0" align="center" bgcolor="#ffffff" style="border:1px solid #e1e5e8">
			                    <tbody><tr>
			                      <td width="538" valign="top">
			                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center" bgcolor="#ffffff" style="padding:0 30px">
			                          <tbody>
			                            <tr>
			                              <td valign="top" style="width:478px;background-color:#ffffff;color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:10px 10px 10px 0;border-bottom:1px solid #e1e5e8">
			                                <span style="font-size:12px">ORDER SUMMARY </span>
			                              </td>
			                            </tr>
			                          </tbody>
			                        </table>
			                      </td>
			                    </tr>
			                    <tr>
			                      <td width="538" valign="top">
			                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
			                          <tbody>
			                           
			                          </tbody>
			                        </table>
			                      </td>
			                    </tr>
			                    <tr>
			                      <td valign="top" width="538">
			                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
			                          <tbody>
			                            <tr>
			                              <td style="width:30px">
			                              </td><td valign="top" style="width:265px;padding:10px 10px 10px 0;background-color:#ffffff;color:#1f2533;font-size:13px;font-family:Arial,sans-serif;text-align:left;line-height:20px">
			                                <strong>Adult</strong>
			                              </td>
			                              <td valign="top" width="213" style="background-color:#ffffff;color:#1f2533;font-size:12px;font-family:Arial,sans-serif;text-align:right;padding:0 0 0 10px;vertical-align:top">
			                                <br>
			                                <strong>'.$numberofadults.'</strong>
			                              </td>
			                              <td style="width:30px">
			                            </td></tr>
			                            <tr>
			                              <td style="width:30px">
			                              </td><td valign="top" style="width:265px;padding:10px 10px 10px 0;background-color:#ffffff;color:#1f2533;font-size:13px;font-family:Arial,sans-serif;text-align:left;line-height:20px">
			                                <strong>Child</strong>
			                              </td>
			                              <td valign="top" width="213" style="background-color:#ffffff;color:#1f2533;font-size:12px;font-family:Arial,sans-serif;text-align:right;padding:0 0 0 10px;vertical-align:top">
			                                <br>
			                                <strong>'.$numberofchildren.'</strong>
			                              </td>
			                              <td style="width:30px">
			                            </td></tr>
			                            <tr>
			                              <td style="width:30px">
			                              </td><td valign="top" style="width:265px;padding:10px 10px 10px 0;background-color:#ffffff;color:#1f2533;font-size:13px;font-family:Arial,sans-serif;text-align:left;line-height:20px">
			                                <strong>Kids Meal</strong>
			                              </td>
			                              <td valign="top" width="213" style="background-color:#ffffff;color:#1f2533;font-size:12px;font-family:Arial,sans-serif;text-align:right;padding:0 0 0 10px;vertical-align:top">
			                                <br>
			                                <strong>'.$noofkidsmeal.'</strong>
			                              </td>
			                              <td style="width:30px">
			                            </td></tr>
			                          </tbody>
			                        </table>
			                      </td>
			                    </tr>
			                    <tr>
			                      <td valign="top" width="538">
			                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
			                          <tbody>
			                            <tr>
			                              <td style="width:30px">
			                              </td><td valign="top" style="width:265px;padding:10px 0 10px 0;background-color:#ffffff;color:#1f2533;font-size:13px;font-family:Arial,sans-serif;text-align:left">
			                                <strong>Internet handling fees</strong>
			                              </td>
			                              <td valign="top" width="213" style="background-color:#ffffff;color:#1f2533;font-size:12px;font-family:Arial,sans-serif;text-align:right;vertical-align:top">
			                                <br>
			                                <strong>Rs.'.$internetcharges.'</strong>
			                              </td>
			                              <td style="width:30px">
			                            </td></tr>
			                            
			                            <tr>
			                              <td style="width:30px">
			                              </td><td valign="top" style="width:265px;background-color:#ffffff;color:#666666;font-size:9px;font-family:Arial,sans-serif;text-align:left;line-height:20px">Service Tax @ 14%</td>
			                              <td valign="top" width="213" style="background-color:#ffffff;color:#666666;font-size:9px;font-family:Arial,sans-serif;text-align:right;vertical-align:top">Rs.'.$servicetax.'</td>
			                              <td style="width:30px">
			                            </td></tr>
			                            <tr>
			                              <td style="width:30px">
			                              </td><td valign="top" style="width:265px;background-color:#ffffff;color:#666666;font-size:9px;font-family:Arial,sans-serif;text-align:left;line-height:20px">Swachh Bharat Cess @ 0.50%</td>
			                              <td valign="top" width="213" style="background-color:#ffffff;color:#666666;font-size:9px;font-family:Arial,sans-serif;text-align:right;vertical-align:top">Rs.'.$swachhbharath.'</td>
			                              <td style="width:30px">
			                            </td></tr>
			                            <tr>
			                              <td style="width:30px">
			                              </td><td valign="top" style="width:265px;background-color:#ffffff;color:#666666;font-size:9px;font-family:Arial,sans-serif;text-align:left;line-height:20px">Krishi Kalyan Cess @ 0.50%
			                                  </td>
			                              <td valign="top" width="213" style="background-color:#ffffff;color:#666666;font-size:9px;font-family:Arial,sans-serif;text-align:right;vertical-align:top">Rs.'.$krishkalyancess.'</td>
			                              <td style="width:30px">
			                            </td></tr>
			                          </tbody>
			                        </table>
			                      </td>
			                    </tr>
			                 
			                    <tr>
			                      <td valign="top" width="538">
			                        <table cellpadding="0" cellspacing="0" width="538" border="0" align="center">
			                          <tbody><tr>
			                            <td style="width:30px">
			                            </td><td valign="top" style="width:265px;padding:15px 10px 0px 0;background-color:#ffffff;color:#666666;font-size:16px;font-family:Arial,sans-serif;text-align:left;border-top:2px dotted #bfbfbf">
			                              <strong>AMOUNT PAYABLE</strong>
			                            </td>
			                            <td valign="top" width="213" style="padding:15px 10px 15px 0;font-size:18px;font-weight:bold;font-family:Arial,sans-serif;text-align:right;background-color:#ffffff;color:#666666;border-top:2px dotted #bfbfbf">Rs.'.$totalcost.'</td>
			                            <td style="width:30px">
			                          </td></tr>
			                        </tbody></table>
			                      </td>
			                    </tr>
			                  </tbody></table>
			                </td>
			              </tr>
			              <!--
			              <tr>
			                <td valign="top" width="540" style="background-color:#ffffff">
			                  <table cellpadding="0" cellspacing="0" width="540" border="0" align="center">
			                    <tbody><tr>
			                      <td valign="top" width="540" style="color:#666666;font-size:12px;font-family:Arial,sans-serif;text-align:justify;padding:30px 0 40px;line-height:20px">
			                        <span style="font-size:12px">
			                          <b>Terms & conditions</b>
			                        </span>
			                        <br>
			                        </td>
			                    </tr>
			                  </tbody></table>
			                </td>
			              </tr>-->
			              <tr>
			                <td valign="top">
			                  <table cellpadding="0" cellspacing="0" width="600" border="0" align="center" bgcolor="1F2533">
			                    <tbody><tr>
			                      <td valign="top" width="260" style="background-color:#1f2533;color:#49ba8e;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:20px 10px 15px 20px">For any further assistance<br><a href="mailto:helpdesk@BookMyShow.com" style="text-decoration:none;color:#49ba8e;font-weight:bold" target="_blank">helpdesk@book4holiday.com</a></td>
			                      <td style="width:200px;vertical-align:top;background-color:#1f2533;text-align:right;padding:25px 0 15px 0">
			                        <img src="https://ci3.googleusercontent.com/proxy/ox1pr8SuruzQrAsTBgtdjSlHhf0BodFY1HY033BSEDpQQx41C7mSyS3nVKhXYKB2WK98ymYskV6_gH0967w5847IDkg85kno18hz0PjzvlWj2HI=s0-d-e1-ft#http://cnt.in.bookmyshow.com/webin/emailer/helpline-phone.png" alt="helpline phone" width="18" height="20" border="0" class="CToWUd">
			                      </td>
			                      <td style="width:105px;vertical-align:top;padding:25px 0 15px 10px;text-align:left;background-color:#1f2533;color:#49ba8e;line-height:14px;font-size:12px;font-weight:bold">
			                        <a href="tel:+912261445050" style="text-decoration:none;color:#49ba8e" target="_blank">+91 40 1234 5678</a>
			                      </td>
			                    </tr>
			                  </tbody></table>
			                </td>
			              </tr>
			            </tbody>
			          </table>
			        </td>
			      </tr>
			    </tbody></table>

			</body>
			</html>';
    mail($to, $subject, $message, $headers);
}


function sendFailureEmail($email,$ticketnumber)
{
	$to=$email;
    $subject = "Transaction Failed";
    $headers = "MIME-Version: 1.0"."\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
    $headers .= 'From: Book4Holiday Support <info@book4holiday.com>'."\r\n";
    $message='<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book4Holiday</title>
</head>

<body>

<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" style="padding:25px 0 15px 0">
      <tbody><tr>
        <td width="100%" valign="top">
          <table cellpadding="0" cellspacing="0" width="600" border="0" align="center" bgcolor="f2f2f2">
            <tbody>
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="600" border="0" align="center">
                    <tbody><tr>
                      <td valign="top" width="300" style="background-color:#1f2533;padding-top:10px">
                        <a href="#" style="text-decoration:none;color:#010101" target="_blank" data-saferedirecturl="#"><!--<img alt="" height="70" border="0" width="200" style="margin:0px auto" src="" class="CToWUd">--><h3 style="color:#FFF; font-family:Arial Black, Gadget, sans-serif; font-size:18px; padding-left:30px;">Book <span style="color:#49ba8e;">4</span> Holiday</h3>
                        </a>
                      </td>
                      
                    </tr>
                  </tbody></table>
                </td>
              </tr>
             
              
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="540" border="0" align="center" bgcolor="#1f2533">
                    <tbody><tr>
                      <td width="15">
                      </td><td width="370" valign="top" style="color:#ffffff;font-size:15px;font-family:Arial,sans-serif;text-align:left;padding:25px 10px 25px 15px;line-height:24px;border-right:1px dotted #ffffff">
                        
                        <span>
                          
                          <span>Dear <span>Customer</span>, <br>Your Transaction is  <b>failed</b>!</span>
                          <span>Your Transaction no: '.$ticketnumber.'</span> 
													</span>
                        <br></td>
                        <br>
                      </tr>
                  </tbody></table>
                </td>
              </tr>
             
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="538" border="0" align="center" bgcolor="#ffffff" style="border:1px solid #e1e5e8">
                    <tbody><tr>
                      <td width="538" valign="top">
                        
                      </td>
                    </tr>
                    <br>
                  </tbody></table>
                </td>
              </tr>
              
              <tr>
                <td valign="top">
                  <table cellpadding="0" cellspacing="0" width="600" border="0" align="center" bgcolor="1F2533">
                    <tbody><tr>
                      <td valign="top" width="260" style="background-color:#1f2533;color:#49ba8e;font-size:12px;font-family:Arial,sans-serif;text-align:left;padding:20px 10px 15px 20px">For any further assistance<br><a href="mailto:helpdesk@BookMyShow.com" style="text-decoration:none;color:#49ba8e;font-weight:bold" target="_blank">helpdesk@book4holiday.com</a></td>
                      <td style="width:200px;vertical-align:top;background-color:#1f2533;text-align:right;padding:25px 0 15px 0">
                        <img src="https://ci3.googleusercontent.com/proxy/ox1pr8SuruzQrAsTBgtdjSlHhf0BodFY1HY033BSEDpQQx41C7mSyS3nVKhXYKB2WK98ymYskV6_gH0967w5847IDkg85kno18hz0PjzvlWj2HI=s0-d-e1-ft#http://cnt.in.bookmyshow.com/webin/emailer/helpline-phone.png" alt="helpline phone" width="18" height="20" border="0" class="CToWUd">
                      </td>
                      <td style="width:105px;vertical-align:top;padding:25px 0 15px 10px;text-align:left;background-color:#1f2533;color:#49ba8e;line-height:14px;font-size:12px;font-weight:bold">
                        <a href="tel:+912261445050" style="text-decoration:none;color:#49ba8e" target="_blank">+91 40 1234 5678</a>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody></table>

</body>
</html>
';
    mail($to, $subject, $message, $headers);
}




//echo json_encode($dataStatus,true);

mysqli_close($conn);
?>
<script>
window.onload = function(e) {
              window.location.href="test.php/ticketnumber=<?php echo $ticketnumber;?>";
              //window.location.href="test.php/ticketnumber=20160808102834000000";
              //alert("hello");
            };

</script>

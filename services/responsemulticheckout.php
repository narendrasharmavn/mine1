<?php
include 'connectDB.php';

//echo '<pre>';

//print_r($_POST);
//echo '</pre>';
$ticketnumber = $_POST['udf9'];

$vendorid = "";
$servicetax;
$kidsmealprice;

$tblbookingsgetdata = "SELECT * FROM tblbookings b LEFT JOIN tblpayments p ON b.ticketnumber=p.ticketnumber WHERE b.ticketnumber='$ticketnumber' ORDER BY b.bookingid DESC LIMIT 1";
$tblbookingsgetdataresult = mysqli_query($conn, $tblbookingsgetdata);

if (mysqli_num_rows($tblbookingsgetdataresult) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($tblbookingsgetdataresult);
    $vendorid = $row["vendorid"];
    $servicetax = $row["servicetax"];
    $kidsmealprice = $row["kidsmealprice"];
    
}



if ($_POST['f_code']=='Ok') {
	echo "Transaction Success!!";


	$tblbookings = "UPDATE tblbookings SET booking_status='booked',payment_status='paid' WHERE ticketnumber='$ticketnumber'";

		if (mysqli_query($conn, $tblbookings)) {
		    //echo "Table bookings updated"."<br>";
		}else{
		    echo "Error updating record: " . mysqli_error($conn);
		}



	$sql = "UPDATE tblpayments SET mmp_txn='$_POST[mmp_txn]',mer_txn='$_POST[mer_txn]',amount='$_POST[amt]',transdate='$_POST[date]',banktransaction='$_POST[bank_txn]',authorizationcode='$_POST[auth_code]',discriminator='$_POST[discriminator]',cardnumber='$_POST[CardNumber]',billingemail='$_POST[udf2]',billingphone='$_POST[udf3]',status='paid',responsestatus='$_POST[f_code]' WHERE ticketnumber='$_POST[udf9]'";

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

	
}else{

	$tblbookings = "UPDATE tblbookings SET booking_status='failed',payment_status='failed', WHERE ticketnumber='$_POST[udf9]'";

		if (mysqli_query($conn, $tblbookings)) {
		    //echo "Table b"."<br>";
		} else {
		    echo "Error updating record: " . mysqli_error($conn);
		}



		$sql = "UPDATE tblpayments SET mmp_txn='$_POST[mmp_txn]',mer_txn='$_POST[mer_txn]',amount='$_POST[amt]',transdate='$_POST[date]',banktransaction='$_POST[bank_txn]',authorizationcode='$_POST[auth_code]',discriminator='$_POST[discriminator]',cardnumber='$_POST[CardNumber]',billingemail='$_POST[udf2]',billingphone='$_POST[udf3]',status='paid',responsestatus='$_POST[f_code]' WHERE ticketnumber='$_POST[udf9]'";

		if (mysqli_query($conn, $sql)) {
		    //echo "Table payments updated"."<br>";
		} else {
		    echo "Error updating record: " . mysqli_error($conn);
		}




	echo "Transaction Failed";
}




//echo json_encode($dataStatus,true);

mysqli_close($conn);
?>
<script>
window.onload = function(e) {
              window.location.href="test.php/ticketnumber=<?php echo $_POST['udf9'];?>";
              //window.location.href="test.php/ticketnumber=20160808102834000000";
              //alert("hello");
            };

</script>

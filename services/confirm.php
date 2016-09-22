<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  
<?php
session_start();
$data1 = json_decode($_GET['data'],true);
//print_r($data1);
$_SESSION['ticketnumber'] = $data1['ticketnumber'];
//echo "data is: ".$data1['ticketnumber'];

?>
<div class="container">
  <center><h2>Book4Holiday</h2></center>
  <p>Press Pay to take you to payment gateway</p>
  <form action="<?php echo 'https://book4holiday.com/'.'merchant/';  ?>submit.php" method="post" id="payment-form">
		<input type="hidden" name="amount" class=" form-control" placeholder="" value="<?php echo $data1['total']; ?>" readonly>
        <INPUT TYPE="hidden" NAME="udf1" value="NSE">
        
		<INPUT TYPE="hidden" NAME="product" value="ADEPTO">
                                    <INPUT TYPE="hidden" NAME="TType" value="NBFundTransfer">
                                    <INPUT TYPE="hidden" NAME="clientcode" value="007">
                                    <INPUT TYPE="hidden" NAME="AccountNo" value="1234567890">

                                    <INPUT TYPE="hidden" NAME="ru" value="<?php echo 'https://book4holiday.com/services/responsemulticheckout.php'; ?>">
                                    <input type="hidden" name="udf9" value="<?php echo  date('Ymdhisu'); ?>"/>
									<INPUT TYPE="hidden" NAME="ticketnumber" value="<?php echo $data1['ticketnumber'];   ?>">
 <input type="hidden" name="udf3" class="form-control" id="mobile" placeholder="Enter Your mobile" value="<?php echo $data1['mobile'];   ?>">
<input type="hidden" name="udf2" class="form-control" id="email" placeholder="abcd@example.com" value="<?php echo $data1['email'];   ?>">

  <table class="table">
  
    <tbody>
        <tr><td>Name</td><td><?php echo $data1['name'];   ?></td></tr>
        <tr><td>Email</td><td><?php echo $data1['email'];   ?></td></tr>
        <tr><td>Mobile</td><td><?php echo $data1['mobile'];   ?></td></tr>
        <tr><td>Amount to Be Paid</td><td>RS. <?php echo $data1['total'];   ?></td></tr>
        <tr>
        
     
    </tbody>
  </table>
  <center><button type="submit" class="btn btn-success">Confirm To Pay</button></center>
  <?php //echo "name is: ".$data1['name'];   ?>
  </form>
</div>

</body>
</html>
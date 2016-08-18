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
$data1 = json_decode($_GET['data'],true);
//print_r($data1);

//echo "data is: ".$data1['ticketnumber'];

?>
<div class="container">
  <h2>Book4Holiday</h2>
  <p>Press Pay to take you to payment gateway</p>
  <form action="<?php echo 'http://fornextit.com/book4holiday/'.'merchant/';  ?>submit.php" method="post" id="payment-form" >
		<input type="hidden" name="amount" class=" form-control" placeholder="" value="<?php echo round($data1['total'],0); ?>" readonly>
        <INPUT TYPE="hidden" NAME="udf1" value="NSE">
        <INPUT TYPE="hidden" NAME="udf9" value="<?php echo $data1['ticketnumber'];   ?>">
		<INPUT TYPE="hidden" NAME="product" value="NSE">
                                    <INPUT TYPE="hidden" NAME="TType" value="NBFundTransfer">

                                    <INPUT TYPE="hidden" NAME="clientcode" value="9654">
                                    <INPUT TYPE="hidden" NAME="AccountNo" value="85654125485412">

                                    <INPUT TYPE="hidden" NAME="ru" value="<?php echo 'http://fornextit.com/bookmobile/responsemulticheckout.php'; ?>">
                                    <input type="hidden" name="bookingid" value="<?php echo  date('Ymdhisu'); ?>"/>
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
  <button type="submit" class="btn btn-success">Confirm To Pay</button>
  </form>
</div>

</body>
</html>
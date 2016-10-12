<?php
include 'connectDB.php';

error_reporting(0);

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$p = $request->packageid;

$sql = "SELECT v.kidsmealprice FROM tblpackages p LEFT join tblvendors v on p.vendorid=v.vendorid  WHERE p.packageid='$p'";
//echo $sql."<br>";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$kidsmealprice = $row["kidsmealprice"];

if ($kidsmealprice==null) {
	$kidsmealprice = 0;
	
}


       $data = array(
       	'kidsmealprice' => $kidsmealprice
       );

echo json_encode($data,true);


mysqli_close($conn);

?>
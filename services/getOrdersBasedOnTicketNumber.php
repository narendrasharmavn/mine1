<?php

include 'connectDB.php';
$status="";
$postdata = file_get_contents("php://input");
if (isset($postdata)) {
	$request = json_decode($postdata);
        $ticketnumber= $request->ticketnumber;

/*

$dt = array();
$sql = "SELECT * FROM tblpayments WHERE ticketnumber='$ticketnumber'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $dt[]= $row;
    }
    echo json_encode($statusArray,true);
} else {
    echo "no orders";
}

}
*/
echo "ticket number is: ".$ticketnumber."<br>'";

?>

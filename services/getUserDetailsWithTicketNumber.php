<?php
include 'connectDB.php';


$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$ticketnumber = $request->ticketnumber;
//echo "package id is: ".$packageid."<br>";


$userdetails = array();



$sql2 = "SELECT * FROM tblpayments WHERE ticketnumber='$ticketnumber'";
//echo $sql2."<\n>";
//mysqli_set_charset("utf8");
$result = mysqli_query($conn, $sql2);
//mysqli_set_charset($conn,"utf8");
if (mysqli_num_rows($result) > 0) {
    // output userdetails of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        
        $userdetails[] = $row;
        //$userdetails[] = ;
        //echo "id: " . $row["eventname"]."<br>";
    }
} else {
    echo "0 results";
}
//echo "amar";

echo json_encode($userdetails,true);
//echo json_last_error_msg();




mysqli_close($conn);

?>
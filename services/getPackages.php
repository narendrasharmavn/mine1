<?php
include 'connectDB.php';

$packageid = $_GET['packageid'];
$resortIdDetails = array();
$adultqty = 0;


$sql2 = "SELECT * FROM tblresorts r LEFT JOIN tblpackages p ON r.resortid=p.resortid WHERE p.packageid='$packageid'";
//echo $sql2."<br>";
//mysqli_set_charset("utf8");
$result = mysqli_query($conn, $sql2);
//mysqli_set_charset($conn,"utf8");
if (mysqli_num_rows($result) > 0) {
    // output resortIdDetails of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        
        $resortIdDetails[] = utf8ize($row);
        //$resortIdDetails[] = ;
        //echo "id: " . $row["eventname"]."<br>";
    }
} else {
    echo "0 results";
}
//echo "amar";

echo json_encode($resortIdDetails,true);
//echo json_last_error_msg();









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
//print_r($eventsData);

/*
foreach ($row as $k => $value) {
        	echo "key is: ".$k."   value is: ".$value."<br>";
        }
*/

mysqli_close($conn);

?>
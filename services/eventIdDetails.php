<?php
include 'connectDB.php';

$eventid = $_GET['eventid'];
$resortIdDetails = array();

$sql = "SELECT * FROM tblevents e WHERE e.eventid='$eventid' GROUP BY r.eventid";
//echo $sql."<br>";
//mysqli_set_charset("utf8");
$result = mysqli_query($conn, $sql);
//mysqli_set_charset($conn,"utf8");
if (mysqli_num_rows($result) > 0) {
    // output resortIdDetails of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        
        $resortIdDetails[] = utf8ize($row);
        //echo "id: " . $row["eventname"]."<br>";
    }
} else {
    echo "0 results";
}




$sql2 = "SELECT * FROM tblevents e LEFT JOIN tblpackages p ON e.eventid=p.eventid WHERE r.eventid='$eventid'";
//echo $sql2."<br>";
//mysqli_set_charset("utf8");
$result = mysqli_query($conn, $sql2);
//mysqli_set_charset($conn,"utf8");
if (mysqli_num_rows($result) > 0) {
    // output resortIdDetails of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        
        $resortIdDetails[] = utf8ize($row);
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
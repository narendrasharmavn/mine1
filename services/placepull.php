<?php
include 'connectDB.php';

$placesData = array();

$sql = "SELECT p.plid as plid,p.place as place,LEFT(p.description, 80) as description ,pp.photoname as photoname FROM tblplaces p LEFT JOIN tblplacesphotos pp ON p.plid=pp.plid GROUP BY p.plid";
//mysqli_set_charset("utf8");
$result = mysqli_query($conn, $sql);
//mysqli_set_charset($conn,"utf8");
if (mysqli_num_rows($result) > 0) {
    // output placesData of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        
        $placesData[] = utf8ize($row);
        //echo "id: " . $row["eventname"]."<br>";
    }
} else {
    echo "0 results";
}
//echo "amar";

echo json_encode($placesData,true);
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
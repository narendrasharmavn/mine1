<?php
include 'connectDB.php';

$sliderdata = array();

$sql = "SELECT * FROM tblsliders2 WHERE status=1";
//mysqli_set_charset("utf8");
$result = mysqli_query($conn, $sql);
//mysqli_set_charset($conn,"utf8");
if (mysqli_num_rows($result) > 0) {
    // output eventsData of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        
        $sliderdata[] = utf8ize($row);
        //echo "id: " . $row["eventname"]."<br>";
    }
} else {
    echo "0 results";
}
//echo "amar";
echo json_encode($sliderdata);



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

//echo json_last_error_msg();
//print_r($eventsData);

mysqli_close($conn);

?>
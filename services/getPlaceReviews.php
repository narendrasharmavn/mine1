<?php
include 'connectDB.php';

$eventid = $_GET['placeid'];
$resortIdDetails = array();
$adultqty = 0;


$sql2 = "select c.name,r.subject,r.review,r.pricereview from placereviews r left join tblcustomers c on r.customerid=c.customer_id where r.placeid='$eventid' order by prid desc limit 5";

//echo $sql2."\n";
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
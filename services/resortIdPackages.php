<?php
include 'connectDB.php';

$resortid = $_GET['resortid'];
$resortIdDetails = array();
$adultqty = 0;


$sql2 = "SELECT r.bannerimage as bannerimage,p.description as description,p.packagename as packagename,p.adultprice as adultprice,p.childprice as childprice,p.packageid as packageid, r.resortname as resortname FROM tblresorts r LEFT JOIN tblpackages p ON r.resortid=p.resortid WHERE r.resortid='$resortid'";
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
echo json_encode($resortIdDetails,true);
    }
} else {
    echo "zero";
}
//echo "amar";


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
<?php
include 'connectDB.php';

$eventid = $_GET['eventid'];
$resortIdDetails = array();
$adultqty = 0;


$sql2 = "SELECT p.packageid as packageid,p.adultprice as adultprice,p.childprice as childprice,p.packagename as packagename,e.bannerimage as bannerimage,e.eventname as eventname,e.description as eventdescription,p.description as packagedescription, DATE_FORMAT(e.fromdate,'%d/%m/%Y') as fromdate, DATE_FORMAT(e.todate,'%d/%m/%Y') as todate FROM tblevents e LEFT JOIN tblpackages p ON e.eventid=p.eventid WHERE e.eventid='$eventid'";
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
echo json_encode($resortIdDetails,true);
}else {
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
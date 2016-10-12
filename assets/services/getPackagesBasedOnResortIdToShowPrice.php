<?php
include 'connectDB.php';


$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$packageid = $request->packageid;
//echo "package id is: ".$packageid."<br>";


$resortIdDetails = array();



$sql2 = "SELECT * FROM tblpackages p LEFT join tblresorts r ON p.resortid=r.resortid WHERE p.packageid='$packageid'";
//echo $sql2."<br>";
//mysqli_set_charset("utf8");
$result = mysqli_query($conn, $sql2);
//mysqli_set_charset($conn,"utf8");
if (mysqli_num_rows($result) > 0) {
    // output resortIdDetails of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        
        $resortIdDetails[] =utf8ize($row);
        //$resortIdDetails[] = ;
        //echo "id: " . $row["eventname"]."<br>";
    }
} else {
    echo "0 results";
}
//echo "amar";
//print_r($resortIdDetails);
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

mysqli_close($conn);

?>
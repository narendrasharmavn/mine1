<?php
include 'connectDB.php';

$data = array();

$sql = "SELECT * FROM tblresorts where resortid!='1' AND status=1 order by resortid desc";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $data[] = utf8ize($row);
    }
} else {
    echo "0 results";
}

echo json_encode($data);





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
<?php
  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.
  include 'connectDB.php';

  function cleanData(&$str)
  {
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    $str = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
  }

  // filename for download
  $filename = "website_data_" . date('Ymd') . ".csv";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/csv; charset=UTF-16LE");

  $out = fopen("php://output", 'w');

  $flag = false;
 $sql = "SELECT * FROM tblcustomers";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while(false !== ($row = mysqli_fetch_assoc($result))) {
		
		 if(!$flag) {
      // display field/column names as first row
      fputcsv($out, array_keys($row), ',', '"');
      $flag = true;
    }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    fputcsv($out, array_values($row), ',', '"');
	 
    }
} else {
    echo "0 results";
}


  fclose($out);
  exit;
?>
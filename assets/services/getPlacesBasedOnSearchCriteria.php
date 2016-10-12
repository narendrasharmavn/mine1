<?php


include 'connectDB.php';
$postdata = file_get_contents("php://input");

$data = array();
    $request = json_decode($postdata);
    $searchkeyword = $request->search;
	
		
		$sql = "SELECT plid,place from tblplaces WHERE status=1 AND place LIKE '%$searchkeyword%' limit 4";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$data[]= $row;
				}
			} 
		
	
echo json_encode($data,true);

?>

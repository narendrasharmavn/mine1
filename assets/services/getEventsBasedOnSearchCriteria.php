<?php


include 'connectDB.php';
$postdata = file_get_contents("php://input");


    $request = json_decode($postdata);
    $searchkeyword = $request->search;
	$searchdate = $request->searchdate;
	$data = array();
	
	if($searchdate!=null){
		$searchdate = date("Y-m-d", strtotime($searchdate));
	}
	
	
	
	//echo "search date is: ".$searchdate."<br>";
	
	if($searchdate!=''  && $searchkeyword!=''){
		
		 //echo "Server returns: " . $username.",".$email.",".$mobile; 
    
			$sql = "SELECT eventid,eventname from tblevents WHERE todate>='$searchdate' AND fromdate<='$searchdate' AND eventname LIKE '%$searchkeyword%' limit 4";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$data[]= $row;
				}
			} 
		
	}else{
		
		$sql = "SELECT eventid,eventname from tblevents WHERE eventname LIKE '%$searchkeyword%' limit 4";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$data[]= $row;
				}
			} 
		
	}
    
   





echo json_encode($data,true);

?>

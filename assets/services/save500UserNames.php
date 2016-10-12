<?php
//save500UserNames.php
include 'connectDB.php';

for($i=1;$i<600;$i++){
	
	$name = "test".$i;
	$username = "test".$i."@test.com";
	$password = hash('sha512','123');
	$number = '1234567899';
	$dateofcreation=date('Y-m-d');
	$regtype="registration";
	echo $name."<br>";
	
	
	$sql = "INSERT INTO tblcustomers (name, username, password, number,dateofcreation,regtype) VALUES ('$name', '$username', '$password', '$number','$dateofcreation','$regtype')";

if (mysqli_query($conn, $sql)) {
    echo "<br>New record created successfully<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
	
	
}
?>
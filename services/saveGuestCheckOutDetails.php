<?php
include 'connectDB.php';

$ipaddress = $_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$o = $request->o;
$usertotals = $request->usertotals;
$userselectedoptions = $request->userselectedoptions;
$userdetails = $request->userdetails;
//print_r($request);

$vendorid="";

$m = microtime(true);
$m = str_replace(".","",$m);

if($m==null || $m=='undefined' || $m==''){
  $ticketnumber = date('Ymdhis');
}else{
  $ticketnumber = $m;
}


for($i=0;$i<count($userselectedoptions);$i++){

 $packageid = $userselectedoptions[$i]->packageid;
    $sql=mysqli_query($conn,"SELECT * FROM `tblpackages` p left join tblresorts r on r.resortid=p.resortid LEFT JOIN  tblvendors v on r.vendorid=v.vendorid WHERE p.packageid='$packageid'");
    $result=mysqli_fetch_assoc($sql);
    $vendorid = $result['vendorid'];

if ($usertotals->dateofvisit!='') {
    $dateofvisit = date("Y-m-d", strtotime($usertotals->dateofvisit));
}

 
//echo "adult qty is: ".$dateofvisit."\n";

$adultqty = $userselectedoptions[$i]->adultqty;
$childqty = $userselectedoptions[$i]->childqty;

    $dt = date('Y-m-d');
    if ($adultqty!=0 || $childqty!=0) {

        $sql2 = "INSERT INTO tblbookings (date, dateofvisit, userid,quantity,booking_status,payment_status,ticketnumber,packageid,visitorstatus,vendorid,childqty,ipaddress)
            VALUES ('$dt', '$dateofvisit', '$o->customerid','$adultqty','pending','pending','$ticketnumber','$packageid','absent',$vendorid,'$childqty','$ipaddress')";

            if (mysqli_query($conn, $sql2)) {
                //echo "New record created successfully";
            } else {
                echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            }
        
        }

            



}



$tblpayments = "INSERT INTO tblpayments (customerid,totalcost,adultpriceperticket,childpriceperticket,kidsmealprice,numberofadults,numberofchildren,noofkidsmeal,servicetax,internetcharges,swachhbharath,krishkalyancess,ticketnumber,status) VALUES ('$o->customerid','$usertotals->total','$usertotals->adultprice','$usertotals->childprice','$usertotals->kidsmealprice','$usertotals->adultqty','$usertotals->childqty','$usertotals->kidsmealqty','$usertotals->internetcharges','$usertotals->internetcharges','$usertotals->swachcess','$usertotals->krishicess','$ticketnumber','unpaid')";
//echo "\nquery is: ".$tblpayments;

if($usertotals->adultprice){
        if (mysqli_query($conn, $tblpayments)) {
            //echo "New record created successfully";
           // echo "\nquery is: ".$tblpayments;
        } else {
            echo "Error: " . $tblpayments . "<br>" . mysqli_error($conn);
        }
       

}

$dataStatus = array(
    'ticketnumber'=>$ticketnumber,
    'name'=>$userdetails->name,
    'email'=>$userdetails->email,
    'mobile'=>$userdetails->mobile,
    'total'=>$usertotals->total,
    'customerid'=>$o->customerid


);

echo json_encode($dataStatus,true);

mysqli_close($conn);
?>
<?php
include 'connectDB.php';



$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$o = $request->o;
$usertotals = $request->usertotals;
$userselectedoptions = $request->userselectedoptions;
$userdetails = $request->userdetails;
//print_r($request);

$vendorid="";

$ticketnumber=date('Ymdhisu');
for($i=0;$i<count($userselectedoptions);$i++){

 $packageid = $userselectedoptions[$i]->packageid;
    $sql=mysqli_query($conn,"SELECT * FROM `tblpackages` p left join tblresorts r on r.resortid=p.resortid LEFT JOIN  tblvendors v on r.vendorid=v.vendorid WHERE p.packageid='$packageid'");
    $result=mysqli_fetch_assoc($sql);
    $vendorid = $result['vendorid'];


 $dateofvisit = date("Y-m-d", strtotime($usertotals->dateofvisit));
//echo "adult qty is: ".$dateofvisit."\n";

$adultqty = $userselectedoptions[$i]->adultqty;
$childqty = $userselectedoptions[$i]->childqty;


    if ($adultqty!=0 || $childqty!=0) {

       

        $sql2 = "INSERT INTO tblbookings (date, dateofvisit, userid,quantity,booking_status,payment_status,ticketnumber,packageid,visitorstatus,vendorid,childqty)
            VALUES ('Y-m-d', '$dateofvisit', '$o->customerid','$adultqty','pending','pending','$ticketnumber','$packageid','absent',$vendorid,'$childqty')";

            if (mysqli_query($conn, $sql2)) {
                //echo "New record created successfully";
            } else {
                echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            }
        
        }

            



}



$tblpayments = "INSERT INTO tblpayments (customerid,totalcost,adultpriceperticket,childpriceperticket,kidsmealprice,numberofadults,numberofchildren,noofkidsmeal,servicetax,internetcharges,swachhbharath,krishkalyancess,ticketnumber,status) VALUES ('$o->customerid','$usertotals->total','$usertotals->adultprice','$usertotals->childprice','0','$usertotals->adultqty','$usertotals->childqty','0','$usertotals->servicetax','$usertotals->internetcharges','$usertotals->swachcess','$usertotals->krishicess','$ticketnumber','unpaid')";
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
    'customerid'=>$o->customerid,
    'vendorid '=>$vendorid


);

echo json_encode($dataStatus,true);

mysqli_close($conn);
?>
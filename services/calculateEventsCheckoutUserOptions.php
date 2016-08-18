<?php
include 'connectDB.php';



$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$dateofvisit = $request->dateofvisit;
$dateofvisit = date("d-m-Y", strtotime($dateofvisit));
$userselectedoptions = $request->userselectedoptions;
//echo "kidsmealqty : ".$kidsmealqty."<br>";
//echo "this is:".$request->obj[0]->packageid."\n";
//print_r($request);

$adultqty=0;
$childqty=0;
$adultticketprice=0;
$childticketprice=0;
$kidmealprice=0;
$internetcharges=0;
$servicetax=0;
$swachcess=0;
$krishicess=0;
$kidmealtax=0;
$total=0;
$vendorid=0;
 $sql1=mysqli_query($conn,"SELECT * FROM taxmaster");
    $result1=mysqli_fetch_assoc($sql1);

for($i=0;$i<count($userselectedoptions);$i++){

    $packageid = $userselectedoptions[$i]->packageid;
    $adultqty = $userselectedoptions[$i]->adultqty;
    $childqty = $userselectedoptions[$i]->childqty;
    //echo "adult qty is: ".$adultqty."\n";

    $sql=mysqli_query($conn,"SELECT * FROM `tblpackages` p left join tblevents e on p.eventid=e.eventid LEFT JOIN  tblvendors v on e.vendorid=v.vendorid WHERE p.packageid='$packageid'");
    //echo "SELECT * FROM `tblpackages` p left join tblevents e on p.eventid=e.eventid LEFT JOIN  tblvendors v on e.vendorid=v.vendorid WHERE p.packageid='$packageid'";
    $result=mysqli_fetch_assoc($sql);
    
    $adultticketprice = $adultqty * $result['adultprice'];
    $childticketprice = $childqty * $result['childprice'];
    $internetcharges = ($adultticketprice + $childticketprice) * ($result['servicetax'] / 100);
    $vendorid = $result['vendorid'];

}

$subtotaltax = $internetcharges;
$servicetax = $internetcharges * ($result1['servicetax'] / 100);
$servicetax = round($servicetax,1);
$swachcess = $internetcharges * ($result1['swachcess'] / 100);
$swachcess = round($swachcess,1);
$krishicess = $internetcharges * ($result1['krishicess'] / 100);
$krishicess = round($krishicess,1);
$totaltax = $subtotaltax + $servicetax + $swachcess + $krishicess;
$total = $adultticketprice + $childticketprice + $internetcharges + $servicetax + $swachcess + $krishicess;
$total = round($total,2);
//echo "adultticketprice ".$adultticketprice."\n"."childticketprice ".$childticketprice."\n";
//echo "internetcharges:".$internetcharges."\nservice tax :".$servicetax."\n swachcess: ".$swachcess."\n krishicess:".$krishicess."\n";




   $calculatedTotal = array(
    "adultqty"  => $adultqty,
    "adultprice"  => $adultticketprice,
    "childqty"  => $childqty,
    "childprice"  => $childticketprice,
    "internetcharges"  => $totaltax,
    "internetchargeswithouttotal"  => $subtotaltax,
    "servicetax"  => $servicetax,
    "swachcess"  => $swachcess,
    "krishicess" => $krishicess,
    "total" => $total,
    "vendorid" => $vendorid,
    "dateofvisit" => $dateofvisit
);




echo json_encode($calculatedTotal,true);




mysqli_close($conn);




?>
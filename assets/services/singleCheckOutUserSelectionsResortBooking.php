<?php
include 'connectDB.php';



$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$dateofvisit = $request->dateofvisit;

$dateofvisit = date("Y-m-d", strtotime($dateofvisit));

//echo "this is:".$request->obj[0]->packageid."\n";
$adultqty=0;
$childqty=0;
$adultticketprice=0;
$childticketprice=0;
$kidmealprice=0;
$internetcharges=0;
$servicecharges=0;
$swachcess=0;
$krishicess=0;
$kidmealtax=0;
$total=0;
$vendorid=0;
 $sql1=mysqli_query($conn,"SELECT * FROM taxmaster");
    $result1=mysqli_fetch_assoc($sql1);
for($i=0;$i<count($request->obj);$i++){

    $packageid = $request->obj[$i]->packageid;
    $sql=mysqli_query($conn,"SELECT * FROM `tblpackages` p left join tblresorts r on r.resortid=p.resortid LEFT JOIN  tblvendors v on r.vendorid=v.vendorid WHERE p.packageid='$packageid'");
    $result=mysqli_fetch_assoc($sql);
    $adultqty =  $adultqty + $request->obj[$i]->adultqty;
    $childqty = $childqty + $request->obj[$i]->childqty;
    $adultticketprice = $adultticketprice + $request->obj[$i]->adultqty * $result['adultprice'];
    $childticketprice = $childticketprice + $request->obj[$i]->childqty * $result['childprice'];
    $internetcharges += ($adultticketprice + $childticketprice) * ($result['servicetax'] / 100);
    $vendorid = $result['vendorid'];
}
    $sql3=mysqli_query($conn,"SELECT * FROM tblvendors WHERE vendorid='$vendorid'");
    $result3=mysqli_fetch_assoc($sql3);
 
  
    $servicecharges = $internetcharges * ($result1['servicetax'] / 100);
    $servicecharges = round($servicecharges,2);
    $swachcess = $internetcharges * ($result1['swachcess']/100);

    $swachcess = round($swachcess,2);
    $swachcess = sprintf("%.2f", $swachcess);

    $krishicess = $internetcharges * ($result1['krishicess']/100);
    $krishicess = round($krishicess,2);
    $krishicess = sprintf("%.2f", $krishicess);
    
    $totaltax = $internetcharges + $servicecharges + $swachcess + $krishicess;
    $total = $adultticketprice + $childticketprice + $kidmealprice + $totaltax;
    $total = round($total,2);
    //echo "\n Adult Qty : ".$adultqty."\n Child Qty : ".$childqty."\n  Adult Ticket Price : ".$adultticketprice."\n Child Ticket Price : ".$childticketprice;
    
   //echo "\n internetcharges ".$internetcharges."\n swachcess : ".$swachcess."\n krishicess : ".$krishicess."\n Total : ".$total;

    $adultticketprice = sprintf(round($adultticketprice , 2) == intval($adultticketprice ) ? "%.2f" : "%.2f", $adultticketprice );

    $childticketprice = sprintf(round($childticketprice , 2) == intval($childticketprice ) ? "%.2f" : "%.2f", $childticketprice );


   $calculatedTotal = array(
    "adultqty"  => $adultqty,
    "adultprice"  => $adultticketprice,
    "childqty"  => $childqty,
    "childprice"  => $childticketprice,
    "dateofvisit"  => $dateofvisit,
    "internetcharges"  => $internetcharges,
    "totaltax"  => $totaltax ,
    "servicetax"  => $servicecharges,
    "swachcess"  => $swachcess,
    "krishicess" => $krishicess,
    "total" => $total,
    "vendorid" => $vendorid
);




echo json_encode($calculatedTotal,true);


mysqli_close($conn);

?>
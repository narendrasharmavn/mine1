<?php
include 'connectDB.php';

error_reporting(0);

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$kidsmealqty = $request->kidsmealqty;
$dateofvisit = $request->dateofvisit;
//echo "kidsmealqty : ".$kidsmealqty."<br>";
//echo "this is:".$request->obj[0]->packageid."\n";
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

//print_r($request);
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

    //echo "vendorid id is: ".$vendorid."\n";


}
    $sql3=mysqli_query($conn,"SELECT * FROM tblvendors WHERE vendorid='$vendorid'");
    //echo "SELECT * FROM tblvendors WHERE vendorid='$vendorid'\n";
    $result3=mysqli_fetch_assoc($sql3);
    $kidmealprice = $kidsmealqty * $result3['kidsmealprice'];
    //echo "kidsmeal price is: ".$kidmealprice."\n";
    //echo "kidsmeal price from database: ".$result3['kidsmealprice']."\n";
    $kidmealtax = $kidmealprice * ($result1['kidsmealtax'] / 100);
   
    $kidmealtax = sprintf(round($kidmealtax , 2) == intval($kidmealtax ) ? "%.2f" : "%.2f", $kidmealtax );
     $subtotaltax= $internetcharges + $kidmealtax;
    $subtotaltax= sprintf(round($subtotaltax, 2) == intval($subtotaltax) ? "%.2f" : "%.2f", $subtotaltax);
    
    $servicetax = $subtotaltax * ($result1['servicetax'] / 100);
    $servicetax = sprintf(round($servicetax , 2) == intval($servicetax ) ? "%.2f" : "%.2f", $servicetax );
    $swachcess = $subtotaltax * ($result1['swachcess']/100);
    $swachcess = sprintf(round($swachcess , 2) == intval($swachcess ) ? "%.2f" : "%.2f", $swachcess );
    $krishicess = $subtotaltax * ($result1['krishicess']/100);
    
     $krishicess = sprintf(round($krishicess , 2) == intval($krishicess ) ? "%.2f" : "%.2f", $krishicess );
    $totaltax= $subtotaltax + $servicetax + $swachcess + $krishicess;
    $totaltax = sprintf(round($totaltax  , 2) == intval($totaltax ) ? "%.2f" : "%.2f", $totaltax );
    $total = $adultticketprice + $childticketprice + $kidmealprice + $totaltax;
     $total = sprintf(round($total , 2) == intval($total ) ? "%.2f" : "%.2f", $total );
    //echo "\n Adult Qty : ".$adultqty."\n Child Qty : ".$childqty."\n Kid Meal Qty : ".$kidsmealqty."\n  Adult Ticket Price : ".$adultticketprice."\n Chicd Ticket Price : ".$childticketprice."\n kidmealprice : ".$kidmealprice;
    //echo "\n kidmealtax ".$kidmealtax;
   //echo "\n internetcharges ".$servicecharges."\n swachcess : ".$swachcess."\n krishicess : ".$krishicess."\n Total : ".$total;


   $calculatedTotal = array(
    "adultqty"  => $adultqty,
    "adultprice"  => $adultticketprice,
    "childqty"  => $childqty,
    "childprice"  => $childticketprice,
    "kidsmealqty"  => $kidsmealqty,
    "kidsmealprice"  => $kidmealprice,
    "internetcharges"  => $totaltax,
    "internetchargeswithouttotal"  => $subtotaltax,
    "servicetax"  => $servicetax,
    "swachcess"  => $swachcess,
    "krishicess" => $krishicess,
    "total" => $total
);




echo json_encode($calculatedTotal,true);


mysqli_close($conn);

?>
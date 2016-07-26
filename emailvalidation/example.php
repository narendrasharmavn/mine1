<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'verify.class.php';

$useremail = $_POST["useremail"];

//echo $useremail."<br>";

$ve = new VE\VerifyEmail($useremail, 'amar@fornextit.com');

var_dump($ve->verify());

//echo '<pre>';print_r($ve->get_debug());


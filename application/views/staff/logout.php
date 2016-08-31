<?php
session_start();
// remove all session variables
session_destroy();

header("Location:login");	
?>
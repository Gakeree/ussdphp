<?php
// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber =  $_POST["PhoneNumber"];
$text        = $_POST["text"];
include "functions.php";
 

if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "CON What would you want to do ?\n";
    $response .= "1. My Account \n";
    $response .= "2. Make Payment";

} else if ($text == "1") {
    // Business logic for first level response
    $response = "CON Choose account information you want to view \n";
    $response .= "1. Account number \n";

} else if ($text == "2") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
    $amount= "2"; 
    $response = makePayment($amount, $phoneNumber, $sessionId);
    $response = "END payment has been initiated";

} else if($text == "1*1") { 
    // This is a second level response where the user selected 1 in the first instance
    $accountNumber  = "ACC1001";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your account number is ".$accountNumber;

}

// Echo the response back to the API
header('Content-type: text/plain');
echo $response;
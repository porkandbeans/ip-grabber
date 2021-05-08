<?php

/*

    allow me to preface this by saying I'm in no way suggesting this code
    should be used for malicious intent. I believe in open source and I
    want as many people to see how I write code as possible for employment
    opportunities.

    this is just something I made while I was bored.

    I often use an IP grabber to snoop on TF2 scammers who send me
    friend requests and want to steal my extremely valuable hats, and I figured
    it would be a good exercise to try writing one of these to understand how they
    work and what sort of information I can gather about someone by getting them
    to simply click on a link.

    The "IP-grabber" is, to put it simply, just that - it grabs an IP address.
    The target clicks on a link expecting it to lead them to a funny meme
    or a YouTube video, but behind the scenes, they are clicking on a link to a third-party
    site that writes down a lot of information, including:
        -Their IP address
        -What country they live in
        -Browser information
        -other spooky things they probably wouldn't have freely given out to the person sending them the link
    
    and after doing all that, it sends the user to their requested location.

*/


// anyone who might fall for this may not exactly be the most tech-literate
// person in the world, however, we should prepare for an eventuality where
// the GET data has been removed
if (!isset($_GET["url"])){
    die();
}


// assign target's destination
$targetDest = $_GET["url"];

// call this if something bad happens
function abortAbortAbort(){
    echo "DEBUG";
    die();
}

$fileName = $_SERVER["REMOTE_ADDR"] . " - " . time();

$logFile = fopen($fileName, "w");
fwrite($logFile, "testicles");

$agent = $_SERVER["HTTP_USER_AGENT"];

if(str_ends_with($agent, "Firefox/78.0")){
    echo "This could be GNU icecat, unless it has been updated - May 08 2021<br>";
    echo $agent;
}else{
    echo $agent;
}

echo "<br>";
echo "IP Address: " . $_SERVER["REMOTE_ADDR"];


/*
// according to this stackoverflow question:
// https://stackoverflow.com/questions/3003145/how-to-get-the-client-ip-address-in-php
// $_SERVER["REMOTE_ADDR"] is the global I'm looking for here
$logFile = fopen($_SERVER["REMOTE_ADDR"], "w") or abortAbortAbort();
fwrite($logFile, get_browser());

*/
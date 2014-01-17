<?php
// This script is ment to be ran from the backend.
mysql_connect("localhost","root","");
mysql_select_db("BBCDJ");

$options = getopt("u:");
$OrigURL = $options['u'];
$ListOfURLs = shell_exec("phantomjs /var/www/bbcdj/getmonths.js $OrigURL");
$DID = explode("/", $OrigURL)[count(explode("/", $OrigURL)) - 4];
mysql_query("INSERT INTO `DJList` (`DJID`, `Friendly Name`) VALUES ('$DID', 'Insert Name');");

print_r($ListOfURLs);
$MonthURLs =  explode("\n", $ListOfURLs);
$Shows = array();
$inc = 0;
foreach($MonthURLs as $MthURL)
{
 	// echo(shell_exec("phantomjs /var/www/bbcdj/BBCEpListing.js $MthURL"));
 	if($MthURL."" != "")
 	{
		$Eps = json_decode(shell_exec("phantomjs /var/www/bbcdj/BBCEpListing.js $MthURL"));
		print_r($Eps);
		foreach ($Eps as $key => $value) {
			$Shows[$inc] = $value;
			$DID = explode("/", $MthURL)[count(explode("/", $MthURL)) - 4];
			$SID = explode("/", $value)[count(explode("/", $value)) - 1];
			mysql_query("INSERT INTO `Shows` (`ShowID`, `DJ`, `HasBeenCrawled`) VALUES ('$SID', '$DID', b'1');");
			$inc++;
		}
	}
}

// Okay so we have the shows now. Lets get started.

foreach ($Shows as $showurl) {
	if($showurl."" != "")
	{
		$a = json_decode(shell_exec("phantomjs /var/www/bbcdj/BBCTrackListing.js $showurl"));
		$SID = explode("/", $showurl)[count(explode("/", $showurl)) - 1];
		foreach ($a as $key => $value) {
			mysql_query("INSERT INTO `Songs` (`ShowID`, `Artist`, `Track`) VALUES ('$SID', '".mysql_real_escape_string($value->artist)."', '".mysql_real_escape_string($value->track)."');");
		}
	}
}
<?php
mysql_connect("localhost","root","");
mysql_select_db("BGP");


while(true)
{

$Q = mysql_query("SELECT * FROM `BGPQue` ORDER BY AppearCount DESC LIMIT 1");
$D = mysql_fetch_array($Q);

$Output = json_decode(shell_exec("phantomjs /tmp/BGPZones.js " . $D[0]));
foreach($Output as $ASNode)
{
	mysql_query("INSERT INTO `BGPLinks` (`OrigAS`, `LinkAS`, `LinkASName`) VALUES ('".mysql_real_escape_string($D[0])."', '".mysql_real_escape_string($ASNode->AS)."', '".mysql_real_escape_string($ASNode->name)."');");
	$Count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `BGPQue` WHERE ASName = '".mysql_real_escape_string($ASNode->AS)."'"));
	$Count2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `BGPLinks` WHERE OrigAS = '".mysql_real_escape_string($ASNode->AS)."'"));
	if($Count[0] == 0 && $Count2[0] == 0)
		mysql_query("INSERT INTO `BGPQue` (`ASName`, `AppearCount`) VALUES ('".mysql_real_escape_string($ASNode->AS)."', 0);");
	else
		mysql_query("UPDATE `BGPQue` SET `AppearCount` = `AppearCount`+1 WHERE `ASName` = '".mysql_real_escape_string($ASNode->AS)."'");

}

mysql_query("DELETE FROM `BGPQue` WHERE ASName = '".mysql_real_escape_string($D[0])."'");

//var_dump($Output);
//var_dump($D);
//break;
sleep(1.5 * rand(1,10));
echo("Done: " . $D[0] . " S: " . $D[1] . "\n");

}

<?php


// exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $outputfile, $pidfile));

// www.bbc.co.uk/programmes/b01d76m6


if(isset($_GET['url']))
{
	if(isset($_GET['p']))
	{
		shell_exec(sprintf("%s > %s 2>&1 & echo $! >> %s", "php /var/www/bbcdj/NewDJSystem.php -u " . $_GET['url'], "/tmp/shit.txt", "/tmp/crawl.pid"));
http://www.bbc.co.uk/programmes/b0072lbw/broadcasts/2013/08
	}
	else
	{
		die("pls add pwd");
	}
}
else
{
	die("no url submitted.");
}
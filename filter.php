<?php
$handle = fopen("episodedata.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $json = json_decode($line);
	//print_r($json);
	if($json)
	{
		foreach($json as $k => $v)
		{
			echo(json_encode($v) . "\n");
		}
	}
    }
} else {
    // error opening the file.
}

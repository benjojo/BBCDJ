<?php
mysql_connect("localhost","root","");
mysql_select_db("BBCDJ");
if(isset($_GET['i']))
{
  $q = mysql_query("SELECT * FROM Songs WHERE ShowID = '".mysql_real_escape_string($_GET['i'])."'");
}
else
{
  die("Pick a show you silly.");
}
?>
<html>
<head>
	<title>Hi I'm BBC</title>
</head>
<body>
<h1>You have selected the Ep ID:</h1><br>

<table border="1">
  
    <td width="50%"><ul>Artist</ul></td>
    <td>Track</td>
    <td>YT Link</td>
  </tr>
  <?php
  
  while($row = mysql_fetch_array($q))
  {
    $YT = "";
    if($row[4]."" == "")
    {
      // We need to get the youtube data for this thing.
      $API_D = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=5&order=relevance&q=".urlencode( $row[2] . ":" . $row[3] )."&key=" . file_get_contents("./apikey") );
      $data = json_decode($API_D);
      mysql_query("UPDATE `Songs` SET `YTData`='".mysql_real_escape_string(json_encode($data->items))."' WHERE  `SID`=".$row[0].";");
      $YT = $data->items;
      $YT = $YT[0];
      // a
    }
    else
    {
      $YT = json_decode($row[4]);
      $YT = $YT[0];
    }
  	?>
    <tr>
    <td width="50%"><?php echo $row[2]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><a href="https://www.youtube.com/watch?v=<?php echo $YT->id->videoId; ?>">Link</a></td>
  </tr>
  	<?php
  }
  ?>
</table>

<form type="POST" action="./newshow.php">
<input type="text" name="url" placeholder="To add a show put it in here." style="width:50%">
<input type="submit">
</form>

</body>

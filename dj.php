<?php
mysql_connect("localhost","root","");
mysql_select_db("BBCDJ");
if(isset($_GET['s']))
{
  $q = mysql_query("SELECT * FROM Shows WHERE `DJ` = '".mysql_real_escape_string($_GET['s'])."'");
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
<h1>You have selected the show ID:</h1><br>

<table border="1">
  
    <td width="50%"><ul>Show ID</ul></td>
    <td>Link</td>
  </tr>
  <?php
  
  while($row = mysql_fetch_array($q))
  {
  	?>
    <tr>
    <td width="50%"><?php echo $row[0]; ?></td>
    <td><a href="show.php?i=<?php echo $row[0]; ?>">Click To View</a></td>
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
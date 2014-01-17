<?php
mysql_connect("localhost","root","");
mysql_select_db("BBCDJ");

?>
<html>
<head>
	<title>Hi I'm BBC</title>
</head>
<body>
<h1>Hi I am BBC, Please Select a show:</h1><br>

<table border="1">
  
    <td width="50%"><ul>DJ Name</ul></td>
    <td>Link</td>
  </tr>
  <?php
  $q = mysql_query("SELECT * FROM `DJList`");
  while($row = mysql_fetch_array($q))
  {
  	?>
    <tr>
    <td width="50%"><?php echo $row[1]; ?></td>
    <td><a href="dj.php?s=<?php echo $row[0]; ?>">Show</a></td>
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
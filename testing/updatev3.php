<?php
require ("config.php");
if(isset($_POST['update']))
{
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$username = $_POST['username'];
$email = $_POST['email'];
$uid =$_POST['uid'];

$sql = "UPDATE users 
       SET email = '$email',
	   uid = '$uid' 
       WHERE username = '$username'";
	   
mysql_select_db('unipay');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
echo "Updated data successfully\n";
mysql_close($conn);
}
else
{
?>
<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">
<tr>
<td width="100">Username</td>
<td><input name="username" type="text" id="username"></td>
</tr>
<tr>
<td width="100">New Email</td>
<td><input name="email" type="text" id="email"></td>
</tr>
<tr>
<td width="100">New UID</td>
<td><input name="uid" type="text" id="uid"></td>
</tr>
<tr>
<td width="100"> </td>
<td> </td>
</tr>
<tr>
<td width="100"> </td>
<td>
<input name="update" type="submit" id="update" value="Update">
</td>
</tr>
</table>
</form>
<?php
}
?>
</body>
</html>
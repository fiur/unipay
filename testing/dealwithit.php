<?php
require('config.php');
$cardno = $_REQUEST['cardno'];

$query = mysql_query("SELECT * FROM transactions WHERE cardno = '$cardno'");

$info=mysql_fetch_array($query);

print $info['*'];

?>

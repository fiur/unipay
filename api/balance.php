<?php require('config.php');
$username = $_REQUEST['username'];

$login_ok = false;



$result = mysql_query("SELECT id FROM users WHERE username = '$username'");
if(mysql_num_rows($result) == 0) {
     echo "N";
} else {
 $sql = mysql_query("SELECT balance FROM users WHERE username = '$username'");
 $info = mysql_fetch_array($sql);
 echo $info['balance'];
    }
    ?>

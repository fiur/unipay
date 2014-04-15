<?php
 
if(isset($_GET['format']) &amp;amp;amp;amp;&amp;amp;amp;amp; intval($_GET['num'])) {
 
//Set our variables
	 = strtolower($_GET['username']);
$num = intval($_GET['balance']);
 
//Connect to the Database
$con = mysql_connect('localhost', 'root', 'stefan') or die ('MySQL Error.');
mysql_select_db('users', $con) or die('MySQL Error.');
 
//Run our query
$result = mysql_query('SELECT * FROM users ORDER BY `id` DESC LIMIT ' . $num, $con) or die('MySQL Error.');
 
//Preapre our output
if($format == 'json') {
 
$recipes = array();
while($recipe = mysql_fetch_array($result, MYSQL_ASSOC)) {
$recipes[] = array('post'=>$recipe);
}
 
$output = json_encode(array('posts' => $recipes));
 
} elseif($format == 'xml') {
 
header('Content-type: text/xml');
$outputÂ  = "<?xml version=\"1.0\"?>\n";
$output .= "<user>\n";
 
for($i = 0 ; $i < mysql_num_rows($result) ; $i++){
$row = mysql_fetch_assoc($result);
$output .= "<username> \n";
$output .= "<id>" . $row['id'] . "</id> \n";
$output .= "<uid>" . $row['uid'] . "</uid> \n";
$output .= "<balance>" . $row['balance'] . "</balance> \n";
}
 
$output .= "</user>";
 
} else {
die('Improper response format.');
}
 
//Output the output.
echo $output;
 
}
 
?>
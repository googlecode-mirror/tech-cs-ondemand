<?php /*

THIS IS COMPLETELY A TEST FILE IN WHICH I TEST JQUERY FX, GET FRUSTRATED, AND RAGEQUIT -- ONLY TO COME BACK AFTER A NICE STRESS-RELIEVING ACTIVITY (LIKE WRITING THIS UNNECESSARY COMMENT) TO SEE THE SOLUTION WITH A SERENDIPITOUS CLAIRVOYANCE

*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>TESTER</title>
<style type="text/css">

p
{
	margin:0;
	padding:0;
}

div
{
	width:500px;
	height:500px;
	background-color:red;
}

</style>
<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
	$(document).click(function()
	{
		$("div").toggle(4000);
	});
});

</script>
</head>
<body>

<?php

require("scripts/OnDemandServices.php");

connectToDb();

// ClassCollection
echo '<h1>ClassCollection</h1>';
$q = mysql_query("SELECT * FROM `ClassCollection`");
echo '<table border="1" cellpadding="2" cellspacing="0">';

echo '<tr>';
echo '<td><b>classid</b></td>';
echo '<td><b>title</b></td>';
echo '<td><b>description</b></td>';
echo '<td><b>subject</b></td>';
echo '<td><b>number</b></td>';
echo '</tr>';

while ($r = mysql_fetch_array($q))
{
	echo '<tr>';
	echo '<td>' . $r['classid'] . '</td>';
	echo '<td>' . $r['title'] . '</td>';
	echo '<td>' . $r['description'] . '</td>';
	echo '<td>' . $r['subject'] . '</td>';
	echo '<td>' . $r['number'] . '</td>';
	echo '</tr>';
}
echo '</table>';

// PostCollection1332
echo '<h1>PostCollection1332</h1>';
$q = mysql_query("SELECT * FROM `PostCollection1332`");
echo '<table border="1" cellpadding="2" cellspacing="0">';

echo '<tr>';
echo '<td><b>postid</b></td>';
echo '<td><b>taid</b></td>';
echo '<td><b>title</b></td>';
echo '<td><b>description</b></td>';
echo '<td><b>created</b></td>';
echo '<td><b>timestamp</b></td>';
echo '<td><b>tag</b></td>';
echo '</tr>';

while ($r = mysql_fetch_array($q))
{
	echo '<tr>';
	echo '<td>' . $r['postid'] . '</td>';
	echo '<td>' . $r['taid'] . '</td>';
	echo '<td>' . $r['title'] . '</td>';
	echo '<td>' . $r['description'] . '</td>';
	echo '<td>' . $r['created'] . '</td>';
	echo '<td>' . $r['timestamp'] . '</td>';
	echo '<td>' . $r['tag'] . '</td>';
	echo '</tr>';
}
echo '</table>';

// TaCollection
echo '<h1>TaCollection</h1>';
$q = mysql_query("SELECT * FROM `TaCollection`");
echo '<table border="1" cellpadding="2" cellspacing="0">';

echo '<tr>';
echo '<td><b>taid</b></td>';
echo '<td><b>classid</b></td>';
echo '<td><b>name</b></td>';
echo '<td><b>email</b></td>';
echo '<td><b>password</b></td>';
echo '<td><b>active</b></td>';
echo '<td><b>admin</b></td>';
echo '<td><b>info</b></td>';
echo '</tr>';

while ($r = mysql_fetch_array($q))
{
	echo '<tr>';
	echo '<td>' . $r['taid'] . '</td>';
	echo '<td>' . $r['classid'] . '</td>';
	echo '<td>' . $r['name'] . '</td>';
	echo '<td>' . $r['email'] . '</td>';
	echo '<td>' . $r['password'] . '</td>';
	echo '<td>' . $r['active'] . '</td>';
	echo '<td>' . $r['admin'] . '</td>';
	echo '<td>' . $r['info'] . '</td>';
	echo '</tr>';
}
echo '</table>';

?>

</body>
</html>

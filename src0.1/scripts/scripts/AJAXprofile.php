<?php

require("OnDemandServices.php");

connectToDB();
$QUERY = mysql_fetch_array(mysql_query(sprintf("SELECT * FROM `tacollection` WHERE `taid`=%s",$_GET['id'])));

$class_query = mysql_fetch_array(mysql_query(sprintf("SELECT * FROM `classcollection` WHERE `classid`=%s",$QUERY['classid'])));
$classId = $class_query['subject'] . ' ' . $class_query['number'];

$delim = '<delim>';
echo $classId . $delim . $QUERY['name'] . $delim . $QUERY['email'] . $delim . $QUERY['admin'] . $delim . $QUERY['info'];

?>
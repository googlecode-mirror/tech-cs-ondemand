<?php
	include_once "scripts/OnDemandServices.php";
	session_cache_limiter('nocache');
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<?php
	$meta_description = "Tech OnDemand is an open repository of academic resources aimed to educate anyone who is interested in the various technical topics offered at the Georgia Institute of Technology.";
	
	echo '<meta name="description" content="'.$meta_description.'" />';
	
	connectToDb();
	if (isset($_GET['pid'])) // post.php
	{
		$Q = mysql_query("SELECT * FROM `PostCollection1332` WHERE `postid`=".$_GET['pid']);
		$Q = mysql_fetch_array($Q);
		$Q = $Q['title'];
	}
	else if (isset($_GET['cid'])) // class.php
	{
		$Q = mysql_query("SELECT * FROM `ClassCollection` WHERE `classid`=".$_GET['cid']);
		$Q = mysql_fetch_array($Q);
		$Q = $Q['subject'] .' '. $Q['number'] .': '. $Q['title'];
	}
	else // index.php & al (no GET vars)
	{
		$Q = "Tech OnDemand";
	}
	
	echo '<meta property="og:title" content="'.addslashes($Q).'" />';
	echo '<meta property="og:description" content="'.$meta_description.'" />';
?>
	<meta property="og:image" content="http://www.tech-ondemand.com/images/square.jpg" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

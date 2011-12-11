</head>
<body onload="bgCheck();">
<div id="bg" onclick="bgSwitch();"></div>
<div id="mainFrame">

<?php

// LOGIN BUSINESS

if (isset($_POST['login_email']))
{
	$query = sprintf('SELECT * FROM `tacollection` WHERE `email`="%s"',mysql_real_escape_string($_POST['login_email']));
	$QUERY = mysql_fetch_array(mysql_query($query));
	//$salt = substr($_POST['login_email'],0,strpos($_POST['login_email'],'@'));
	/*
	$QUERY = mysql_fetch_row($QUERY);
	if (md5(md5($_POST['login_password']) . $salt) == md5(md5($QUERY['password']) . $salt))
	{
		$_SESSION['user'] = new OdTA($QUERY['taid'], $QUERY['classid'], $QUERY['name'], $QUERY['email'], md5(md5($QUERY['password']) . $salt), $QUERY['active'], $QUERY['admin'], $QUERY['info'], $QUERY['picture']);
		
		unset($_POST['login_email']);
		unset($_POST['login_password']);
	}
	else // bad login
	{
		
	
	}*/
}


?>
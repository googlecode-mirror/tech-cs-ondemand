</head>
<body onload="bgCheck();">
<div id="bg" onclick="bgSwitch();"></div>
<div id="mainFrame">

<?php

// LOGIN BUSINESS
if (isset($_POST['login_email']))
{
	connectToDB();
	
	$email = mysql_real_escape_string($_POST['login_email']);
	$password = mysql_real_escape_string($_POST['login_password']);
	
	$query = sprintf('SELECT * FROM `TaCollection` WHERE `email`="%s"',$email);
	$QUERY = mysql_fetch_array(mysql_query($query));
	
	$salt = substr($email,0,strpos($email,'@'));

	if (md5(md5($password) . $salt) == $QUERY['password'])
	{
		$_SESSION['user'] = new OdTA($QUERY['taid'], $QUERY['classid'], $QUERY['name'], $QUERY['email'], $QUERY['password'], $QUERY['active'], $QUERY['admin'], $QUERY['info'], $QUERY['picture']);
	}
	else // bad login
	{
		echo '<script type="text/javascript">';
		echo '$(document).ready(function(){';
		if (isset($_GET['pid']))
			echo 'popUp("login",'.$_GET['cid'].','.$_GET['pid'].',"'.$_POST['login_email'].'","Invalid username/password combination");';
		else
			echo 'popUp("login",'.$_GET['cid'].',null,"'.$_POST['login_email'].'","Invalid username/password combination");';
		echo '});';
		echo '</script>';
	}
}


?>

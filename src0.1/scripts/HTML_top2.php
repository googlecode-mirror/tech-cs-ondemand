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

	if (md5(md5($password) . $salt) == $QUERY['password'] && $QUERY['active'] == '1')
	{
		$_SESSION['user'] = new OdTA($QUERY['taid'], $QUERY['classid'], $QUERY['name'], $QUERY['email'], $QUERY['password'], $QUERY['active'], $QUERY['admin'], $QUERY['info'], $QUERY['picture']);
	}
	else // bad login
	{
		$errorMsg = "";
		if ($QUERY['active'] == '0')
			$errorMsg = "This account is currently not active";
		else
			$errorMsg = "Invalid username/password combination";
	
		echo '<script type="text/javascript">';
		echo '$(document).ready(function(){';
		echo 'popUp("login",'.$_GET['cid'].',null,"'.$_POST['login_email'].'","'.$errorMsg.'");';
		echo '});';
		echo '</script>';
	}
}

// UPDATE PROFILE BUSINESS
if (isset($_POST['profile_name']))
{
	connectToDB();
	
	mysql_query(sprintf("UPDATE `TaCollection` SET `name`='%s',`info`='%s' WHERE `TaCollection`.`taid`=%d",addslashes($_POST['profile_name']),addslashes($_POST['profile_info']),$_SESSION['user']->getId()));

	if ($_FILES['profile_tapic']['type'] == 'image/jpeg' && $_FILES['profile_tapic']['size'] < 50000)
		move_uploaded_file($_FILES['profile_tapic']['tmp_name'], "TApics/" . $_SESSION['user']->getId() . ".jpg");
}

?>

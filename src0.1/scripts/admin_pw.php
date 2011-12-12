<?php require("HTML_top1.php"); ?>

<title>Admin &gt;&gt; ON DEMAND</title>
<?php
	require("styles.php");
	require("scripts.php");
?>

<?php require("HTML_top2.php"); ?>

<?php
	$class = getClassById($_GET["cid"]);
	require("topBar.php");
?>

<p class="b cen">Change password</p>

<table border="0" cellpadding="0" cellspacing="0" class="cen">
<form action="" method="post">

<tr>
<td width="100" class="left">Old Password:</td>
<td><input type="password" name="old" size="15" /></td>
</tr>

<tr>
<td class="left">New Password:</td>
<td><input type="password" name="new" size="15" /></td>
</tr>

<tr>
<td class="left">Confirm:</td>
<td><input type="password" name="confirm" size="15" /></td>
</tr>

<tr>
<td></td>
<td class="left"><input type="submit" name="submit" id="changePasswordButton" value="Change Password" /></td>
</tr>

</form>
</table>

<?php

if (isset($_POST["submit"]))
{
	if (strlen($_POST['old']) == 0)
		err("One or more fields blank");
	else if (strlen($_POST['new']) == 0 || strlen($_POST['confirm']) == 0)
		err("One or more fields blank");
	else if (md5(md5($_POST['old']) . substr($_SESSION['user']->email,0,strpos($_SESSION['user']->email,'@'))) != $_SESSION['user']->password)
		err("Old password does not match");
	else if ($_POST['new'] != $_POST['confirm'])
		err("Confirmation field does not match");
	else // finally success!
	{
		$email = $_SESSION['user']->email;
		$salt = substr($email,0,strpos($email,'@'));
		$new = md5(md5($_POST['new']) . $salt);
		
		connectToDb();
		mysql_query(sprintf("UPDATE `TaCollection` SET `password`='%s' WHERE `TaCollection`.`taid`=%d",$new,$_SESSION['user']->getId()));
		
		echo '<script type="text/javascript">document.getElementById("changePasswordButton").disabled = true;</script>';
		out("Password updated successfully");
	}
}

?>

<p>
<b>Privacy statement:</b> Tech OnDemand <b>does not store your password</b> in its databases. Upon submission of this form, your submitted password plaintext is hashed multiple times, and the resulting hash code is stored in our database as a means of password <i>verification</i>. We will never store your password directly as raw text, so you do not have to be concerned about information vulnerability.
</p>

<?php require("HTML_bottom.php"); ?>

<?php require("HTML_top1.php"); ?>

<?php
	// destroying the session doesn't apply until page reload, so unset user var as well
	session_destroy();
	unset($_SESSION['user']);
?>

<title>Logged out &gt;&gt; ON DEMAND</title>
<?php
	require("styles.php");
	require("scripts.php");
?>

<?php require("HTML_top2.php"); ?>

<?php
	$class = getClassById($_GET["cid"]);
	require("topBar.php");
?>

<p>You have been logged out.</p>

<?php
echo '<a href="class.php?cid='.$_GET['cid'].'">Click here to return to the class home page</a>';
?>

<?php require("HTML_bottom.php"); ?>

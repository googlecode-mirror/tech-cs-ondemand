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

<p class="b cen">Account &amp; Site Administration Panel</p>

<?php echo '<a href="admin_pw.php?cid='.$_GET['cid'].'">Change password</a>'; ?>

<br/>
<?php require("HTML_bottom.php"); ?>

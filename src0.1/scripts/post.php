<?php require("HTML_top1.php"); ?>
<?php
	$class = getOdClassById($_GET["cid"]);
	$post = getOdPostById($_GET["id"]);
?>
<title><?php echo $post->title; ?> &gt;&gt; ON DEMAND</title>
<?php
	require("styles.php");
	require("scripts.php");
?>

<?php require("HTML_top2.php"); ?>

<?php require("topBar.php"); ?>

<?php

	echo '<h2 style="text-align:center">' . $post->title . '</h2>';
	echo '<p>' . $post->description . '</p>';

?>

<?php require("HTML_bottom.php"); ?>
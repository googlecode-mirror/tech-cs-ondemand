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

<!--?php

	echo '<h2 style="text-align:center">' . $post->title . '</h2>';
	
	echo '<p>' . $post->description . '</p>';

?-->

<h2 style="text-align:center">Example Post</h2><br />

<video width="640" height="360" controls="controls">
	<source src="American_Accents.ogg" type="video/ogg" />
	Your browser does not support the HTML5 video tag.
</video>

<p>This is a sample post description.</p>


<?php require("HTML_bottom.php"); ?>

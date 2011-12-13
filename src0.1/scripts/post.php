<?php require("HTML_top1.php"); ?>
<?php

	// EDIT POST BUSINESS
	if (isset($_POST['edit_post']))
	{
		connectToDb();
		
		mysql_query("UPDATE `PostCollection1332` SET `taid`=".$_SESSION['user']->getId().",`title`='".addslashes($_POST['edit_post_title'])."',`description`='".addslashes($_POST['edit_post_description'])."',`timestamp`=CURRENT_TIMESTAMP,`tag`='".addslashes($_POST['edit_post_topic'])."' WHERE `postid`=".$_GET['pid']);
	}

	$class = getClassById($_GET["cid"]);
	$post = getPostById($_GET["pid"], $class->number);
?>
<title><?php echo $post->title; ?> &gt;&gt; ON DEMAND</title>
<?php
	require("styles.php");
	require("scripts.php");
?>

<script type="text/javascript" src="js/flowplayer-3.2.6.min.js"></script>
<script type="text/javascript">

function validate(obj)
{
	// RegEx: at least one non whitespace character
	var pattern = /\S+/g;

	if (!pattern.test(obj.comment.value))
	{
		alert("There is nothing to post!");
		return false;
	}
	return true;
}

</script>

<?php require("HTML_top2.php"); ?>

<?php require("topBar.php"); ?>

<div id="postContentWrapper">

<?php

echo '<h5>'.$post->title;

if (isset($_SESSION['user']))
	echo ' (<a href="post_edit.php?cid='.$_GET['cid'].'&pid='.$_GET['pid'].'">edit</a>)';

echo '</h5>';

?>

<a href="<?php echo 'video/'.$post->getId() . '.flv'; ?>" id="player" class="video"></a>
<script type="text/javascript">
flowplayer("player", {src:"flash/flowplayer-3.2.7.swf", wmode:"opaque"},
{
	onload:function()
	{
		this.setVolume(100);
	},
	clip:
	{
		autoPlay:false,
		autoBuffering:true,
		scaling:"fit"
	}
});
</script>

<div id="postDescription">

<p><b>Description:</b><br/><br/><?php echo $post->description; ?></p>
<p class="gray">
<?php

$lastModified = $post->getLastModified();
//$lastModified->setTimezone(new DateTimezone("US/Eastern")); // this sets -5 hours

echo '<i>Last modified on ' . $lastModified->format("F j, Y, g:i a") . ' (local server time) by <a href="" onclick="popUp(\'profile\',null,null,'.$post->getTA()->getId().',null);return false;">'.$post->getTA()->name.'</a></i>';

?>
</p>
</div>

<hr/><br/><br/>

<p class="cen">
<script type="text/javascript" src="gcount/graphcount.php?page=post"></script>
</p>

</div>

<?php require("HTML_bottom.php"); ?>

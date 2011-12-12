<?php require("HTML_top1.php"); ?>
<?php
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

echo '<h5>'.$post->title.'</h5>';



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

<p><?php echo $post->description; ?></p>
</div>

<hr/><br/><br/>

</div>

<?php require("HTML_bottom.php"); ?>

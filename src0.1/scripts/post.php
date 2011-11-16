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

<script type="text/javascript" src="flowplayer-3.2.6.min.js"></script>
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

<!--?php

	echo '<h2 style="text-align:center">' . $post->title . '</h2>';
	
	echo '<p>' . $post->description . '</p>';

?-->

<div id="postContentWrapper">

<h5>Example Post</h5>

<a href="American_Accents.flv" id="player" class="video"></a>
<script type="text/javascript">
flowplayer("player", {src:"flowplayer-3.2.7.swf", wmode:"opaque"},
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

<p>
This is a sample post description.<br/>
<br/>
It can contain embedded <b>html</b> and code:
<pre>
public Miracle pray(Deity god)
{
	if (god.isWilling())
		return new Bacon();
	return silence;
}
</pre>
</p>

<hr/><br/><br/>

<h2>Comments</h2>
<hr/>

<!--for each comment-->
<p>
<b>Anonymous</b> wrote on November 16, 2011 1:30 PM:<br/>

<div style="margin-left:25px;">
Sample post in raw text. Make sure to filter out html entities!<br/>
And to convert \n to &lt;br/&gt;'s!<br/>
<br/>
Or nasty injections will happen...
</div>

</p>
<hr/>

<!--sample filler comments-->
<p>
<b>Anonymous</b> wrote on November 16, 2011 1:30 PM:<br/>

<div style="margin-left:25px;">
<font color="red">LIKE MEEEEE TROLOLOLOL!!!</font>
</div>

</p>
<hr/>

<p>
<b>Anonymous</b> wrote on November 16, 2011 1:30 PM:<br/>

<div style="margin-left:25px;">
NOOBS!
</div>

</p>
<hr/>

<p>
<b>Anonymous</b> wrote on November 16, 2011 1:30 PM:<br/>

<div style="margin-left:25px;">
lol...
</div>

</p>
<hr/>
<!--end sample filler comments-->

<br/>
<h2>Leave a comment</h2>
<form id="a" onsubmit="return validate(this);" action="" method="post">

<textarea name="comment" rows="10" cols="55">
</textarea>
<br/>
<input type="submit" value="Post Comment" />

</form>

</div>

<?php require("HTML_bottom.php"); ?>

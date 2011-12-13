<?php require("HTML_top1.php"); ?>

<title>Create/Edit Post &gt;&gt; ON DEMAND</title>
<?php
	require("styles.php");
	require("scripts.php");
?>

<?php require("HTML_top2.php"); ?>

<?php
	$class = getClassById($_GET["cid"]);
	if (isset($_GET['pid'])) $post = getPostById($_GET["pid"], $class->number);
	require("topBar.php");

$uploadMsg = "Video files must be in .flv (Flash video) format and not exceed 30 MB in size.<br/>The video upload cap is currently subject to change, as we continue to optimize the site.<br/><br/>The video player on this site has a widescreen (16:9) aspect ratio with a resolution of 640x360 pixels.<br/>We suggest your video file match the video player's resolution or match 480x360 pixels if your video has a letterbox (4:3) aspect ratio.";
	
if (isset($_GET['pid']))
{
	echo '<h5>Edit Post: '.$post->title.'</h5>';
	echo '<form action="post.php?cid='.$_GET['cid'].'&pid='.$_GET['pid'].'" method="post">';
	
	echo '<input type="text" name="edit_post_title" value="'.$post->title.'" size="50" /><br/>';
	echo '<input type="text" name="edit_post_topic" value="'.$post->topic.'" size="50" /><br/>';
	echo '<textarea name="edit_post_description" rows="10" cols="50">'.$post->description.'</textarea><br/>';
	
	echo '<input type="submit" name="edit_post" value="Submit Changes" />';
	echo '<a href="post.php?cid='.$_GET['cid'].'&pid='.$_GET['pid'].'"><input type="button" value="Cancel" /></a>';
	echo '</form><br/>';
	
	echo '<form action="class.php?cid='.$_GET['cid'].'" method="post" class="right" onsubmit="return confirm(\'Are you sure you want to delete this post?\')">';
	echo '<input type="hidden" name="edit_post_delete_pid" value="'.$post->getId().'" />';
	echo '<input type="submit" name="edit_post_delete" value="Delete Post" />';
}
else
{
	echo '<h5>Create Post</h5>';
	echo '<form action="class.php?cid='.$_GET['cid'].'" method="post" enctype="multipart/form-data">';
	
	echo '<input type="text" name="create_post_title" value="Title" size="50" /><br/>';
	echo '<input type="text" name="create_post_topic" value="Topic" size="50" /><br/>';
	echo '<textarea name="create_post_description" rows="10" cols="50">Post description i.e. additional explanation, information, etc. You may include HTML formatting, but do not get carried away!</textarea><br/>';
	echo '<input type="file" name="create_post_file" /><br/>';
	echo $uploadMsg . '<br/><br/>';
	
	echo '<input type="submit" name="create_post" value="Create Post" />';
}
?>

</form>

<br/>
<?php require("HTML_bottom.php"); ?>

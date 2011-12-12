<?php require("HTML_top1.php"); ?>
<?php $class = getClassById($_GET["cid"]); ?>
<title><?php echo $class->subject . ' ' . $class->number; ?> &gt;&gt; ON DEMAND</title>
<?php
	require("styles.php");
	require("scripts.php");
	
	// CREATE POST BUSINESS
	if (isset($_POST['create_post']))
	{
		if ($_FILES['create_post_file']['error'] == 0)
		{
			$ext = pathinfo($_FILES['create_post_file']['name']);
			$ext = $ext['extension'];
		
			if ($ext == 'flv' && $_FILES['create_post_file']['size'] < 30000000)
			{
				connectToDb();
				
				mysql_query("INSERT INTO `PostCollection1332` (`postid`,`taid`,`title`,`description`,`created`,`timestamp`,`tag`) VALUES(NULL, '".$_SESSION['user']->getId()."', '".addslashes($_POST['create_post_title'])."', '".addslashes($_POST['create_post_description'])."',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'".addslashes($_POST['create_post_topic'])."')");

				move_uploaded_file($_FILES['create_post_file']['tmp_name'], "video/" . mysql_insert_id() . ".flv");
			
				$postResult = "Created new post successfully!";
			}
			else $postResult = "Wrong file type or file too large. No post created.";
		}
		else $postResult = "No file specified. No post created.";
	}
	// DELETE POST BUSINESS
	else if (isset($_POST['edit_post_delete']))
	{
		connectToDb();
		
		mysql_query("DELETE FROM `PostCollection1332` WHERE `postid`=".$_POST['edit_post_delete_pid']);

		$file = "video/".$_POST['edit_post_delete_pid'].".flv";
		if (file_exists($file)) unlink($file);

		$postResult = "Deleted post successfully!";
	}
	
	$posts = $class->getAllPosts();
	mt_srand($class->number); // seed used for header random color generation
?>

<style type="text/css">
<?php
	$numTopics = count($posts);
	$rainbow = array();
	
	// constant saturation levels
	$FADE = 0.5;
	$FULL = 1.0;
	
	// constant lightness level
	$LIGHT = 0.6; // semi-white
	
	// assign each topic a random hue
	for ($i=0; $i < $numTopics; $i++)
	{
		$hue = mt_rand(0,360) / 360;
		$rainbow[] = $hue;
		
		$rgb = hsl2rgb($hue, $FADE, $LIGHT);
		
		echo '#topic_' . $i . '{';
		echo 'background-color:rgb(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ');';
		echo '}';
		
		echo '.topic_' . $i . '{';
		echo 'background-color:rgb(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ');';
		echo '}';
		
		$rgb = hsl2rgb($hue, $FULL, $LIGHT);
		
		echo '#topic_' . $i . ':hover{';
		echo 'background-color:rgb(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ');';
		echo '}';
		
		echo '.topic_' . $i . ':hover{';
		echo 'background-color:rgb(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ');';
		echo '}';
	}

?>
</style>
<script type="text/javascript">

/**
 * Remember which headers the user collapsed/expanded by storing in cookie
 * so that on browser return the user can continue where he left off
 */
$(document).ready(function()
{
	<?php

		for ($i=0; $i < $numTopics; $i++)
		{
			echo '
		
			$("#topic_'.$i.'").click(function()
			{
				$("#topicDiv_'.$i.'").slideToggle("fast",function()
				{
					if (document.getElementById("topicDiv_'.$i.'").style.display == "none")
						setCookie("topicDiv_'.$i.'","0");
					else
						setCookie("topicDiv_'.$i.'","1");
				});
			});';

			echo '
			
			if (getCookie("topicDiv_'.$i.'") != "1")
				$("#topicDiv_'.$i.'").toggle();
			';
		}

	?>
});

</script>
<?php require("HTML_top2.php"); ?>

<?php require("topBar.php"); ?>

<?php if (isset($postResult)) out($postResult); ?>

<p><?php echo $class->description;?></p>

<?php

	if (isset($_SESSION['user']))
	{
		echo '<p class="right"><a href="post_edit.php?cid='.$_GET['cid'].'"> + Create new post</a></p>';
	}

	$i = 0;
	foreach ($posts as $post)
	{
		echo '<h3 id="topic_' . $i . '">' . $post[0]->topic . '</h3>';
		echo '<div id="topicDiv_' . $i . '">';
		foreach ($post as $p)
		{
			echo '<a href="post.php?cid='. $class->getId() .'&pid=' . $p->getId() . '" class="post">';
			echo '<h4 class="topic_' . $i . '">' . $p->title . ' <i>with '.$p->getTA()->name.'</i></h4></a>';
		}
		$i++;
		echo '</div>';
	}

?>

<?php require("HTML_bottom.php"); ?>

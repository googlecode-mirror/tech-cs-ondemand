<?php require("HTML_top1.php"); ?>
<?php $class = getOdClassById($_GET["id"]); ?>
<title><?php echo $class->subject . ' ' . $class->number; ?> &gt;&gt; ON DEMAND</title>
<?php
	require("styles.php");
	require("scripts.php");
	
	$posts = $class->getAllPosts();
	echo "<pre>*";
	print_r($posts);
	echo "*</pre>";
	mt_srand($class->number); // seed used for header random color generation
?>

<style type="text/css">
<?php
	$numTopics = count($posts);
	$rainbow = array();

	// hue
	$hue = 0;
	
	// constant saturation levels
	$FADE = 0.4;
	$FULL = 1;
	
	// constant brightness level
	$BRIGHT = 0.8;
	
	// assign each topic a random hue
	for ($i=0; $i < $numTopics; $i++)
	{
		$hue = mt_rand(0,359);
		$rainbow[] = $hue;
		
		$rgb = hsb2rgb($hue, $FADE, $BRIGHT);
		
		echo '#topic_' . $i . '{';
		echo 'background-color:rgb(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ');';
		echo '}';
		
		echo '.topic_' . $i . '{';
		echo 'background-color:rgb(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ');';
		echo '}';
		
		$rgb = hsb2rgb($hue, $FULL, $BRIGHT);
		
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

<p><?php echo $class->description;?></p>

<?php

	for ($i=0; $i < $numTopics; $i++)
	{
		echo '<h3 id="topic_' . $i . '">' . $posts[$i][0]->topic . '</h3>';
		echo '<div id="topicDiv_' . $i . '">';
		foreach ($posts[$i] as $post)
		{
			echo '<a href="post.php?cid='. $class->getId() .'&id=' . $post->getId() . '" class="post">';
			echo '<h4 class="topic_' . $i . '">' . $post->title . '</h4></a>';
		}
		echo '</div>';
	}

?>

<?php require("HTML_bottom.php"); ?>

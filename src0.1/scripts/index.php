<?php require("HTML_top1.php"); ?>
<title>Tech &gt;&gt; ON DEMAND</title>
<?php
	require("styles.php");
	require("scripts.php");
	
	/**
	 * 2-D array of OdClass objects where each sub-array groups the classes
	 * into subjects i.e.
	 * $subjects[0] => CS
	 * $subjects[1] => MATH
	 * $subjects[2] => PHYS
	 * etc.
	 */
	$subjects = getAllOdClasses();
?>
<script type="text/javascript">

/**
 * Create listeners for each subject header
 * to slide up/down list of classes on click
 */
$(document).ready(function()
{
	<?php

		foreach ($subjects as $subject)
		{
			echo '
		
			$("#header_'.$subject[0]->type.'").click(function()
			{
				$("#div_'.$subject[0]->type.'").toggle("fast");
			});';
			
			// Hide all subject classes except CS initially
			if ($subject[0]->type != 0)
				echo '$("#div_'.$subject[0]->type.'").toggle();';
		}
	?>
});

</script>

<?php require("HTML_top2.php"); ?>

<div class="cen"><img src="banner.jpg" alt="TECH ON DEMAND" /></div>
<hr />

<p class="gray">
	<span style="color:#8888FF;font-weight:bold;">TECH ON DEMAND </span>is an open resource forum that seeks to satiate your curiosity for various technical subjects. These resources will exist through semesters and is available to the general public for free. We aim to bring Georgia Institute of Technology caliber education to any and all that have a desire to learn.<br /><br />
	<b>Choose a class below:</b>
</span>

<?php

	// Print all subject headers and for each subject, print all class links
	foreach ($subjects as $subject)
	{
		echo '<h1 id="header_' . $subject[0]->type . '">' . $CLASS_NAMES[$subject[0]->type] . '</h1>';
		
		echo '<div id="div_' . $subject[0]->type .'"><br />';
		foreach ($subject as $class)
		{
			echo '<a href="class.php?id=' . $class->getID() . '" class="class">' . $class->alias . ' ' . $class->title . '</a><br />';
		}
		echo '</div><br />';
	}

?>

<?php require("HTML_bottom.php"); ?>
<?php require("HTML_top1.php"); ?>
<title>Tech &gt;&gt; ON DEMAND</title>
<?php
	require("styles.php");
	require("scripts.php");

	$subjects = getAllClasses();
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
		
			$("#header_'.$subject[0]->subject.'").click(function()
			{
				$("#div_'.$subject[0]->subject.'").toggle("fast");
			});';
			
			// Hide all subject classes except CS initially
			if ($subject[0]->subject != 'CS')
				echo '$("#div_'.$subject[0]->subject.'").toggle();';
		}
	?>
});

</script>

<?php require("HTML_top2.php"); ?>

<div class="cen"><img src="images/banner.jpg" alt="TECH ON DEMAND" /></div>
<hr />

<p class="gray">
	<span style="color:#8888FF;font-weight:bold;">TECH ON DEMAND </span>is an open resource forum that seeks to satiate your curiosity for various technical subjects. These resources will exist through semesters and is available to the general public for free. We aim to bring Georgia Institute of Technology caliber education to any and all that have a desire to learn.<br /><br />
	<b>Choose a class below:</b>
</span>

<?php

	// map from short class subject to full subject name
	// eg: 'CS' => 'Computer Science'
	$SUBJECT_NAMES = array();
	$SUBJECT_NAMES['CS'] = 'Computer Science';
	$SUBJECT_NAMES['MATH'] = 'Mathemagics';
	$SUBJECT_NAMES['PHYS'] = 'Physics';

	// Print all subject headers and for each subject, print all class links
	foreach ($subjects as $subject)
	{	
		echo '<h1 id="header_' . $subject[0]->subject . '">' . $SUBJECT_NAMES[$subject[0]->subject] . '</h1>';
		
		echo '<div id="div_' . $subject[0]->subject .'"><br />';
		foreach ($subject as $class)
		{
			echo '<a href="class.php?cid=' . $class->getID() . '" class="class">' . $class->subject . ' ' . $class->number . ' ' . $class->title . '</a><br />';
		}
		echo '</div><br />';
	}

?>

<?php require("HTML_bottom.php"); ?>

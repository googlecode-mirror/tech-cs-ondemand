<table width="750" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="2" style="width:300px;">
			<a href="index.php" class="banner_s"></a>
		</td>
		
		<td class="right vat" style="width:450px;height:50px;">
			<a href="#">Login</a>
		</td>
	</tr>
	<tr>
		<td class="right vab">
			<h2>
			<?php
				echo '<a href="class.php?id=' . $class->getId() . '" style="color:#000000">';
				echo $class->alias . " " . $class->title . '</a>';
			?>
			</h2>
		</td>
	</tr>
</table>

<hr />
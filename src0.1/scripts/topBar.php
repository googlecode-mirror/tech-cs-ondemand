
<table width="750" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="2" style="width:300px;">
			<a href="index.php" class="banner_s"></a>
		</td>
		
		<td class="right vat" style="width:450px;height:50px;">
		
		<?php
		
			if (isset($_SESSION['user']))
			{
				echo '
				
				<a href="" onclick="popUp(\'profile\',null,null);return false;">Joseph Gee Kim</a>
				&nbsp;|&nbsp;
				<a href="" onclick="popUp(\'_profile\',null,null);return false;">Profile</a>
				&nbsp;|&nbsp;
				<a href="">Logout</a>
			
				';
			
			}
			else // anonymous/guest
			{
				echo '<a href="" onclick="popUp(\'login\',null,null);return false;">Login</a>';
			}
		?>
		
		</td>
	</tr>
	<tr>
		<td class="right vab">
			<h2>
			<?php
				if (!is_null($class))
				{
					echo '<a href="class.php?id=' . $class->getId() . '" style="color:#000000">';
					echo $class->subject . " " . $class->number . " " . $class->title . '</a>';
				}
			?>
			</h2>
		</td>
	</tr>
</table>

<hr />

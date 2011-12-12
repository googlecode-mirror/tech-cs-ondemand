
<table width="750" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="2" style="width:300px;">
			<a href="index.php" class="banner_s"></a>
		</td>
		
		<td class="right vat" style="width:450px;height:50px;">
		
		<?php
		
			if (isset($_SESSION['user']))
			{
				$TA = $_SESSION['user'];
			
				echo '<a href="" onclick="popUp(\'profile\',null,null,'.$TA->getId().',null);return false;">'.$TA->name.'</a>';
				
				echo '&nbsp;|&nbsp;';
				
				if (isset($_GET['pid']))
					echo '<a href="" onclick="popUp(\'_profile\','.$_GET['cid'].','.$_GET['pid'].','.$TA->getId().',null);return false;">Profile</a>';
				else
					echo '<a href="" onclick="popUp(\'_profile\','.$_GET['cid'].',null,'.$TA->getId().',null);return false;">Profile</a>';
				
				echo '&nbsp;|&nbsp;';
				
				echo '<a href="logout.php?cid='.$_GET['cid'].'">Logout</a>';
			}
			else // anonymous/guest
			{
				if (isset($_GET['pid']))
					echo '<a href="" onclick="popUp(\'login\','.$_GET['cid'].','.$_GET['pid'].',null,null);return false;">Login</a>';
				else
					echo '<a href="" onclick="popUp(\'login\','.$_GET['cid'].',null,null,null);return false;">Login</a>';
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
					if (isset($_GET['pid']))
						echo '<a href="class.php?cid=' . $class->getId() . '" style="text-decoration:underline">&lt;&lt; ';
					else
						echo '<a href="class.php?cid=' . $class->getId() . '" style="text-decoration:underline">';
					echo $class->subject . " " . $class->number . " " . $class->title . '</a>';
				}
			?>
			</h2>
		</td>
	</tr>
</table>

<hr />

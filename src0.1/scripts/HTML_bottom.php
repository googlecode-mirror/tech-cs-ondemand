<br />
<hr />
<br />
<!--FOOTER-->
<div class="cen">

	<a href="index.php">Home</a>&nbsp;&nbsp;-&nbsp;&nbsp;
	<a href="" onclick="popUp('about',null,null,null,null);return false;">About</a>&nbsp;&nbsp;-&nbsp;&nbsp;
	<a href="" onclick="popUp('contact',null,null,null,null);return false;">Contact</a>
	<br />
	<span class="gray">
	&copy; Copyright David Esposito and Joseph Gee Kim
	</span>

<?php
	if (isset($_SESSION['user']) && isset($_GET['cid']))
		echo '<br/><a href="admin.php?cid='.$_GET['cid'].'">Admin</a><br/>';
?>

</div>
</div> <!--end mainFrame div-->
<div id="popUpBG" onclick="closePopUp();"></div>
<div id="popUp"></div>
</body>
</html>

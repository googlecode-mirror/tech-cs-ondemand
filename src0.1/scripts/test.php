<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>TESTER</title>
<style type="text/css">

p
{
	margin:0;
	padding:0;
}

div
{
	width:500px;
	height:500px;
	background-color:red;
}

</style>
<script type="text/javascript" src="jquery-1.6.4.min.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
	$(document).click(function()
	{
		$("div").toggle(4000);
	});
});

</script>
</head>
<body>
<p>stuff is here</p>
<div></div>
<p>more junk</p>
</body>
</html>
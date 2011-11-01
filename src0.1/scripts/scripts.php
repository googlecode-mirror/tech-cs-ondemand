<script type="text/javascript" src="jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="js.js"></script>

<?php

/**
 * Converts a color from HSB to RGB color space
 *
 * @param h hue from 0 to 360 (exclusive)
 * @param s saturation from 0 to 1 (percentage)
 * @param b brightness/value from 0 to 1 (percentage)
 * @return a 3-element array corresponding to RGB components (0-255 of each)
 */
function hsb2rgb($h,$s,$b)
{
	$c = $b * $s; // chroma
	$h_ = $h / 60;
	$x = $c * (1 - abs($h_ % 2 - 1));
	
	$R = $G = $B = 0; // red, green, blue components
	if ($h_ >= 0 && $h_ < 1)
	{
		$R = $c;
		$G = $x;
		$B = 0;
	}
	else if ($h_ >= 1 && $h_ < 2)
	{
		$R = $x;
		$G = $c;
		$B = 0;
	}
	else if ($h_ >= 2 && $h_ < 3)
	{
		$R = 0;
		$G = $c;
		$B = $x;
	}
	else if ($h_ >= 3 && $h_ < 4)
	{
		$R = 0;
		$G = $x;
		$B = $c;
	}
	else if ($h_ >= 4 && $h_ < 5)
	{
		$R = $x;
		$G = 0;
		$B = $c;
	}
	else if ($h_ >= 5 && $h_ < 6)
	{
		$R = $c;
		$G = 0;
		$B = $x;
	}
	
	$m = $b - $c;
	$R = round(($R + $m)*255);
	$G = round(($G + $m)*255);
	$B = round(($B + $m)*255);
	
	$RGB = array();
	$RGB[] = (int)$R;
	$RGB[] = (int)$G;
	$RGB[] = (int)$B;
	
	return $RGB;
}





?>
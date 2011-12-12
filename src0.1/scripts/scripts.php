<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="js/js.js"></script>

<?php

include_once "scripts/OnDemandServices.php";

/**
 * Converts a color from HSL to RGB color space
 *
 * @param H hue from 0 to 1 (map from 0 to 360 degrees of hue)
 * @param S saturation from 0 to 1 (percentage: 0=colorless, 1=colorful)
 * @param L lightness from 0 to 1 (percentage: 0=black, 0.5=std, 1=white)
 * @return a 3-element array corresponding to RGB components (0-255 of each)
 */
function hsl2rgb($H,$S,$L)
{
	// shade of gray
	if ($S == 0)
	{
		$r = $L * 255;
		$g = $L * 255;
		$b = $L * 255;
	}
	else
	{
		if ($L < 0.5)
			$var_2 = $L * (1 + $S);
		else
			$var_2 = ($L + $S) - ($S * $L);

		$var_1 = 2 * $L - $var_2;
		$r = 255 * hue_2_rgb($var_1,$var_2,$H + (1/3));
		$g = 255 * hue_2_rgb($var_1,$var_2,$H);
		$b = 255 * hue_2_rgb($var_1,$var_2,$H - (1/3));
	}

	$RGB = array();
	$RGB[] = round($r);
	$RGB[] = round($g);
	$RGB[] = round($b);
	
	return $RGB;
}

// not entirely sure how this function works, but assuming it works
// src: http://serennu.com/colour/rgbtohsl.php
function hue_2_rgb($v1,$v2,$vh)
{
	if ($vh < 0) $vh += 1;
	if ($vh > 1) $vh -= 1;

	if ((6 * $vh) < 1) return $v1 + ($v2 - $v1) * 6 * $vh;
	if ((2 * $vh) < 1) return $v2;
	if ((3 * $vh) < 2) return $v1 + ($v2 - $v1) * ((2/3 - $vh) * 6);
	
	return $v1;
}

function err($string)
{
	echo '<p style="color:#FF0000">'.$string.'</p>';
}

function out($string)
{
	echo '<p style="color:#00CC00">'.$string.'</p>';
}

?>

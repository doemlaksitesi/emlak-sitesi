<?php
$im = imagecreate($_GET['uzunluk'], 20);
$img = $_GET['str'];
// White background and blue text
$bg = imagecolorallocate($im, 242, 242, 242);
$textcolor = imagecolorallocate($im, 200, 100, 0);

imagestring($im, 3, 12, 2, $img, $textcolor);

// Output the image
header('Content-type: image/png');

imagepng($im);
imagedestroy($im);
	
?>

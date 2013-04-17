<?php
# 직접 접근을 막는다요
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) die ('Please do not load this page directly. Thanks!');

$im = @imagecreatefrompng(plugin_dir_path(__FILE__) . "wp-dark-hi-bg.png");
$size = getimagesize(plugin_dir_path(__FILE__) . "wp-dark-hi-bg.png");

$random_pixel = $x = $y = array();

for($i=0; $i<5; $i++) {
	$x[$i] = get_unique_random($x, $size[0] - 1);
	$y[$i] = get_unique_random($y, $size[1] - 1);

	$random_pixel[$i] = array(
		"color" => rand(0, 255),
		"x" => $x[$i],
		"y" => $y[$i]
	);
	
	$x_ = $random_pixel[$i]["x"] + 1;
	$y_ = $random_pixel[$i]["y"] + 1;
	
	$color = imagecolorallocate($im, $random_pixel[$i]["color"], $random_pixel[$i]["color"], $random_pixel[$i]["color"]);
	imagefilledrectangle($im, $random_pixel[$i]["x"], $random_pixel[$i]["y"], $x_, $y_, $color);
}

function get_unique_random($array, $value) {
	$rand = rand(0, $value);
	if (in_array($rand, $array)) {
		return get_unique_random($array, $value);
	} else {
		return $rand;
	}
}

update_user_meta($user->data->ID, "sj-uploagin-key", $random_pixel);

header('Content-Type: image/png');
header('Content-Disposition: attachment; filename=your_key.png');
imagepng($im);
imagedestroy($im);
?>
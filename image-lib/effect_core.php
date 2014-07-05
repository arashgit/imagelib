<?php
// image-lib/effect_core.php

if ( ! defined('IMAGEAPI_ROOT'))
	exit('No direct script access allowed');


// static class fo builtin effects. custom effects must be placed as separate files in image_userefects
// note:
//		1- please do not add any extra function in the source code of this class. define user custom effect classes instead.
// 		2- each effect method(either builtin or user custom) must have two parameters source_image and parameters
class EffectCore
{
	// effect:
	// 		resize
	// prameters
	// 		width
	// 		height
	public static function resize($source_image,$parameters)
	{
		$new_width=$parameters['width'];
		$new_height=$parameters['height'];
		if(IMAGEAPI_ENVIRONMENT=='development')
			echo 'resize '.$new_width.'x'.$new_height.' is called<br>';
		$width=imagesx($source_image);
		$height=imagesy($source_image);
		$image_r = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($image_r, $source_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		return $image_r;
	}

	// effect:
	// 		blur
	// prameters
	// 		radius
	public static function blur($source_image,$parameters)
	{// this function is not implemented yet
		$radius=$parameters['radius'];
		if(IMAGEAPI_ENVIRONMENT=='development')
			echo 'blur is called with radius '.$radius.'px but not implemented yet<br>';
		return $source_image;
	}

	// effect:
	// 		grayscale
	// prameters
	// 		(none)
	public static function grayscale($source_image,$parameters)
	{
		if(IMAGEAPI_ENVIRONMENT=='development')
			echo 'grayscale is called<br>';
		imagefilter($source_image, IMG_FILTER_GRAYSCALE);
		return $source_image;
	}

}

// include all user custom effects
foreach (glob(IMAGEAPI_USEREFFECTPATH."*.php") as $filename)
{
    include $filename;
}

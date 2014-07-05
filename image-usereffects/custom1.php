<?php
// image-usereffects/custom1.php

if ( ! defined('IMAGEAPI_ROOT'))
	exit('No direct script access allowed');

class CustomEffect1
{
	// user custom effect
	// effect:
	// 		invert
	// prameters
	// 		(none)
	public static function invert($source_image,$parameters)
	{
		if(IMAGEAPI_ENVIRONMENT=='development')
			echo 'CustomEffect1::invert is called.<br>';		
		imagefilter($source_image, IMG_FILTER_NEGATE);
		return $source_image;
	}

	// user custom effect
	// effect:
	// 		effect1
	// prameters
	// 		(none)
	public static function effect1($source_image,$parameters)
	{
		if(IMAGEAPI_ENVIRONMENT=='development')
			echo 'CustomEffect1::effect1 is called but not implemented yet.<br>';
		else
			throw new Exception("not implemented", 1);
		
		return $source_image;
	}

	// user custom effect
	// effect:
	// 		effect2
	// prameters
	// 		(none)
	public static function effect2($source_image,$parameters)
	{
		if(IMAGEAPI_ENVIRONMENT=='development')
			echo 'CustomEffect1::effect2 is called but not implemented yet.<br>';
		else
			throw new Exception("not implemented", 1);
		
		return $source_image;
	}
}

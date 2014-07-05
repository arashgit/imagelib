<?php
// image-usereffects/custom2.php

if ( ! defined('IMAGEAPI_ROOT'))
	exit('No direct script access allowed');

class CustomEffect2
{
	// user custom effect
	// effect:
	// 		effect1
	// prameters
	// 		custom param 1
	// 		custom param 2
	public static function effect1($source_image,$parameters)
	{
		if(IMAGEAPI_ENVIRONMENT=='development')
			echo 'CustomEffect2::effect1 is called but not implemented yet.<br>';
		else
			throw new Exception("not implemented", 1);
		
		return $source_image;
	}

	// user custom effect
	// effect:
	// 		effect2
	// prameters
	// 		custom param 1
	// 		custom param 2
	//		...
	// 		custom param n

	public static function effect2($source_image,$parameters)
	{
		if(IMAGEAPI_ENVIRONMENT=='development')
			echo 'CustomEffect2::effect2 is called but not implemented yet.<br>';
		else
			throw new Exception("not implemented", 1);

		return $source_image;
	}
}

<?php
//  image-lib/config.php

if ( ! defined('IMAGEAPI_ROOT'))
	exit('No direct script access allowed');

/****** system settings **************/

// warning: change to production when publishing 
define('IMAGEAPI_ENVIRONMENT', 'development');

// the output folder to export image
define('IMAGEAPI_CONTENTFOLDER', 'image-content');

// collection of php functions that must be called for import and exporting images
// note:
//		you user can define his own custom function for unsupported image types and add them here
//		contents of this class might change at run-time
class ImageConfig
{
	public static $mimetypes=array(// supported image types
		'image/png'=>array('import'=>'imagecreatefrompng','export'=>'imagepng'),
		'image/jpeg'=>array('import'=>'imagecreatefromjpeg','export'=>'imagejpeg'),
		'image/gif'=>array('import'=>'imagecreatefromgif','export'=>'imagegif'),
		);

	// image file permission after exporting
	public static $outputimage_permission=0775;
}

// show output errors for developer
if(IMAGEAPI_ENVIRONMENT=='development')
{
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

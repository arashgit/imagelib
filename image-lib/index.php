<?php
// image-lib/index.php

if ( ! defined('IMAGEAPI_ROOT')) // avoid loading library for two times
{
	define('IMAGEAPI_ROOT', dirname(__DIR__).DIRECTORY_SEPARATOR);
	define('IMAGEAPI_LIBPATH', __DIR__.DIRECTORY_SEPARATOR);
	define('IMAGEAPI_USEREFFECTPATH', dirname(IMAGEAPI_LIBPATH).DIRECTORY_SEPARATOR.'image-usereffects'.DIRECTORY_SEPARATOR);
	include_once IMAGEAPI_LIBPATH.'config.php';
	include_once IMAGEAPI_LIBPATH.'image_collection.php';
}

// avoid closing php close tag "? >" to prevent fault

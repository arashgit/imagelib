<?php
// image-lib/image_collection.php

if ( ! defined('IMAGEAPI_ROOT'))
	exit('No direct script access allowed');

include_once IMAGEAPI_LIBPATH.'image_item.php';

// this class is a collection of images
// you can add, delete images, running all existing effects on all files, and export all images
class ImageCollection
{
	private $collection= array();

	public function __construct()
	{
		// check if GD image library is installed upon php or not.
		// to install GD in Ubuntu server:
		// sudo apt-get install php5-gd
		if(!function_exists('ImageCreate'))
			fatal_error('Error: GD is not installed') ;
	}

	// insert image to the collection
	public function addimage($newitem)
	{
		// check if the inserted item is an image
		if(!is_a($newitem,'ImageItem'))
			throw new Exception('ImageItem type was expected.');
		// insert image
		array_push($this->collection, $newitem);
	}

	// remove an image from the collection
	public function remove_image($item)
	{
		throw new Exception('Not implemented yet.');
	}

	// run all effects on all images
	public function implement_all_effects()
	{
		foreach ($this->collection as $image)
		{
			$image->implement_effects();
		}
	}

	// export all images to files
	public function export_all()
	{
		foreach ($this->collection as $image)
		{
			$image->export();
		}	
	}
}

<?php
// image-lib/image_item.php

if ( ! defined('IMAGEAPI_ROOT'))
	exit('No direct script access allowed');

include_once IMAGEAPI_LIBPATH.'effect_item.php';

// this class holds an image with its effects
class ImageItem
{
	protected $image_full_path;// full path of imported image
	protected $effect_collection=array();
	protected $image_content;// image in byte form
	protected $mimetype;// holds mime type of imported image 

	// constructor initializes the image from path
	public function __construct($image_file_path)
	{
		$this->image_full_path=IMAGEAPI_ROOT.IMAGEAPI_CONTENTFOLDER.DIRECTORY_SEPARATOR.$image_file_path;
		// check if file exists
		if(!file_exists ($this->image_full_path))
			throw new Exception("Image file not found", 1);
		// prevent processing wrong file (or file which is not an image)
		$this->mimetype=mime_content_type($this->image_full_path);
		if(!array_key_exists($this->mimetype,ImageConfig::$mimetypes))
			throw new Exception("Image mime type is not recognized", 1);
		// load image into memory
		$import_function=ImageConfig::$mimetypes[$this->mimetype]['import'];
		$this->image_content = $import_function($this->image_full_path);
	}

	// releasing image byte content allocation
	function __destruct()
	{
		imagedestroy($this->image_content);
	}

	// insert a new effect to image
	public function add_effect($neweffect)
	{
		// check if inserted item is an effect (prevent var type mistake)
		if(!is_a($neweffect,'EffectItem'))
			throw new Exception('EffectItem type was expected.',1);
		array_push($this->effect_collection, $neweffect);
	}

	// remove an effect from image
	public function remove_effect($item)
	{
		throw new Exception('Not implemented yet.');
	}

	// export image to a custom file
	// note:
	//		1- this method does not call effects. effects should be executed before calling this method
	//		2- if custom file is not determined, this method chooses a name for it eg.: previousname_result.png 
	public function export($destination=null)
	{
		if(empty($destination)) // if export path file is not determined
		{
			// generate new path
			$added_word='_result'; 
			$path_parts= pathinfo($this->image_full_path);
			$destination = $path_parts['dirname'].DIRECTORY_SEPARATOR.$path_parts['filename'].$added_word.'.'.$path_parts['extension'];
		}
		// call appropriate php function from list of ImageConfig::$mimetypes
		$export_function=ImageConfig::$mimetypes[$this->mimetype]['export'];
		$export_function($this->image_content,$destination);
		// check file created
		if(!file_exists($destination))
			throw new Exception("Error cannot create image. Check directory permissions.", 1);
		// modify permissions
		chmod($destination, ImageConfig::$outputimage_permission);
	}

	// implement current effects attached to the image and empty list of implemented effects
	public function implement_effects()
	{
		if(IMAGEAPI_ENVIRONMENT=='development')
			echo '### implementing effects on '.$this->image_full_path.'<br>';
		// run all effects
		foreach ($this->effect_collection as $effect)
    	{
    		$this->image_content=$effect->implement_effect($this->image_content);
    	}
    	// empty implemented effects
    	$this->effect_collection=array();
	}
}

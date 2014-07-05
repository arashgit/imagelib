<?php
// image-lib/effect_item.php
if ( ! defined('IMAGEAPI_ROOT'))
	exit('No direct script access allowed');

include_once IMAGEAPI_LIBPATH.'effect_core.php';

// this class represents each single effect that is going to be attached to the image
class EffectItem
{
	private $effect_function;// function variable to effect function
	private $effect_parameters;// parametenrs to be sent to function variable

	// effect is defined at creation
	public function __construct($effect_function,$effect_parameters)
	{
		$this->effect_function=$effect_function;
		$this->effect_parameters=$effect_parameters;
	}

	// convert an image data according to function variable
	public function implement_effect($image)
	{
		// call effect function from a variable
		return call_user_func($this->effect_function,$image,$this->effect_parameters);
	}

}

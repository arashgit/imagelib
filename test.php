<?php
// test.php

// supported file types
//		png,gif,jpeg

// include the library
require_once 'image-lib'.DIRECTORY_SEPARATOR.'index.php'; 

// define image collection
$imagecollection = new ImageCollection();
// image 1
// file: a.png
// effects: resize 150x500, blur 10px, grayscale
$image1=new ImageItem('a.png');
$imagecollection->addimage($image1);		// add image to collection
$effect_resize150=new EffectItem('EffectCore::resize',array('width'=>150,'height'=>500));
$effect_blur10=new EffectItem('EffectCore::blur',array('radius'=>10));
$effect_grayscale1=new EffectItem('EffectCore::grayscale',array());
$image1->add_effect($effect_resize150); 	// attach effect
$image1->add_effect($effect_blur10);		// attach effect
$image1->add_effect($effect_grayscale1);	// attach effect
// image 2
// file: b.jpeg
// effects: resize 200x200, invert, custom effect 1, custom effect 2
$image2=new ImageItem('b.jpeg');
$imagecollection->addimage($image2);		// add image to collection
$effect_resize200=new EffectItem('EffectCore::resize',array('width'=>200,'height'=>200));
$effect_invert=new EffectItem('CustomEffect1::invert',array());
$effect_custom1=new EffectItem('CustomEffect2::effect1',array(/* effect parameters */));
$effect_custom2=new EffectItem('CustomEffect2::effect2',array(/* effect parameters */));
$image2->add_effect($effect_resize200); 	// attach effect
$image2->add_effect($effect_invert); 		// attach effect
$image2->add_effect($effect_custom1); 		// attach effect
$image2->add_effect($effect_custom2); 		// attach effect
//implement effects
$imagecollection->implement_all_effects();// effects can run on each seperate image too
$imagecollection->export_all();// each image can be exported separately too

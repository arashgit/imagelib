Imagelib
========

Library for image effect assistance

Generated in IDE: sublime-text3 , OS:Ubuntu.

This library is basically written in Linux environments. However to make it compatible windows file-system, I have used DIRECTORY_SEPARATOR instead of '/' for separating folder inside path. So, it can run under windows server too.

Include hierarchy:
 - 	test.php
 - 	->image-lib/index.php
 - 	->-> config.php
 - 	->-> image_collection.php 
 - 	->->-> image_item.php 
 - 	->->->-> effect_item.php 
 - 	->->->->-> effect_manager.php
 -  ->->->->->-> * cusom effecs.php

All user custom effects go to folder 'image-usereffects'.

All images are located inside image-content folder. The result would be generated in the same folder.

How to run codes
=====

Include library and define collection

    require_once 'image-lib/index.php';
    // define collection
    $imagecollection = new ImageCollection();


Load an image file, add it into the collection and define some effects

    // image 1
    // file: a.png
    // effects: resize 150x500, blur 10px, grayscale
    $image1=new ImageItem('a.png');
    $imagecollection->addimage($image1);		// add image to collection
    $effect_resize150=new EffectItem('EffectCore::resize',array('width'=>150,'height'=>500));
    $effect_blur10=new EffectItem('EffectCore::blur',array('radius'=>10));
    $effect_grayscale1=new EffectItem('EffectCore::grayscale',array());


Attach effects to image:

    $image1->add_effect($effect_resize150); 	// attach effect 1
    $image1->add_effect($effect_blur10);		// attach effect 2
    $image1->add_effect($effect_grayscale1);	// attach effect 3

Define othe images and effects

    ...

Run effects and generate output files:

    $imagecollection->implement_all_effects();// effects can run on each seperate image too
    $imagecollection->export_all();// each image can be exported separately too


Outputs would be generated in image-content folder.

Four sample images are added into the issue:
https://github.com/arashgit/imagelib/issues/1
Output result:

    ### implementing effects on /home/aran/arash/www/imagelib/image-content/a.png
    resize 150x500 is called
    blur is called with radius 10px but not implemented yet
    grayscale is called
    ### implementing effects on /home/aran/arash/www/imagelib/image-content/b.jpeg
    resize 200x200 is called
    CustomEffect1::invert is called.
    CustomEffect2::effect1 is called but not implemented yet.
    CustomEffect2::effect2 is called but not implemented yet.

User Custom Effects
=====
Inside folder 'image-usereffects' create a custom file with .php extension. This file would be included automatically. Add a custom class. Inside the class you should add static functions as effect:

    class CustomEffect1
    {
    // user custom effect
    // effect:
    // 		invert
    // prameters
    // 		parameter1, parameter2, parameter3
    public static function myeffect($source_image,$parameters)
    {
        ...
        return $final_image;
    }
    ......

Inside your main php file call the effect this way:

    $effect_custom1=new EffectItem('CustomEffect1::myeffect',array('parameter1'=>11, 'parameter2'=>15, 'parameter3'=>null));
    $image2->add_effect($effect_custom1); 	// attach effect
    ....


Considerations
=====


It is supposed that PHP-GD library is installed as it is the standard php library for resizing image:
    sudo apt-get install php5-gd

The primary environment is set to 'developement'. To avoid showing errors and messages it should be change to 'production' inside config.php.

To run this library images are need to be loaded. hence, upload_max_filesize inside php.ini is needed to be adjusted correctly.
    sudo gedit /etc/php5/apache2/php.ini

Parameters inside ImageConfig are changable at runtime.

Adjust file permission for image-content folder:
    sudo chown arashuser:www-data image-content

Since php version is set to 5 I avoided using __callStatic.

Even though all images in test file are exported together, each image can be exported separately too with its custom file path

This library keeps the image primary extension and does not change it while exporting files.

With a very slight change this library is able to hold effects before importing any image at the cost of proning it to faults however I left it as it is.

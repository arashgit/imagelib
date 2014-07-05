imagelib
========

library for image effect assistance

generated in IDE: sublime-text3 , OS:Ubuntu

This library is basically written in Linux environments. However to make it compatible windows file-system, I have used DIRECTORY_SEPARATOR instead of '/' for separating folder inside path. So, it can run under windows server too.

include hierarchy:
test.php
 - 	->image-lib/index.php
 - 	->-> config.php
 - 	->-> image_collection.php 
 - 	->->-> image_item.php 
 - 	->->->-> effect_item.php 
 - 	->->->->-> effect_manager.php
 -  ->->->->->-> * cusom effecs.php

all user custom effects go to folder 'image-usereffects'.
with a custom php file with a custom class name. 

all images are located inside image-content folder

how to run codes
=====

include library and define collection

    require_once 'image-lib/index.php';
    // define collection
    $imagecollection = new ImageCollection();


load an image file, add it into the collection and define some effects

    // image 1
    // file: a.png
    // effects: resize 150x500, blur 10px, grayscale
    $image1=new ImageItem('a.png');
    $imagecollection->addimage($image1);		// add image to collection
    $effect_resize150=new EffectItem('EffectCore::resize',array('width'=>150,'height'=>500));
    $effect_blur10=new EffectItem('EffectCore::blur',array('radius'=>10));
    $effect_grayscale1=new EffectItem('EffectCore::grayscale',array());


attach effects to image:

    $image1->add_effect($effect_resize150); 	// attach effect 1
    $image1->add_effect($effect_blur10);		// attach effect 2
    $image1->add_effect($effect_grayscale1);	// attach effect 3

define othe images and effects

    ...

run effects and generate output files:

    $imagecollection->implement_all_effects();// effects can run on each seperate image too
    $imagecollection->export_all();// each image can be exported separately too


outputs would be generated in image-content file.

considerations
=====


it is suppose PHP-GD library is installed as it is the standard php library for resizing image:
sudo apt-get install php5-gd

the primary environment is set to 'developement'. to avoid showing errors and messages it should be change to 'production' inside config.php.

to run this library images are need to be loaded. hence, upload_max_filesize inside php.ini is needed to be adjusted correctly.
sudo gedit /etc/php5/apache2/php.ini

parameters inside ImageConfig are changable at runtime.

adjust file permission for image-content folder:
sudo chown arashuser:www-data image-content

since php version is set 5 I avoided using __callStatic.



even though all images in test file are exported together, each image can be exported separately too with its custom file path

this library keeps the image primary extension and does not change it while exporting files

with a very slight change this library is able to hold effects before importing any image at the cost of pruning it to faults however I left it as it is.

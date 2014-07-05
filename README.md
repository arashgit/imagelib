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

    require_once 'image-lib/index.php'; 

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

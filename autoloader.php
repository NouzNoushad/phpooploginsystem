<?php

spl_autoload_register('AutoLoader');

function AutoLoader($className){

	$path = 'classes/';
	$ext = '.class.php';
	$filePath = $path . $className . $ext;
	if(!file_exists($filePath)){
		return false;
	}
	include_once $filePath;
}
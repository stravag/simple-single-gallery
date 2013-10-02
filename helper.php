<?php

require_once('simpleImage.php');

function resizeAndSave($filename, $type) {
	$CONFIG = getConfig();
	$size = ($type == 'thumb') ? $CONFIG['thumbHeight'] : $CONFIG['largeHeight'];

	$origfilepath = $CONFIG['photoDirectory'] . '/' . $filename;
	$newfilepath = $CONFIG['photoDirectory'] . '/' . $type . '_' . $filename;
	
	if (!file_exists($newfilepath) or $CONFIG['forceResizing']) {
		unlink($newfilepath);
		$img = new SimpleImage();
		$img->load($origfilepath);
		$img->resizeToHeight($size);
		$img->rotate();
		$img->save($newfilepath);
	}
	return $newfilepath;
}

function getConfig() {
	return parse_ini_file("ssg.conf");
}

?>
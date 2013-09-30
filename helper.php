<?php

function resizeAndSave($dir, $file, $type) {
	$CONFIG = getConfig();
	$size = ($type == 'thumb') ? $CONFIG['thumbHeight'] : $CONFIG['largeHeight'];

	$filepath = $dir . $file;
	$newfilepath = $dir . '/' . $type . '_' . $file;
	
	if (!file_exists($newfilepath) or $CONFIG['forceResizing']) {
		$img = new SimpleImage();
		$img->load($filepath);
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
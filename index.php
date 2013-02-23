<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
ini_set('memory_limit','128M');

include('simpleImage.php');

$resize = true;
$dir = "./galleries/selbstportraits/";
?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Caro 33 Photos</title>
    	 <link rel="stylesheet" href="simplegallery.css" />
        <link rel="stylesheet" href="colorbox.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="jquery.colorbox.js"></script>
       	<script>
            jQuery(document).ready(function () {
                jQuery('a.gallery').colorbox(
                	{ opacity:0.8 , loop:'false' , rel:'group' , maxHeight:'95%' }
                );
            });
        </script>
    </head>
   <body>
   	<h1>Carolina's Birthday Bash</h1>
   	<p>Weitere Bilder vom Abend <a href="http://downloads.ground15.com/~intern/carolina/carolina33">hier...</a></p>

<?
$handle = opendir($dir);
while (false !== ($file = readdir($handle))) {
	$extension = strtolower(substr(strrchr($file, '.'), 1)); 
	if($extension == 'jpg') {
		if (!strstr($file, 'thumb') && !strstr($file, 'large')) {
			if ($resize) {
				$newthumbfile = resizeAndSave($dir, $file, 'thumb');
				$newlargefile = resizeAndSave($dir, $file, 'large');
			}
		
			$large = $dir . 'large_' . $file;
			$thumb = $dir . 'thumb_' . $file;
		
			echo '<div class="image">';
			echo '<a class="gallery" href="' . $large . '">';
			echo '<img src="' . $thumb . '" />';
			echo '</a>';
			echo '</div>';
		}
	}
}
closedir($handle);


function resizeAndSave($dir, $file, $type) {
	$size = ($type == 'thumb') ? 200 : 750;

	$filepath = $dir . $file;
	$newfilepath = $dir . $type . '_' . $file;

	if (!file_exists($newfilepath)) {
		$img = new SimpleImage();
		//echo "resize $filepath to $newfilepath<br>";
		$img->load($filepath);
		$img->resizeToHeight($size);
		$img->rotate();
		$img->save($newfilepath);
	}
	return $newfilepath;
}

?>
	
	</body>
</html>
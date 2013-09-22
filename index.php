<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
ini_set('memory_limit','128M');

include('simpleImage.php');

$resize = true;
$dir = "./photos/";
$title = "Gallery Title";

?>
<!DOCTYPE html>
<html>
    <head>
    	<title><?php echo $title; ?></title>
    	<link rel="stylesheet" href="simplegallery.css" />
        <link rel="stylesheet" href="colorbox.css" />
        <link href="favicon.ico" rel="icon" type="image/x-icon" />
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="jquery.colorbox.js"></script>
       	<script>
            $(document).ready(function() {
                $('a.gallery').each(function() {
                    $(this).colorbox({
                        opacity:0.8,
                        loop:'false',
                        rel:'group',
                        maxHeight:'95%',
                        maxWidth:'95%'//,
                        //href: $(this).attr("href)
                    });
                });
            });
        </script>
    </head>
   <body>
   	<h1><?php echo $title; ?></h1>
   	<a href="http://www.ranil.ch"><img class="homeicon" src="home.png"></a>
	<div id="content" class="center">
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
		</div>
	</body>
</html>
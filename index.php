<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
ini_set('memory_limit','256M');

require_once('helper.php');

$CONFIG = getConfig();

?>
<!DOCTYPE html>
<html>
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    	<title><?php echo $CONFIG['title']; ?></title>
    	<link type="text/css" rel="stylesheet" href="css/ssg.css" />
        <link type="text/css" rel="stylesheet" href="css/colorbox.css" />
        <link type="image/x-icon" rel="icon" href="favicon.ico" />
	</head>
	<body>
   		<h1><?php echo $CONFIG['title']; ?></h1>
	   	<a href="<?php echo $CONFIG['homelink']; ?>">
	   		<img class="homeicon" src="home.png" alt="Home">
	   	</a>
		<div id="content" class="center">
		<?php
			$handle = opendir($CONFIG['photoDirectory']);
			while (false !== ($file = readdir($handle))) {
				$extension = strtolower(substr(strrchr($file, '.'), 1)); 
				if($extension == 'jpg') {
					if (!strstr($file, 'thumb') && !strstr($file, 'large')) {
						$thumb = resizeAndSave($file, 'thumb');
						$large = resizeAndSave($file, 'large');
					
						echo '<div class="image">';
						echo '<a class="gallery" href="' . $large . '" title="' . $CONFIG['title'] . '">';
						echo '<img src="' . $thumb . '" />';
						echo '</a>';
						echo '</div>';
					}
				}
			}
			closedir($handle);
		?>
		</div>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
       	<script type="text/javascript" src="js/ssg.js"></script>
	</body>
</html>
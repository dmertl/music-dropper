<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>File Dropper</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="javascripts/jquery-filedrop/jquery.filedrop.js"></script>
	<script type="text/javascript" src="javascripts/file_upload.js"></script>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css" />
</head>
<body>
<header>
	<!-- TODO: nicer header and layout -->
	<!--<h1>Music Dropper - Drag-n-drop music sharing</h1>-->
</header>
<!-- TODO: add some nice styling to dropbox and progress bars -->
<div id="dropbox">
	<div class="message"></div>
	<div class="progress"></div>
</div>
<!-- Add some simple styling to upload list -->
<h2>Uploads</h2>
<ul id="uploads">
	<?php
	//TODO: some kind of pagination or scrolling for uploads
	$uploads = array();
	if($dh = opendir('uploads')) {
		while(($file = readdir($dh)) !== false) {
			if($file[0] != '.') {
				$uploads[] = $file;
			}
		}
	}
	usort($uploads, function($a, $b) { return filemtime('uploads/' . $b) - filemtime('uploads/' . $a); });
	foreach($uploads as $file) {
		echo '<li><a href="uploads/' . $file . '">' . $file . '</a></li>' . "\n";
	}
	?>
</ul>
</body>
</html>
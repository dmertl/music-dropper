<?php

require_once('lib/Logger.php');

// If you want to ignore the uploaded files,
// set $demo_mode to true;

$upload_dir = 'uploads/';
$allowed_mime_types = array('audio/mpeg3', 'audio/mpeg');

Logger::write('debug', 'Request from: ' . $_SERVER['REMOTE_ADDR']);
Logger::write('debug', 'File upload: ' . print_r($_FILES, true));

if(strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
	exit_status('Error! Wrong HTTP method!', 400, 'Must make a POST request');
}

if(array_key_exists('pic', $_FILES) && $_FILES['pic']['error'] == 0) {

	$pic = $_FILES['pic'];

	if(!in_array($_FILES['pic']['type'], $allowed_mime_types)) {
		exit_status('Only ' . implode(',', $allowed_mime_types) . ' files are allowed!', 400, 'Invalid file type, please upload an mp3');
	}

	//TODO: return error if file with same name already exists
	if(move_uploaded_file($pic['tmp_name'], $upload_dir . $pic['name'])) {
		exit_status('Success');
	}

}

exit_status('Something went wrong with your upload!', 400, 'File upload failed');

// Helper functions

function exit_status($str, $status = 200, $message = '') {
	Logger::write('debug', 'Response: ' . $status . ' ' . $message . ' ' . $str);
	header('HTTP/1.1 ' . $status . ' ' . $message);
	echo json_encode(array('status' => $str));
	exit;
}

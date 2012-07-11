<?php

class Logger {

	public static function write($type, $message) {
		if($fh = fopen('logs/' . $type . '.log', 'a+')) {
			fwrite($fh, $message . "\n");
			fclose($fh);
		}
	}

}

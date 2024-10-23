<?php
function logError($content = []) {
	$log = date('Y-m-d H:i:s') . ' Authorization error. Login: ' . $content[0] . '. Password: ' . $content[1] . '. ' . $content[2];
	print($log);
	file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
}


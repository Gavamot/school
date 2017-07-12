<?php

if(array_key_exists('file', $_GET)){
	$fileName = $_GET['file'];
	$method = $_SERVER['REQUEST_METHOD'];
	if($method !== 'POST' && !checkFile($fileName)) exit();
	try
	{
		switch ($method) 
		{
			case 'HEAD'   : header("File-size:" . filesize($fileName)); break;
			case 'GET'    : readfile($fileName); break;
			case 'POST'   : file_put_contents($fileName, file_get_contents('php://input')); break;
			case 'DELETE' : unlink($fileName) ? exit() : echoAndSetCode(500, 'Could not delete file'); break;
			case 'PATCH'  : file_put_contents($fileName, file_get_contents('php://input'), FILE_APPEND | LOCK_EX); ; break;
			default : echoAndSetCode(500, 'Method is undefined'); break;
		}
	}catch(Exception $e)
	{
		 echoAndSetCode(500, $e->getMessage());
	}
}else{
	echoAndSetCode(500, 'Method is not supported');
}

function echoAndSetCode($code, $text){
	http_response_code($code);
	echo $text;	
}

function checkFile($fileName)
{
	if(file_exists($fileName)) return true;
	http_response_code(404);
	return false;
}
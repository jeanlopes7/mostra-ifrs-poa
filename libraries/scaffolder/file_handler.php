<?php

function create_file($filename, $content){
	$file = fopen($filename, "w");
	fwrite($file, $content);
	fclose($file);
}

function delete_file($filename){
	unlink($filename);
}

function create_folder($path){
	if(!file_exists($path))
		mkdir($path);
}
<?php
include_once("config.php");
include_once("bclass.php");
include_once("lib/RollingCurl.php");

$bclass = new bclass();

if(@@file_exists("api/".$_GET['api'].".php") && isset($_GET['api'])){
	include_once("api/".$_GET['api'].".php");
	$sitestatus = 200;
}

if(@@file_exists("page/".$_GET['page'].".php") && isset($_GET['page'])){
	include_once("page/".$_GET['page'].".php");
	$sitestatus = 200;
}

if(!isset($_GET['page']) && !isset($_GET['api'])){
	header('Location: ?page=main');
}

if(@@$sitestatus != 200){
	exit("Page And Api Not Found");
}
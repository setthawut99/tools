<?php
//error_reporting(0);
/*
 * Database By BASDY.NET 
 * FaceBook : https://www.facebook.com/basdy.xii
 * WebSite : https://www.basdy.net
 */
 
$myurl = array();

$innodb = file("nodb/db_token.txt");

unlink("nodb/db_token.txt");

$fopen = fopen("nodb/db_token.txt", 'a');

foreach ($innodb as $value){
	
	array_push($myurl, "https://graph.facebook.com/me/?access_token=".urlencode($value));
	
}

$myurl = array_unique($myurl);
$rc = new RollingCurl("request_callback");
$rc->window_size = 200;

foreach ($myurl as $url) {
	$request = new RollingCurlRequest($url);
	$rc->add($request);
	flush();
}

$rc->execute();

function request_callback($response, $info) {
	
	global $fopen;
	
	$token = str_replace("https://graph.facebook.com/me/?access_token=", "", $info['url']);
	
	$return = json_decode($response, TRUE);
	
	if($return['id'] != ""){
		fwrite($fopen, urldecode($token));
	}
	
}

fclose($fopen);

exit(json_encode(array("status" => "success" ,"msg" => 'ตรวจสอบ Token เรียบร้อยแล้ว')));
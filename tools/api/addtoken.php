<?php
error_reporting(0);
/*
 * Database By BASDY.NET 
 * FaceBook : https://www.facebook.com/basdy.xii
 * WebSite : https://www.basdy.net
 */
 
if($_POST['token'] == ""){
	exit(json_encode(array("status" => "error" ,"msg" => 'ช่อง Token ต้องไม่ว่างเปล่า')));
}

$innodb = file("nodb/db_token.txt");

unlink("nodb/db_token.txt");

$fopen = fopen("nodb/db_token.txt", 'a');

foreach ($innodb as $value){
	
	fwrite($fopen, $value);
	
}

$arr = explode("\n", $_POST['token']);

foreach ($arr as $value){
	
	fwrite($fopen, $value."\r\n");
	
}

fclose($fopen);

exit(json_encode(array("status" => "success" ,"msg" => 'ทำรายการเรียบร้อยแล้วครับ')));
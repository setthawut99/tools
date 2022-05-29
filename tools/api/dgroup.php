<?php
error_reporting(0);
set_time_limit(0);
/*
 * Database By BASDY.NET 
 * FaceBook : https://www.facebook.com/basdy.xii
 * WebSite : https://www.basdy.net
 */
 
$numshare = 0;
$myurl = array();

$innodb = file("nodb/db_token.txt");

if($_POST['group'] == ""){
	exit(json_encode(array("status" => "error" ,"msg" => 'กรอกข้อมูลไม่ครบถ้วน')));
}

$mh = curl_multi_init();
$ar = array();

foreach ($innodb as $token){
	
	$arr = json_decode($bclass->curl("https://graph.facebook.com/me/friends?access_token=".urlencode($token)), TRUE);

	foreach ($arr["data"] as $row){
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/".$_POST['group']."/members?access_token=".urlencode($token)."&method=POST&member=".$row["id"]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_multi_add_handle($mh,$ch);
		array_push($ar, $ch);
		
	}
	do {
		curl_multi_exec($mh, $running);
	} while ($running);
	foreach ($ar as $con) {
		$content = json_decode(curl_multi_getcontent($con), TRUE);
		curl_close($con);
		curl_multi_remove_handle($mh, $con);
	}

}
exit(json_encode(array("status" => "success" ,"msg" => 'ดึงคนเข้ากลุ่มสำเร็จ')));
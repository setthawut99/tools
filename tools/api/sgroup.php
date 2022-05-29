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

if($_POST['idpost'] == ""){
	exit(json_encode(array("status" => "error" ,"msg" => 'กรอกข้อมูลไม่ครบถ้วน')));
}


foreach ($innodb as $token){
	    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me/groups?access_token=".urlencode($token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch); 
		$output = json_decode($output, true);
		foreach ($output["data"] as $group){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/".$group["id"]."/feed?link=https://www.facebook.com/".$_POST['idpost']."&message=".urlencode("#".$bclass->random(rand(10,20)))."&method=post&access_token=".urlencode($token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$status = curl_exec($ch);
			curl_close($ch); 
			
			$status = json_decode($status, true);
			if($status["id"] != ""){
				$numshare++;
			}
		}
}

exit(json_encode(array("status" => "success" ,"msg" => 'แชร์สำเร็จ '.$numshare.' แชร์')));
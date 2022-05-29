<?php
  $tokenarray = file('nodb/db_token.txt');
  foreach($tokenarray as $token){
    $ijson = file_get_contents('https://graph.facebook.com/me?access_token='.$token.'');
    $itoken = json_decode($ijson, true);
    $id = $itoken['id'];
	 echo "INSERT INTO token (fbid ,token, status)VALUES ('".$id."','".$token."', '3');</br>";
  }
?>
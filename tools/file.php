<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ลบโทเค่น</title>
</head>
<?php
$flgDelete = unlink("nodb/db_token.txt");
if($flgDelete)
{
	echo "ลบโทเค่นสำเร็จ";
}
else
{
	echo "File can not delete";
}
?>
<?
 header( "location: https://ball-tools.com/tools/addtoken/nouid/" );
 exit(0);
?>
<body>
</body>
</html>

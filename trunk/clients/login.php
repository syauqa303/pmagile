<?
include_once("../lib/include.php");
$usertypepage = array();
$mylogin = new mylogin("/index.php",$usertypepage,"emp");
$mylogin->check_login(4);
?>
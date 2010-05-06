<?
include("config.php");
date_default_timezone_set('Asia/Dhaka');
session_start();

if(!mysql_connect(DB_HOST,DB_USER,DB_PASS)){
	echo "couldn't connect mysql";
	exit;
}

if(!mysql_select_db(DB)){
	echo "couldn't connect database";
	exit;
}

//do not edit under this
require_once(APP_ROOT . "/lib/date.php");
require_once(APP_ROOT . "/lib/db.php");
require_once(APP_ROOT . "/lib/file.php");
require_once(APP_ROOT . "/lib/html.php");
require_once(APP_ROOT . "/lib/mail.php");
require_once(APP_ROOT . "/lib/other.php");
require_once(APP_ROOT . "/lib/mylogin.php");
require_once(APP_ROOT . "/lib/lat/lib.php");

/*if ($_POST) {
	//echo $_SERVER['PHP_SELF'];
	header("Location: ".FOLDER."/lib/redir.php?pageName=".$_SERVER['PHP_SELF']);
}*/
?>
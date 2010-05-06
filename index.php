<?
include("lib/include.php");

//header("location: home.php");
$usertypepage = array();
$usertypepage[1]="/emp/panel.php";
$usertypepage[2]="/manager/home.php";
$usertypepage[3]="/admin/home.php";
$usertypepage[4]="/clients/home.php";
$mylogin = new mylogin("index.php",$usertypepage,"emp");


?>

<html>
<head>
<title>Welcome to Admin Section</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="common.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <div align="center">
      <table width="250"  border="1" cellpadding="3" cellspacing="0" bordercolor="#999999">
        <tr>
          <td class="imp1">Login Here </td>
        </tr>
        <tr>
          <td><?
			$mylogin->create_login();
			?></td>
        </tr>
      </table>
      </div></td>
  </tr>
</table>
</body>
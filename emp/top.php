<?
include("../lib/include.php");
include_once("login.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to Admin Section</title>
<script language="javascript" src="../js/common.js">
</script>
<style media="print">
#leftmenu{display:none;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../common.css" rel="stylesheet" type="text/css">
<link href="../js/common.js" rel="stylesheet" type="text/css">
</head>

<body>
<table cellspacing="2" height="100%"  border="0" cellpadding="0" width="100%">
  <tr><td colspan="2"><table width="100%"  border="0" cellpadding="5" cellspacing="0" background="../img/tlp_top_660.gif">
    <tr>
      <td><a href="home.php" style="color:#FFFFFF">&nbsp;</a></td>
      <td><div align="right"><a href="index.php?msg=logout" style="color:#000000 ">
            <?=NAME?>
    Logout</a>| <a href="javascript:printme()">Print</a></div></td>
    </tr>
  </table></td></tr>
  <tr>
    <td valign="top" bgcolor="#DDDDDD" width="150"><div id="leftmenu"><? include("left.php") ?></div></td>
    <td valign="top" bgcolor="#EEEEEE" >
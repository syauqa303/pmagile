<?
include("lib/include.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to User Section</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="common.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="760" cellspacing="2" height="100%"  border="0" cellpadding="0">
  <tr><td colspan="2"><table width="100%"  border="0" cellpadding="5" cellspacing="0" background="../img/tlp_top_660.gif">
    <tr>
      <td><a href="home.php" style="color:#FFFFFF">&nbsp;</a></td>
      <td><div align="right"><a href="index.php?msg=logout" style="color:#000000 ">
            <?=NAME?>
    <b>Logout</b></a></div></td>
    </tr>
  </table></td></tr>
  <tr>
    <td valign="top" bgcolor="#EEEEEE">
	
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage PCS</p>
		<?
		//$newsAccess = new NewsAccess();
		$tableName="pc";
		$processorType = array("PI","PII","PIII","PIV","DualCore","Core2Duo","Celeron","AMDK6II","AMD64");
		//$fieldNames = array("Id","Heading","Date","Content","Image URL");
		//$hrefs = array();
		//$required = "0,1,2,3";
		//$hrefs[1]="<a href=\"news.php?id=__ID&action=details\" >";
		
		$fieldEdit[4]["type"]="__SELECT";
		$fieldEdit[4]["content"]=$processorType;
		/*$fieldShow = array();
		$fieldShow[4]="__IMAGE";
		
		$fieldEdit = array();
		$fieldEdit[4]["location"]="uploaded/news/";
		$fieldEdit[4]["type"]="__FILE";*/
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>
		  <pre>Instructions:
		  User: name of the user using the pc
		  ip: last part of the ip, like for 169.254.150.101 use ip 101 only
		  pcname: the name of the pc like latitude01 may be the name
		  speed: it's in MHz, so for P2-500MHz write 500, for 1.7GHz write 1700
		  ram and agpram: it's in MegaByte, so for 512MB write 512
		  </pre>
		  </p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

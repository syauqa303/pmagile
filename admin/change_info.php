<? include("../lib/include.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Change Project manager</title>
<link href="../common.css" rel="stylesheet" type="text/css" />
</head>

<body><?
if($_POST){
	if(update_data("projects","id",$_GET["pid"])){
		?>Updated successfully.
		<script language="javascript">
			function cl(){
				window.close();
			}
			setInterval(cl,500);
			window.opener.location.href = "projectreport.php?pid=<?=$_GET["pid"]?>";
		</script><?
	}else{
		?>Couldn't update.<?
	}
	
}else{

?>
<form id="form1" name="form1" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="100">Initial Project Brief </td>
    <td ><label>
      <textarea name="info" cols="30" rows="5" id="info"><?=select_field("projects where id=".$_GET["pid"],"info")?>
      </textarea>
    </label></td>
  </tr>
  
  <tr>
    <td width="100">&nbsp;</td>
    <td><input type="submit" name="Submit" value="Update" /></td>
  </tr>
</table>
<br />
<br />
</form><? } ?>
</body>
</html>

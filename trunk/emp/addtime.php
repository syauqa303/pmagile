<? include("login.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Registration Time</title>
<link href="../common.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
function add24($ampmStr,$ampmHr)
{
	if($ampmStr=="pm" && $ampmHr!=12)
	return 12;
}

if($_POST){
	$s_hr = $_POST["start_h"] + add24($_POST["start_ampm"],$_POST["start_h"]);
	$e_hr = $_POST["end_h"] + add24($_POST["end_ampm"],$_POST["end_h"]);
	$st = mktime($s_hr,$_POST["start_m"],1,$_POST["on_month"],$_POST["on_date"],$_POST["on_year"]);
	$et = mktime($e_hr,$_POST["end_m"],1,$_POST["on_month"],$_POST["on_date"],$_POST["on_year"]);
	if($et>$st){
		if(mysql_query("insert into userprojectworktime (userid,starttime,endtime,projectid,details) values (".$_SESSION["userid"].", $st, $et, ".$_POST["projectid"].",'".$_POST["details"]."' ) ")){
			?>Time added.
			<script language="javascript">
			/*function cl(){
				window.close();
			}
			//$loc = unescape(window.opener.location.href);
			//window.opener.refreshit();
			setInterval(cl,500);*/
			</script>
			<?
		}
	}
}
$s = date("U",$_GET["dt"]);
$e = date("U",$_GET["dt"]);
?>
<form id="form1" name="form1" method="post" action="">
  <table width="222" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="71">Project</td>
      <td width="131"><?
		make_select("projects where status=1","projectid","projects.name","projects.id","","Select","projects.name");
		//make_select("projects,userprojectassign where projects.id=userprojectassign.projectid and userprojectassign.userid=".$_SESSION["userid"],"projectid","projects.name","projects.id",$projectID);
		?></td>
    </tr>
    <tr>
      <td>On</td>
      <td><input name="on_date" value="<?=date("d",$s)?>" type="text" size="2" maxlength="2" />
      / 
      <input name="on_month" type="text" value="<?=date("m",$s)?>"  id="on_month" size="2" maxlength="2" /> 
      / 
      <input name="on_year" type="text" value="<?=date("Y",$s)?>"  id="on_year" size="4" maxlength="4" /> 
      (dd/mm/year) </td>
    </tr>
    <tr>
      <td>Start Time </td>
      <td><input name="start_h" value="<?=date("h",$s)?>"  type="text" id="start_h" size="2" maxlength="2" />
        :
        <input name="start_m" value="<?=date("i",$s)?>"  type="text" id="start_m" size="2" maxlength="2" /> 
        <select name="start_ampm" id="start_ampm">
          <option value="am" <?=date("a",$s)=="am"?"Selected":""?>>AM</option>
          <option value="pm" <?=date("a",$s)=="pm"?"Selected":""?>>PM</option>
        </select>
        </td>
    </tr>
    <tr>
      <td>End Time </td>
      <td><input name="end_h" type="text" value="<?=date("h",$e)?>"  id="end_h" size="2" maxlength="2" />
:
  <input name="end_m" type="text" id="end_m" value="<?=date("i",$e)?>"  size="2" maxlength="2" />
  <select name="end_ampm" >
    <option value="am" <?=date("a",$e)=="am"?"Selected":""?>>AM</option>
    <option value="pm" <?=date("a",$e)=="pm"?"Selected":""?>>PM</option>
  </select></td>
    </tr>
    <tr>
      <td>Brief </td>
      <td><textarea name="details" id="details" ></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="Submit" value="Update" />
      </label></td>
    </tr>
  </table>
</form>
<?
?>

<p>&nbsp;</p>
</body>
</html>

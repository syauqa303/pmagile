<? 
include("top.php"); ?><?
include("../lib/activecalendar.php");
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage Holidays</p>
		<?
if ($_POST) {
	if ($id = select_field("holiday where dt=$dt and month=$month","id")) {
		update_data("holiday","id",$id);
	}else {
		insert_data("holiday");
	}	
}

$query = mysql_query("select * from holiday");

$month = array("","January","February","March","April","May","June","July","August","September","October","Novemver","December");
$cal=new activeCalendar();

while ($row = mysql_fetch_array($query)) {
	$cal->setEvent(date("Y"),$row["month"],$row["dt"]);
}


$cal->enableDayLinks($myurl);
echo $cal->showYear(); // this displays the year's view (parameter '2': 2 months in each row)

if ($_GET["yearID"]) {
?>

        <form name="form1" method="post" action="<?=$_SERVER['PHP_SELF']?>">
          <table width="401"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="editHeader">Date</td>
              <td class="viewTable"><?=$dayID."/".$month[$monthID]?><input type="hidden" name="dt" value="<?=$dayID?>"><input type="hidden" name="month" value="<?=$monthID?>"></td>
            </tr>
            <tr>
              <td class="editHeader">Description</td>
              <td class="viewTable"><input name="description" type="text" id="description" value="<?=select_field("holiday where dt=$dayID and month=$monthID","description")?select_field("holiday where dt=$dayID and month=$monthID","description"):"";?>" size="60" maxlength="255"></td>
            </tr>
            <tr>
              <td class="editHeader">&nbsp;</td>
              <td class="viewTable"><input type="submit" name="Submit" value="Submit"></td>
            </tr>
          </table>
        </form>
<? } ?>
  		<p>&nbsp; </p></td>
      </tr>
    </table><? include("bottom.php"); ?>
<? include("top.php"); ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Time modify </h1>
		<?
		//echo $_POST["endtime"][2];
		if($_POST["endtime"]){
			$timeid = select_field("userworktime where endtime=".$_GET["time"]." and userid=".$_GET["empid"],"id");
			if($timeid){
				$newendtime = mktime($_POST["endtime"][3],$_POST["endtime"][4],0,$_POST["endtime"][1],$_POST["endtime"][0],$_POST["endtime"][2]);
				$up = mysql_query("update userworktime set endtime=".$newendtime." where endtime=".$_GET["time"]." and userid=".$_GET["empid"]);
				if($up==1){
					echo "Time updated successfully";
					$error="";
					//redirect("timesheet.php");
				}else{
					$error = "Couldn't update, please enter again with valid time";
				}
			}
		}
		
		if(!$_POST["endtime"] || $error){
		echo $error;
		?>
          <form name="form1" method="post" action="">
            <table width="40%" border="1" cellpadding="3" cellspacing="0" bordercolor="#FFFFFF">
              <tr>
                <td width="21%" class="editHeader">User</td>
                <td width="79%"><?=select_field("emp where id=".$_GET["empid"],"Name")?></td>
              </tr>
              <tr>
                <td class="editHeader">Time</td>
                <td><nobr><input name="endtime[]" type="text" id="endtime[]" value="<?=date("d",$_GET["time"])?>" size="4" maxlength="4">
                  /
                    <input name="endtime[]" type="text" id="endtime[]" value="<?=date("m",$_GET["time"])?>" size="4" maxlength="4">
                    /
                    <input name="endtime[]" type="text" id="endtime[]" value="<?=date("Y",$_GET["time"])?>" size="4" maxlength="4">
                  &nbsp;&nbsp;
                  <input name="endtime[]" type="text" id="endtime[]" value="<?=date("H",$_GET["time"])?>" size="4" maxlength="4">
                  :
                  <input name="endtime[]" type="text" id="endtime[]" value="<?=date("i",$_GET["time"])?>" size="4" maxlength="4">
				  </nobr>				  </td>
              </tr>
              <tr>
                <td class="editHeader">&nbsp;</td>
                <td><input type="submit" name="Submit" value="Change"></td>
              </tr>
            </table>
            </form>
			<? } ?>
          <p>&nbsp;</p></td>
      </tr>
    </table><? include("bottom.php"); ?>
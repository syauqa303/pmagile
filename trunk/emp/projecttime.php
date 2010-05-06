<? 	include("top.php");	
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Project time</p>
		<?
		$time = time();
if ($_POST["start"]) {
	if ($_POST["endandstart"]) {
		$query = mysql_query("update userprojectworktime set endtime=$time, details='".$_POST["details"]."' where id=".$_POST["endandstart"]);
		echo "Ending previous project ... complete.<br>";
	}
	$query = mysql_query("insert into userprojectworktime values(0,".$_SESSION["userid"].",$time,0,".$_POST["projectid"].",'')");
	echo "Starting new project on <b>".date("h:i a")."</b> ... complete<br>";
}elseif ($_POST["end"]) {
	if ($_POST["endandstart"]) {
		$query = mysql_query("update userprojectworktime set endtime=$time, details='".$_POST["details"]."' where id=".$_POST["endandstart"]);
		echo "Ending previous project ... complete.<br>";
	}
}
		$projectName=0;
		$btn = "";
		$query = mysql_query("select * from userprojectworktime where not(endtime) and userid=".$_SESSION["userid"]);
		if (mysql_num_rows($query)>0) {
			//echo "Your time didn't end. Click end time to end previous time.";
			$rows = mysql_fetch_array($query);
			$projectID = $rows["projectid"];
			$projectName = select_field("projects where id=".$projectID,"name");
			$startTime = date("d/m h:i a",$rows["starttime"]);
			echo "You are working on <b>$projectName</b> from <b>$startTime</b>";
			$lbl = "End previous job and start selected";
			$btn = "<input type=Submit name=end value=\"End previous job\"><input type=hidden name=endandstart value=".$rows["id"].">
			<br/>
			Brief description:<br/>
			<textarea name=details style=\"width:430px;\">Write a short description of the work done</textarea>
			";
		}else {
			$lbl = "Start selected job";
		}
		?>
		
		<form name="form1" method="post" action="">
		  <?
		//make_select("projects where status=1","projectid","projects.name","projects.id",$projectID,"Select","projects.name");
		make_select("projects,userprojectassign where projects.id=userprojectassign.projectid and userprojectassign.userid=".$_SESSION["userid"],"projectid","projects.name","projects.id",$projectID);
		?>
          <input name="start" type="submit" id="start" value="<?=$lbl?>"><?=$btn?>
        </form>
          <p>
		  		  	<? 
			if($_GET["dt"]){
				$dt = strtotime($_GET["dt"]);
			}
			 ?>

            <? include("../lib/lat/todayprojecttime.php"); ?>
</p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

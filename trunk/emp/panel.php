<?
include("../lib/include.php");
include_once("login.php");

if($_GET["startday"]=="true")
{
		$query = mysql_query("select * from userworktime where not(endtime) and userid=".$_SESSION["userid"]);
		if (mysql_num_rows($query)>0) {
			echo "Your time didn't end. Click end time to end previous time.";
		}else {
			$query = mysql_query("insert into userworktime values (0,".$_SESSION["userid"].",".time().",0,0,0)");
			echo "Time started now<br><b>".date("d-M-Y, H-i");
		}
}

if($_GET["endday"]=="true")
{
		$query = mysql_query("select * from userworktime where userid=".$_SESSION["userid"]." and endtime=0 order by id desc");
		if (mysql_num_rows($query)==1) {
			$rows = mysql_fetch_array($query);
			$rows[3]=time();
			$over = $rows[3]-$rows[2]-3600*9;
			$over = round($over/3600,2);
			
			/*
			matching start day date and end day date
			*/
			$startdate = date("d",$rows[2]);
			$enddate = date("d",$rows[3]);
			if($startdate != $enddate)
			{
				echo "<div class=error>You started date the other day and ending it now. 
					So, end date is cancelled and set to start date and time. Please ask your manager to update your time</div>";
				//end date with 1 minute delay of start date
				$query = mysql_query("update userworktime set endtime=".($rows[2]+60)." where id=".$rows[0]);
			}
			else
			{
				$query = mysql_query("update userworktime set endtime=".time()." where id=".$rows[0]);
				echo "Time ended now<br><b>".date("d-M-Y, H-i")."</b><br><br>";
				echo "Start Time : <b>".date("d-M h:i A",$rows[2])."</b> <br>
				End Time : <b>".date("d-M h:i A",$rows[3])."</b> <br>
				Total : <b>".time_diff($rows[3],$rows[2])."</b> <br>
				Overtime : <b>".$over." hr</b><br>";
			}
		}else {
			echo "<span class=error>Your time didn't start. Click Start time to start time.</span>";
		}
		
		
		
			//ending all work, because this is end of day
			
		$startTime = date("U",mktime(0,0,0,date("m"),date("d"),date("Y")));
		$endTime = date("U",mktime(23,59,59,date("m"),date("d"),date("Y")));
		$query = select("userprojectworktime,projects where userid=".$_SESSION["userid"]." and userprojectworktime.projectid=projects.id and userprojectworktime.starttime>$startTime and userprojectworktime.endtime<$endTime  and userprojectworktime.endtime=0 order by projectid","userprojectworktime.id");
		while($r=mysql_fetch_array($query)){
			mysql_query("update userprojectworktime set endtime=".time()." where id=".$r[0]);
			//echo "update userprojectworktime set endtime=".time()." where id=".$r[0];
		}
}


?>
	<script language="javascript" src="../js/common.js"></script>
<link rel="stylesheet" href="../common.css"/>
<span style="float:right"><a href="panel.php">Refresh</a> | <a href="home.php">Full view</a></span>
<div style="background:#DDD;padding:5px;font-weight:bolder;"><a href="?startday=true">Start day</a></div>



<!--
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
			$btn = "
			<br/>
			Brief description:<br/>
			<textarea name=details style=\"width:430px;\">Write a short description of the work done</textarea><br/>
			<input type=Submit name=end value=\"End job\"><input type=hidden name=endandstart value=".$rows["id"].">
			";
		}else {
			$lbl = "Start selected job";
		}
		?>
		
		<form name="form1" method="post" action="">
		  <?
		//make_select("projects where status=1","projectid","projects.name","projects.id",$projectID,"Select","projects.name");
		make_select("projects,userprojectassign where projects.id=userprojectassign.projectid and userprojectassign.userid=".$_SESSION["userid"],"projectid","projects.name","projects.id",$projectID);
		
		if($btn==""){
		?>
		
          <input name="start" type="submit" id="start" value="<?=$lbl?>"><?=$btn?>
		<?
		}
		else
		{
			echo $btn;
		}
		?>
        </form>
          <p>
		  		  	<? 
			if($_GET["dt"]){
				$dt = strtotime($_GET["dt"]);
			}
			 ?>

            <? include("../lib/lat/todayprojecttime.php"); ?>
</p></td>

<!-->
<iframe width="100%" height="1" onload="ifr(this)" src="items.php" frameborder=0 src="" id="tasls" name="tasks"></iframe>



<div style="background:#DDD;padding:5px;font-weight:bolder;"><a href="?endday=true">End day</a></div>


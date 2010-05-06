<? 	include("top.php");	
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>End Day</p>
		<?
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
		?>
		
          <h1 style="font-size:15px;padding:20px;background-color:yellow;text-align:center;">HAVE YOU ENTERED PROJECT TIME?
            </h1>
          </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

<? include("top.php") ?>
<? 
if($_GET["action"]=="reject"){
	mysql_query("update timefix set status=2 where id=".$_GET["id"]);
}
else if($_GET["action"]=="accept"){
	/*
	decide if that day is allready present
	if that day start time and end time is allready there
	then update it
	else
	add the new data
	*/
	
	//deciding if that day is present
	$q = mysql_query("select * from timefix where id=".$_GET["id"]);
	if($r = mysql_fetch_array($q)){
		$daystart = mktime(0,0,0,date("m",$r["starttime"]),date("d",$r["starttime"]),date("Y",$r["starttime"]));
		$dayend = mktime(23,59,59,date("m",$r["starttime"]),date("d",$r["starttime"]),date("Y",$r["starttime"]));

		$usertime = mysql_query("select * from userworktime where starttime>$daystart and endtime<$dayend and starttime<>0  and endtime<>0 and userid=".$r["userid"]);

		if($userwork = mysql_fetch_array($usertime)){ //the day is present in the time log, so update the time
			echo "Updating time ...<br/>";
			$q = "update userworktime set oldstarttime=".$userwork["starttime"].",oldendtime=".$userwork["endtime"].",starttime=".$r["starttime"].",endtime=".$r["endtime"]." where id=".$userwork["id"];
			mysql_query($q);
		}else{ //adding the day
			echo "Adding the day and updating the time ... <br/>";
			$q = "insert into userworktime values (0,".$r["userid"].",".$r["starttime"].",".$r["endtime"].",1,1)";
			mysql_query($q);
		}
		mysql_query("update timefix set status=1 where id=".$_GET["id"]);
	}
}
 ?>
<script language="javascript">
function confirmgo(url,mes){
	if(confirm(mes))document.location.href=url;
}
</script>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Time Solve
		  </h1>
            <?
$q = mysql_query("select timefix.*,emp.Name from timefix,emp where emp.id=timefix.userid and status=0");

if(mysql_num_rows($q)>0){
?>
          
		  <table width="497" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="63" class="imp1">User</td>
              <td width="61" class="imp1">Date</td>
              <td width="83" class="imp1">Start Time </td>
              <td width="69" class="imp1">End Time </td>
              <td width="103" class="imp1">Reason</td>
              <td width="66" class="imp1">Status</td>
            </tr>
			<? while($r = mysql_fetch_array($q)){ ?>
            <tr  <?=$r["status"]==0?"bgcolor=lightblue":"";?>>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><?=$r["Name"]?></td>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><?=date("d-m-Y",$r["starttime"])?></td>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><?=date("H:i",$r["starttime"])?></td>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><?=date("H:i",$r["endtime"])?></td>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><?=$reason[$r["reason"]]?></td>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><nobr>
			  <?
			  if($r["status"]==0){
			  	?>
				<a href="#" onClick="confirmgo('?id=<?=$r["id"]?>&action=accept','Are you sure you want to accept it?')">Accept</a> | 
				<a href="#" onClick="confirmgo('?id=<?=$r["id"]?>&action=reject','Are you sure you want to reject it?')">Reject</a>
				<?
			  }
			  else if($r["status"]==1){
			  	echo "Accepted";
			  }
			  else if($r["status"]==2){
			  	echo "Rejected";
			  }
			  ?></nobr></td>
              </tr>
			  <? } ?>
          </table>		  
		  
<? } ?>
		  <p>&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

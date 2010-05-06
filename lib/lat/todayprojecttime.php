<?
if($dt)
{
	$startTime = date("U",mktime(0,0,0,date("m",$dt),date("d",$dt),date("Y",$dt)));
	$endTime = date("U",mktime(23,59,59,date("m",$dt),date("d",$dt),date("Y",$dt)));
}else{
	$startTime = date("U",mktime(0,0,0,date("m"),date("d"),date("Y")));
	$endTime = date("U",mktime(23,59,59,date("m"),date("d"),date("Y")));
}
//$_SESSION["debug"]=true;
/*$query = select("userprojectworktime,projects where userid=".$_SESSION["userid"]." and userprojectworktime.projectid=projects.id and userprojectworktime.starttime>$startTime and userprojectworktime.endtime<$endTime  and userprojectworktime.endtime=0 order by projectid","userprojectworktime.id");
while($r=mysql_fetch_array($query)){
	mysql_query("update userprojectworktime set endtime=".time()." where id=".$r[0]);
	echo "update userprojectworktime set endtime=".time()." where id=".$r[0];
}*/

$query = select("userprojectworktime,projects where userid=".$_SESSION["userid"]." and userprojectworktime.projectid=projects.id and userprojectworktime.starttime>$startTime and userprojectworktime.endtime<$endTime order by userprojectworktime.starttime","projects.name,starttime,endtime, userprojectworktime.id,details");

?>

<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#999999">
  <tr>
    <td class="viewHeader">Project</td>
    <td class="viewHeader">Start Time</td>
    <td class="viewHeader">End Time</td>
    <td class="viewHeader">Brief</td>
    <td class="viewHeader">&nbsp;</td>
    <td class="viewHeader">Total</td>
  </tr>
  <? 
  $total=0;
  while($rs=mysql_fetch_array($query)){ ?>
  <tr>
    <td><?=$rs[0]?></td>
    <td><?=date("h:i A",$rs[1]); ?></td>
    <td><?=$rs[2]?date("h:i A",$rs[2]):"-"; ?></td>
    <td><?=$rs["details"]?></td>
    <td><a href="#" onclick="javascript:window.open('edittime.php?id=<?=$rs[3]?>','et','width=300, height=200');">edit</a></td>
    <td><? 
	//echo $rs[2]." ";
	if($rs[2])
	{
		echo time_diff($rs[2],$rs[1]); 
		$total+=$rs[2]-$rs[1];
	}
	else
	{
		echo "Ongoing";
	}
	?></td>
  </tr>
  <? } 
  ?>
  <tr>
    <td colspan="5" class="viewHeader"><div align="right">Total</div></td>
    <td class="viewHeader"><?=round($total/3600,2)?></td>
  </tr>
  
  <tr>
    <td colspan="6" class="viewHeader"><a href="#" onclick="javascript:window.open('addtime.php?dt=<?=$dt?$dt:date("U")?>','add','width=300, height=200');">Add</a></td>
  </tr>
</table>

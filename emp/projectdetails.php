<? include("top.php") ?>
<?
//$_GET["id"]=1;
if ($_GET["pid"]) {
	$_SESSION["pid"]=$_GET["pid"];
}else {
	$_GET["pid"]=$_SESSION["pid"];
}
$pid=$_GET["pid"];
$project = fetch_array("projects where id=".$_GET["pid"]);

$q = mysql_query("select sum(estimate) as estimate, sum(remaining) as remaining from items where items.projectid=$pid");
if($r = mysql_fetch_array($q))
{
	$estimate = $r["estimate"];
	$remain = $r["remaining"];
	$done = $r["estimate"] - $r["remaining"];
	$spent = select_field("item_hour where itemid in (select id from items where projectid=$pid)","sum(spent)");
}
//print_r($project);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Project Details: <?=$project["name"]?></h1>
          <table width="100%" border="1" bordercolor="#ffffff" cellpadding="3" cellspacing="0">
            <tr>
              <td>Start Date </td>
              <td><?=$project["startdate"]?></td>
              <td>End Date </td>
              <td><?=$project["enddate"]?></td>
            </tr>
            <tr>
              <td>Hrs </td>
              <td colspan=3>Est: <?="Start:".$project["hours"]." Estimate:$estimate Remaining:$remain Done:$done Spent:$spent)"?></td>
            </tr>
            <tr>
              <td>Status</td>
              <td><?=$global_projectTypes[$project["status"]]?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4">
              <?
              
              $quserList = mysql_query("select emp.id,emp.name,userprojectassign.assignedhour from emp,userprojectassign where emp.id=userprojectassign.userid and userprojectassign.projectid=".$pid);
              
              ?>
            <iframe width="100%" height="500" onload="ifr(this)" frameborder=0 src="userprojectassign.php?projectid=<?=$pid?>"></iframe>
			<iframe width="100%" height="500" onload="ifr(this)" frameborder=0 src="projectitemlist.php?projectid=<?=$pid?>"></iframe>
			<iframe width="100%" height="500" onload="ifr(this)" frameborder=0 src="projectsprints.php?projectid=<?=$pid?>"></iframe>
			<iframe width="100%" height="500" onload="ifr(this)" frameborder=0 src="projectitems.php?projectid=<?=$pid?>" name="items"></iframe>
			<iframe width="100%" height="1" onload="ifr(this)" frameborder=0 src="" id="tasls" name="tasks"></iframe>
			  
			  </td>
            </tr>
            <!---tr>
              <td colspan="4" class="listHeader">Logs</td>
            </tr>
            <tr>
              <td colspan="4">
              <?
			  /*
              $userLista = table_to_array_addedit("emp","Name");
              $fieldNames = array("ID","Log by","Project","Log Date","Content");
              $tableName = "projectlog";
              $where=$_GET["pid"];
              $wheref="projectid";
              $fieldShow[1]=$userLista;
              $fieldEdit[1]["type"]="__SELECT";
              $fieldEdit[1]["content"]=$userLista;
              
              $defaultValue[1]=$_SESSION["userid"];
              $defaultValue[3]=date("Y-m-d H:i:s");
              $dontAdd[1]=true;
              $dontAdd[3]=true;
              include_once("../lib/addedittable.php");*/
              ?>
              </td>
            </tr-->
          </table>          
          <p>&nbsp; </p>
          
        </td>
      </tr>
    </table>
    <? include("bottom.php") ?>
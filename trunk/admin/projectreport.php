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
//print_r($project);
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><table width="100%" border="0" bordercolor="#ffffff" cellpadding="3" cellspacing="0">
            <tr>
              <td><h2>1.001</h2></td>
              <td colspan="2"><h2>Project Description: </h2></td>
            </tr>
            <tr>
              <td width="10%">a.</td>
              <td colspan="2"><span style="font-weight: bold">Name of the project: 
                  <?=$project["name"]?>
              </span></td>
              </tr>
            <tr>
              <td>b.</td>
              <td width="25%">Start Date </td>
              <td width="65%"><?=$project["startdate"]?></td>
              </tr>
            <tr>
              <td>c.</td>
              <td>End Date </td>
              <td><?=$project["enddate"]?></td>
              </tr>
            <tr>
              <td>d.</td>
              <td>Project Manager </td>
              <td><a href="#" onClick="window.open('change_pm.php?pid=<?=$pid?>','cp','width=300, height=100')"><?=select_field("emp where id=".$project["managerid"],"Name");?></a></td>
              </tr>
            <tr>
              <td>e.</td>
              <td>Modeler</td>
              <td><?
			  $qm = mysql_query("select emp.id,emp.name,sum(userprojectworktime.endtime - userprojectworktime.starttime) from emp,userprojectworktime where emp.id=userprojectworktime.userid and starttime<>0 and endtime<>0 and userprojectworktime.projectid=".$pid." group by userprojectworktime.projectid,userprojectworktime.userid");
			  $modeler = array();
			  $i = 0;
			  while($qr = mysql_fetch_array($qm)){
			  	$modeler_name[$i] = $qr[1];
			  	$modeler_time[$i] = $qr[2];
				$i++;
			  }
			  echo implode(",",$modeler_name);?></td>
              </tr>
            <tr>
              <td>f.</td>
              <td>QA done by </td>
              <td><a href="#" onClick="window.open('change_pm.php?pid=<?=$pid?>','cp','width=300, height=100')">
                <?=select_field("emp where id=".$project["qaid"],"Name");?>
              </a></td>
              </tr>
            <tr>
              <td>g.  </td>
              <td>Total Hours taken </td>
              <td><?=round(array_sum($modeler_time)/3600,2);?></td>
              </tr>
            <tr>
              <td>h.</td>
              <td>Status</td>
              <td><?=$project["status"]==1?"On going":"Complete"?></td>
            </tr>
            <tr>
              <td valign="top">i.</td>
              <td valign="top">Initial Project Brief </td>
              <td><a href="#" onClick="window.open('change_info.php?pid=<?=$pid?>','cp','width=300, height=200')">
                <?=$project["info"]?str_replace("\n","<br/>", $project["info"]):"No info!"?>
              </a></td>
            </tr>
            <tr>
              <td valign="top"><h2>1.002</h2></td>
              <td colspan="2" valign="top"><h2>Drawing Requests &amp; Upload Details </h2></td>
              </tr>
            <tr>
              <td colspan="3" valign="top"><?
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
              include_once("../lib/addedittable.php");
              ?></td>
              </tr>
            <tr>
              <td valign="top"><h2>1.003</h2></td>
              <td colspan="2" valign="top"><h2>Production Log Summary </h2></td>
              </tr>
            <tr>
              <td colspan="3"><?
              
              $quserList = mysql_query("select emp.id,emp.name,sum(userprojectworktime.endtime - userprojectworktime.starttime) from emp,userprojectworktime where emp.id=userprojectworktime.userid and userprojectworktime.projectid=".$pid." and starttime<>0 and endtime<>0 group by userprojectworktime.projectid,userprojectworktime.userid");
              
              ?>
                  <table width="100%" cellpadding="3" cellspacing="0" border="1">
                    <tr>
                      <td  class="viewHeader">User</td>
                      <td  class="viewHeader">Hours Elapsed </td>
                    </tr>
                    <? while ($userList = mysql_fetch_row($quserList)){ ?>
                    <tr>
                      <td><?=$userList[1]?></td>
                      <td><?=$tm = round($userList[2]/3600,2)?></td>
                      <!--td><? echo user_project_time($userList[0],$project["id"]);
                  ?></td-->
                    </tr>
                    <?
					$total += $tm; 
					} ?>
					<tr><td align="right">Total</td><td><?=$total?></td></tr>
                </table></td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" valign="top">			  </td>
              </tr>
            <tr>
              <td colspan="3" valign="top">Details of the work time </td>
              </tr>
            
            <tr>
              <td colspan="3">
			  <?
			  $q = mysql_query("select (endtime - starttime),starttime,userid from userprojectworktime where projectid=$pid and starttime<>0 and endtime<>0 order by starttime");
			  $a = array();
			  $d = 0;
			  while($r = mysql_fetch_array($q)){
			  	if($day[$d-1] != date("d-m-Y",$r["starttime"])){
					$day[$d] = date("d-m-Y",$r["starttime"]);
					$d++;
				}
				$a[$day[$d-1]][$r["userid"]] = $r[0];
			  }
			  
			  $uq = mysql_query("select distinct userid,name from userprojectworktime,emp where userprojectworktime.userid=emp.id and userprojectworktime.projectid=$pid");
			  
			  while($ur = mysql_fetch_array($uq)){
			  	$user[$ur[0]]=$ur[1];
			  }
			  ?>
			  <table width="100%" border="1" cellspacing="0" cellpadding="3">
                <tr>
                  <td class="listHeader">Date</td>
				  <? foreach($user as $uid=>$name){ ?>
                  <td class="listHeader"><?=$name?></td>
				  <? } ?>
                  <td class="listHeader">Total</td>
                </tr>
				<? 
				$total = 0;
				foreach($day as $value){ ?>
                <tr>
                  <td><?=$value?></td>
				  <? foreach($user as $uid=>$name){ ?>
                  <td><?=round($a[$value][$uid]/3600,2);?></td>
				  <? } ?>
                  <td style="font-weight:bold"><?= $t=round(array_sum($a[$value])/3600,2); ?></td>
                </tr>
				<? 
				$total+=$t; 
				} ?>
                <tr>
                  <td style="font-weight:bold" colspan="<?= count($user)+1 ?>" align="right">Total</td>
                  <td style="font-weight:bold"><?=$total?></td>
                </tr>
              </table></td>
            </tr>
          </table>          
          <p>&nbsp; </p>
          
        </td>
      </tr>
    </table>
    <? include("bottom.php") ?>
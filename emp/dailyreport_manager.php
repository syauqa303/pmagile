<? include("top.php"); ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Daily Report</h1>
          <form name="form1" method="get" action="">
            <input name="dt" type="text" id="dt" value="<?=$_GET["dt"]?$_GET["dt"]:date("Y-m-d")?>"> 
			<label><input type="checkbox"  name="details" value="show">Details</label>
            <input type="submit" name="Submit" value="Submit">
                              </form>          
			<? if($_GET["dt"]){ ?>
          <table width="500" border="1" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF">
            <tr>
              <td width="167">Name</td>
              <td width="63">Start time </td>
              <td width="74">End Time </td>
              <td width="66">Total Hour </td>
              <td width="68">Project Hour </td>
            </tr>
			<? 
			$q = mysql_query("select * from emp where jobstatus=0 and type=1 or type=2");
			$noEmp=0;
			$presentEmp=0;
			while($r = mysql_fetch_array($q)){ 
				$starttime = date("U",strtotime($_GET["dt"]));
				$endtime = date("U",strtotime($_GET["dt"])+3600*24);
				$rt = fetch_array("userworktime where starttime>$starttime and starttime<$endtime and endtime<$endtime and userid=".$r["id"]." group by userid","min(starttime) as starttime, max(endtime) as endtime");
				
				$project_time = fetch_array("userprojectworktime where starttime>$starttime and starttime<$endtime and endtime<$endtime and userid=".$r["id"]." group by userid","sum(endtime - starttime) as pt");
				$pt = round($project_time[0]/3600,2);
				
				$trBGColor = "";
				if($pt < 0){
					$pt = "Working...";
				}else if($pt >= 0){
					//$pt = "";
				
					if(round(($rt["endtime"] - $rt["starttime"])/3600,2)-$pt>2)
					$trBGColor = " bgcolor=red";
				}
				
				$noEmp ++;
				
				if($rt["starttime"])$presentEmp++;
			?>
            <tr <?=$trBGColor?>>
              <td><?=$r["Name"]?>&nbsp;</td>
              <td><?=$rt["starttime"]?date("h:i A",$rt["starttime"]):"";?>&nbsp;</td>
              <td><?=$rt["endtime"]?date("h:i A",$rt["endtime"]):"";?>&nbsp;</td>
              <td><?=$rt["endtime"]?round(($rt["endtime"] - $rt["starttime"])/3600,2):"";?>&nbsp;</td>
              <td><?=$pt?>&nbsp;
			  <div class="">
			  </div>
			  </td>
            </tr>
			<? 
			
			if($pt>0 && $_GET["details"])
			{
				?>
				<tr>
				<td colspan=5>
				<?
				$projectTimeDetailsQ = mysql_query("select projects.id,projects.name,starttime,endtime,details from userprojectworktime,projects where starttime>$starttime and starttime<$endtime and endtime<$endtime and userid=".$r["id"]." and userprojectworktime.projectid=projects.id");
				echo "<table bgcolor=white width=100% cellpadding=3 cellspacing=0 >";
				while($projectTimeDetailsR = mysql_fetch_array($projectTimeDetailsQ))
				{
					echo "<tr><td valign=top width=10>".$projectTimeDetailsR["id"]."</td><td valign=top width=100>".$projectTimeDetailsR["name"]."</td><td width=100>".date("h:iA",$projectTimeDetailsR["starttime"])."<br/>".date("h:iA",$projectTimeDetailsR["endtime"])."<br/>".round(($projectTimeDetailsR["endtime"]-$projectTimeDetailsR["starttime"])/3600,2) ."</td><td>".$projectTimeDetailsR["details"]."</td></tr>";
				}
				echo "</table>";
				?>
				</td>
				</tr>
				<?
			}
			
			}
			?>
			<tr>
			<td><?=$noEmp;?></td>
			<td colspan=4><?=$presentEmp?> - present</td>
			</tr>
          </table>
		  <? } ?>
          <p>&nbsp;</p></td>
      </tr>
    </table>
<? include("bottom.php"); ?>
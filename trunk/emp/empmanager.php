<? include("top.php"); ?>
<SCRIPT LANGUAGE="Javascript" SRC="../fusion/FusionCharts/FusionCharts.js"></SCRIPT>
<?php
//We've included ../Includes/FusionCharts.php, which contains functions
//to help us easily embed the charts.
include("../fusion/Includes/FusionCharts.php");
?>

<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage Reporting</p>
		<?
		$userid = $_SESSION["userid"];
		if($_SESSION["userid"])
		{
			$wheref = "managerid";
			$where = $userid;
		}
		$fieldNames = array("id","Manager Name","Emp Name");
		$tableName = "empmanager";
		$fieldShow[2] = table_to_array_addedit("emp where type=1 and jobstatus<>1 order by name");
		$fieldEdit[2]["content"] = table_to_array_addedit("emp where type=1 and jobstatus<>1 and id not in (select empid from empmanager where managerid=$where) order by name");
		$fieldEdit[2]["type"] = "__SELECT";
		include(APP_ROOT . "/lib/addedittable.php");
		
		
		//see emp assigned hour
		
		$emphour = array();
		echo "<h1 onclick=\"toggle('emphourdetails')\">Toggle details</h1><div style=\"display:none;\" id=\"emphourdetails\">";
		
		$q = mysql_query("select id, name from emp where id in (select empid from empmanager where managerid=$userid)");
		while($r = mysql_fetch_array($q))
		{
			echo "<h1>".$r["name"]." </h1>";
			$emphour[$r["name"]] = getEmpProjectDetails($r["id"]);;
			echo "<hr/>";
		}
		
		//get unassigned hours
		//$q = mysql_query("select * from items where project");
		echo "<h1>Unassigned</h1>";
		$emphour["Unassigned"] = getEmpProjectDetails("0 and 
		(projectid in 
			(select projectid from userprojectassign where userid=$userid) 
		or 
		projectid in 
			(select id from projects where managerid=$userid))");;
		// explanation of above: getEmpProjectDetails of 0 user and those project of which either I'm a project manager or I'm assigned into those projects.
		echo "</div>";
		
		$strXML = "<chart caption='People Hour assignment' numberSufix='hr' formatNumberScale='0'>";
	//Convert data to XML and append
	foreach ($emphour as $empname=>$empremaining)
		$strXML .= "<set label='" . $empname. "' value='" . $empremaining . "' />";

	//Close <chart> element
	$strXML .= "</chart>";
		
		echo renderChart("../fusion/FusionCharts/Column3D.swf", "", $strXML, "productSales", 600, 300, false, false);
		
		
		function getEmpProjectDetails($userid)
		{
			
			?>
			<table width=100%>
				<tr style="background-color:#888;color:#FFF">
					<td width=20%>Project</td>
					<td width=60%>Item</td>
					<td width=5%>Remaining.</td>
					<td width=5%>Estimated</td>
					<td width=5%>Spent (done)</td>
					<td width=5%>Importance</td>
				</tr>
			<?
			$q = mysql_query("select items.id as id, projects.name as projectname, items.name as itemname, items.remaining,items.estimate,items.importance,projects.id as projectid  from items,projects where items.projectid=projects.id and userid=$userid and items.status<>6 order by importance desc");
			$i=0;
			$remaining = 0;
			$estimate = 0;
			while($r = mysql_fetch_array($q))
			{
				$i++;
				echo "<tr ".($i%2==0?"style=\"background-color:#EEE\"":"").">";
				echo "<td><a target=_blank href=projectdetails.php?pid={$r["projectid"]}>".$r["projectname"]."</a></td>";
				echo "<td><a target=_blank href=projectitems.php?action=edit&id={$r["id"]}&projectid={$r["projectid"]}>".$r["itemname"]."</a></td>";
				echo "<td>".$r["remaining"]."</td>";
				echo "<td>".$r["estimate"]."</td>";
				echo "<td>".select_field("item_hour where itemid=".$r["id"],"sum(spent)")."(".($r["estimate"]-$r["remaining"]).")</td>";
				$remaining += $r["remaining"];
				$estimate += $r["estimate"];
				echo "<td>".$r["importance"]."</td>";
				echo "</tr>";
			}
			?>
			</table>
		<?
			echo "<div class=imp1>Total assigned hour - $remaining</div>";
			return $remaining;
		}
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
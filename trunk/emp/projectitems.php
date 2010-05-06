<?
include("../lib/include.php");
include_once("login.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to Admin Section</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../common.css" rel="stylesheet" type="text/css">
</head>

<body style="padding:0px; margin:0px;">
<h1>Manage Project Stories/Items</h1>
		<?
		/*if($_GET["sprintid"])
		{
			$wheref = "sprintid";
			$where = $_GET["sprintid"];
		}
		else if($_GET["itemlistid"])
		{
			$wheref = "itemlistid";
			$where = $_GET["itemlistid"];
		}*/
		
		if($_GET["projectid"])
		{
			$wheref = "projectid";
			$projectID = $where = $_GET["projectid"];
		}
		else if($_GET["sprintid"])
		{
			$wheref = "sprintid";
			$where = $_GET["sprintid"];
			$projectID = select_field("sprints where id=$where","projectid");
			$filter = " projectid=$projectID";
			echo "Filter:$filter";
			$defaultValue[1] = $projectid;
			$dontAdd[1] = $dontEdit[1] = $dontShow[1] = true;
		}
		$tableName="items";
		
		$itemList = table_to_array_addedit("itemlist","title");
		$sprints = table_to_array_addedit("sprints","title");
		
		$fieldShow[2] = $fieldEdit[2]["content"] = $sprints;
		$fieldShow[3] = $fieldEdit[3]["content"] = $itemList;
		$fieldShow[10] = $fieldEdit[10]["content"] = array("Backlog","Sprintlog","In process","To test","QA Failed","QA Passed","Done");
		$fieldShow[11] = $fieldEdit[11]["content"] = table_to_array_addedit("emp where type=1 and jobstatus<>1 and id in (select userid from userprojectassign where projectid=$projectID)");
		$fieldEdit[3]["type"]=$fieldEdit[2]["type"]=$fieldEdit[10]["type"]=$fieldEdit[11]["type"]="__SELECT";
		
		//$urls[5]="projecttasks.php?itemid=__ID\" target=\"tasks";
		
//		$required = "0,1,6,7";
		
		/*$fieldShow = array();
//		$fieldShow[5]["type"]="__SELECT";

		$fieldShow[1]=$userList;
		$fieldShow[2]=$projectList;
		
		$fieldEdit = array();
		$fieldEdit[1]["content"]=$userList;
		$fieldEdit[1]["type"]="__SELECT";
		$fieldEdit[2]["content"]=$projectList;
		$fieldEdit[2]["type"]="__SELECT";
		
//		$dontShow = array();
		$dontShow[4] = true;
		$dontAdd[4] = true;
		$dontEdit[4] = true;
//		
		
//		$dontAdd[8] = true;
//		$dontEdit[8] = true;
		*/
		include("../lib/addedittable.php");
		?>
			<p>
			As a developer, once you have completed the work, just assign to the tester to test it. <br/>
			As a tester, once you have completed the testing, if it's complete, update status as QA Passed and pass it to PM. <br/>
			If not complete, pass it to developer. <br/>
			As a PM, check it, accept it and mark as done. Then it won't come to anybody's screen anymore.<br/>
			</p>
	</body></html>
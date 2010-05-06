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
		
		$fieldNames = array("ID","Project","Sprint","Item List","Unique ID","Title","Priority","Estimate(hr)","How to demo","Note","Status","Assign to","Remaining (hr)");
		
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
		
		include("../lib/addedittable.php");
		?>
	</body></html>
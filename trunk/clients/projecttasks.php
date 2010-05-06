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
		<?

		if($_GET["itemid"])
		{
			$wheref = "itemid";
			$where = $_GET["itemid"];
			echo "<h1>Manage Tasks: ".select_field("items where id=$where","name")."</h1>";
		}
		$tableName="tasks";
		
		$fieldShow[2] = $fieldEdit[2]["content"] = table_to_array_addedit("emp where jobstatus=0 and type=1 or type=2");;
		$fieldShow[6] = $fieldEdit[6]["content"] = array("","Todo","In progress","In review","Done");
		$fieldEdit[2]["type"]=$fieldEdit[6]["type"]="__SELECT";
		
		
//		$required = "0,1,6,7";
//		$urls[1]="projectdetails.php?id=__ID";
		
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
	</body></html>
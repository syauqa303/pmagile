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
<h1>Project Stats</h1>
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
			
			$q = "SELECT dt as Date, SUM( remaining ) as Remaining, sum(spent) as Spent
FROM item_hour
WHERE id
IN (

SELECT MAX( item_hour.id ) 
FROM items,  `item_hour` 
WHERE items.id = item_hour.itemid
AND items.projectid =$projectID
GROUP BY item_hour.dt, item_hour.itemid
)
GROUP BY dt DESC 
LIMIT 10;";
			table($q);
		}
		else
		{
			echo "Project id not found!";
		}
		
		?>
	</body></html>
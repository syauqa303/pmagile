<?
include_once("../lib/include.php");
include_once("login.php");

$userid = $_SESSION["userid"];

if($_POST)
{
	$q = mysql_query("select id,name,remaining from items where userid=$userid");
	while($r = mysql_fetch_array($q))
	{
		$remaining = $_POST["remaining"][$r["id"]];
		$spent = $_POST["spent"][$r["id"]];
		$itemid = $r["id"];
		$itemname = $r["name"];
		if(is_numeric($remaining)==true && is_numeric($spent)==true)
		{
			//echo "Update items set remaining=$remaining where id=".$r["id"];
			mysql_query("Update items set remaining=$remaining where id=".$r["id"]);
			//echo "insert item_hour (userid,estimate,remaining,spent,itemid,dt,note) values ($userid,{$r["remaining"]},$remaining,$spent,{$r["id"]},{$_POST["date"][$r["id"]]},'{$_POST["note"][$r["id"]]}')";
			mysql_query("insert item_hour (userid,estimate,remaining,spent,itemid,dt,note,from_time,to_time) values ($userid,{$r["remaining"]},$remaining,$spent,{$r["id"]},'{$_POST["date"][$r["id"]]}','{$_POST["note"][$r["id"]]}','{$_POST["from"][$r["id"]]}','{$_POST["to"][$r["id"]]}')");
			if(mysql_error()=="")echo "$itemid <b>$itemname</b> has been updated<br/>";
			else echo mysql_error();
		}
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to User Section</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../common.css" rel="stylesheet" type="text/css">
</head>

<body>
<form method="post">
<table>
	<tr style="background-color:#888;color:#FFF">
		<td>Project</td>
		<td>Item</td>
		<td>Est.</td>
		<td>Spent </td>
		<td>Remaining </td>
		<td>Details </td>
		<td>Date </td>
		<td>From</td>
		<td>To</td>
		<td>Importance</td>
	</tr>
<?
//show the project name, task name,  hours remaining, input box for hours spent, input box for hours remaining, input box for note, input box for date
$q = mysql_query("select items.id as id, projects.name as projectname, items.name as itemname, items.remaining,items.estimate,items.importance,projects.id as projectid  from items,projects where items.projectid=projects.id and userid=$userid and items.status<>6 order by importance desc");
$i=0;
while($r = mysql_fetch_array($q))
{
	$i++;
	echo "<tr ".($i%2==0?"style=\"background-color:#EEE\"":"").">";
	echo "<td><a target=_blank href=projectdetails.php?pid={$r["projectid"]}>".$r["projectname"]."</a></td>";
	echo "<td><a target=_blank href=projectitems.php?action=edit&id={$r["id"]}&projectid={$r["projectid"]}>".$r["itemname"]."</a></td>";
	echo "<td>".$r["remaining"]."/".$r["estimate"]."</td>";
	echo "<td><input size=4 name=spent[{$r["id"]}]></td>";
	echo "<td><input size=4 name=remaining[{$r["id"]}]></td>";
	echo "<td><input name=note[{$r["id"]}]></td>";
	echo "<td><input name=date[{$r["id"]}] size=10 value=\"".date("Y-m-d")."\"></td>";
	echo "<td><input name=from[{$r["id"]}] size=5 ></td>";
	echo "<td><input name=to[{$r["id"]}] size=5 ></td>";
	echo "<td>".$r["importance"]."</td>";
	echo "</tr>";
}
?>
	</table>
	<input name="Submit" value="Submit" type="submit">
</form>
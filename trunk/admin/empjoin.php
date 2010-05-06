<? include("top.php"); ?>
<?
$q = mysql_query("select emp.name,emp.joiningdate,DATEDIFF(CURDATE(),emp.joiningdate),id from emp where jobstatus=0");

echo "<table border=1>";
while($r = mysql_fetch_array($q))
{
	echo "<tr><td>".$r[3]."</td><td>".$r[0]."</td><td>".$r[1]."</td><td>".($r[2]/30.4)."</td></tr>";
}
echo "<table>";

//echo date("d-m-Y",select_field("userworktime where userid=25","min(starttime)"));
?>
<? include("bottom.php"); ?>
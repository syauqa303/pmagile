<?
/*
configuration -------------------------------------
 $tableName="gamesdownload"; //this is the table where addition deletion will occur
 $wheref="categoryid";  
 $where = $_GET[$wheref];
 $addedit_xtra=" | <a target=\"_blank\" href=gamesdownloadimg.php?id=".$id.">Manage Image</a>";
 function addeditxtra($id){
	return " | <a target=\"_blank\" href=gamesdownloadimg.php?id=".$id.">Manage Image</a>";
 }
 make_select_table("gamesdownloadcategory",$wheref,$_GET[$wheref]); 
*/
?>

<script src="../scripts.js"></script>
<table width="100%"  border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td>
      <?
$opageName = $_SERVER['PHP_SELF'];
$pageName = $_SERVER['PHP_SELF'];

// remember to use full table and column sequence, bcoz edit is needed;
if($wheref){
	$whereq = " where $wheref='$where'";
}

$oquery = "select * from $tableName";
$fullQuery = "select * from $tableName ".$whereq;


if(@$_GET["order"])
{
	$pageName .= "?order=".$_GET["order"];
	$fullQuery .= " order by ".$_GET["order"];
	if(@$_GET["desc"])$fullQuery .=" desc";
}




$result = mysql_query($fullQuery);
$postaction=$pageName;
if($wheref)$postaction.="?$wheref=$where";
?>
      <form name="form1" method="post" action="<?=$postaction?>">
        <?








if(@$_POST["action"]=="add"){
	$addstr = "insert into $tableName values (0 ";
		for($i=1;$i< mysql_num_fields($result);$i++)
			$addstr .= ",'" . $_POST["input$i"] . "'";
	$addstr .= ")";
//	echo $addstr;
	$add = mysql_query($addstr);
	$result = mysql_query($fullQuery);
}

else if(@$_POST["action"]=="edit")
{
	$result = mysql_query($oquery);
	$editstr = "update $tableName set ";
	for($i=1;$i< mysql_num_fields($result);$i++)
	{
		if($_POST["edit$i"]!="") $editstr .=  mysql_field_name($result,$i)."='" . $_POST["edit$i"] . "', ";
	}
	$editstr = substr($editstr,0,strlen($editstr)-2);
	$editstr .= " where id=".$_POST["id"];
	//echo $editstr;
	$add = mysql_query($editstr);
	$result = mysql_query($fullQuery);
}

else if(@$_GET["action"]=="del")
{
	$add = mysql_query("delete from $tableName where id=".$_GET["id"]);
	$result = mysql_query($fullQuery);
}













$i = 0;
$cl = 0;
echo "<table border=0 cellpadding=3 cellspacing=0>";


echo "<tr>";
echo "<td>";
for($i=0;$i< mysql_num_fields($result);$i++)
{
	
	if(mysql_field_name($result,$i)!=$wheref){
	echo "<tr>";
	echo "<td>\n"
	?>
        <table border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="center">
                <?=mysql_field_name($result,$i)?>
            </div></td>
          </tr>
        </table>
        <? echo "\n</td>";echo "</tr>";
	}
}

echo "</table>";
echo "</td>";
echo "<td>";
echo "<table border=0 cellpadding=3 cellspacing=0>";







//################################## this is add part ###############################
if(@$_GET["action"]!="edit")
{
	echo "<tr><td>0<input type=hidden name=action value=add></td></tr>";

		for($i=1;$i<mysql_num_fields($result);$i++ ){
			if(mysql_field_name($result,$i)!=$wheref){
			echo "<tr>";
			echo "<td>";
			if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)>25)
				echo "<input type=text size=30 maxlength=".mysql_field_len($result,$i)." name=input$i>";
			else if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)<25)
				echo "<input type=text size=".(mysql_field_len($result,$i)+5)." maxlength=".mysql_field_len($result,$i)." name=input$i>";
			else if(mysql_field_type($result,$i)=="blob")
				echo "<textarea name=input$i  cols=\"30\" rows=\"2\"></textarea>";
			else if(mysql_field_type($result,$i)=="date")
				echo "<input type=text size=8 name=input$i value=".date("Y-m-d").">";
			else
				echo "<input type=text name=input$i>";
			echo "</td>";
			echo "</tr>";
			}
			else{ $hiddenstr =  "<input name=input$i type=hidden value=$where>";}
		}
	echo "<tr><td><input type=Submit name=submit value=Add>$hiddenstr</td></tr>";
}













//#################################  whole construction  ################################   pmedia media23 
while ($rows = mysql_fetch_row($result) ) {
    echo "<tr ";
	if($cl%2==0) echo "bgcolor=#cccccc";
	echo ">";
	$cl++;
	if(@$_GET["action"]=="edit" && @$_GET["id"]==$rows[0])
	{	
		echo	"<td><a name=ab href=$postaction>Reset</a><input type=hidden name=id value=$rows[0]><input type=hidden name=action value=edit></td>";
		
		for($i=1;$i<mysql_num_fields($result);$i++ ){
			if(mysql_field_name($result,$i)!=$wheref){
			echo "<td>";
			if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)>25)
				echo "<input type=text size=30 maxlength=".mysql_field_len($result,$i)." name=edit$i value=\"$rows[$i]\">";
			else if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)<25)
				echo "<input type=text size=".(mysql_field_len($result,$i)+5)." maxlength=".mysql_field_len($result,$i)." name=edit$i value=\"$rows[$i]\">";
			else if(mysql_field_type($result,$i)=="blob")
				echo "<textarea name=edit$i  cols=\"30\" rows=\"4\">$rows[$i]</textarea>";
			else
				echo "<input type=text name=edit$i value=\"$rows[$i]\">";
			echo "</td>";
			}else{ $hiddenstr =  "<input name=input$i type=hidden value=$where>";}

		}
		echo "<td><input type=Submit Name=Submit Value=Edit>$hiddenstr</td></tr>";
	}
	else
	{
		if($wheref)$where_xtra="&$wheref=$where";
		if($addedit_xtra)$addedit_xtra = addeditxtra($rows[0]);
		else $where_xtra="";
		for($i=0;$i<mysql_num_fields($result);$i++ )
			if(mysql_field_name($result,$i)!=$wheref)
			echo "<td><a href=$opageName?action=edit&id=$rows[0]$where_xtra>$rows[$i]</a></td>";
		$id=$rows[0];
		echo "<td><nobr><a href=\"javascript:confirmgo('$opageName?action=del&id=$rows[0]$where_xtra','Are you sure you want to delete?')\">Delete</a>$addedit_xtra</nobr></td></tr>";
	}
}


echo "</table>";
?>
        <p></p>
    </form></td>
  </tr>
</table>
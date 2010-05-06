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
		$fieldNames = array("Id","Heading","Date","Content");
		$hrefs = array();
		$hrefs[1]="<a href=\"news.php?id=__ID&action=details\" >";

 make_select_table("gamesdownloadcategory",$wheref,$_GET[$wheref]); 



 
 
*************************** changes in new ver ...beta 0.9 ********************************
22-09-05
added paging

26-01-06
edit $noedit, if $noedit=true set, edit option won't come
and <Enter> key works now, so formatting is working ok
*/
?>
<script language="javascript">
function confirmgo(url,mes){
	if(confirm(mes))document.location.href=url;
}

function checkMe(){
	args = arguments;
	error=true;
	for(i=1;i<args.length;i++){
		if(document.addeditform[args[0]+args[i]].value==""){
			alert("Please fillup all required fields");
			error = false;
			break;
		}
	}
	return error;
}
</script>
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
if ($filter) {
	if ($whereq) {
		$whereq .= " and $filter";
	}else {
		$whereq = " where $filter";
	}
}
$oquery = "select * from $tableName ";
$fullQuery = "select * from $tableName ".$whereq;


if(@$_GET["order"])
{
	$pageName .= "?order=".$_GET["order"];
	$fullQuery .= " order by ".$_GET["order"];
	if(@$_GET["desc"])$fullQuery .=" desc";
}

$requiredArrayT = explode(",",$required);
for($i=0;$i<count($requiredArrayT);$i++){
	$requiredArray[(int)$requiredArrayT[$i]]=true;
}


$result = mysql_query($fullQuery);
$postaction=$pageName;
if($wheref)$postaction.="?$wheref=$where";
?>

        <?








if(@$_POST["action"]=="add"){
	$addstr = "insert into $tableName values (0 ";
	for($i=1;$i< mysql_num_fields($result);$i++){
		if ($fieldEdit[$i]["type"]=="__IMAGE" || $fieldEdit[$i]["type"]="__FILE") {
			if($_FILES["file$i"]["name"]!=""){
				$tm = time();
				$ext = substr($_FILES["file$i"]["name"],strpos($_FILES["file$i"]["name"],".")+1);
				copy($_FILES["file$i"]["tmp_name"],"../".$fieldEdit[$i]["location"].$tm.".".$ext);
				if ($fieldShow[$i]["thumb"]==true) {
					copyimg($_FILES["file$i"]["tmp_name"],"../".$fieldEdit[$i]["location"].$tm."_thumb.".$ext,200,100);	
				}
				$addstr .=  ",'" . "../".$fieldEdit[$i]["location"].$tm.".".$ext . "' ";
			}else {
				$addstr .= ",'" . $_POST["input$i"] . "'";
			}
		}else {
			$addstr .= ",'" . $_POST["input$i"] . "'";
		}
	}
	$addstr .= ")";
//		echo $addstr;
	$add = mysql_query($addstr);
	
	$newinsertid=mysql_insert_id();
//	echo $newinsertid."sdkfjsdkfjksdhfkjdshfkdjhk";
	$result = mysql_query($fullQuery);
//	if($_POST["againadd"]=="true"){
//		$_GET["action"]="doadd";
//	}
}

else if(@$_POST["action"]=="edit")
{
	$result = mysql_query($oquery);
	$editstr = "update $tableName set ";
	for($i=1;$i< mysql_num_fields($result);$i++)
	{
		if ($fieldEdit[$i]["type"]=="__IMAGE" || $fieldEdit[$i]["type"]=="__FILE") {
//			echo "image";
			if($_FILES["file$i"]["name"]!=""){
				$tm = time();
				$ext = substr($_FILES["file$i"]["name"],strpos($_FILES["file$i"]["name"],".")+1);
				copy($_FILES["file$i"]["tmp_name"],"../".$fieldEdit[$i]["location"].$tm.".".$ext);
				if ($fieldShow[$i]["thumb"]==true) {
					copyimg($_FILES["file$i"]["tmp_name"],"../".$fieldEdit[$i]["location"].$tm."_thumb.".$ext,200,100);	
				}
				$editstr .=  mysql_field_name($result,$i)."='" . "../".$fieldEdit[$i]["location"].$tm.".".$ext . "', ";
			}
		}else {
			if($_POST["edit$i"]!="") $editstr .=  mysql_field_name($result,$i)."='" . $_POST["edit$i"] . "', ";
			else $editstr .=  mysql_field_name($result,$i)."=NULL, ";
//			echo "normal";
		}
	}
	$editstr = substr($editstr,0,strlen($editstr)-2);
	$editstr .= " where id=".$_POST["id"];
	/*echo "<pre>";
	print_r($fieldEdit);
	echo "</pre>";
	echo $editstr;*/
	$add = mysql_query($editstr);
	$result = mysql_query($fullQuery);
}

else if(@$_GET["action"]=="del")
{
	$query = mysql_query("select * from $tableName where id=".$_GET["id"]);
	for($i=1;$i< mysql_num_fields($result);$i++)
	{
		if ($fieldEdit[$i]["type"]=="__IMAGE" || $fieldEdit[$i]["type"]="__FILE") {
			if ($row_temp=mysql_fetch_array($query)) {
				if (file_exists($row_temp[$i])) {
					unlink($row_temp[$i]);
				}
				if (file_exists(thumb_name($row_temp[$i]))) {
					unlink(thumb_name($row_temp[$i]));
				}
			}
		}
	}
	
	$add = mysql_query("delete from $tableName where id=".$_GET["id"]);
	$result = mysql_query($fullQuery);
}












$serial = 0;
$i = 0;
$cl = 0;
if($wheref)$where_xtra="&$wheref=$where";
if ($_GET["action"]=="" || $_GET["action"]=="list" || $_GET["action"]=="del") {
	
	$result = page($fullQuery,20);
	$serial += 20*$_POST["pageNo"];
}
?>
      <form name="addeditform" method="post" action="<?=$postaction?>" enctype="multipart/form-data">
<?
if($_GET["action"]=="" || $_GET["action"]=="list" || $_GET["action"]=="del"){
	echo "<table class=listTable cellpadding=3 cellspacing=0 width=\"100%\">";
	
	echo "<tr>";
	for($i=0;$i<mysql_num_fields($result);$i++)
	{
		if(mysql_field_name($result,$i)!=$wheref && strpos(strtolower(mysql_field_name($result,$i)),"pass")===false){
			$addDecor="";
			if ($fieldShowWidth[$i]) {
				$addDecor=" width= ".$fieldShowWidth[$i];
			}
			if($dontShow[$i]==true)continue;
			echo "<td class=listHeader $addDecor>\n";
			?>
				<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
				  <tr>
					<td>
						<? if(count($fieldNames)>0)echo $fieldNames[$i]; 
						else echo mysql_field_name($result,$i);
						?>
					</td>
				  </tr>
				</table>
			<? echo "\n</td>";
		}
	}
	if($noedit!=true)echo "<td class=listHeader width=50><div align=right>Modify</div></td>";
	echo "</tr>";
	
	while ($rows = mysql_fetch_row($result) ) {
		echo "<tr ";
		if($cl%2==0) echo "class=listEvenCell";
		else echo "class=listOddCell";
		echo ">";
		$cl++;
		
		$id=$rows[0];
		
		if($addedit_xtra)$addedit_xtra = addeditxtra($rows[0]);
		else $addedit_xtra="";
		for($i=0;$i<mysql_num_fields($result);$i++ )
			if(mysql_field_name($result,$i)!=$wheref && strpos(strtolower(mysql_field_name($result,$i)),"pass")===false){
			if($dontShow[$i]==true)continue;
				
				$rows[$i]=str_replace("\n","<br>",$rows[$i]); //replacing /n with br so that enter works
				
				if ($fieldShow[$i]=="__FILE") {
					if (file_exists($rows[$i])) {
						$fvalue = "<a href=\"".$rows[$i]."\">Download"."</a>";
					}else $fvalue = "&nbsp;";
				}else if ($fieldShow[$i]=="__IMAGE" && $fieldShow[$i]["thumb"]!=true){
					if (file_exists($rows[$i])) {
						$fvalue = "<a href=\"".$rows[$i]."\" target=\"_blank\"><img border=0 height=100 src=\"".$rows[$i]."\"/>"."</a>";
					}
					else $fvalue="&nbsp;";
				}else if ($fieldShow[$i]=="__IMAGE" && $fieldShow[$i]["thumb"]==true){
					if (file_exists($rows[$i])) {
						$fvalue = "<a href=\"".$rows[$i]."\" target=\"_blank\"><img border=0 height=100 src=\"".thumb_name($rows[$i])."\"/>"."</a>";
					}
					else $fvalue="&nbsp;";
				}
				else if(is_array($fieldShow[$i])){
					$fvalue = $fieldShow[$i][$rows[$i]];
				}
				else $fvalue = $rows[$i];
				
				if ($i==0) {
					$fvalue = ++$serial;
				}
				if($urls[$i]){
					$href = str_replace("__ID",$id,$urls[$i]);
					echo "<td class=listTD><a href=\"".$href."\">$fvalue</a></td>";
				}
				else{
				 echo "<td class=listTD>$fvalue</td>";
				}
				
			}
		$id=$rows[0];
		$pageinfo = "";
		if ($_POST["pageNo"]) {
			$pageinfo .= "&page=".$_POST["pageNo"];
		}
		if($noedit!=true)
		echo "<td class=listTD><nobr><a href=$opageName?action=edit$pageinfo&id=$rows[0]".$where_xtra.">Edit</a> | <a href=\"javascript:confirmgo('$opageName?action=del&id=$rows[0]$where_xtra','Are you sure you want to delete?')\">Delete</a>$addedit_xtra</nobr></td></tr>";
	}
	
	
	echo "
	<tr><td colspan=".($i+1)." align=right><a href=$opageName?action=doadd&".$where_xtra.">Add new</a></td></tr>
	</table>
	";

}







//################################## this is add part ###############################
else if(@$_GET["action"]=="doadd")
{
	echo "<table class=addTable>";
		$hiddenstr = "";
		for($i=1;$i<mysql_num_fields($result);$i++ ){
			if(mysql_field_name($result,$i)!=$wheref){
			if($dontAdd[$i]==true){
				if ($defaultValue[$i]) {
					$hiddenstr .=  "<input name=input$i type=hidden value=\"".$defaultValue[$i]."\">";
				}
				continue;
			}
			
			echo "<tr><td valign=top class=editHeader>";
			if(count($fieldNames)>0)echo $fieldNames[$i]; 
			else echo mysql_field_name($result,$i);
			echo "</td><td class=editTD>";
			if(strpos(strtolower(mysql_field_name($result,$i)),"pass")!==false)$type="password";
			else $type="text";
			
			if($defaultValue[$i])$type.=" value=\"".$defaultValue[$i]."\"";
			
			//	echo "<input type=password size=15 maxlength=".mysql_field_len($result,$i)." name=input$i>";
			
			if($fieldEdit[$i]){
				if($fieldEdit[$i]["type"]=="__SELECT"){
					make_select_array_addedit($fieldEdit[$i]["content"],"input$i",$defaultValue[$i],"Select");
				}else if($fieldEdit[$i]["type"]=="__RADIO"){
					make_radio_array_addedit($fieldEdit[$i]["content"],"input$i",$defaultValue[$i],"Select");
				}elseif ($fieldEdit[$i]["type"]=="__IMAGE"|| $fieldEdit[$i]["type"]=="__FILE") {
					?><input type="file" name="file<?=$i?>" id="file<?=$i?>" ><?
				}
			}
			else{
				if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)>25)
					echo "<input type=$type size=30 maxlength=".mysql_field_len($result,$i)." name=input$i>";
				else if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)<25)
					echo "<input type=$type size=".(mysql_field_len($result,$i)+5)." maxlength=".mysql_field_len($result,$i)." name=input$i>";
				else if(mysql_field_type($result,$i)=="blob")
					echo "<textarea name=input$i  cols=\"30\" rows=\"2\"></textarea>";
				else if(mysql_field_type($result,$i)=="date")
					echo "<input type=text size=15 name=input$i value=".date("Y-m-d").">";
				else
					echo "<input type=text name=input$i>";
			}			
			
			//required field
			if($requiredArray[$i])echo "<font color=red><sup>*</sup></font>";
			if ($note[$i]) {
				echo "<br><div class=note>".$note[$i]."</div>";
			}
			echo "</td></tr>";


			}
			else{ $hiddenstr .=  "<input name=input$i type=hidden value=$where>";}
		}
//				$againaddcheck = $_POST["againadd"]=="true"?"Checked":"";
//		echo "<tr><td class=addHeader>&nbsp;</td><td class=addTD><input type=Checkbox name=againadd $againaddcheck value=true>Add another after this
//	</td></tr>";

	echo "<td class=addHeader>&nbsp;</td><td class=addTD><input type=Submit name=submit value=Add ";
	if ($required) {
	 	echo "onClick=\"return checkMe('input',".$required.");\"";
	 } echo ">$hiddenstr
	<input type=hidden name=action value=add>
	</td></tr></table>";
	if($required)echo "<table><tr><td><p><font color=red size=1>[*] means required fields</font></p></td></tr></table>";
}













else if(@$_GET["action"]=="edit")
{	
	echo	"<table class=editTable>";
	$q = $oquery." where id=".$_GET["id"];
	$result=mysql_query($q);
	$rows = mysql_fetch_array($result);
	$hiddenstr="";
	for($i=1;$i<mysql_num_fields($result);$i++ ){
		if(mysql_field_name($result,$i)!=$wheref){
		
			if($dontEdit[$i]==true){
				$hiddenstr.="<input type=hidden name=edit$i value=\"$rows[$i]\">";
				continue;
			}
		
			echo "<tr><td class=editHeader>";
			if(count($fieldNames)>0)echo $fieldNames[$i]; 
			else echo mysql_field_name($result,$i);
			echo "</td><td class=editTD>";
			if(strpos(strtolower(mysql_field_name($result,$i)),"pass")!==false)$type="password";
			else $type="text";
			
			if($fieldEdit[$i]){
				if($fieldEdit[$i]["type"]=="__SELECT")make_select_array_addedit($fieldEdit[$i]["content"],"edit$i",$rows[$i],"Select Ringtone type");
				else if($fieldEdit[$i]["type"]=="__RADIO")make_radio_array_addedit($fieldEdit[$i]["content"],"edit$i",$rows[$i],"Select Ringtone type");
				elseif ($fieldEdit[$i]["type"]=="__IMAGE"|| $fieldEdit[$i]["type"]=="__FILE") {
					?><input type="file" name="file<?=$i?>" id="file<?=$i?>" ><?
				}
			}
			else{
				if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)>25)
					echo "<input type=$type size=30 maxlength=".mysql_field_len($result,$i)." name=edit$i value=\"$rows[$i]\">";
				else if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)<25)
					echo "<input type=$type size=".(mysql_field_len($result,$i)+5)." maxlength=".mysql_field_len($result,$i)." name=edit$i value=\"$rows[$i]\">";
				else if(mysql_field_type($result,$i)=="blob")
					echo "<textarea name=edit$i  cols=\"30\" rows=\"4\">$rows[$i]</textarea>";
				else
					echo "<input type=text name=edit$i value=\"$rows[$i]\">";
			}
			
			if($requiredArray[$i])echo "<font color=red><sup>*</sup></font>";
			echo "</td></tr>";
		}else{ $hiddenstr .=  "<input name=edit$i type=hidden value=$where>";}

	}
	echo "<tr><td colspan=2>&nbsp;</td></tr>";
	echo "<td class=editHeader>&nbsp;</td><td class=editTD><input type=Submit Name=Submit Value=\"Commit Change\"";
	
	if ($required) {
		echo " onClick=\"return checkMe('edit',".$required.");\"";
	}
	
	echo ">$hiddenstr ";
	if ($_GET["page"]) {
		echo "<input type=hidden name=pageNo value=".$_GET["page"].">";
		$postaction .= "&pageNo=".$_GET["page"];
	}
	echo "<a name=ab href=$postaction>Back to list</a><input type=hidden name=id value=$rows[0]><input type=hidden name=action value=edit>
	</td></tr></table>";
	if($required)echo "<table><tr><td><p><font color=red size=1>[*] means required fields</font></p></td></tr></table>";
}






else if(@$_GET["action"]=="details")
{	
	echo	"<table cellspacing=0 cellpadding=5 class=viewTable >";
	$q = $oquery." where id=".$_GET["id"];
	$result=mysql_query($q);
	$rows = mysql_fetch_array($result);
	for($i=1;$i<mysql_num_fields($result);$i++ ){
		if(mysql_field_name($result,$i)!=$wheref){
			echo "<tr><td class=viewHeader>";
			if(count($fieldNames)>0)echo $fieldNames[$i]; 
			else echo mysql_field_name($result,$i);
			echo "</td><td class=viewTD>";
			echo $rows[$i];
			echo "</td></tr>";
		}else{ $hiddenstr =  "<input name=edit$i type=hidden value=$where>";}

	}
	echo "<td class=viewHeader>&nbsp;</td><td class=viewTD><a href=$opageName?action=edit&id=$id".$where_xtra.">Edit</a> | <a name=ab href=$postaction>Back</a> 
	</td></tr></table>";
}



function make_select_array_addedit($tbl,$slct,$ed="",$mode=""){
	echo "<select name=\"$slct\">";
	/*if($mode!=""){
		echo "<option selected value=0>$mode</option>";
		$i=1;
	}else{ 
		$i=0;
	}*/
	//for($i=0;$i< count($tbl) ; $i++)
	while (list($i,$vl) = each($tbl))
		if($ed!=$i)echo "	<option value=\"".$i."\">".$tbl[$i]."</option>";
		else echo "	<option selected value=\"".$i."\">".$tbl[$i]."</option>";
	echo "</select>";
}
function make_radio_array_addedit($tbl,$slct,$ed="",$mode=""){
//	echo "<select name=\"$slct\">";
//	if($mode!=""){
//		echo "<option selected value=0>$mode</option>";
//		$i=1;
//	}else{ 
//		$i=0;
//	}
	for($i=1;$i< count($tbl) ; $i++)
		if($ed!=$i)echo "<input type=radio name=\"$slct\" id=\"".$slct."$i\" value=\"".$i."\">".$tbl[$i];
		else echo "	<input checked type=radio name=\"$slct\" id=\"".$slct."$i\" value=\"".$i."\">".$tbl[$i];
//	echo "</select>";
}

function thumb_name($src){
	return substr($src,0,strlen($src)-4)."_thumb".substr($src,strlen($src)-4);
}

?>
        <p></p>
    </form></td>
  </tr>
</table>
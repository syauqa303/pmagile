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
		$urls = array();
		$urls[1]="just_url.php?id=__ID";

 make_select_table("gamesdownloadcategory",$wheref,$_GET[$wheref]); 



//Handling Image
$fieldShow[2]["thumb"]=true;
$fieldShow[2]["type"]="__IMAGE";

$fieldEdit[2]["type"]="__IMAGE";
$fieldEdit[2]["location"]="_img/";

//showing word type interface
$fieldEdit[2]["type"]="__WORD";

//showing red star required
$requiredarray[$no]=true;

//showing a note under input 
$note[2]="Ja khushi tai";
 
 
*************************** changes in new ver ...beta 0.9 ********************************
22-09-05
added paging

26-01-06
edit $noedit, if $noedit=true set, edit option won't come
and <Enter> key works now, so formatting is working ok

03-02-06
$noadd=true, would do same kind as $noedit ...

19-03-06
Upload progressbar

21-03-06
Deleting file while deleting a row

24-03-06
$fieldEdit[$noOfField]["type"]="__WORD";
would provide you a word like page

31-03-06
Fixed a bug in add
*/


/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
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
if($postaction)
	$postaction=$pageName.$postaction;
else
	$postaction=$pageName;
	
if($wheref)$postaction.="?$wheref=$where";
?>

<?

if(@$_POST["action"]=="add"){
	//echo "adding ... <br>";
	
	//var_dump($_POST);
	
	$addstr = "insert into $tableName values (0 ";
	for($i=1;$i< mysql_num_fields($result);$i++){
		if ($fieldEdit[$i]["type"]=="__IMAGE" || $fieldEdit[$i]["type"]=="__FILE") {
			if($_FILES["file$i"]["name"]!=""){
				$tm = time();
				$ext = substr($_FILES["file$i"]["name"],strpos($_FILES["file$i"]["name"],".")+1);
				if($fieldEdit[$i]["sizex"] && $fieldEdit[$i]["sizey"])
					copyimg($_FILES["file$i"]["tmp_name"],"../".$fieldEdit[$i]["location"].$tm.".".$ext,$fieldEdit[$i]["sizex"],$fieldEdit[$i]["sizey"]);
				else
					copy($_FILES["file$i"]["tmp_name"],"../".$fieldEdit[$i]["location"].$tm.".".$ext);
					
				if ($fieldShow[$i]["thumb"]==true) {
					copyimg($_FILES["file$i"]["tmp_name"],"../".$fieldEdit[$i]["location"].$tm."_thumb.".$ext,100,150);	
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
	
		//echo "test->" . $addstr;
		//exit;
		
	$add = mysql_query($addstr);
	
	$newinsertid=mysql_insert_id();
	
	/* 
	if($newinsertid){
		if($sendnewsletter == true){
		
			$newsletter_qry 	= mysql_query("SELECT * FROM newsletter WHERE id = '$newinsertid'");
			$newsletter_res     = mysql_fetch_array($newsletter_qry);
			$newsletter			= substr($newsletter_res['path'],2);
			$qry = "SELECT * FROM newsletter_user WHERE status = 'true'";
			$res = mysql_query($qry);
			while($data = mysql_fetch_array($res)){
				$url  = "http://" . $_SERVER['HTTP_HOST'] ."/unsubscribe.php?email=" . $data["email"];
				$a 	  = "<a href=\"". $url . "\">" . unsubscribe . "</a>";
				$pdf  = "http://" . $_SERVER['HTTP_HOST'] . $newsletter; 
				$link = "<a href=\"". $pdf . "\">" . $pdf . "</a>";
				$message = file_get_contents('../email_template/newsletter.txt');
				
				$message = str_replace("##customername##",$data['name'], $message);
				
				$message = str_replace("##unsubscribelink##",$a, $message);
				
				$message = str_replace("##link##",$link, $message);
				
				$subject = "citycell newsletter";
				
				$from	 = "customerservice@citycell.com";
				mymail($data["email"],$subject,$message,$from);
				//echo $data["email"] . "<br />";
				//echo $subject . "<br />";
				//echo $message . "<br />";
				//echo $from . "<br />";
			}
		}
	}
	*/
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
					copyimg($_FILES["file$i"]["tmp_name"],"../".$fieldEdit[$i]["location"].$tm."_thumb.".$ext,100,150);	
				}
				$editstr .=  '`'.mysql_field_name($result,$i)."`='" . "../".$fieldEdit[$i]["location"].$tm.".".$ext . "', ";
			}
		}else {
			if($_POST["edit$i"]!="") $editstr .=  "`".mysql_field_name($result,$i)."`='" . $_POST["edit$i"] . "', ";
			else $editstr .=  "`".mysql_field_name($result,$i)."`=NULL, ";
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
	
	
		if($tableName == "sales"){
		$user_id = $_SESSION['userid'];
		$user_name = fetch_array("users where id=$user_id",$field="*"); 
		$username = $user_name['firstname'] . " " . $user_name['lastname'];

		//var_dump($username);
		//echo "UPDATE $tableName SET attendedBy = '$username' WHERE id='$_POST[id]'";
		mysql_query("UPDATE $tableName SET attendedBy = '$username' WHERE id='$_POST[id]'") or die(mysql_error());
		
		if($_POST['edit20'] == 'Lost' || $_POST['edit20'] == 'Sold'){
			$curr_date = date("Y-m-d H:i:s",mktime(date("H")+13, date("i"), date("s"), date("m") , date("d"), date("Y")));
			
			//echo "UPDATE $tableName SET closing_date = '$curr_date' WHERE id='$_POST[id]'";
			mysql_query("UPDATE $tableName SET closing_date = '$curr_date' WHERE id='$_POST[id]'") or die(mysql_error());
			
		}
	}
	
	
}

else if(@$_GET["action"]=="del")
{
	$query = mysql_query("select * from $tableName where id=".$_GET["id"]);
	for($i=1;$i< mysql_num_fields($result);$i++)
	{
		//echo "$i <br>";
		if ($fieldEdit[$i]["type"]=="__IMAGE" || $fieldEdit[$i]["type"]=="__FILE") {
			//echo "File found ".$fieldEdit[$i]["type"];
			if ($row_temp=mysql_fetch_array($query)) {
				//echo "Data Found ".$row_temp[$i];
				if (file_exists($row_temp[$i])) {
					unlink($row_temp[$i]);
					//echo "Deleting file ".$row_temp[$i];
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
$where_xtra = str_replace(" ","%20",$where_xtra);

if ($_GET["action"]=="" || $_GET["action"]=="list" || $_GET["action"]=="del") {
	
	$result = page($fullQuery,$addedit_paging?$addedit_paging:20);
	$serial += 20*$_POST["pageNo"];
}
?>
      <form name="addeditform" method="post" action="<?=$postaction?>" enctype="multipart/form-data" onsubmit="upload()">
	  				<script language="javascript">
					filediv = new Array();
					fileinput = new Array();
					function upload(){
						var si = setInterval( function(){
							var obs = document.getElementsByTagName("input");
							for(var i=0;i<obs.length;i++)
							{
								obs[i].disabled = true;
							}
						},100);
						
						for(var i=0;i<fileinput.length;i++){
							if(fileinput[i].value){
								//alert(ob1.value);
								filediv[i].style.display="";
							}
						}
						//return false;
						//return true;
					}
					</script>

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
					<td class=listHeader >
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
				
				if(mysql_field_name($result,$i) == "code")
					$rows[$i] = substr(htmlspecialchars($rows[$i]), 0, 150) . ". . .";
				
				$rows[$i]=str_replace("\n","<br>",$rows[$i]); //replacing /n with br so that enter works
				
				if ($fieldShow[$i]=="__FILE") {
					if (file_exists($rows[$i])) {
						$fvalue = "<a href=\"".$rows[$i]."\">Download"."</a>";
					}else $fvalue = "&nbsp;";
				}else if ($fieldShow[$i]["type"]=="__IMAGE" && $fieldShow[$i]["thumb"]!=true){
					if (file_exists($rows[$i])) {
						$fvalue = "<a href=\"".$rows[$i]."\" target=\"_blank\"><img border=0 height=100 src=\"".$rows[$i]."\"/>"."</a>";
					}
					else $fvalue="&nbsp;";
				}else if ($fieldShow[$i]["type"]=="__IMAGE" && $fieldShow[$i]["thumb"]==true){
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
					//$fvalue = ++$serial;   ************************************************************************
					$fvalue = $rows[$i];
				}
				if($urls[$i]){
					if($urls[$i] == "self")
						echo "<td class=listTD><a href=\"".$fvalue."\" target=\"blank\">$fvalue</a></td>";
					else{
						$href = str_replace("__ID",$id,$urls[$i]);
						echo "<td class=listTD><a href=\"".$href."\">$fvalue</a></td>";
					}
					
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
		echo "<td class=listTD><nobr><a href=$opageName?action=edit$pageinfo&id=$rows[0]".$where_xtra.">Edit</a>";
		if($nodelete!=true)	echo "| <a href=\"javascript:confirmgo('$opageName?action=del&id=$rows[0]$where_xtra','Are you sure you want to delete?')\">Delete</a>$addedit_xtra</nobr></td></tr>";
	}
	
	
	if($noadd!=true)echo "<tr><td colspan=".($i+1)." align=right><a href=$opageName?action=doadd&".$where_xtra.">Add new</a></td></tr>";
	
	echo "</table>";

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
					?>
					<?
				}else if($fieldEdit[$i]["type"]=="__RADIO"){
					make_radio_array_addedit($fieldEdit[$i]["content"],"input$i",$defaultValue[$i],"Select");
					?>
					<?
				}else if($fieldEdit[$i]["type"]=="__WORD"){
//					echo "<input type='text' value='' name=''/>";
					include_once("FCKeditor/fckeditor.php");
/// Including FCKEditor


// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/FCKeditor/' ;	// '/FCKeditor/' is the default value.
//$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = FOLDER."/lib/FCKeditor/";//substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
//

$tFCKeditor = new FCKeditor('input'.$i) ;

$tFCKeditor->ToolbarSet = "Default";
$tFCKeditor->Height = 500;
$tFCKeditor->BasePath = $sBasePath;
if($defaultValue[$i])
$tFCKeditor->Value = $defaultValue[$i];
$tFCKeditor->Create();



/// End of Including FCKEditor

				}elseif ($fieldEdit[$i]["type"]=="__IMAGE"|| $fieldEdit[$i]["type"]=="__FILE") {
					?><input type="file" name="file<?=$i?>" id="file<?=$i?>" >
					<div id="fileuploading<?=$i?>" >
					<script language="javascript">
					ob = document.getElementById("fileuploading<?=$i?>");
					ob.style.display="none";
					ob1 = document.getElementById("file<?=$i?>");
					filediv.push(ob);
					fileinput.push(ob1);
					</script>
					  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="99" height="10">
                        <param name="movie" value="<?=FOLDER?>/lib/progress.swf" />
                        <param name="quality" value="high" />
                        <embed src="<?=FOLDER?>/lib/progress.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="99" height="10"></embed>
				      </object>
					</div>
					<?
				}
			}
			else{
					?>
					<?
				if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)>25)
					echo "<input type=$type size=30 maxlength=".mysql_field_len($result,$i)." name=input$i>";
				else if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)<25)
					echo "<input type=$type size=".(mysql_field_len($result,$i)+5)." maxlength=".mysql_field_len($result,$i)." name=input$i>";
				else if(mysql_field_type($result,$i)=="blob")
					echo "<textarea name=input$i  cols=\"30\" rows=\"2\"></textarea>";
				else if(mysql_field_type($result,$i)=="date"){
					echo "<input type=text size=15 name=input$i value=".date("Y-m-d").">";
					echo "<a href=\"javascript:cal$i.popup();\"><img src=\"img/cal.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"Click Here to Pick up the date\"></a>";
					echo "<script language=\"javascript\">var cal$i = new calendar3(document.forms['addeditform'].elements['input$i']);</script>";
						
				}
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
			else{
				$hiddenstr .=  "<input name=input$i type=hidden value=\"$where\">";}
		}
//				$againaddcheck = $_POST["againadd"]=="true"?"Checked":"";
//		echo "<tr><td class=addHeader>&nbsp;</td><td class=addTD><input type=Checkbox name=againadd $againaddcheck value=true>Add another after this
//	</td></tr>";

	echo "<td class=addHeader>&nbsp;</td><td class=addTD><input type=Submit name=submit value=Add ";
	if ($required) {
	 	echo "onClick=\"return checkMe('input',".$required.");\"";
	 } echo ">$hiddenstr
	<input type=hidden name=action value=add> <a href=".$_SERVER["PHP_SELF"]."?".str_replace("action=doadd","",$_SERVER["QUERY_STRING"]) .">Cancel</a>
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
				else if($fieldEdit[$i]["type"]=="__WORD"){
					//echo "<input type='text' name='edit$i'>";
					include_once("FCKeditor/fckeditor.php");
										
					/// Including FCKEditor
					
					
					// Automatically calculates the editor base path based on the _samples directory.
					// This is usefull only for these samples. A real application should use something like this:
					// $oFCKeditor->BasePath = '/FCKeditor/' ;	// '/FCKeditor/' is the default value.
					//$sBasePath = $_SERVER['PHP_SELF'] ;
					$sBasePath = FOLDER."/lib/FCKeditor/"; //substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
					$tFCKeditor = new FCKeditor('edit'.$i); //$tFCKeditor->Config['CustomConfigurationsPath'] = $sBasePath.'/myconfig.js'  ;
					
					$tFCKeditor->ToolbarSet = "Default";
					$tFCKeditor->Height = 500;
					$tFCKeditor->BasePath = $sBasePath;
					$tFCKeditor->Value = $rows[$i];
					$tFCKeditor->Create();
					
					
					
					/// End of Including FCKEditor
					
				}
				elseif ($fieldEdit[$i]["type"]=="__IMAGE"|| $fieldEdit[$i]["type"]=="__FILE") {
					?><input type="file" name="file<?=$i?>" id="file<?=$i?>" >
					
					<div id="fileuploading<?=$i?>" >
					<script language="javascript">
					ob = document.getElementById("fileuploading<?=$i?>");
					ob.style.display="none";
					ob1 = document.getElementById("file<?=$i?>");
					filediv.push(ob);
					fileinput.push(ob1);
					</script>
					  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="99" height="10">
                        <param name="movie" value="<?=FOLDER?>/lib/progress.swf" />
                        <param name="quality" value="high" />
                        <embed src="<?=FOLDER?>/lib/progress.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="99" height="10"></embed>
				      </object>
					</div>

					<?
				}
			}
			else{
				if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)>25)
					echo "<input type=$type size=30 maxlength=".mysql_field_len($result,$i)." name=edit$i value=\"$rows[$i]\">";
				else if(mysql_field_type($result,$i)=="string" && mysql_field_len($result,$i)<25)
					echo "<input type=$type size=".(mysql_field_len($result,$i)+5)." maxlength=".mysql_field_len($result,$i)." name=edit$i value=\"$rows[$i]\">";
				else if(mysql_field_type($result,$i)=="blob")
					echo "<textarea name=edit$i  cols=\"30\" rows=\"4\">$rows[$i]</textarea>";
				else if(mysql_field_type($result,$i)=="date"){
					echo "<input type=text size=15 name=edit$i value=".$rows[$i].">";
					echo "<a href=\"javascript:cal$i.popup();\"><img src=\"img/cal.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"Click Here to Pick up the date\"></a>";
					echo "<script language=\"javascript\">var cal$i = new calendar3(document.forms['addeditform'].elements['edit$i']);</script>";
						
				}
				else
					echo "<input type=text name=edit$i value=\"$rows[$i]\">";
			}
			
			if($requiredArray[$i])echo "<font color=red><sup>*</sup></font>";
			echo "</td></tr>";
		}else{
			$hiddenstr .=  "<input name=edit$i type=hidden value=\"$where\">";}

	}
	
	//trying to add iframe
	//if($iframe)	echo "<tr><td colspan=2><iframe src=$iframe height=50 frameborder=0></iframe></td></tr>";
	
	
	
	
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
		//if($dontShow[$i]==true)continue;
		
		if(mysql_field_name($result,$i)!=$wheref){
			echo "<tr><td class=viewHeader>";
			if(count($fieldNames)>0)echo $fieldNames[$i]; 
			else echo mysql_field_name($result,$i);
			echo "</td><td class=viewTD>";
			echo $rows[$i];
			echo "</td></tr>";
		}else{
			$hiddenstr =  "<input name=edit$i type=hidden value=\"$where\">";}

	}
	echo "<td class=viewHeader>&nbsp;</td><td class=viewTD>";
	if(!$noedit)echo "<a href=$opageName?action=edit&id=$id".$where_xtra.">Edit</a> | ";
	echo "<a name=ab href=$postaction>Back</a></td></tr></table>";
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
	
	if($tbl[0])$starti=0;
	else $starti = 1;
	for($i=$starti;$i< count($tbl) ; $i++)
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
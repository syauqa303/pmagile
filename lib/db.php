<?
/*

************************ changes last made **********************
22-09-05
Fixed a bug in paging

*/


if(!$dbcon=mysql_connect(DB_HOST,DB_USER,DB_PASS)){
	echo "couldn't connect mysql";
	exit;
}
if(!mysql_select_db(DB)){
	echo "couldn't connect database";
	exit;
}


//creates the select query
function select($tbl,$field="*"){
	if($_SESSION["debug"]==true)echo "select $field from $tbl";
	return $q = mysql_query("select $field from $tbl");
}

function fetch_array($tbl,$field="*"){
	$r = mysql_fetch_array(select($tbl,$field));
//	print_r($r);
	return $r;
}
//checks if this sql exists
function data_exist($sql){
	$q = mysql_query($sql);
	if(mysql_num_rows($q))return true;
	else return false;
}

//returns the value of a field
function select_field($tbl,$field){
	$q = select($tbl,$field);
	if($r = mysql_fetch_array($q))return $r[0]?$r[0]:"0";
	else return "0";
}

//counts the fieldNames number
function get_count($tblName,$fieldName,$xtra="")
{
	$sql = mysql_query("select count($fieldName) from $tblName $xtra");
	$row = mysql_fetch_row($sql);
	return $row[0];
}


//$sql query to execute
//$num=number of rows to show
function page($sql,$num=10){
	$pg=mysql_query($sql);
	if($pg)
	$norow =  mysql_num_rows($pg);
	$nopage = ceil($norow/$num);
	if(!$_POST["pageNo"])$pageNo = 0;
	else $pageNo = $_POST["pageNo"];
	$sqlq = $sql . " limit ".$pageNo*$num.",$num";//.(($pageNo+1)*$num);
//	echo $sqlq;
	if($nopage>1){
		echo "<scr"."ipt language=\"javascript\">function gopage(num){";
		echo "	document.forms['pageform'].pageNo.value=num;";
		echo "	document.forms['pageform'].submit();";
		echo "}</script>";
		echo "
		<table border=0 cellpadding=0 cellspacing=3 width=100% bgcolor=#DDDDDD><form name=\"pageform\" method=\"post\">
			<tr>
				<td width=\"30%\"><input type=\"hidden\" name=\"pageNo\">";
		$hl = ($pageNo+1)*$num<$norow?($pageNo+1)*$num:$norow;
		echo "Listing ".($pageNo*$num+1)."-".$hl." of ".$norow."</td>
				<td align=center width=\"40%\">";
		
		for($i=0;$i<$nopage;$i++){
			if($tp+$i<$nopage){
				if($tp+$i==$pageNo) echo $tp+$i+1;
				else  echo "<a href=\"javascript:gopage(".($tp+$i).")\">".($tp+$i+1)."</a>";
				
				if($tp+$i+1<$nopage)echo ", ";
				else {echo " <a href=\"javascript:gopage(".($tp+$i).")\"> >> </a> of <a href=\"javascript:gopage(".($nopage-1).")\">".($nopage)."</a>";}
			}
			else break;
		}
		
		echo "</td><td align=right width=\"30%\">";
		if($pageNo>0)echo "<a href=\"javascript:gopage(".($pageNo-1).")\">Previous</a>  ";
		if($pageNo<$nopage-1)echo "<a href=\"javascript:gopage(".($pageNo+1).")\">Next</a>";
		
		echo "&nbsp;</td></tr></form></table>";
	}
	return mysql_query($sqlq);
}

//just return the country name
function country($code){
	$r = mysql_fetch_array( mysql_query("select country.country from country where code='$code'"));
	if($r)return $r[0];
	else return $code;
}

//return age
function age($dt){
	$dob = substr($dt,0,4);
	$cury = date("Y");
	$age = ($cury-$dob);
	if($age>0 && $age<100)
		return $age;
	else	return "Not given";
}


//$tble=table name e.g. users or users where type=admin
//$slct=<select name>
//$fldshow=which field to show
//$fldid=which value to return upon select
//#ed=if anything selected
//$order=if order by something
function make_select($tbl,$slct,$fldshow,$fldid="id",$ed="",$select="Select",$order="",$js="",$list="",$additional=""){
//	echo "select $fldid,$fldshow from $tbl $order";
	if($js!="")
	echo "<select name=\"$slct\" $list onchange=\"document.form1.submit()\">";
	else
	echo "<select name=\"$slct\" $list>";
	if(empty($ed))echo "	<option selected value=0>$select</option>";
	else echo "	<option value=\"\">Select</option>";
	if($additional!="") echo "<option value=\"$additional\">$additional</option>";
	if($order)$order="order by $order";
	$msq = mysql_query("select $fldid,$fldshow from $tbl $order");
	
	while($msr = mysql_fetch_row($msq))
		if($ed!=$msr[0])echo "	<option value=\"".$msr[0]."\">".$msr[1]."</option>";
		else echo "	<option selected value=\"".$msr[0]."\">".$msr[1]."</option>";
	
	echo "</select>";
}

//if you need to insert value of a table into an array
//$tbl=table name
//$id=array's id
//$value=array's value
//example: returns an array like this array[$id]=value
function into_array($tbl,$id=0,$value=1){
	$ara = array();
	$arq = mysql_query("select * from $tbl");
	//echo "select * from $tbl";
	while($arr = mysql_fetch_array($arq)){
		$ara[$arr[$id]]=$arr[$value];
		//echo $arr[$value];
	}
	return $ara;
}

function table_to_array_addedit($tableName,$field="name",$id="id",$select="Select"){
	$qtemp = mysql_query("select $id,$field from $tableName");
	//echo "select $id,$field from $tableName";
	$result = array($select);
	while ($row_temp = mysql_fetch_row($qtemp)) {
		$result[$row_temp[0]]=$row_temp[1];
	}
	return $result;	
}

//returns all id of a query
//necessary for subqueries
function get_all_id($query){
	$ids="";
	while($tr = mysql_fetch_array($query)){
		$ids.=$tr[0].",";
	}
	return $ids;
}


/*insertData to a table
return insertID
param: tableName
MUST USE inputName same as fieldName to insert
if any error $_SESSION["errortxt"] will contiain the insert string */

function insert_data($tbl){
	$fl = "";
	$str = "";
	$utable = mysql_query("select * from $tbl ");
	$o = 0;
	while($ur = mysql_fetch_field($utable)){
		if(!empty($_POST[$ur->name])){
			$fl  .= "`".$ur->name."`,";
			$str .= "'".str_replace("'","''",$_POST[$ur->name])."',";
		}
	}
	$fl = substr($fl,0,strlen($fl)-1);
	$str = substr($str,0,strlen($str)-1);
	$uq = mysql_query("insert into $tbl    ($fl) values( ".$str.")");
	if (mysql_affected_rows()==1) {
		return mysql_insert_id();
	}
	else {
		$_SESSION["errortxt"] = "insert into $tbl ($fl) values( ".$str.")";
		return "";
	}
}


function update_data($tbl,$field,$value){
	$fl = "";
	$str = "";
	$utable = mysql_query("select * from $tbl ");
	$o = 0;
	while($ur = mysql_fetch_field($utable)){
		if(!empty($_POST[$ur->name])){
			$str .= $ur->name."='".$_POST[$ur->name]."',";
		}
	}
	$str = substr($str,0,strlen($str)-1);
	$uq = mysql_query("update $tbl  set ".$str." where ".$field."='".$value."'");
	if (mysql_affected_rows()==1) {
		return true;
	}
	else {
		$_SESSION["errortxt"] = "update $tbl  set ".$str." where ".$field."='".$value."'";
		return false;
	}
}

function table($q)
{
	if(is_string($q))
	{
		$q = mysql_query($q);
	}
	
	if(mysql_error())
	{
		echo mysql_error();
		exit;
	}
	
	echo "<table class=listTable cellpadding=3 cellspacing=0 width=\"100%\">";
	echo "<tr>";
	for($i=0;$i<mysql_num_fields($q);$i++)
	{
		echo "<td class=listHeader>".mysql_field_name($q,$i)."</td>";
	}
	echo "</tr>";
	
	$i=0;
	while($r = mysql_fetch_row($q))
	{
		$i++;
		echo "<tr ".($i%2!=0?"bgcolor=#eeeeee":"").">";
		foreach($r as $value)
			echo "<td>$value</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
<?
function checkbox($name,$vl,$label,$style="",$flv="1"){
	if($vl==$flv)$ch="checked";
	return "<input type=\"checkbox\" value=\"$vl\" $ch id=\"$name\" $style name=\"$name\"><label $style for=\"$name\">$label</label>";
}

function radio($name,$vl,$label,$style="",$flv="1"){
	if($vl==$flv)$ch="checked";
	$rnd=rand()*10;
	return "<input type=\"radio\" value=\"$vl\" $ch id=\"$name_$rnd\" $style name=\"$name\"><label $style for=\"$name_$rnd\">$label</label>";
}

function selected($vl,$flv){
	if($vl==$flv)return "selected";
	else return "";
}


//function that will make select combo and 
//from array $tbl, named $slct and selected value is $ed and $mode=all will return 
function make_select_array($tbl,$slct,$ed="",$mode=""){
	echo "<select name=\"$slct\">";
	if($mode!=""){
		echo "<option selected value=0>$mode</option>";
		$i=1;
	}else{ 
		$i=0;
	}
	for(;$i< count($tbl) ; $i++)
		if($ed!=$i)echo "	<option value=\"".$i."\">".$tbl[$i]."</option>";
		else echo "	<option selected value=\"".$i."\">".$tbl[$i]."</option>";
	echo "</select>";
}

function create_link($url,$name,$class="",$selectedclass=""){
	//echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
	$len = strpos($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'],$url) + strlen($url);
	//strpos($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'],$url)===false
	
	if ($_SERVER['QUERY_STRING']) {
		$totalurl=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
	}else {
		$totalurl=$_SERVER['PHP_SELF'];
	}
	
//	echo strlen($totalurl) - $len ;
		
	if ((strlen($totalurl) - $len)==0 && strpos($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'],$url)!==false) {
		if ($selectedclass) {
			$class = "class=\"$selectedclass\"";
		}
		echo "<span $class>$name</span>";
		
	}else {
		if ($class) {
			$class = "class=\"$class\"";
		}
		echo "<a href=\"$url\" $class>$name</a>";
	}
	
}

//create_link("url","name","clsdf");
?>
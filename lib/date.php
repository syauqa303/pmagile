<?

//to enter in database
//outDate("23-06-2005","-") returns "2005-06-23"
function outDate($dt,$sep="-"){
	if(strlen($dt)==10)
	return substr($dt,6,4).$sep.substr($dt,3,2).$sep.substr($dt,0,2);
	else return $dt;
}

//to show from database
//showDate("2005-06-20")=>20.06.2005
function showDate($dt,$sep="."){
	if(strlen($dt)==10)
	echo substr($dt,8,2).$sep.substr($dt,5,2).$sep.substr($dt,0,4);
	else echo $dt;
}

//to Show date in specified format
//default 
function dateFormat($date,$type="l F d, Y  "){
	$strt = strtotime($date);
	return date($type,$strt);
}


//returns time 11:23 PM
function timeFormat($time,$type="h:i A"){
	$strt = strtotime($time);
	return date($type,$strt );
}


//echoes January 23,2005
function dateFormat1($date){
	$strt = strtotime($date);
	return date("F d, Y  ",$strt);
}

//return date and time both
function dateTimeFormat($date){
	$strt = strtotime($date);
	echo date("d/m/Y h:i A",$strt);
}

//returns time 11:23 PM
function timeFormat1($time){
	$strt = strtotime($time);
	echo date("h:i A",$strt );
}



function create_select_month($inputName,$sd=""){
	if($sd){
		$sm = $sd;
	}else{
		$sm=date("m");
		$sy=date("Y");
		$sd=date("d");
	}
	$txt = "<select name=\"".$inputName."\" id=\"".$inputName."\">";
	$month = array("","January","February","March","April","May","June","July","August","September","October","Novemver","December");
	for($i=1;$i<13;$i++){
		$txt .= "<option ".selected($i,$sm)." value=\"$i\">".$month[$i]."</option>";
	}
	$txt .= "</select>";
	return $txt;
}


function create_select_year($inputName,$sd="",$futureYear=0,$pastYear=10){
	if($sd){
		$sy = $sd;
	}else{
		$sm=date("m");
		$sy=date("Y");
		$sd=date("d");
	}
	$year = 0;
	$year += date("Y");
	$txt = "<select name=\"".$inputName."\" id=\"".$inputName."\">";
	if($futureYear==0)
		for($i=$year;$i>($year-$pastYear);$i--){
			$txt .= "<option ".selected($i,$sy)." value=\"$i\">".$i."</option>";
		}
	else
		for($i=$year;$i<($year+$futureYear);$i++){
			$txt .= "<option ".selected($i,$sy)." value=\"$i\">".$i."</option>";
		}
	$txt .= "</select>";
	return  $txt;
}

//it returns a <select><option> --  type for date,
//inputName = what will be the name of <select>
//sd = selected date
//futureYear = if not past but future year is needed then set how many years you want to show
function create_select_date($inputName,$sd="",$futureYear=0){
	if($sd){
		$sm = substr($sd,5,2);
		$sy = substr($sd,0,4);
		$sd = substr($sd,8,2);
	}else{
		$sm=date("m");
		$sy=date("Y");
		$sd=date("d");
	}
	$txt = "<select onChange=\"updateHiddenfield('$inputName')\" name=\"".$inputName."Month\" id=\"".$inputName."Month\">";
	$month = array("","January","February","March","April","May","June","July","August","September","October","Novemver","December");
	for($i=1;$i<13;$i++){
		$txt .= "<option ".selected($i,$sm)." value=\"$i\">".$month[$i]."</option>";
	}
	$txt .= "</select>/";
	$txt .= "<select onChange=\"updateHiddenfield('$inputName')\" name=\"".$inputName."Day\" id=\"".$inputName."Day\">";
	for($i=1;$i<32;$i++){
		$txt .= "<option ".selected($i,$sd)." value=\"$i\">".$i."</option>";
	}
	$txt .= "</select>/";
	$txt .= "<select onChange=\"updateHiddenfield('$inputName')\" name=\"".$inputName."Year\" id=\"".$inputName."Year\">";
	$year = 0;
	$year += date("Y");
	if($futureYear==0)
		for($i=$year;$i>($year-100);$i--){
			$txt .= "<option ".selected($i,$sy)." value=\"$i\">".$i."</option>";
		}
	else
		for($i=$year;$i<($year+$futureYear);$i++){
			$txt .= "<option ".selected($i,$sy)." value=\"$i\">".$i."</option>";
		}
	$txt .= "</select>";
	$txt .= "<input type=hidden id=\"$inputName\" name=$inputName value=$sy-$sm-$sd>";
	return  $txt;
}


//$sd = selected time
function create_select_time($inputName,$sd=""){
	if($sd){
		$sh = substr($sd,0,2);
		$sm = substr($sd,3,2);
		if($sh>=12)$sa = "PM";
		else $sa = "AM";
		$sh%=12;
	}else{
		$sh=date("g");
		$sm=date("i");
		$sa=date("A");
	}
	$txt = "<select onChange=\"updateHiddenTime('$inputName')\" name=\"".$inputName."Hour\" id=\"".$inputName."Hour\">";
	for($i=1;$i<13;$i++){
		$txt .= "<option ".selected($i,$sh)." value=\"$i\">".$i."</option>";
	}
	$txt .= "</select>/";
	$txt .= "<select onChange=\"updateHiddenTime('$inputName')\" name=\"".$inputName."Minute\" id=\"".$inputName."Minute\">";
	for($i=1;$i<61;$i++){
		$txt .= "<option ".selected($i,$sm)." value=\"$i\">".$i."</option>";
	}
	$txt .= "</select>/";
	$txt .= "<select onChange=\"updateHiddenTime('$inputName')\" name=\"".$inputName."AM\" id=\"".$inputName."AM\">";
		$txt .= "<option ".selected("AM",$sa)." value=\"AM\">AM</option>";
		$txt .= "<option ".selected("PM",$sa)." value=\"PM\">PM</option>";

	$txt .= "</select>";
	$txt .= "<input type=hidden name=\"$inputName\" id=\"$inputName\" value=\"$sh:$sm:00\">";
	return  $txt;
}

?>
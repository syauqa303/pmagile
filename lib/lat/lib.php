<?
$offDay = "Sat";
$global_projectTypes = array("","On going","Complete","Paid","Cancelled","Paused");
//finds how much time this project took from this man
function user_project_time($userid,$projectid){
	$time = select_field("userprojectworktime where userid=".$userid." and projectid=".$projectid,"sum(endtime-starttime)");
	if ($time<0) {
		$time+=time();
	}
	$hr = floor($time/3600);
	$min = round(($time - $hr*3600)/60);
	return $hr." hours and $min minutes";
}

//how much hour and min diff between these two seconds
function time_diff($time1,$time2){
	$time = $time1 - $time2;
	if ($time<0) {
		$time+=time();
	}
	$hr = floor($time/3600);
	$min = round(($time - $hr*3600)/60);
	return $hr." hours and $min minutes";
}

$reason = array("","Software wasn't working","Server Down","I forgot");

if ($_SESSION["userid"]) {
	define("NAME",select_field("emp where id=".$_SESSION["userid"],"Name"));
}
?>
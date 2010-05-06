<? include("../lib/include.php"); ?>
<?
header('Content-Disposition: attachment; filename="report.xls"');

        $pid = $_GET["pid"];
        $uid = $_GET["uid"];

		$filter = "";
		if($uid)
		{
			$filter .= " and userid=$uid ";
		}
		if($_GET["startdate"])
		{
			$filter .= " and starttime> ".strtotime($_GET["startdate"]);
		}
		if($_GET["enddate"])
		{
			$filter .= " and endtime< ".strtotime($_GET["enddate"]);
		}
		
		if ($pid) {
		if($_GET["action"]=="delete")
		{
			mysql_query("delete from userprojectworktime where id=".$_GET["id"]);
		}
        $query = mysql_query("select starttime,endtime,name,details from userprojectworktime,emp where userprojectworktime.userid=emp.id and projectid=$pid $filter");
              
			  echo "Date\tFrom\tTo\tEmpName\tDetails\tLength\n";
             
			$total = 0;
			$times = 0;
			while ($rows = mysql_fetch_array($query)){ 
				if(($rows["endtime"]-$rows["starttime"])>60 && date("d,M Y",$rows["starttime"])==date("d,M Y",$rows["endtime"])){
				$times++;
				echo date("d,M Y",$rows["starttime"])."\t".date("h:i A",$rows["starttime"])."\t".date("h:i A",$rows["endtime"]?$rows["endtime"]:"Working")."\t\"".$rows["name"]."\"\t\"'". $rows["details"]."\"\t".round( ($rows["endtime"]-$rows["starttime"])/3600,2)."\n";
				$total += $rows["endtime"]-$rows["starttime"];
				} //end if
			} 
echo round($total/3600,2)."\t".$times;
           }
		   ?>
<? include("top1.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Project work time </h1>
        <form action="" id="form1" name="form1" method="GET"><?
        $pid = $_GET["pid"];
        $uid = $_GET["uid"];
        ?>
        Select project <? make_select("projects","pid","name","id",$pid,"Select project","name"); ?>
        Select user <? make_select("emp where type=1","uid","Name","id",$uid,"Select user","Name"); ?>
        Start Date <input type="text" style="width:70px" value="<?=$_GET["startdate"]?$_GET["startdate"]:date("Y-m-d")?>" name="startdate"/>
        Start Date <input type="text" style="width:70px"  value="<?=$_GET["enddate"]?$_GET["enddate"]:date("Y-m-d")?>" name="enddate"/>
		<a href="javascript:document.location.href=document.location.href.replace('report_projecttime.php','report_projecttime_excl.php')">create</a>
        <br>
        <input type="submit" name="submit" value="View">
        <?
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
        $query = mysql_query("select userprojectworktime.id,starttime,endtime,name,details from userprojectworktime,emp where userprojectworktime.userid=emp.id and projectid=$pid $filter");
        print("select starttime,endtime,name,details from userprojectworktime,emp where userprojectworktime.userid=emp.id and projectid=$pid $filter");
 		?>
		<table width="100%" cellpadding="3" cellspacing="0" border="1" bordercolor="#ffffff">
            <tr>
              <td class="viewHeader">Date</td>
              <td class="viewHeader">From</td>
              <td class="viewHeader">To</td>
              <td class="viewHeader">Emp Name</td>
              <td class="viewHeader">Details</td>
              <td class="viewHeader">Length</td>
              <td class="viewHeader">Delete</td>
            </tr>
            <? 
			$total = 0;
			$times = 0;
			while ($rows = mysql_fetch_array($query)){ 
				if(($rows["endtime"]-$rows["starttime"])>60 && date("d,M Y",$rows["starttime"])==date("d,M Y",$rows["endtime"])){
				$times++;
				?>
				<tr>
				  <td ><?=date("d,M Y",$rows["starttime"])?></td>
				  <td ><a href="userprojectworktimestartedit.php?time=<?=$rows["starttime"]?>&empid=<?=$uid?>"><?=date("h:i A",$rows["starttime"])?></a></td>
				  <td ><a href="userprojectworktimeendedit.php?time=<?=$rows["endtime"]?>&empid=<?=$uid?>"><?=date("h:i A",$rows["endtime"]?$rows["endtime"]:"Working")?><a></td>
				  <td ><?=$rows["name"]?></td>
				  <td ><?=$rows["details"]?></td>
				  <td ><?= round( ($rows["endtime"]-$rows["starttime"])/3600,2) ?></td>
				  <td ><a href="javascript:if(confirm('sure?'))document.location.href='<?="?uid=".$_GET["uid"]."&pid=".$_GET["pid"]."&id=".$rows["id"]."&action=delete"?>'">X</a> | <a href=# onclick="javascript:window.open('edittime.php?id=<?=$rows["id"]?>','et','width=300, height=200');">E</a></td>
				</tr>
				<? 
				$total += $rows["endtime"]-$rows["starttime"];
				} //end if
			} 
			?>
          </table>
		  <br/>Total time: <?=round($total/3600,2)?>
		  <br/>Occurances: <?=$times?>
          <? } ?>
          </form>
          <p>&nbsp; </p></td>
      </tr>
    </table><? include("bottom.php"); ?>
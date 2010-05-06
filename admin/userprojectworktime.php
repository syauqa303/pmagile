<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Project work time </h1>
        <form action="" id="form1" name="form1" method="GET"><?
        $pid = $_GET["pid"];
        $uid = $_GET["uid"];
        ?>
        Select project <? make_select("projects","pid","name","id",$pid,"Select project","name"); ?>
        <br>
        Select user <? make_select("emp where type=1","uid","Name","id",$uid,"Select user","Name"); ?>
        <br>
        <input type="submit" name="submit" value="View">
        <?
		if ($pid && $uid) {
		if($_GET["action"]=="delete")
		{
			mysql_query("delete from userprojectworktime where id=".$_GET["id"]);
		}
        $query = mysql_query("select * from userprojectworktime where userid=$uid and projectid=$pid order by starttime");
 		?>
		<table width="100%" cellpadding="3" cellspacing="0" border="1" bordercolor="#ffffff">
            <tr>
              <td width="20%" class="viewHeader">Date</td>
              <td width="30%" class="viewHeader">From</td>
              <td width="30%" class="viewHeader">To</td>
              <td width="30%" class="viewHeader">Details</td>
              <td width="20%" class="viewHeader">Length</td>
              <td width="20%" class="viewHeader">Delete</td>
            </tr>
            <? 
			$total = 0;
			$times = 0;
			while ($rows = mysql_fetch_array($query)){ 
				if(($rows["endtime"]-$rows["starttime"])>60 && date("d,M Y",$rows["starttime"])==date("d,M Y",$rows["endtime"])){
				$times++;
				?>
				<tr>
				  <td width="20%"><?=date("d,M Y",$rows["starttime"])?></td>
				  <td width="30%"><a href="userprojectworktimestartedit.php?time=<?=$rows["starttime"]?>&empid=<?=$uid?>"><?=date("h:i A",$rows["starttime"])?></a></td
				  <td width="30%"><a href="userprojectworktimeendedit.php?time=<?=$rows["endtime"]?>&empid=<?=$uid?>"><?=date("h:i A",$rows["endtime"]?$rows["endtime"]:"Working")?><a></td>
				  <td width="20%"><?=$rows["details"]?></td>
				  <td width="20%"><?= round( ($rows["endtime"]-$rows["starttime"])/3600,2) ?></td>
				  <td width="20%"><a href="javascript:if(confirm('sure?'))document.location.href='<?="?uid=".$_GET["uid"]."&pid=".$_GET["pid"]."&id=".$rows["id"]."&action=delete"?>'">X</a> | <a href=# onclick="javascript:window.open('edittime.php?id=<?=$rows["id"]?>','et','width=300, height=200');">E</a></td>
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
<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Project work time </p>
        <form action="" id="form1" name="form1" method="GET"><?
        $pid = $_GET["pid"];
        $uid = $_GET["uid"];
        ?>
        Select project <? make_select("projects","pid","name","id",$pid,"Select project","name"); ?>
        Select user <? make_select("emp where type=1","uid","Name","id",$uid,"Select user","Name"); ?>
        <input type="submit" name="submit" value="View">
        <?
		if ($pid && $uid) {
        $query = mysql_query("select * from userprojectworktime where userid=$uid and projectid=$pid");
 		?>
		<table width="100%" cellpadding="3" cellspacing="0" border="1" bordercolor="#ffffff">
            <tr>
              <td width="20%" class="viewHeader">Date</td>
              <td width="30%" class="viewHeader">From</td>
              <td width="30%" class="viewHeader">To</td>
              <td width="20%" class="viewHeader">Length</td>
            </tr>
            <? while ($rows = mysql_fetch_array($query)){ ?>
            <tr>
              <td width="20%"><?=date("d,M Y",$rows["starttime"])?></td>
              <td width="30%"><?=date("h:i A",$rows["starttime"])?></td>
              <td width="30%"><?=date("h:i A",$rows["endtime"]?$rows["endtime"]:"Working")?></td>
              <td width="20%"><?=time_diff($rows["endtime"],$rows["starttime"])?></td>
            </tr>
            <? } ?>
          </table>
          <? } ?>
          </form>
          <p>&nbsp; </p></td>
      </tr>
    </table><? include("bottom.php"); ?>
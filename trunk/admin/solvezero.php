<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Solve Zero problem  </h1>
		<?
		if($_GET["do"]=="solve"){
			//fixing endtime problem
			$q = mysql_query("select * from userworktime where endtime=0");
			while($r=mysql_fetch_array($q)){
				$update = mysql_query("update userworktime set endtime=starttime+60 where id=".$r[0]);
			}
			
			//fixing starttime problem
			$q = mysql_query("select * from userworktime where starttime=0");
			while($r=mysql_fetch_array($q)){
				$update = mysql_query("update userworktime set starttime=endtime-60 where id=".$r[0]);
			}
			
			//fixing endtime problem of projects
			$q = mysql_query("select * from userprojectworktime where endtime=0");
			while($r=mysql_fetch_array($q)){
				$update = mysql_query("update userprojectworktime set endtime=starttime+60 where id=".$r[0]);
			}
			
			//fixing starttime problem of projects
			$q = mysql_query("select * from userprojectworktime where starttime=0");
			while($r=mysql_fetch_array($q)){
				$update = mysql_query("update userprojectworktime set starttime=endtime-60 where id=".$r[0]);
			}
		}
		?>
		  <p><?=select_field("userprojectworktime where endtime=0 or starttime=0",count(id));?> problems found in project work time and <?=select_field("userworktime where endtime=0 or starttime=0",count(id));?> problems found in work time, <a href="?do=solve">solve</a></p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
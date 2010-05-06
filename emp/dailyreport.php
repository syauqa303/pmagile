<? include("top.php"); ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Daily Report</h1>
          <form name="form1" method="post" action="">
            <input name="dt" type="text" id="dt" value="<?=$_POST["dt"]?$_POST["dt"]:date("Y-m-d")?>"> 
            <input type="submit" name="Submit" value="Submit">
                              </form>          
			<? if($_POST["dt"]){ ?>
          <table width="500" border="1" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF">
            <tr>
              <td width="167">Name</td>
              <td width="63">Start time </td>
              <td width="74">End Time </td>
              <td width="66">Total Hour </td>
              <td width="68">Project Hour </td>
            </tr>
			<? 
			$q = mysql_query("select * from emp where type=1 or type=2");
			while($r = mysql_fetch_array($q)){ 
				$starttime = date("U",strtotime($_POST["dt"]));
				$endtime = date("U",strtotime($_POST["dt"])+3600*24);
				$rt = fetch_array("userworktime where starttime>$starttime and endtime<$endtime and endtime<>0 and userid=".$r["id"]." group by userid","min(starttime) as starttime, max(endtime) as endtime");
				//echo "userworktime where starttime>$starttime and endtime<$endtime and userid=".$r["id"];
				$project_time = fetch_array("userprojectworktime where starttime>$starttime and endtime<$endtime and endtime<>0 and userid=".$r["id"]." group by userid","sum(endtime - starttime) as pt");
				$pt = round($project_time[0]/3600,2);
				if($pt < 0){
					$pt = "Err";
				}else if($pt == 0){
					$pt = "";
				}
				//print_r($rt);
				//echo "<br/>";
				
			?>
            <tr>
              <td><?=$r["Name"]?>&nbsp;</td>
              <td><?=$rt["starttime"]?date("h:i A",$rt["starttime"]):"";?>&nbsp;</td>
              <td><?=$rt["endtime"]?date("h:i A",$rt["endtime"]):"";?>&nbsp;</td>
              <td><?=$rt["endtime"]?round(($rt["endtime"] - $rt["starttime"])/3600,2):"";?>&nbsp;</td>
              <td><?=$pt?>&nbsp;</td>
            </tr>
			<? 
			}
			?>
          </table>
		  <? } ?>
          <p>&nbsp;</p></td>
      </tr>
    </table>
<? include("bottom.php"); ?>
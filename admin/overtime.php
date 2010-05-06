<? include("top.php"); ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Overtime report </h1>
        <? 
        /*if (!$_POST["month"]) {
        	$_POST["month"]=date("m");
        	$_POST["year"]=date("y");
        }
        */
        ?>
        <form action="" id="form1" name="form1" method="POST">
        <?
		echo create_select_month("month",$_POST["month"])." ".create_select_year("year",$_POST["year"]);
        ?>
        <input type="submit" name="Submit" value="Show">
          </form>
          <? if ($_POST) {
          ?>
          <strong>Project report </strong>
          <? 
          $month = $_POST["month"];
          $year = $_POST["year"];
          $startTime = date("U",mktime(0,0,0,$_POST["month"],1,$_POST["year"]));
          $endTime = date("U",mktime(0,0,0,$_POST["month"],31,$_POST["year"]));
          
          $mdays = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
          ?>
          <table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#FFFFFF">
          	<tr>
          		<td>&nbsp;</td><? 
          		for ($date=1;$date<=$mdays[$month];$date++){
          			$style="";
          			$dayName = date("D",mktime(0,0,0,$month,$date,$year));
					if ($dayName==$offDay) {
						$style=" class=\"imp1\" ";
					}
          			echo "<td $style>$date</td>"; 
          		}?><td class="listHeader">&nbsp;</td>
          	</tr>
          	<tr>
          		<td>&nbsp;</td><? 
          		for ($date=1;$date<=$mdays[$month];$date++){
          			$style="";
          			$dayName = date("D",mktime(0,0,0,$month,$date,$year));
					if ($dayName==$offDay) {
						$style=" class=\"imp1\" ";
					}
          			echo "<td $style>$dayName</td>"; 
          		}?><td class="listHeader">Total</td>
          	</tr>
          	<? 
          	$userq = mysql_query("select * from emp where type!=3 and jobstatus!=1 order by Name");
          	
          	while ($row = mysql_fetch_array($userq)) {
          	 ?>
          	<tr>
          		<td><?=$row["Name"]?></td><? 
          		
          		//more than 9 hour is over time
          		$overHour=9;
          		//end
          		
          		
          		$userTotal=0;
          		$userOver = 0;
          		for ($date=1;$date<=$mdays[$month];$date++){
          			$style="";
          			$startTime = date("U",mktime(0,0,0,$_POST["month"],$date,$_POST["year"]));
          			$endTime = date("U",mktime(23,59,0,$_POST["month"],$date,$_POST["year"]));
          			$total = select_field("userworktime where starttime>$startTime and endtime<$endTime and endtime<>0 and userid=".$row["id"],"sum(endtime-starttime)");
					$userTotal += $total;
					$dayName = date("D",mktime(0,0,0,$month,$date,$year));
					$holiday = select_field("holiday where dt=$date and month=$month","id");
					if ($dayName==$offDay || $holiday) {
						$style=" class=\"imp1\" ";
						$over=$total;
					}else {
						$over = $total - $overHour*3600;
					}
					
					$style = $over>2?" bgcolor=red":$style;
					
					$over=$over>0?$over:0;
					$userOver += $over;
          			echo "<td $style >".round($total/3600,2)."/".round($over/3600,2)."</td>";
      			}
      			echo "<td  class=\"listHeader\">".round($userTotal/3600)."/".round($userOver /3600)."</td>";
      			?>
          	</tr>
          	<? } ?>
          </table>
          <?
          }
?>     </td>
      </tr>
    </table><? include("bottom.php"); ?>
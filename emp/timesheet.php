<? include("top.php"); ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Overtime report </h1>
        <? 
        if (!$_POST["month"]) {
        	$_POST["month"]=date("m");
        	$_POST["year"]=date("Y");
        }
        
        ?>
        <form action="" id="form1" name="form1" method="POST">
        <?
		echo create_select_month("month",$_POST["month"])." ".create_select_year("year",$_POST["year"]);
        ?>
        <input type="submit" name="Submit" value="Show">
          </form>
          <strong>Project report </strong>
          <? 
          $month = $_POST["month"];
          $year = $_POST["year"];
          $startTime = date("U",mktime(0,0,0,$_POST["month"],1,$_POST["year"]));
          $endTime = date("U",mktime(0,0,0,$_POST["month"],31,$_POST["year"]));
          
          $mdays = array(0,31,29,31,30,31,30,31,31,30,31,30,31);
          ?>
          <table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#FFFFFF">
		  	<tr class="listHeader">
				<td>Date</td>
				<td>Start</td>
				<td>End</td>
				<td>Total</td>
				<td>Overtime</td>
			</tr>
			<? 
			$userTotal=0;
			$userOver = 0;
			$dayTotal = 0;
			$dayPresent = 0;

			for ($date=1;$date<=$mdays[$month];$date++){
				$style="";
				$dayName = date("D",mktime(0,0,0,$month,$date,$year));
				if ($dayName=="Fri") {
					$style=" class=\"imp1\" ";
				}
				
				
				
				
				
				
				
				$userq = mysql_query("select * from emp where id=".$_SESSION["userid"]);
				if ($row = mysql_fetch_array($userq)) {
          	
          		//more than 9 hour is over time
          		$overHour=9;
          		//end
				$style="";
				$startTime = date("U",mktime(0,0,0,$_POST["month"],$date,$_POST["year"]));
				$todaytime = date("U",mktime(23,59,59,date("m"),date("d"),date("Y")));
				$endTime = date("U",mktime(23,59,0,$_POST["month"],$date,$_POST["year"]));


				$q = select("userworktime where starttime>$startTime and endtime<$endTime and endtime<>0 and userid=".$row["id"],"starttime,endtime");
				$over=0;
				$total=0;
				$times = 0;
				while($r = mysql_fetch_array($q)){
					if($total==0)$starttemp=$r[0];
					$total += $r[1]-$r[0]+1;
					$endtemp = $r[1];
					$times ++;
				}
				
				//echo "<td>".$r[0]."</td>"."<td>".$r[1]."</td>"."<td>".$r[0]."</td>"."<td>".$r[0]."</td>";
				
				
				
				$r[0]=$starttemp;
				$r[1]=$endtemp;

				$dayName = date("D",mktime(0,0,0,$month,$date,$year));
				$holiday = select_field("holiday where dt=$date and month=$month","id");
				
				if($total>0)
					if ($dayName=="Fri" || $holiday) {
						$style=" class=\"imp1\" ";
						$over=$r[1]-$r[0];
					}else {
						$over = $r[1]-$r[0] - $overHour*3600;
					}
				
				$style = $over>2?" bgcolor=red":$style;
				
				//$over=$over>0?$over:0;
				$userOver += $over;
				$userTotal += $total;
				
				if($style=="")$dayTotal ++ ;
				
				if($total==0){
					echo "<tr>";
					echo "<td $style>$date $dayName</td>"; 
					echo "<td $style >&nbsp;</td><td $style >&nbsp;</td><td $style >&nbsp;</td><td $style >&nbsp;</td>";
					echo "</tr>";
				}else{
					$dayPresent++;
					echo "<tr>";
					echo "<td $style>$date $dayName</td>"; 
					echo "<td $style >".date("h:i A",$r[0])."</td>"."<td $style >".date("h:i A",$r[1])."</td>"."<td $style >".time_diff($r[1],$r[0])."</td>"."<td $style >".round($over/3600,2)."</td>";
					echo "</tr>";
				}
				
				}
				
				
				
				
				
				
			}?>
			<tr class="listHeader">
		  	  <td><?=$dayTotal?></td>
		  	  <td><?=$dayPresent?></td>
		  	  <td>&nbsp;</td>
		  	  <td><?=round($userTotal/3600)?></td>
		  	  <td><?=round($userOver/3600)?></td>
		  	  </tr>
          </table>
     </td>
      </tr>
    </table><? include("bottom.php"); ?>
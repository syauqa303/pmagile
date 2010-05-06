<? include("top.php"); ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Monthly report </h1>
        <? 
        if (!$_POST["month"]) {
        	$_POST["month"]=date("m");
        	$_POST["year"]=date("y");
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
          $startTime = date("U",mktime(0,0,0,$_POST["month"],1,$_POST["year"]));
          $endTime = date("U",mktime(0,0,0,$_POST["month"],31,$_POST["year"]));
          $projectq = mysql_query("select distinct projectid from userprojectworktime where starttime>".$startTime." and endtime<".$endTime);
          $no=1;
//			echo "select distinct projectid from userprojectworktime where starttime>".$startTime."<br>";
//			echo time();
           ?>
          <table width="500" border="1" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF">
  <tr class="listHeader">
    <td width="10">Sl.</td>
    <td>Project</td>
    <td>Hour</td>
  </tr>
  <?
  $subtotal=0;
  while ($projectID = mysql_fetch_row($projectq)) {
//  	$proq = mysql_query("select ");
	if($projectID[0]!=0){
		  ?>
		  <tr <?=$no%2==0?"class=listOddCell":"";?>>
			<td width="10"><?=$no++;?></td>
			<td><a href="projectreport.php?pid=<?=$projectID[0]?>"><?=select_field("projects where id=".$projectID[0],"name")?></a></td>
			<td><?=$time = round($time=select_field("userprojectworktime where projectid=".$projectID[0]." and starttime>".$startTime." and endtime<".$endTime." and endtime<>0","sum(endtime-starttime)")/3600,2)?></td>
		  </tr>
		  <? 
	  }
  $subtotal+=$time;
  } ?>
  <tr class="listHeader">
    <td colspan="2"><div align="right">Total</div></td>
    <td><?=$subtotal?></td>
  </tr>
</table>
          <br>          
          <strong>User report [Project work] </strong> 
          <?
          $userq = mysql_query("select distinct userid from userprojectworktime where starttime>".$startTime." and endtime<".$endTime);
          $no=1;
//			echo "select distinct projectid from userprojectworktime where starttime>".$startTime."<br>";
//			echo time();
           ?>
          <table width="500" border="1" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF">
  <tr class="listHeader">
    <td width="10">Sl.</td>
    <td>Employee Name</td>
    <td>Hour</td>
  </tr>
  <?
  $subtotal=0;
  while ($userID = mysql_fetch_row($userq)) {
//  	$proq = mysql_query("select ");
  ?>
  <tr <?=$no%2==0?"class=listOddCell":"";?>>
    <td width="10"><?=$no++;?></td>
    <td><?=select_field("emp where id=".$userID[0],"Name")?></td>
    <td><?=$time = round(select_field("userprojectworktime where userid=".$userID[0]." and starttime>".$startTime." and endtime<".$endTime." and endtime<>0","sum(endtime-starttime)")/3600,2);?></td>
  </tr>
  <? 
  $subtotal+=$time;
  } ?>
  <tr class="listHeader">
    <td colspan="2"><div align="right">Total</div></td>
    <td><?=$subtotal?></td>
  </tr>
</table><br>          
          <strong>User report [Presence]</strong> 
          <?
          $userq = mysql_query("select id,Name from emp where type=1");
          $no=1;
//			echo "select distinct projectid from userprojectworktime where starttime>".$startTime."<br>";
//			echo time();
           ?>
          <table width="500" border="1" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF">
  <tr class="listHeader">
    <td width="10">Sl.</td>
    <td>Name</td>
    <td>Hour</td>
    <td>Total over time days</td>
  </tr>
  <?
  $subtotal1=0;
  $subtotal2=0;
  while ($userID = mysql_fetch_row($userq)) {
//  	$proq = mysql_query("select ");
  ?>
  <tr <?=$no%2==0?"class=listOddCell":"";?>>
    <td width="10"><?=$no++;?></td>
    <td><?=$userID[1]?></td>
    <td><?=$time1 = round(select_field("userworktime where userid=".$userID[0]." and starttime>".$startTime." and endtime<".$endTime." and endtime<>0","sum(endtime-starttime)")/3600,2);?></td>
    <td><?=$time2 = select_field("userworktime where userid=".$userID[0]." and starttime>".$startTime." and endtime<".$endTime." and (endtime-starttime)>36000"." and endtime<>0","count(id)")?></td>
  </tr>
  <? 
  $subtotal1+=$time1;
  $subtotal2+=$time2;
  } ?>
  <tr class="listHeader">
    <td colspan="2"><div align="right">Total</div></td>
    <td><?=$subtotal1?></td>
    <td><?=$subtotal2?></td>
  </tr>
</table></td>
      </tr>
    </table><? include("bottom.php"); ?>
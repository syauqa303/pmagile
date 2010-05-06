<? include("top.php"); ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Custom report </h1>
        <form action="" id="form1" name="form1" method="POST">
        Start Date <input type="text" name="startdate" value="<?=$_POST["startdate"]?$_POST["startdate"]:date("d-m-Y")?>"> End Date <input type="text" name="enddate" value="<?=$_POST["enddate"]?$_POST["enddate"]:date("d-m-Y")?>">
        <input type="submit" name="Submit" value="Show">
          </form>
          
          <? 
if ($_POST["startdate"]) {
	echo "<strong>Project report </strong>";
          $startTime = date("U",mktime(0,0,0,substr($_POST["startdate"],3,2),substr($_POST["startdate"],0,2),substr($_POST["startdate"],6,4)));
          $endTime = date("U",mktime(0,0,0,substr($_POST["enddate"],3,2),substr($_POST["enddate"],0,2),substr($_POST["enddate"],6,4)));
          $projectq = mysql_query("select distinct projectid from userprojectworktime where starttime>".$startTime." and endtime<".$endTime);
          $no=1;
//			echo "select distinct projectid from userprojectworktime where starttime>".$startTime."<br>";
//			echo time();

           ?>
          <table width="500" border="1" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF">
  <tr class="listHeader">
    <td>Sl.</td>
    <td>Project</td>
    <td>Hour</td>
  </tr>
  <?
  while ($projectID = mysql_fetch_row($projectq)) {
//  	$proq = mysql_query("select ");
  ?>
  <tr <?=$no%2==0?"class=listOddCell":"";?>>
    <td><?=$no++;?></td>
    <td><?=select_field("projects where id=".$projectID[0],"name")?></td>
    <td><?=round(select_field("userprojectworktime where projectid=".$projectID[0]." and starttime>".$startTime." and endtime<".$endTime,"sum(endtime-starttime)")/3600,2);?></td>
  </tr>
  <? } ?>
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
    <td>Sl.</td>
    <td>Project</td>
    <td>Hour</td>
  </tr>
  <?
  while ($userID = mysql_fetch_row($userq)) {
//  	$proq = mysql_query("select ");
  ?>
  <tr <?=$no%2==0?"class=listOddCell":"";?>>
    <td><?=$no++;?></td>
    <td><?=select_field("emp where id=".$userID[0],"Name")?></td>
    <td><?=round(select_field("userprojectworktime where userid=".$userID[0]." and starttime>".$startTime." and endtime<".$endTime,"sum(endtime-starttime)")/3600,2);?></td>
  </tr>
  <? } ?>
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
    <td>Sl.</td>
    <td>Name</td>
    <td>Hour</td>
    <td>Total over time days</td>
  </tr>
  <?
  while ($userID = mysql_fetch_row($userq)) {
//  	$proq = mysql_query("select ");
  ?>
  <tr <?=$no%2==0?"class=listOddCell":"";?>>
    <td><?=$no++;?></td>
    <td><?=$userID[1]?></td>
    <td><?=round(select_field("userworktime where userid=".$userID[0]." and starttime>".$startTime." and endtime<".$endTime,"sum(endtime-starttime)")/3600,2);?></td>
    <td><?=select_field("userworktime where userid=".$userID[0]." and starttime>".$startTime." and endtime<".$endTime." and (endtime-starttime)>36000","count(id)")?></td>
  </tr>
  <? } ?>
</table>
<? } ?>
</td>
      </tr>
    </table><? include("bottom.php"); ?>